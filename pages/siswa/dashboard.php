<?php
if (!defined('ROOTPATH')) {
    define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
}
include ROOTPATH . "/config/config.php";
include ROOTPATH . '/includes/header.php';
$nisFilter = $_SESSION['user']['nis'] ?? null;
$namaUser = $_SESSION['user']['nama_siswa'] ?? ($_SESSION['user']['nama'] ?? 'Pengguna');
$roleUser = $_SESSION['user']['role'] ?? 'user';

function esc($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function single_value($conn, $sql, $field = 'total')
{
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return 0;
    }
    $row = mysqli_fetch_assoc($result);
    return $row[$field] ?? 0;
}

$totalSiswa = single_value($conn, "SELECT COUNT(*) AS total FROM siswa");
$totalGuru = single_value($conn, "SELECT COUNT(*) AS total FROM guru WHERE status = 1");
$totalPelanggaran = single_value($conn, "SELECT COUNT(*) AS total FROM pelanggaran_siswa" . ($nisFilter ? " WHERE nis = " . (int) $nisFilter : ''));
$totalPoin = single_value($conn, "SELECT COALESCE(SUM(jp.poin),0) AS total
    FROM pelanggaran_siswa ps
    JOIN jenis_pelanggaran jp ON ps.id_jenis_pelanggaran = jp.id_jenis_pelanggaran" .
    ($nisFilter ? " WHERE ps.nis = " . (int) $nisFilter : ''));
$totalSurat = single_value($conn, "SELECT COUNT(*) AS total FROM surat_keluar" . ($nisFilter ? " WHERE nis = " . (int) $nisFilter : ''));
$totalPerjanjian = single_value($conn, "SELECT COUNT(*) AS total FROM perjanjian_orang_tua" . ($nisFilter ? " WHERE nis = " . (int) $nisFilter : ''));

$recentSql = "SELECT ps.tanggal, ps.nis, s.nama_siswa, jp.jenis, jp.poin, ps.keterangan
    FROM pelanggaran_siswa ps
    JOIN siswa s ON s.nis = ps.nis
    JOIN jenis_pelanggaran jp ON jp.id_jenis_pelanggaran = ps.id_jenis_pelanggaran" .
    ($nisFilter ? " WHERE ps.nis = " . (int) $nisFilter : '') .
    " ORDER BY ps.tanggal DESC LIMIT 5";
$recent = mysqli_query($conn, $recentSql);

$statusRows = [];
$statusResult = mysqli_query($conn, "SELECT status, COUNT(*) AS total FROM siswa GROUP BY status ORDER BY total DESC");
if ($statusResult) {
    while ($row = mysqli_fetch_assoc($statusResult)) {
        $statusRows[] = $row;
    }
}

$topSiswaRows = [];
$topSiswaSql = "SELECT s.nis, s.nama_siswa, COALESCE(SUM(jp.poin),0) AS total_poin, COUNT(ps.id_pelanggaran_siswa) AS total_kasus
    FROM siswa s
    LEFT JOIN pelanggaran_siswa ps ON ps.nis = s.nis
    LEFT JOIN jenis_pelanggaran jp ON jp.id_jenis_pelanggaran = ps.id_jenis_pelanggaran
    GROUP BY s.nis, s.nama_siswa
    HAVING total_poin > 0
    ORDER BY total_poin DESC, total_kasus DESC, s.nama_siswa ASC
    LIMIT 3";
$topSiswa = mysqli_query($conn, $topSiswaSql);
if ($topSiswa) {
    while ($row = mysqli_fetch_assoc($topSiswa)) {
        $topSiswaRows[] = $row;
    }
}

$cards = [
    [
        'label' => 'Total Siswa',
        'value' => $totalSiswa,
        'note' => 'Data master siswa',
        'tone' => 'bg-blue-50 text-blue-700 border-blue-100'
    ],
    [
        'label' => 'Guru Aktif',
        'value' => $totalGuru,
        'note' => 'Tenaga pendidik aktif',
        'tone' => 'bg-emerald-50 text-emerald-700 border-emerald-100'
    ],
    [
        'label' => 'Total Pelanggaran',
        'value' => $totalPelanggaran,
        'note' => 'Kasus tercatat',
        'tone' => 'bg-rose-50 text-rose-700 border-rose-100'
    ],
    [
        'label' => 'Akumulasi Poin',
        'value' => $totalPoin,
        'note' => 'Total poin pelanggaran',
        'tone' => 'bg-amber-50 text-amber-700 border-amber-100'
    ],
];
?>

<div class="space-y-6 rounded-[28px] bg-blue-50 p-4 md:p-6">
    <div class="rounded-3xl border border-blue-100 bg-gradient-to-r from-blue-50 to-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span class="inline-flex rounded-full bg-white px-3 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-100">Overview</span>
                <h1 class="mt-3 text-3xl font-bold text-gray-900">Dashboard Pelanggaran Siswa</h1>
                <p class="mt-2 max-w-2xl text-sm text-gray-600">
                    Tampilan final yang lebih clean, ringan, dan selaras dengan header putih pada sistem Anda.
                </p>
            </div>

            <div class="rounded-full bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200">
                Halo, <?= esc($namaUser) ?>
            </div>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <?php foreach ($cards as $card): ?>
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-gray-500"><?= esc($card['label']) ?></p>
                        <h3 class="mt-2 text-3xl font-bold text-gray-900"><?= esc($card['value']) ?></h3>
                    </div>
                    <span class="rounded-full border px-3 py-1 text-xs font-semibold <?= esc($card['tone']) ?>">
                        <?= esc($card['note']) ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="grid gap-4 xl:grid-cols-12">
        <div class="xl:col-span-6 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-blue-700">Selamat datang</p>
                    <h2 class="mt-1 text-3xl font-bold text-gray-900"><?= esc($namaUser) ?></h2>
                    <p class="mt-2 text-sm text-gray-500">Role aktif: <span class="font-semibold capitalize text-gray-700"><?= esc($roleUser) ?></span></p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Total Surat</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900"><?= esc($totalSurat) ?></p>
                    </div>
                    <div class="rounded-2xl bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Perjanjian</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900"><?= esc($totalPerjanjian) ?></p>
                    </div>
                </div>

                <div class="inline-flex w-fit rounded-full bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm">
                    Dashboard aktif
                </div>
            </div>
        </div>

        <div class="xl:col-span-6 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Aktivitas Terbaru</h2>
                    <p class="text-sm text-gray-500">Riwayat pelanggaran terbaru.</p>
                </div>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">5 data</span>
            </div>

            <div class="space-y-3">
                <?php if ($recent && mysqli_num_rows($recent) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($recent)): ?>
                        <?php
                        $poin = (int) $row['poin'];
                        $pillClass = 'bg-emerald-50 text-emerald-700';
                        if ($poin >= 30) {
                            $pillClass = 'bg-amber-50 text-amber-700';
                        }
                        if ($poin >= 60) {
                            $pillClass = 'bg-rose-50 text-rose-700';
                        }
                        ?>
                        <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-900"><?= esc($row['nama_siswa']) ?> <span class="text-gray-400">#<?= esc($row['nis']) ?></span></p>
                                    <p class="mt-1 text-sm text-gray-500"><?= esc($row['jenis']) ?> • <?= esc(date('d M Y', strtotime($row['tanggal']))) ?></p>
                                </div>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold <?= $pillClass ?>">
                                    <?= esc($poin) ?> poin
                                </span>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-4 py-8 text-center text-gray-500">
                        Belum ada aktivitas pelanggaran.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="grid gap-4 xl:grid-cols-12">
        <div class="xl:col-span-7 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-5 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Status Siswa</h2>
                    <p class="text-sm text-gray-500">Distribusi status dari data siswa.</p>
                </div>
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">Live data</span>
            </div>

            <div class="space-y-4">
                <?php foreach ($statusRows as $row):
                    $label = $row['status'] ?: 'tanpa status';
                    $value = (int) $row['total'];
                    $width = max(12, min(100, $value * 5));
                ?>
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span class="capitalize text-gray-600"><?= esc(str_replace('_', ' ', $label)) ?></span>
                            <span class="font-semibold text-gray-900"><?= esc($value) ?></span>
                        </div>
                        <div class="h-2 rounded-full bg-gray-100">
                            <div class="h-2 rounded-full bg-blue-500" style="width: <?= $width ?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="xl:col-span-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900">Akses Cepat</h2>
                <p class="text-sm text-gray-500">Navigasi cepat sesuai alur kerja.</p>
            </div>

            <div class="space-y-3">
                <a href="/poin_pelanggaran_siswa/pages/siswa/list.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-blue-50">
                    <div class="font-medium text-gray-800">Data Siswa</div>
                    <div class="text-sm text-gray-500">Lihat daftar siswa.</div>
                </a>
                <a href="/poin_pelanggaran_siswa/pages/laporan/pelanggaran_siswa/list.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-blue-50">
                    <div class="font-medium text-gray-800">Riwayat Pelanggaran</div>
                    <div class="text-sm text-gray-500">Pantau detail pelanggaran.</div>
                </a>
                <a href="pages/profile/index.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-blue-50">
                    <div class="font-medium text-gray-800">Profil Saya</div>
                    <div class="text-sm text-gray-500">Kelola profil akun.</div>
                </a>
                <?php if (($_SESSION['user']['role'] ?? '') === 'guru'): ?>
                    <a href="/poin_pelanggaran_siswa/pages/laporan/list_rekapitulasi.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-blue-50">
                        <div class="font-medium text-gray-800">Rekapitulasi Surat</div>
                        <div class="text-sm text-gray-500">Akses laporan cetak.</div>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Top Siswa Berdasarkan Poin</h2>
                <p class="text-sm text-gray-500">Prioritas monitoring berdasarkan akumulasi poin.</p>
            </div>
            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Monitoring</span>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            <?php if (!empty($topSiswaRows)): ?>
                <?php foreach ($topSiswaRows as $row): ?>
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">
                        <div>
                            <p class="text-lg font-semibold text-gray-900"><?= esc($row['nama_siswa']) ?></p>
                            <p class="mt-1 text-sm text-gray-500">NIS <?= esc($row['nis']) ?></p>
                        </div>
                        <div class="mt-5 flex items-end justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-wide text-gray-400">Total poin</p>
                                <p class="text-3xl font-bold text-gray-900"><?= esc($row['total_poin']) ?></p>
                            </div>
                            <span class="rounded-full bg-white px-3 py-1 text-sm text-gray-600 ring-1 ring-gray-200"><?= esc($row['total_kasus']) ?> kasus</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="md:col-span-2 xl:col-span-3 rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-4 py-10 text-center text-gray-500">
                    Belum ada siswa dengan akumulasi poin pelanggaran.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include ROOTPATH . '/includes/footer.php'; ?>
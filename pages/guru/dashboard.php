<?php
if (!defined('ROOTPATH')) {
    define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
}
include ROOTPATH . "/config/config.php";
include ROOTPATH . '/includes/header.php';

$namaUser = $_SESSION['user']['nama'] ?? 'Guru';
$roleUser = $_SESSION['user']['role'] ?? 'guru';
$kodeGuru = $_SESSION['user']['kode_guru'] ?? null;

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

$guruNameSql = "SELECT nama FROM guru WHERE kode_guru = '" . mysqli_real_escape_string($conn, (string) $kodeGuru) . "' LIMIT 1";
$guruNameResult = $kodeGuru ? mysqli_query($conn, $guruNameSql) : false;
if ($guruNameResult && mysqli_num_rows($guruNameResult) > 0) {
    $guruRow = mysqli_fetch_assoc($guruNameResult);
    $namaUser = $guruRow['nama'] ?? $namaUser;
}

$totalSiswa = single_value($conn, "SELECT COUNT(*) AS total FROM siswa WHERE status = 'aktif'");
$totalGuru = single_value($conn, "SELECT COUNT(*) AS total FROM guru WHERE status = 1");
$totalKasus = single_value($conn, "SELECT COUNT(*) AS total FROM pelanggaran_siswa");
$totalPoin = single_value($conn, "SELECT COALESCE(SUM(jp.poin),0) AS total
    FROM pelanggaran_siswa ps
    JOIN jenis_pelanggaran jp ON jp.id_jenis_pelanggaran = ps.id_jenis_pelanggaran");

$kelasBinaan = 0;
if ($kodeGuru) {
    $kelasBinaan = single_value($conn, "SELECT COUNT(*) AS total FROM kelas WHERE kode_guru = '" . mysqli_real_escape_string($conn, (string) $kodeGuru) . "'");
}

$siswaBinaan = 0;
if ($kodeGuru) {
    $siswaBinaan = single_value($conn, "SELECT COUNT(*) AS total
        FROM siswa s
        JOIN kelas k ON k.id_kelas = s.id_kelas
        WHERE k.kode_guru = '" . mysqli_real_escape_string($conn, (string) $kodeGuru) . "'");
}

$recentSql = "SELECT ps.tanggal, s.nama_siswa, s.nis, jp.jenis, jp.poin, ps.keterangan
    FROM pelanggaran_siswa ps
    JOIN siswa s ON s.nis = ps.nis
    JOIN jenis_pelanggaran jp ON jp.id_jenis_pelanggaran = ps.id_jenis_pelanggaran
    ORDER BY ps.tanggal DESC
    LIMIT 5";
$recent = mysqli_query($conn, $recentSql);

$kelasRows = [];
if ($kodeGuru) {
    $kelasSql = "SELECT
            k.id_kelas,
            t.tingkat,
            pk.program_keahlian,
            k.rombel,
            COUNT(s.nis) AS total_siswa,
            COALESCE(SUM(CASE WHEN ps.id_pelanggaran_siswa IS NOT NULL THEN 1 ELSE 0 END), 0) AS total_kasus
        FROM kelas k
        JOIN tingkat t ON t.id_tingkat = k.id_tingkat
        JOIN program_keahlian pk ON pk.id_program_keahlian = k.id_program_keahlian
        LEFT JOIN siswa s ON s.id_kelas = k.id_kelas
        LEFT JOIN pelanggaran_siswa ps ON ps.nis = s.nis
        WHERE k.kode_guru = '" . mysqli_real_escape_string($conn, (string) $kodeGuru) . "'
        GROUP BY k.id_kelas, t.tingkat, pk.program_keahlian, k.rombel
        ORDER BY t.id_tingkat ASC, pk.program_keahlian ASC, k.rombel ASC";
    $kelasResult = mysqli_query($conn, $kelasSql);
    if ($kelasResult) {
        while ($row = mysqli_fetch_assoc($kelasResult)) {
            $kelasRows[] = $row;
        }
    }
}

$topSiswaSql = "SELECT s.nama_siswa, s.nis, COALESCE(SUM(jp.poin),0) AS total_poin, COUNT(ps.id_pelanggaran_siswa) AS total_kasus
    FROM siswa s
    LEFT JOIN pelanggaran_siswa ps ON ps.nis = s.nis
    LEFT JOIN jenis_pelanggaran jp ON jp.id_jenis_pelanggaran = ps.id_jenis_pelanggaran";
if ($kodeGuru) {
    $topSiswaSql .= " JOIN kelas k ON k.id_kelas = s.id_kelas WHERE k.kode_guru = '" . mysqli_real_escape_string($conn, (string) $kodeGuru) . "'";
}
$topSiswaSql .= " GROUP BY s.nis, s.nama_siswa
    HAVING total_poin > 0
    ORDER BY total_poin DESC, total_kasus DESC, s.nama_siswa ASC
    LIMIT 5";
$topSiswa = mysqli_query($conn, $topSiswaSql);
$topSiswaRows = [];
if ($topSiswa) {
    while ($row = mysqli_fetch_assoc($topSiswa)) {
        $topSiswaRows[] = $row;
    }
}

$cards = [
    [
        'label' => 'Siswa Aktif',
        'value' => $totalSiswa,
        'note' => 'Seluruh siswa aktif',
        'tone' => 'bg-blue-50 text-blue-700 border-blue-100'
    ],
    [
        'label' => 'Kelas Binaan',
        'value' => $kelasBinaan,
        'note' => 'Kelas yang diampu',
        'tone' => 'bg-emerald-50 text-emerald-700 border-emerald-100'
    ],
    [
        'label' => 'Siswa Binaan',
        'value' => $siswaBinaan,
        'note' => 'Siswa dalam kelas Anda',
        'tone' => 'bg-violet-50 text-violet-700 border-violet-100'
    ],
    [
        'label' => 'Total Kasus',
        'value' => $totalKasus,
        'note' => 'Pelanggaran tercatat',
        'tone' => 'bg-rose-50 text-rose-700 border-rose-100'
    ],
];
?>

<div class="space-y-6 rounded-[28px] bg-sky-50 p-4 md:p-6">
    <div class="rounded-3xl border border-sky-100 bg-gradient-to-r from-sky-50 to-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <span class="inline-flex rounded-full bg-white px-3 py-1 text-xs font-semibold text-sky-700 ring-1 ring-sky-100">Dashboard Guru</span>
                <h1 class="mt-3 text-3xl font-bold text-gray-900">Monitoring Kelas & Pelanggaran</h1>
                <p class="mt-2 max-w-2xl text-sm text-gray-600">
                    Ringkasan khusus guru untuk memantau kelas binaan, siswa, dan aktivitas pelanggaran terbaru.
                </p>
            </div>

            <div class="rounded-full bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200">
                <?= esc($namaUser) ?>
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
        <div class="xl:col-span-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-sky-700">Profil Guru</p>
                    <h2 class="mt-1 text-3xl font-bold text-gray-900"><?= esc($namaUser) ?></h2>
                    <p class="mt-2 text-sm text-gray-500">Role aktif: <span class="font-semibold capitalize text-gray-700"><?= esc($roleUser) ?></span></p>
                </div>

                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Total Guru Aktif</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900"><?= esc($totalGuru) ?></p>
                    </div>
                    <div class="rounded-2xl bg-gray-50 p-4">
                        <p class="text-sm text-gray-500">Total Poin Sistem</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900"><?= esc($totalPoin) ?></p>
                    </div>
                </div>

                <div class="inline-flex w-fit rounded-full bg-sky-600 px-4 py-2 text-sm font-medium text-white shadow-sm">
                    Panel guru aktif
                </div>
            </div>
        </div>

        <div class="xl:col-span-7 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Aktivitas Pelanggaran Terbaru</h2>
                    <p class="text-sm text-gray-500">Pantau kejadian terbaru di sistem.</p>
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
                                    <p class="mt-1 truncate text-xs text-gray-400"><?= esc($row['keterangan'] ?: '-') ?></p>
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
                    <h2 class="text-xl font-bold text-gray-900">Kelas Binaan</h2>
                    <p class="text-sm text-gray-500">Ringkasan kelas yang diampu guru.</p>
                </div>
                <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold text-sky-700">Ringkasan</span>
            </div>

            <div class="space-y-3">
                <?php if (!empty($kelasRows)): ?>
                    <?php foreach ($kelasRows as $kelas): ?>
                        <div class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-4">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        <?= esc($kelas['tingkat']) ?> <?= esc($kelas['program_keahlian']) ?> <?= esc($kelas['rombel']) ?>
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500"><?= esc($kelas['total_siswa']) ?> siswa • <?= esc($kelas['total_kasus']) ?> kasus</p>
                                </div>
                                <div class="flex gap-2 text-xs font-semibold">
                                    <span class="rounded-full bg-blue-50 px-3 py-1 text-blue-700">Kelas aktif</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-4 py-8 text-center text-gray-500">
                        Belum ada kelas yang terhubung ke akun guru ini.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="xl:col-span-5 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900">Akses Cepat Guru</h2>
                <p class="text-sm text-gray-500">Shortcut yang sering dipakai saat monitoring.</p>
            </div>

            <div class="space-y-3">
                <a href="/poin_pelanggaran_siswa/pages/siswa/list.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-sky-50">
                    <div class="font-medium text-gray-800">Data Siswa</div>
                    <div class="text-sm text-gray-500">Lihat daftar siswa aktif.</div>
                </a>
                <a href="/poin_pelanggaran_siswa/pages/laporan/pelanggaran_siswa/list.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-sky-50">
                    <div class="font-medium text-gray-800">Riwayat Pelanggaran</div>
                    <div class="text-sm text-gray-500">Pantau detail pelanggaran siswa.</div>
                </a>
                <a href="pages/profile/index.php" class="block rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 transition hover:bg-sky-50">
                    <div class="font-medium text-gray-800">Profil Guru</div>
                    <div class="text-sm text-gray-500">Kelola data akun guru.</div>
                </a>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Top Siswa Berdasarkan Poin</h2>
                <p class="text-sm text-gray-500">Prioritas monitoring untuk guru.</p>
            </div>
            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Prioritas</span>
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

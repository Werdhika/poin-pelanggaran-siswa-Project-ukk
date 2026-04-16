<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

/* =========================
   DATA SURAT KELUAR
=========================*/
$result_surat = mysqli_query($conn, "SELECT 
                                    a.*,
                                    b.nama_siswa
                             FROM surat_keluar a
                             LEFT JOIN siswa b ON a.nis = b.nis 
                             ");

/* =========================
   DATA SISWA > 50 POIN
=========================*/
$result = mysqli_query($conn, " SELECT 
        s.nis,
        s.nama_siswa,
        GROUP_CONCAT(j.jenis SEPARATOR ', ') AS jenis_pelanggaran,
        SUM(j.poin) AS point
    FROM pelanggaran_siswa p
    JOIN siswa s 
        ON p.nis = s.nis
    JOIN jenis_pelanggaran j 
        ON p.id_jenis_pelanggaran = j.id_jenis_pelanggaran
    GROUP BY s.nis, s.nama_siswa
    HAVING SUM(j.poin) > 50
");

$bulan = [
    "January" => "Januari",
    "February" => "Februari",
    "March" => "Maret",
    "April" => "April",
    "May" => "Mei",
    "June" => "Juni",
    "July" => "Juli",
    "August" => "Agustus",
    "September" => "September",
    "October" => "Oktober",
    "November" => "November",
    "December" => "Desember"
];
?>

<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
    <div>
        <h2 class="mb-2 font-urbanist text-3xl font-extrabold">Daftar Surat Panggilan Orang Tua / Wali</h2>
        <p class="text-gray-600">Kelola daftar pelanggaran siswa diatas 50 poin dan riwayat surat.</p>
    </div>

    <?php if (
        $_SESSION['user']['role'] == 'Guru BK' ||
        $_SESSION['user']['role'] == 'Kepala Sekolah' ||
        $_SESSION['user']['role'] == 'Wakasek'
    ): ?>
        <div>
            <a href="pages/laporan/panggilan_orang_tua/daftar_siswa/init.php"
                class="group inline-flex items-center rounded-lg py-4 px-6 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                <svg class="h-5 w-5 transition-transform duration-500 group-hover:rotate-180" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
                </svg>
                Cetak Surat
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- ===================================================== -->
<!-- TABEL SISWA POIN > 50 -->
<!-- ===================================================== -->
<div class="mt-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <div class="max-h-[400px] overflow-y-auto">
            <table class="w-full text-left text-sm">
                <thead class="sticky top-0 z-0 bg-gray-100 font-poppins text-sm text-gray-700 shadow-sm">
                    <tr>
                        <th class="px-3 py-5 text-center font-bold">NO</th>
                        <th class="px-4 py-5 font-bold">NIS</th>
                        <th class="px-4 py-5 font-bold">Nama</th>
                        <th class="px-4 py-5 font-bold">Jenis Pelanggaran</th>
                        <th class="px-4 py-5 font-bold">Poin</th>
                        <th class="px-4 py-5 font-bold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr class="font-poppins text-sm transition hover:bg-gray-50">
                                <td class="px-3 py-4 text-center text-[16px] font-bold"><?= $no++; ?></td>
                                <td class="px-4 py-4 font-bold"><?= htmlspecialchars($row['nis']); ?></td>
                                <td class="px-4 py-4 font-semibold"><?= htmlspecialchars($row['nama_siswa']); ?></td>
                                <td class="px-4 py-4 font-semibold max-w-80"><?= htmlspecialchars($row['jenis_pelanggaran']); ?></td>
                                <td class="px-4 py-4 font-semibold">
                                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-3xl border-2 text-[12px] 
                                        <?= match (true) {
                                            $row['point'] < 25 => 'bg-green-50 border-green-600',
                                            $row['point'] < 50 => 'bg-yellow-50 border-yellow-600',
                                            $row['point'] < 100 => 'bg-orange-50 border-orange-600',
                                            default => 'bg-red-100 border-red-600'
                                        } ?>
                                    ">
                                        <?= htmlspecialchars($row['point'] . ' ' . 'poin'); ?>
                                </td>

                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="pages/laporan/detail_pelanggaran.php?nis=<?= urlencode($row['nis']); ?>"
                                            class="inline-flex items-center rounded-lg bg-slate-600 px-4 py-4 text-sm font-medium text-white shadow transition duration-300 hover:bg-slate-700">
                                            Detail Pelanggaran
                                        </a>

                                        <?php if (
                                            $_SESSION['user']['role'] == 'Guru BK' ||
                                            $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                                            $_SESSION['user']['role'] == 'Wakasek'
                                        ): ?>
                                            <a href="pages/laporan/panggilan_orang_tua/daftar_siswa/add.php?nis=<?= urlencode($row['nis']); ?>"
                                                class="inline-flex items-center rounded-lg bg-linear-to-r from-blue-600 to-indigo-600 px-4 py-4 text-sm font-medium text-white shadow transition duration-300 hover:from-blue-700 hover:to-indigo-700">
                                                Cetak Surat
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-2xl">
                                        📭
                                    </div>
                                    <p class="text-base font-semibold text-gray-700">Data siswa kosong</p>
                                    <p class="mt-1 text-sm text-gray-500">Belum ada siswa dengan total poin di atas 50.</p>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- TABEL RIWAYAT SURAT -->
<!-- ===================================================== -->
<div class="mt-12 mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <div class="max-h-[400px] overflow-y-auto">
            <table class="w-full text-left text-sm">
                <thead class="sticky top-0 z-0 bg-gray-100 font-poppins text-sm text-gray-700 shadow-sm">
                    <tr>
                        <th class="px-3 py-4 text-center font-bold">NO</th>
                        <th class="px-4 py-4 font-bold">Tanggal <br> Pembuatan Surat</th>
                        <th class="px-4 py-4 font-bold">Tanggal Pemanggilan <br> Ortu/Wali</th>
                        <th class="px-4 py-4 font-bold">Nomor Surat</th>
                        <th class="px-4 py-4 font-bold">Nama Siswa</th>
                        <th class="px-4 py-4 font-bold">Keperluan</th>
                        <?php if (
                            $_SESSION['user']['role'] == 'Guru BK' ||
                            $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                            $_SESSION['user']['role'] == 'Wakasek'
                        ): ?>
                            <th class="px-4 py-4 text-center font-semibold">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 font-semibold">
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($result_surat) > 0) {
                        while ($row = mysqli_fetch_assoc($result_surat)) {
                    ?>
                            <tr class="font-poppins text-sm transition hover:bg-gray-50">
                                <td class="px-3 py-4 text-center text-[16px] font-bold"><?= $no++; ?></td>

                                <td class="px-4 py-4 font-bold">
                                    <?= date("d", strtotime($row['tanggal_pembuatan_surat'])) ?>
                                    <?= $bulan[date("F", strtotime($row['tanggal_pembuatan_surat']))] ?>
                                    <?= date("Y", strtotime($row['tanggal_pembuatan_surat'])) ?>
                                </td>

                                <td class="px-4 py-4 font-bold">
                                    <div>
                                        <?= date("d", strtotime($row['tanggal_pemanggilan'])) ?>
                                        <?= $bulan[date("F", strtotime($row['tanggal_pemanggilan']))] ?>
                                        <?= date("Y", strtotime($row['tanggal_pemanggilan'])) ?>
                                    </div>
                                    <div class="mt-1 text-xs text-blue-500">
                                        Pukul: <?= date("H:i", strtotime($row['tanggal_pemanggilan'])) ?>
                                    </div>
                                </td>

                                <td class="px-4 py-4 font-bold">
                                    <?= htmlspecialchars($row['no_surat']); ?>/SMK/TI/BG/<?= date("Y", strtotime($row['tanggal_pembuatan_surat'])) ?>
                                </td>

                                <td class="px-4 py-4">
                                    <div class="text-sm font-semibold"><?= htmlspecialchars($row['nama_siswa']); ?></div>
                                    <div class="text-[14px] text-blue-500"><?= htmlspecialchars($row['nis']); ?></div>
                                </td>

                                <td class="px-4 py-4 max-w-50"><?= htmlspecialchars($row['keperluan']); ?></td>

                                <?php if (
                                    $_SESSION['user']['role'] == 'Guru BK' ||
                                    $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                                    $_SESSION['user']['role'] == 'Wakasek'
                                ): ?>
                                    <td class="px-4 py-4 text-center">
                                        <a href="pages/cetak/surat_panggilan_ortu.php?nis=<?= urlencode($row['nis']); ?>"
                                            class="inline-flex items-center rounded-lg bg-linear-to-r from-emerald-500 to-green-600 px-4 py-4 text-sm font-medium text-white shadow transition duration-300 hover:from-emerald-600 hover:to-green-700">
                                            Cetak Ulang
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-2xl">
                                        📄
                                    </div>
                                    <p class="text-base font-semibold text-gray-700">Riwayat surat kosong</p>
                                    <p class="mt-1 text-sm text-gray-500">Belum ada data surat panggilan yang dibuat.</p>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$result_50 = mysqli_query($conn, "
    SELECT 
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
    HAVING 
        SUM(j.poin) BETWEEN 25 AND 50
");

$result_list = mysqli_query($conn, "SELECT 
        a.*,
        b.nama_siswa,
        d.tingkat
    FROM perjanjian_siswa a
    INNER JOIN siswa b ON a.nis = b.nis
    INNER JOIN kelas c ON b.id_kelas = c.id_kelas
    INNER JOIN tingkat d ON c.id_tingkat = d.id_tingkat
    WHERE a.nis IS NOT NULL
");

// $data_perjanjian_siswa = mysqli_fetch_assoc($result_list);

?>

<div class="flex justify-between">
    <div>
        <h2 class="text-3xl font-urbanist font-extrabold mb-2">Daftar Pelanggaran Per Siswa</h2>
        <p>Daftar Pelanggaran Siswa di atas 25 Point</p>
    </div>

    <div>
        <?php if (
            $_SESSION['user']['role'] == 'Guru BK' ||
            $_SESSION['user']['role'] == 'Kepala Sekolah' ||
            $_SESSION['user']['role'] == 'Wakasek'
        ): ?>
            <a href="pages/laporan/perjanjian_siswa/daftar_siswa/init.php"
                class="group inline-flex items-center rounded-lg py-4 px-4 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                Buat Surat Perjanjian Siswa
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- TABEL POINT -->
<div class="border border-gray-200 rounded-lg shadow-sm mt-8">
    <div class="max-h-[500px] overflow-y-auto">

        <table class="w-full text-sm text-left">

            <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-0 shadow-md">
                <tr>
                    <th class="px-2 py-5 text-center">NO</th>
                    <th class="px-4 py-5">NIS</th>
                    <th class="px-4 py-5">Nama Siswa</th>
                    <th class="px-4 py-5">Jenis Pelanggaran</th>
                    <th class="px-4 py-5">Poin</th>
                    <th class="px-4 py-5 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                <?php
                $no = 1;
                if (mysqli_num_rows($result_50) > 0) {
                    while ($row = mysqli_fetch_assoc($result_50)) {
                ?>

                        <tr class="bg-white font-medium font-poppins text-sm">

                            <td class="px-2 py-4 text-center"><?= $no++; ?></td>
                            <td class="px-4 py-4"><?= $row['nis']; ?></td>
                            <td class="px-4 py-4"><?= $row['nama_siswa']; ?></td>
                            <td class="px-4 py-4 max-w-80"><?= $row['jenis_pelanggaran']; ?></td>
                            <td class="px-4 py-4 font-bold">
                                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-3xl border-2 text-xs 
                            <?= match (true) {
                                $row['point'] < 25 => 'bg-green-50 border-green-600',
                                $row['point'] < 50 => 'bg-yellow-50 border-yellow-600',
                                $row['point'] < 100 => 'bg-orange-50 border-orange-600',
                                default => 'bg-red-100 border-red-600'
                            } ?>
                            ">
                                    <?= $row['point'] . ' ' . 'Poin'; ?>
                            </td>

                            <td class="px-4 py-4 flex flex-col gap-4">

                                <div class="flex gap-2">
                                    <a href="pages/laporan/detail_pelanggaran.php?nis=<?= $row['nis']; ?>"
                                        class="inline-flex items-center rounded-lg py-2.5 px-4 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                                        Detail Pelanggaran
                                    </a>

                                    <?php
                                    $resultNis = mysqli_query($conn, "SELECT COUNT(*) as data FROM perjanjian_siswa WHERE nis='" . $row['nis'] . "'");
                                    $count_nis = mysqli_fetch_assoc($resultNis);
                                    if ($count_nis['data'] == 0):
                                    ?>
                                        <?php if (
                                            $_SESSION['user']['role'] == 'Guru BK' ||
                                            $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                                            $_SESSION['user']['role'] == 'Wakasek'
                                        ): ?>
                                            <a href="pages/laporan/perjanjian_siswa/daftar_siswa/add.php?nis=<?= $row['nis']; ?>"
                                                class="inline-flex items-center rounded-lg py-2.5 px-4 text-sm text-white font-poppins font-medium bg-linear-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 shadow-[0_3px_4px_rgba(34,197,94,0.4)] transition duration-300">
                                                Cetak Surat Perjanjian Siswa
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php
                                    $resultfoto = mysqli_query($conn, "SELECT foto_dokumen as data FROM perjanjian_siswa WHERE nis='" . $row['nis'] . "'");
                                    $count_foto = mysqli_fetch_assoc($resultfoto);
                                    if (!empty($count_foto['data'])):
                                    ?>
                                        <?php if ($_SESSION['user']['role'] == 'Guru BK' || 'Kepala Sekolah' || 'Wakasek' || 'Guru'): ?>
                                            <a href="pages/laporan/panggilan_siswa/daftar_siswa/add.php?nis=<?= $row['nis']; ?>"
                                                class="inline-flex items-center rounded-lg py-2.5 px-4 text-sm text-white font-poppins font-medium bg-linear-to-r from-purple-600 to-violet-600 hover:from-purple-700 hover:to-violet-700 shadow-[0_3px_4px_rgba(168,85,247,0.4)] transition duration-300">
                                                Lihat Gambar
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <?php
                                $resultfoto = mysqli_query($conn, "SELECT foto_dokumen as data FROM perjanjian_siswa WHERE nis='" . $row['nis'] . "'");
                                $count_foto = mysqli_fetch_assoc($resultfoto);
                                if (empty($count_foto['data'])):
                                ?>
                                    <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
                                        <form action="process/laporan_surat_perjanjian_siswa/upload.php" method="POST" enctype="multipart/form-data" class="w-full">
                                            <input type="hidden" name="nis" value="<?= $row['nis']; ?>">
                                            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                                                <div class="mb-3">
                                                    <h3 class="text-sm font-semibold text-gray-700 font-poppins">
                                                        Upload Bukti / Gambar
                                                    </h3>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <input type="file" name="foto_dokumen" required>
                                                    <input type="submit" name="submit" value="Upload">
                                                </div>
                                            </div>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">
                            Tidak ada data siswa dengan poin 25 - 50
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</div>

<!-- TABEL LIST SURAT -->
<div class="mt-16">

    <h2 class="text-3xl font-urbanist font-extrabold mb-2">Daftar Surat Perjanjian Siswa</h2>
    <p>Daftar Siswa Sudah Cetak Surat Siswa</p>

    <div class="border border-gray-200 rounded-lg shadow-sm mt-8">

        <div class="max-h-[500px] overflow-y-auto">

            <table class="w-full text-sm text-left">

                <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-0 shadow-md">
                    <tr>
                        <th class="px-2 py-5 text-center">NO</th>
                        <th class="px-4 py-5">Tanggal Pembuatan Surat</th>
                        <th class="px-4 py-5">NIS</th>
                        <th class="px-4 py-5">Nama Siswa</th>
                        <th class="px-4 py-5">Tingkat</th>
                        <?php if (
                            $_SESSION['user']['role'] == 'Guru BK' ||
                            $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                            $_SESSION['user']['role'] == 'Wakasek'
                        ): ?>
                            <th class="px-4 py-5 text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    <?php
                    $no = 1;
                    if (mysqli_num_rows($result_list) > 0) {
                        while ($row = mysqli_fetch_assoc($result_list)) {
                    ?>

                            <tr class="bg-white font-medium font-poppins text-sm">

                                <td class="px-2 py-4 text-center"><?= $no++; ?></td>
                                <td class="px-4 py-4"><?= $row['tanggal']; ?></td>
                                <td class="px-4 py-4"><?= $row['nis']; ?></td>
                                <td class="px-4 py-4"><?= $row['nama_siswa']; ?></td>
                                <td class="px-4 py-4"><?= $row['tingkat']; ?></td>

                                <?php if (
                                    $_SESSION['user']['role'] == 'Guru BK' ||
                                    $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                                    $_SESSION['user']['role'] == 'Wakasek'
                                ): ?>
                                    <td class="px-4 py-4 text-center">
                                        <a href="pages/cetak/surat_perjanjian_siswa.php?nis=<?= $row['nis']; ?>"
                                            class="inline-flex items-center rounded-lg py-2.5 px-4 text-sm text-white font-poppins font-medium bg-blue-600 hover:bg-blue-700 transition">
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
                            <td colspan="6" class="text-center py-10 text-gray-500">
                                Belum ada data surat perjanjian siswa
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>

    </div>
</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>
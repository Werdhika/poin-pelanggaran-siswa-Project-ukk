<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$result = mysqli_query($conn, "
SELECT 
    pelanggaran_siswa.nis,
    siswa.nama_siswa,
    GROUP_CONCAT(jenis_pelanggaran.jenis SEPARATOR ', ') AS jenis,
    SUM(jenis_pelanggaran.poin) AS total_point,
    MAX(pelanggaran_siswa.tanggal) AS tanggal
FROM pelanggaran_siswa
INNER JOIN siswa 
    ON pelanggaran_siswa.nis = siswa.nis
INNER JOIN jenis_pelanggaran 
    ON pelanggaran_siswa.id_jenis_pelanggaran = jenis_pelanggaran.id_jenis_pelanggaran
GROUP BY pelanggaran_siswa.nis
ORDER BY tanggal DESC
");
?>

<div class="flex justify-between">
    <div>
        <h2 class="text-3xl font-urbanist font-extrabold mb-2">Data Pelanggaran Siswa</h2>
        <p>Kelola data pelanggaran siswa yang tersimpan pada sistem sekolah.</p>
    </div>

    <div>
        <a href="pages/laporan/pelanggaran_siswa/add.php" class="group inline-flex items-center rounded-lg py-4 px-6 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
            <svg class="w-5 h-5 transition-transform duration-600 group-hover:rotate-180" viewBox="0 0 24 24" fill="none">
                <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
            </svg>
            Tambah Pelanggaran
        </a>
    </div>
</div>

<div class="relative overflow-auto max-h-112 border border-gray-200 rounded-lg shadow-sm mt-8">
    <table class="w-full text-sm text-left">
        <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-1 shadow-md">
            <tr>
                <th class="px-2 py-5 font-bold text-center">NO</th>
                <th class="px-4 py-5">Tanggal</th>
                <th class="px-4 py-5">NIS</th>
                <th class="px-4 py-5">Nama</th>
                <th class="px-0 py-5">Jenis Pelanggaran</th>
                <th class="px-4 py-5">Total Point</th>
                <th class="px-4 py-5 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            <?php
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr class="bg-white hover:bg-gray-100 font-semibold font-poppins transition text-sm">
                        <td class="px-2 py-4 font-bold text-center"><?= $no++; ?></td>

                        <td class="px-4 py-4 font-bold">
                            <div><?= date("d-m-Y", strtotime($row['tanggal'])) ?></div>
                            <div class="text-xs text-gray-500"><?= date("H:i:s", strtotime($row['tanggal'])) ?></div>
                        </td>

                        <td class="px-4 py-4 font-bold"><?= $row['nis']; ?></td>

                        <td class="px-4 py-4"><?= $row['nama_siswa']; ?></td>

                        <td class="px-0 py-4 max-w-80"><?= $row['jenis']; ?></td>

                        <td class="px-4 py-4 font-bold">
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-3xl border-2 text-[12px] 
                            <?= match (true) {
                                $row['total_point'] < 25 => 'bg-green-50 border-green-600',
                                $row['total_point'] < 50 => 'bg-yellow-50 border-yellow-600',
                                $row['total_point'] < 100 => 'bg-orange-50 border-orange-600',
                                default => 'bg-red-100 border-red-600'
                            } ?>
                            ">
                                <?= $row['total_point']; ?> Point
                        </td>

                        <td class="px-4 py-4 text-center">
                            <a href="pages/laporan/detail_pelanggaran.php?nis=<?= $row['nis']; ?>"
                                class=" inline-flex items-center rounded-lg py-3 px-4 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">

                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                    <path d="M1 12C1 12 5 5 12 5C19 5 23 12 23 12C23 12 19 19 12 19C5 19 1 12 1 12Z"
                                        stroke="currentColor" stroke-width="2" />
                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" />
                                </svg>

                                Detail
                            </a>
                        </td>

                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-500">
                        Belum ada data pelanggaran siswa
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>
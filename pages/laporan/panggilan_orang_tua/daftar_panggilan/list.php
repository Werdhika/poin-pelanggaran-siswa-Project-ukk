<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$result = mysqli_query($conn, "SELECT 
                                    a.*,
                                    b.nama_siswa
                             FROM surat_keluar a
                             LEFT JOIN siswa b ON a.nis = b.nis 
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

<div class="flex justify-between">
    <div>
        <h2 class="text-3xl font-urbanist font-extrabold mb-2">Daftar Surat Panggilan Orang Tua / Wali</h2>
        <p>List Surat Panggilan Orang Tua / Wali yang sudah dicetak</p>
    </div>

    <!-- Button -->
    <?php if ($_SESSION['user']['role'] == 'Guru BK' || 'Kepala Sekolah' || 'Wakasek'): ?>
        <div>
            <a href="pages/laporan/pelanggaran_siswa/add.php" class="group inline-flex items-center rounded-lg py-4 px-6 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                <svg class="w-5 h-5 transition-transform duration-600 group-hover:rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
                </svg>
                Cetak Surat
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Fitur Pencarian -->
<div class="flex z-1 mt-16 justify-end items-end rounded-md ">
    <div>
        <div class="relative group">
            <div class="absolute inset-y-0 flex items-center ps-2.5 pointer-events-none">
                <svg class="w-5 text-gray-500 group-focus-within:text-black transition duration-200" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.0002 21.0002L16.6602 16.6602" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <input type="text" id="input-group-1" class="w-full ps-9 py-3 pr-4 mr-28 font-poppins text-sm font-medium placeholder:font-poppins placeholder:text-[14px] rounded-md border border-gray-300 focus:outline-none focus:border-black transition duration-200" placeholder="Cari Nama atau Nis ">
        </div>
    </div>
</div>

<!-- Tabel Siswa -->
<div class="relative overflow-visible border border-gray-200 rounded-lg shadow-sm mt-8">
    <table class="w-full text-sm text-left">
        <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-1 shadow-md">
            <tr>
                <th scope="col" class="px-2 py-5 font-bold text-gray-700 text-center">NO</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700">Tanggal <br> Pembuatan Surat</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700">Tanggal Pemanggilan <br> Ortu/Wali</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700">Nomor Surat</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700">Nama Siswa</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700">Keperluan</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr class="bg-white hover:bg-gray-100 font-medium font-poppins transition text-sm">
                    <td class="px-2 py-4 font-bold text-[16px] text-center"><?= $no++; ?></td>
                    <td class="px-4 py-4 font-medium">
                        <div>
                            <?= date("d", strtotime($row['tanggal_pembuatan_surat'])) ?>
                            <?= $bulan[date("F", strtotime($row['tanggal_pembuatan_surat']))] ?>
                            <?= date("Y", strtotime($row['tanggal_pembuatan_surat'])) ?>
                        </div>
                    <td class="px-4 py-4 font-medium">
                        <div>
                            <?= date("d", strtotime($row['tanggal_pemanggilan'])) ?>
                            <?= $bulan[date("F", strtotime($row['tanggal_pemanggilan']))] ?>
                            <?= date("Y", strtotime($row['tanggal_pemanggilan'])) ?></div>
                        <div class="text-xs text-blue-500">Pukul: <?= date("H : i ", strtotime($row['tanggal_pemanggilan'])) ?>
                        </div>
                    </td>
                    <td class="px-4 py-4 font-medium"><?= $row['no_surat']; ?>/SMK/TI/BG/<?= date("Y", strtotime($row['tanggal_pembuatan_surat'])) ?></td>
                    <td class="px-4 py-4">
                        <div class="text-sm font-semibold"><?= $row['nama_siswa']; ?></div>
                        <div class="text-[14px] text-blue-500"><?= $row['nis']; ?></div>
                    </td>
                    <td class="px-4 py-4 font-medium"><?= $row['keperluan']; ?></td>

                    <!-- Dropdowns -->
                    <?php if ($_SESSION['user']['role'] == 'Guru BK' || 'Kepala Sekolah' || 'Wakasek'): ?>
                        <td class="px-4 py-6 relative flex justify-center">
                            <a href="pages/cetak/surat_panggilan_ortu.php?nis=<?= $row['nis']; ?>"
                                class="inline-flex items-center rounded-lg py-4 px-4 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                                Cetak Ulang
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-6 pb-20 font-poppins" aria-label="Table navigation">
    <span class="text-sm font-normal text-body mb-4 md:mb-0 block w-full md:inline md:w-auto">Menampilkan <span class="font-semibold text-heading">10 data siswa</span> dari <span class="font-semibold text-heading">300 data siswa</span></span>
    <ul class="flex -space-x-px text-sm gap-1.5">
        <li>
            <a href="#" class="flex items-center justify-center border border-gray-300 font-medium text-sm px-5 h-10 focus:outline-none rounded-lg">
                <svg class="w-4 h-4 me-0.5 -ms-0.5"" width=" 24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="currentColor" />
                </svg>Prev
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center justify-center text-white bg-linear-to-r from-blue-600 to-indigo-600 font-medium text-sm w-10 h-10 focus:outline-none rounded-lg">1</a>
        </li>
        <li>
            <a href="#" class="flex items-center justify-center border border-gray-300 font-medium text-sm w-10 h-10 focus:outline-none rounded-lg">2</a>
        </li>
        <li>
            <a href="#" aria-current="page" class="flex items-center justify-center border border-gray-300 font-medium text-sm w-10 h-10 focus:outline-none rounded-lg">3</a>
        </li>
        <li>
            <a href="#" class="flex items-center justify-center border border-gray-300 font-medium text-sm w-10 h-10 focus:outline-none rounded-lg">...</a>
        </li>
        <li>
            <a href="#" class="flex items-center justify-center border border-gray-300 font-medium text-sm w-10 h-10 focus:outline-none rounded-lg">5</a>
        </li>
        <li>
            <a href="#" class="flex items-center justify-center text-white bg-linear-to-r from-blue-600 to-indigo-600 text-sm px-5 h-10 focus:outline-none rounded-lg">Next
                <svg class="w-4 h-4 ms-1 rotate-180" width=" 24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="currentColor" />
                </svg>
            </a>
        </li>
    </ul>
</nav>


<?php
include ROOTPATH . "/includes/footer.php";
?>
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$result = mysqli_query($conn, "SELECT * FROM tahun_ajaran");
?>

<div class="flex justify-between">
    <div>
        <h2 class="text-3xl font-urbanist font-extrabold mb-2">Data Tahun Ajaran</h2>
        <p>Kelola data tahun ajaran yang tersimpan pada sistem sekolah.</p>
    </div>

    <!-- Button -->
    <div>
        <a href="pages/tahun_ajaran/add.php" class="group inline-flex items-center rounded-lg py-4 px-6 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
            <svg class="w-5 h-5 transition-transform duration-600 group-hover:rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<!-- Fitur Tabel -->
<div class="flex items-center z-10 mt-16 justify-between rounded-md ">
    <!-- Tab Status -->
    <div class="inline-flex font-poppins text-sm font-medium">
        <a href="#" class="px-5 py-3 rounded-lg bg-linear-to-r from-blue-600 to-indigo-600 shadow-[0_3px_10px_rgba(59,130,246,0.5)] font-semibold text-white">Semua</a>
        <a href="#" class="px-5 py-3 rounded-lg text-gray-500 hover:text-gray-900">Aktif</a>
        <a href="#" class="px-5 py-3 rounded-lg text-gray-500 hover:text-gray-900">Tidak aktif</a>
        <a href="#" class="px-5 py-3 rounded-lg text-gray-500 hover:text-gray-900">Lulus</a>
        <a href="#" class="px-5 py-3 rounded-lg text-gray-500 hover:text-gray-900">Pindah Sekolah</a>
    </div>

    <!-- Fitur Pencarian -->
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

<!-- Table Siswa -->
<div class="relative overflow-visible border border-gray-200 rounded-lg shadow-sm mt-8">
    <table class="w-full text-sm text-left">
        <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-10 shadow-md">
            <tr>
                <th scope="col" class="px-2 py-5 font-bold text-gray-700 text-center">NO</th>
                <th scope="col" class="px-28 py-5 font-semibold text-gray-700">Tahun Ajaran</th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700 text-center">Status</th>
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
                    <td class="px-28 py-4 font-medium"><?= $row['tahun']; ?></td>
                    <td class="px-4 py-4 text-center">
                        <div class="inline-block bg-gray-100 px-4 py-2 rounded-3xl border-2 border-gray-400 text-[12px] font-semibold">
                            <?= $row['status'] == '1' ? 'Aktif' : 'Tidak Aktif';  ?>
                        </div>
                    </td>

                    <!-- Dropdowns -->
                    <td class="px-4 py-4 relative flex justify-center">
                        <span class="inline-flex divide-x divide-gray-300 overflow-hidden rounded-lg border border-gray-300 bg-white">
                            <button type="button"
                                class="dropdown-btn px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 12C7 12.5304 6.78929 13.0391 6.41421 13.4142C6.03914 13.7893 5.53043 14 5 14C4.46957 14 3.96086 13.7893 3.58579 13.4142C3.21071 13.0391 3 12.5304 3 12C3 11.4696 3.21071 10.9609 3.58579 10.5858C3.96086 10.2107 4.46957 10 5 10C5.53043 10 6.03914 10.2107 6.41421 10.5858C6.78929 10.9609 7 11.4696 7 12ZM14 12C14 12.5304 13.7893 13.0391 13.4142 13.4142C13.0391 13.7893 12.5304 14 12 14C11.4696 14 10.9609 13.7893 10.5858 13.4142C10.2107 13.0391 10 12.5304 10 12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10C12.5304 10 13.0391 10.2107 13.4142 10.5858C13.7893 10.9609 14 11.4696 14 12ZM21 12C21 12.5304 20.7893 13.0391 20.4142 13.4142C20.0391 13.7893 19.5304 14 19 14C18.4696 14 17.9609 13.7893 17.5858 13.4142C17.2107 13.0391 17 12.5304 17 12C17 11.4696 17.2107 10.9609 17.5858 10.5858C17.9609 10.2107 18.4696 10 19 10C19.5304 10 20.0391 10.2107 20.4142 10.5858C20.7893 10.9609 21 11.4696 21 12Z" fill="black" />
                                </svg>
                            </button>
                        </span>

                        <div role="menu" class="dropdown-menu hidden absolute end-0 top-12 z-10 w-40 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-300 bg-white">
                            <div>
                                <a href="pages/tahun_ajaran/edit.php?id_tahun_ajaran=<?= $row['id_tahun_ajaran']; ?>" class="block px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900" role="menuitem">Edit</a>
                            </div>
                            <a href="/poin_pelanggaran_siswa/process/tahun_ajaran/delete.php?id_tahun_ajaran=<?= $row['id_tahun_ajaran']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="block w-full px-3 py-2 text-sm font-medium text-red-700 transition-colors hover:bg-red-50 ltr:text-left rtl:text-right">Hapus</a>
                        </div>
                    </td>
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
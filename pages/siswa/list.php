<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
$result = mysqli_query($conn, "SELECT * FROM siswa

JOIN ortu_wali ON siswa.id_ortu_wali = ortu_wali.id_ortu_wali
JOIN kelas ON siswa.id_kelas = kelas.id_kelas
JOIN tingkat ON kelas.id_tingkat = tingkat.id_tingkat
JOIN program_keahlian ON kelas.id_program_keahlian = program_keahlian.id_program_keahlian
JOIN guru on kelas.kode_guru = guru.kode_guru");
?>

<div>
    <h2 class="mt-8 font-heading text-3xl py-4 font-semibold">Data Siswa</h2>
    <hr class="text-gray-300 border-t-1.5">

    <!-- Featurs Table -->
    <div class=" z-10 mt-15 flex items-center justify-between">
        <label for="input-group-1" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="h-4 w-4 text-body text-gray-500" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.0002 20.9999L16.6602 16.6599" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <input type="text" id="input-group-1" class="block w-full max-w-96 ps-9 pe-32 py-3 bg-neutral-secondary-medium border border-default-medium text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body rounded-lg" placeholder="Cari Nama Siswa">
        </div>

        <!-- button -->
        <div class="flex gap-2">
            <!-- button Download -->
            <a class="flex items-center rounded-lg border border-indigo-600 px-4 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-white" href="#">
                <svg class="w-4.5 h-4.5 me-1.5 -ms-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.92 15.62C20.8685 15.4993 20.7976 15.3878 20.71 15.29L17.71 12.29C17.5217 12.1017 17.2663 11.9959 17 11.9959C16.7337 11.9959 16.4783 12.1017 16.29 12.29C16.1017 12.4783 15.9959 12.7337 15.9959 13C15.9959 13.2663 16.1017 13.5217 16.29 13.71L17.59 15H12C11.7348 15 11.4804 15.1054 11.2929 15.2929C11.1054 15.4804 11 15.7348 11 16C11 16.2652 11.1054 16.5196 11.2929 16.7071C11.4804 16.8946 11.7348 17 12 17H17.59L16.29 18.29C16.1963 18.383 16.1219 18.4936 16.0711 18.6154C16.0203 18.7373 15.9942 18.868 15.9942 19C15.9942 19.132 16.0203 19.2627 16.0711 19.3846C16.1219 19.5064 16.1963 19.617 16.29 19.71C16.383 19.8037 16.4936 19.8781 16.6154 19.9289C16.7373 19.9797 16.868 20.0058 17 20.0058C17.132 20.0058 17.2627 19.9797 17.3846 19.9289C17.5064 19.8781 17.617 19.8037 17.71 19.71L20.71 16.71C20.8033 16.6167 20.875 16.5041 20.92 16.38C21.02 16.1365 21.02 15.8635 20.92 15.62ZM14 20H6C5.73478 20 5.48043 19.8946 5.29289 19.7071C5.10536 19.5196 5 19.2652 5 19V5C5 4.73478 5.10536 4.48043 5.29289 4.29289C5.48043 4.10536 5.73478 4 6 4H11V7C11 7.79565 11.3161 8.55871 11.8787 9.12132C12.4413 9.68393 13.2044 10 14 10H18C18.1974 9.99901 18.3901 9.93961 18.5539 9.82928C18.7176 9.71895 18.845 9.56262 18.92 9.38C18.9966 9.19789 19.0175 8.99718 18.9801 8.80319C18.9428 8.6092 18.8488 8.43062 18.71 8.29L12.71 2.29C12.6281 2.21122 12.5334 2.14697 12.43 2.1H12.34L12.06 2H6C5.20435 2 4.44129 2.31607 3.87868 2.87868C3.31607 3.44129 3 4.20435 3 5V19C3 19.7956 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H14C14.2652 22 14.5196 21.8946 14.7071 21.7071C14.8946 21.5196 15 21.2652 15 21C15 20.7348 14.8946 20.4804 14.7071 20.2929C14.5196 20.1054 14.2652 20 14 20ZM13 5.41L15.59 8H14C13.7348 8 13.4804 7.89464 13.2929 7.70711C13.1054 7.51957 13 7.26522 13 7V5.41Z" fill="currentColor" />
                </svg>
                Download
            </a>
            <!-- button Tambah Siswa -->
            <a class="flex items-center rounded-lg border border-indigo-600 px-4 py-3 text-sm font-medium text-indigo-600 hover:bg-indigo-600 hover:text-white" href="pages/siswa/add.php">
                <svg class="w-4.5 h-4.5 me-1.5 -ms-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
                </svg>
                Tambah Siswa
            </a>
        </div>
    </div>
    <!-- Table Siswa -->
    <div class="relative max-h-screen overflow-auto rounded-lg shadow-md mt-6">
        <table class="min-w-max w-full divide-y-2 divide-gray-200 bg-gray-100 ">
            <thead class="bg-neutral-secondary-medium text-gray-900  sticky top-0">
                <tr class="text-sm font-normal text-left">
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="table-checkbox" type="checkbox" value="" class="w-4 h-4 ">
                            <label for="table-checkbox" class="sr-only">Table checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        NISN
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Nama Siswa
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Jenis Kelamin
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3  font-medium">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-3  font-medium">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y-2 divide-gray-200">
                <?php
                while ($data = mysqli_fetch_assoc($result)) { ?>
                    <tr class="bg-white hover:bg-gray-100text-sm">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="table-checkbox-2" type="checkbox" value="" class="w-4 h-4">
                                <label for="table-checkbox-2" class="sr-only">Tabel List Siswa</label>
                            </div>
                        </td>
                        <td class="px-6 py-4"><?= $data['nis']; ?></td>
                        <td class="px-4 py-4"><?= $data['nama_siswa']; ?></td>
                        <td class="px-6 py-4"><?= $data['jenis_kelamin']; ?></td>
                        <td class="px-6 py-4"><?= $data['alamat']; ?></td>
                        <td class="px-6 py-4">
                            <?= "$data[tingkat] $data[program_keahlian] $data[rombel]"; ?>
                        </td>
                        <!-- Dropdowns -->
                        <td class="px-3 py-3 relative">
                            <span class="inline-flex divide-x divide-gray-300 overflow-hidden rounded-lg border border-gray-300 bg-white">
                                <button type="button"
                                    class="dropdown-btn px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </button>
                            </span>

                            <div role="menu" class="dropdown-menu hidden absolute end-0 top-12 z-10 w-56 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-300 bg-white">
                                <div>
                                    <a href="pages/siswa/add.php" class="block px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900" role="menuitem">
                                        Edit
                                    </a>

                                    <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900" role="menuitem">
                                        Detail
                                    </a>

                                    <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-gray-900" role="menuitem">
                                        Reset Password
                                    </a>
                                </div>
                                <button type="button" class="block w-full px-3 py-2 text-sm font-medium text-red-700 transition-colors hover:bg-red-50 ltr:text-left rtl:text-right">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 pb-20" aria-label="Table navigation">
        <span class="text-sm font-normal text-body mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-heading">1-6</span> of <span class="font-semibold text-heading">300</span></span>
        <ul class="flex -space-x-px text-sm gap-1.5">
            <li>
                <a href="#" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium rounded-s-base text-sm px-4 h-9 focus:outline-none rounded-lg">
                    <svg class="w-4 h-4 me-0.5 -ms-0.5"" width=" 24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="currentColor" />
                    </svg>
                    Previous</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium text-sm w-9 h-9 focus:outline-none rounded-lg">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium text-sm w-9 h-9 focus:outline-none rounded-lg">2</a>
            </li>
            <li>
                <a href="#" aria-current="page" class="flex items-center justify-center text-fg-brand bg-brand-softer box-border border border-default-medium hover:bg-brand-soft hover:text-fg-brand font-medium text-sm w-9 h-9 focus:outline-none rounded-lg">3</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium text-sm w-9 h-9 focus:outline-none rounded-lg">...</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium text-sm w-9 h-9 focus:outline-none rounded-lg">5</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading font-medium rounded-e-base text-sm px-3 h-9 focus:outline-none rounded-lg"> Next
                    <svg class="w-4 h-4 ms-0.5 rotate-180" width=" 24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="currentColor" />
                    </svg></a>
            </li>
        </ul>
    </nav>

</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>
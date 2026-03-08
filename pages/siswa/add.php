<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="mt-4 font-urbanist font-extrabold text-5xl mb-8 ">Data Siswa</h2>
        <div class="flex font-urbanist font-semibold">
            <a href="/poin_pelanggaran_siswa/pages/siswa/list.php">Data Siswa</a>
            <svg class="rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
            </svg>
            <a class=" text-blue-600">Tambah Siswa</a>
        </div>
    </div>
    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a class="inline-flex items-center rounded-lg border border-gray-300 py-3.5 px-8 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300" href="/poin_pelanggaran_siswa/pages/siswa/list.php">
            Batal Simpan
        </a>

        <!-- button Simpan -->
        <a class="group inline-flex items-center rounded-lg py-3.5 px-14 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600
               hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300" href="pages/siswa/add.php">
            Simpan
        </a>
    </div>
</div>

<!-- Form Data Siswa -->
<form action="">
    <div class="w-full mt-16 flex gap-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">

                <!-- Header -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>IDENTITAS SISWA</span>
                </div>

                <!-- Body -->
                <div class="p-8 space-y-6 font-poppins text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">

                        <div class="flex-1">
                            <label class="block mb-2 font-medium">Nama Siswa</label>
                            <input type="text"
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                        </div>

                        <div class="flex-1">
                            <label class="block mb-2 font-medium">NIS</label>
                            <input type="text"
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                        </div>

                        <div class="flex-1">
                            <label class="block mb-2 font-medium">Kelas</label>
                            <select
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                                <option>Pilih Kelas</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Alamat</label>
                        <textarea
                            class="w-full border border-gray-300 p-3.5 rounded-md box-border"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white rounded-md shadow-md overflow-hidden">

                <!-- Header -->
                <div class="flex px-7 p-3.5 gap-3 text-gray-700 text-[18px] font-urbanist font-bold rounded-t-md items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-yellow-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#efb100" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#efb100" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>JENIS KELAMIN & STATUS</span>
                </div>

                <!-- Body -->
                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins text-sm border-2 border-t-0 border-gray-200">

                    <!-- Jenis Kelamin Siswa -->
                    <div>
                        <label class="block mb-2 font-medium font-poppins">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            <button type="button" data-value="Laki-laki" class="btn gender-btn flex-1 py-2.5 outline rounded-md outline-blue-300 text-blue-500 bg-blue-100 font-medium">Laki - Laki</button>
                            <button type="button" data-value="Perempuan" class="btn gender-btn flex-1 py-2.5 outline rounded-md outline-red-300 text-red-500 bg-red-100 font-medium">Perempuan</button>
                        </div>
                        <input type="hidden" name="jenis_kelamin" id="jenis_kelamin">
                    </div>

                    <!-- Status Siswa -->
                    <div>
                        <label class="block mb-2 font-medium">Status</label>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" data-value="aktif" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-green-300 text-green-500 bg-green-100 font-medium">Aktif</button>
                            <button type="button" data-value="tidak_aktif" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-red-300 text-red-500 bg-red-100 font-medium">Tidak Aktif</button>
                            <button type="button" data-value="lulus" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-orange-300 text-orange-500 bg-orange-100 font-medium">Pindah</button>
                            <button type="button" data-value="pindah" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-blue-300 text-blue-500 bg-blue-100 font-medium">Lulus Sekolah</button>
                        </div>
                        <input type="hidden" name="status" id="status">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 pb-16">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">

                <!-- Header -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>IDENTITAS ORANG TUA / WALI</span>
                </div>

                <!-- Body -->
                <div class="p-8 space-y-6 font-poppins text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div>
                        <label class="block mb-2 font-medium">Nama Siswa</label>
                        <input type="text"
                            class="w-full border border-gray-300 p-2 rounded-md box-border">
                    </div>

                    <!-- Data Ayah -->
                    <div class="flex gap-4 text-white font-poppins">
                        <div class="flex-1 px-4 py-5 bg-linear-to-t from-blue-900 to-blue-700 rounded-lg">
                            <svg class="size-10 bg-white p-2.5 rounded-md" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0833 13.75L15.18 14.6816C15.7383 14.8515 16.2434 15.1626 16.6463 15.5848C17.0492 16.007 17.3364 16.526 17.48 17.0916C17.5933 17.5383 17.2075 17.9166 16.745 17.9166H3.255C2.7925 17.9166 2.40666 17.5383 2.52 17.0916C2.66364 16.526 2.9508 16.007 3.35372 15.5848C3.75663 15.1626 4.26167 14.8515 4.82 14.6816L7.91666 13.75V12.135C6.43333 10.9741 5.41666 9.58331 5.41666 6.59748C5.41666 3.60581 7.04583 2.08331 9.57666 2.08331C11.3692 2.08331 12.1158 2.91665 12.1158 2.91665C14.2308 2.91665 14.5833 4.66415 14.5833 6.59748C14.5833 9.58331 13.5667 10.9741 12.0833 12.135V13.75Z" stroke="#466EDF" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col mt-2">
                                <span class="font-urbanist font-extrabold text-[15px] ">Alwi Susilo Damar Dininggrat</span>
                                <span class="font-urbanist font-semibold text-[12px] ">Nama Orang tua dari Ryan!</span>
                            </div>
                            <div class="flex gap-4 mt-4.5">
                                <div class="flex flex-col">
                                    <span class="font-urbanist font-extrabold text-sm ">Pekerjaan:</span>
                                    <span class="font-urbanist font-semibold text-[12px] ">Pegawai Swasta</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-urbanist font-extrabold text-sm ">Nomor Telepon</span>
                                    <span class="font-urbanist font-semibold text-[12px] ">+62 12345678910</span>
                                </div>
                            </div>
                        </div>

                        <!-- Data Ibu -->
                        <div class="flex-1 px-4 py-5 bg-linear-to-t from-pink-900 to-pink-700 rounded-lg">
                            <svg class="size-10 bg-white p-2.5 rounded-md text-pink-500" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0834 13.75L15.18 14.6817C15.7383 14.8515 16.2434 15.1626 16.6463 15.5848C17.0492 16.007 17.3364 16.526 17.48 17.0917C17.5934 17.5383 17.2075 17.9167 16.745 17.9167H3.25503C2.79253 17.9167 2.40669 17.5383 2.52003 17.0917C2.66367 16.526 2.95083 16.007 3.35375 15.5848C3.75667 15.1626 4.26171 14.8515 4.82003 14.6817L7.91669 13.75V11.9542C6.84586 11.8183 5.85836 11.5808 5.00003 11.2633C5.41669 10.4433 5.83336 9.21332 5.83336 6.34416C5.83336 1.42416 10.4167 1.42416 11.6667 3.06416C14.1667 2.65416 14.1667 4.70416 14.1667 7.16416C14.1667 9.13082 14.7225 10.7167 15 11.2642C14.1417 11.5808 13.1542 11.8183 12.0834 11.9542V13.75Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                            </svg>
                            <div class="flex flex-col mt-2">
                                <span class="font-urbanist font-extrabold text-[15px] ">Ni luh Aryawati Sukawati</span>
                                <span class="font-urbanist font-semibold text-[12px] ">Nama Orang tua dari Ryan!</span>
                            </div>
                            <div class="flex gap-4 mt-4.5">
                                <div class="flex flex-col">
                                    <span class="font-urbanist font-extrabold text-sm ">Pekerjaan:</span>
                                    <span class="font-urbanist font-semibold text-[12px] ">-</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-urbanist font-extrabold text-sm ">Nomor Telepon</span>
                                    <span class="font-urbanist font-semibold text-[12px] ">+62 10987654321</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Alamat</label>
                        <textarea
                            class="w-full border border-gray-300 p-3.5 rounded-md box-border"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Data Orang Tua & Wali</h2>
        <p>Silakan isi data orang tua / wali yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/orang_tua/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formOrang_tua"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan
        </button>
    </div>
</div>

<form id="formOrang_tua" action="/poin_pelanggaran_siswa/process/orang_tua/insert.php" method="POST">
    <!-- Form Data Orang Tua -->
    <div class="w-full bg-white rounded-md shadow-md mt-16">
        <!-- Header Identitas Orang Tua -->
        <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
            <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                    <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                </svg>
            </div>
            <span>IDENTITAS ORANG TUA</span>
        </div>

        <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
            <div class="flex gap-4 w-full">
                <!-- Input Nama Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama Ayah</label>
                    <input
                        type="text"
                        name="ayah"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-blue-500">
                </div>

                <!-- Input Nama Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama Ibu</label>
                    <input
                        type="text"
                        name="ibu"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input No. Telp Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Ayah</label>
                    <div class="flex">
                        <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                            +62
                        </span>

                        <input
                            type="text"
                            name="no_telp_ayah"
                            placeholder="8123456789"
                            class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <!-- Input No. Telp Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Ibu</label>
                    <div class="flex">
                        <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                            +62
                        </span>

                        <input
                            type="text"
                            name="no_telp_ibu"
                            placeholder="8123456789"
                            class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input Alamat Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat Ayah</label>
                    <textarea
                        name="alamat_ayah"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-blue-500"
                        rows="2"></textarea>
                </div>

                <!-- Input Alamat Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat Ibu</label>
                    <textarea
                        name="alamat_ibu"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-blue-500"
                        rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Data Wali -->
    <div class="w-full bg-white rounded-md shadow-md mt-12">
        <!-- Header Identitas Wali -->
        <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
            <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                    <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                </svg>
            </div>
            <span>IDENTITAS WALI</span>
        </div>

        <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
            <!-- Input Nama Wali -->
            <div>
                <label class="block mb-2 font-semibold">Nama wali</label>
                <input
                    type="text"
                    name="wali"
                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-blue-500">
            </div>

            <!-- Input No. Telp Wali -->
            <div>
                <label class="block mb-2 font-semibold">No. Telp Wali</label>
                <div class="flex">
                    <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                        +62
                    </span>

                    <input
                        type="text"
                        name="no_telp_ayah"
                        placeholder="8123456789"
                        class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Input Alamat Wali -->
            <div>
                <label class="block mb-2 font-semibold">Alamat wali</label>
                <textarea
                    name="alamat_wali"
                    class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-blue-500"
                    rows="2"></textarea>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Data Tahun Ajaran</h2>
        <p>Silahkan isi data tahun ajaran yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/tahun_ajaran/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formTahun_ajaran"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan
        </button>
    </div>
</div>

<form id="formTahun_ajaran" action="/poin_pelanggaran_siswa/process/tahun_ajaran/insert.php" method="POST">
    <!-- Form Data Tahun Ajaran -->
    <div class="w-full mt-16 flex gap-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Tahun Ajaran -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>TAHUN AJARAN</span>
                </div>

                <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="w-full">
                        <!-- Input Tahun Ajaran -->
                        <div>
                            <label class="block mb-2 font-semibold">Tahun Ajaran</label>
                            <input
                                type="text"
                                name="tahun"
                                class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Isi data tahun ajaran')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Jenis Kelamin & Status -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>STATUS</span>
                </div>

                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins font-medium text-sm border-2 border-t-0 border-gray-200">
                    <!-- Status Siswa -->
                    <p class="block mb-2 font-semibold">Status</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="w-full">
                            <label for="status_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                <p class="text-gray-700">Aktif</p>
                                <input
                                    type="radio"
                                    name="status"
                                    value="1"
                                    id="status_aktif"
                                    class="sr-only"
                                    required
                                    oninvalid="this.setCustomValidity('Pilih Status terlebih dahulu')"
                                    oninput="this.setCustomValidity('')">
                            </label>
                        </div>
                        <div class="w-full">
                            <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-red-600 has-checked:ring-1 has-checked:ring-red-600 has-checked:bg-red-100">
                                <p class="text-gray-700">Tidak Aktif</p>
                                <input
                                    type="radio"
                                    name="status"
                                    value="0"
                                    id="status_tidak_aktif"
                                    class="sr-only">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
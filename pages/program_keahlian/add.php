<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
?>

<div class="flex justify-between items-center px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Program Keahlian</h2>
        <p>Silakan isi data program keahlian yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/program_keahlian/list.php" class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">
            Batal
        </a>

        <!-- button Simpan -->
        <button type="submit" form="formProgramkeahlian"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">
            Simpan Data
        </button>
    </div>
</div>

<form id="formProgramkeahlian" action="/poin_pelanggaran_siswa/process/program_keahlian/insert.php" method="POST" autocomplete="off">
    <div class="w-full mt-16 flex gap-8 px-28">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 10.25H11.5M11.5 2.62C11.5 3.79 9.038 4.74 6 4.74C2.962 4.74 0.5 3.79 0.5 2.62C0.5 1.45 2.962 0.5 6 0.5C9.038 0.5 11.5 1.45 11.5 2.62ZM11.5 2.62V4.5M10.25 13.5C11.112 13.5 11.9386 13.1576 12.5481 12.5481C13.1576 11.9386 13.5 11.112 13.5 10.25C13.5 9.38805 13.1576 8.5614 12.5481 7.9519C11.9386 7.34241 11.112 7 10.25 7C9.38805 7 8.5614 7.34241 7.9519 7.9519C7.34241 8.5614 7 9.38805 7 10.25C7 11.112 7.34241 11.9386 7.9519 12.5481C8.5614 13.1576 9.38805 13.5 10.25 13.5Z" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M0.5 2.62V9.38C0.5 10.31 2.04 11.09 4.19 11.38" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.49 8C2.19 7.78 0.5 7 0.5 6" stroke="#0088FF" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>PROGRAM KEAHLIAN</span>
                </div>

                <div class="p-10 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">

                        <div class="flex-5">
                            <label class="block mb-2 font-semibold">Nama Program Keahlian</label>
                            <input
                                type="text"
                                name="deskripsi"
                                placeholder="Silakan masukkan nama program keahlian"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Nama program keahlian tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="flex-2">
                            <label class="block mb-2 font-semibold">Kode Program Keahlian</label>
                            <input
                                type="text"
                                name="program_keahlian"
                                placeholder="Masukkan kode program"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Kode program keahlian tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
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
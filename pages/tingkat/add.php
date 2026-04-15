<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

?>

<div class="flex justify-between items-center px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Tingkat Kelas</h2>
        <p>Silakan isi data tingkat kelas yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/tingkat/list.php" class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">
            Batal
        </a>

        <!-- button Simpan -->
        <button type="submit" form="formTingkat"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">
            Simpan Data
        </button>
    </div>
</div>

<form id="formTingkat" action="/poin_pelanggaran_siswa/process/tingkat/insert.php" method="POST" autocomplete="off">
    <div class="w-full mt-16 flex gap-8 px-28">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.443 3.83105C11.4433 4.49194 11.3133 5.1464 11.0605 5.75703C10.8077 6.36766 10.4371 6.92249 9.96974 7.3898C9.50243 7.85712 8.9476 8.22776 8.33697 8.48055C7.72634 8.73334 7.07188 8.86332 6.411 8.86305" stroke="#0088FF" stroke-linecap="round" />
                            <path d="M3.74199 8.86306C3.74199 9.21739 3.88275 9.5572 4.13329 9.80775C4.38384 10.0583 4.72366 10.1991 5.07799 10.1991C5.43232 10.1991 5.77214 10.0583 6.02268 9.80775C6.27323 9.5572 6.41399 9.21739 6.41399 8.86306C6.41399 8.50873 6.27323 8.16891 6.02268 7.91836C5.77214 7.66781 5.43232 7.52706 5.07799 7.52706C4.72366 7.52706 4.38384 7.66781 4.13329 7.91836C3.88275 8.16891 3.74199 8.50873 3.74199 8.86306ZM10.107 2.49506C10.107 2.84939 10.2477 3.1892 10.4983 3.43975C10.7488 3.6903 11.0887 3.83106 11.443 3.83106C11.7973 3.83106 12.1371 3.6903 12.3877 3.43975C12.6382 3.1892 12.779 2.84939 12.779 2.49506C12.779 2.14073 12.6382 1.80091 12.3877 1.55036C12.1371 1.29981 11.7973 1.15906 11.443 1.15906C11.0887 1.15906 10.7488 1.29981 10.4983 1.55036C10.2477 1.80091 10.107 2.14073 10.107 2.49506Z" stroke="#0088FF" />
                            <path d="M2.615 13.496L2.42 13.474C1.95134 13.4195 1.51494 13.208 1.18177 12.8739C0.848598 12.5398 0.638269 12.1028 0.584995 11.634L0.564995 11.444M0.563995 9.28603V7.71803M13.435 13.488H11.867M0.563995 5.67903V4.11103M9.829 13.464H8.26M0.563995 2.07203V0.504028M6.222 13.476H4.654" stroke="#0088FF" stroke-linecap="round" />
                        </svg>
                    </div>
                    <span>TINGKAT KELAS</span>
                </div>

                <div class="p-8 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="w-full">
                        <label class="block mb-2 font-semibold">Tingkat</label>
                        <input
                            type="text"
                            name="tingkat"
                            placeholder="Silakan masukkan tingkat kelas"
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                            required
                            oninvalid="this.setCustomValidity('Tingkat kelas tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
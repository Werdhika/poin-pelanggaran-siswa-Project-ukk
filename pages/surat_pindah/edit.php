<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$id = $_GET['id_surat_pindah'];
$result = mysqli_query($conn, "SELECT * FROM surat_pindah WHERE id_surat_pindah = '$id'");
$data = mysqli_fetch_assoc($result);
?>

<div class="flex justify-between items-start px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Edit Data Tahun Ajaran</h2>
        <p>Perbarui data tahun ajaran yang dipilih.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/surat_pindah/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formSurat_pindah"
            class="inline-flex items-center rounded-lg py-4 px-8 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Perubahan
        </button>
    </div>
</div>

<form id="formSurat_pindah" action="/poin_pelanggaran_siswa/process/surat_pindah/update.php" method="POST">
    <input type="hidden" name="id_surat_pindah" value="<?= $data['id_surat_pindah']; ?>">
    <!-- Form Data Tahun Ajaran -->
    <div class="w-full mt-16 px-28">
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
                    <!-- Input Tahun Ajaran -->
                    <div>
                        <label class="block mb-2 font-semibold">Nama Sekolah</label>
                        <input
                            type="text"
                            name="sekolah_tujuan"
                            value="<?= $data['sekolah_tujuan']; ?>"
                            placeholder="Silakan masukkan nama sekolah tujuan anda."
                            class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black"
                            required
                            oninvalid="this.setCustomValidity('Isi data tahun ajaran')"
                            oninput="this.setCustomValidity('')">
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Alasan Pindah</label>
                        <textarea
                            name="alasan_pindah"
                            placeholder="Silakan masukkan alasan anda pindah sekolah."
                            class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black "
                            rows="2"><?= $data['alasan_pindah']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$id = $_GET['id_profil_sekolah'];
$result = mysqli_query($conn, "SELECT * FROM profil_sekolah WHERE id_profil_sekolah = '$id'");
$data = mysqli_fetch_assoc($result);
?>

<div class="flex justify-between items-start px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Edit Profil Sekolah</h2>
        <p>Perbarui data Profil Sekolah yang dipilih.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/profil_sekolah/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formProfil_sekolah"
            class="inline-flex items-center rounded-lg py-4 px-8 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Perubahan
        </button>
    </div>
</div>

<form id="formProfil_sekolah" action="/poin_pelanggaran_siswa/process/profil_sekolah/update.php" method="POST">
    <input type="hidden" name="id_profil_sekolah" value="<?= $data['id_profil_sekolah']; ?>">
    <!-- Form Data Tahun Ajaran -->
    <div class="w-full mt-16 px-28 mb-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-5" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.5 8.25V12C16.5 13.7678 16.5 14.6512 15.951 15.201C15.4012 15.75 14.5177 15.75 12.75 15.75H5.25C3.48225 15.75 2.598 15.75 2.049 15.201C1.5 14.6512 1.5 13.7678 1.5 12V8.25C1.5 7.2 1.5 6.675 1.704 6.27375C1.88379 5.92077 2.17077 5.63379 2.52375 5.454C2.925 5.25 3.45 5.25 4.5 5.25L7.2 3.225C8.067 2.57475 8.49975 2.25 9 2.25C9.50025 2.25 9.933 2.57475 10.8 3.225L13.5 5.25C14.55 5.25 15.075 5.25 15.4762 5.454C15.829 5.63392 16.1156 5.92088 16.2952 6.27375C16.5 6.675 16.5 7.2 16.5 8.25Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.5 15.75V13.5C7.5 13.1022 7.65803 12.7206 7.93934 12.4393C8.22064 12.158 8.60217 12 9 12C9.39782 12 9.77935 12.158 10.0607 12.4393C10.342 12.7206 10.5 13.1022 10.5 13.5V15.75M4.875 8.25H4.125V9H4.875V8.25ZM4.875 11.625H4.125V12.375H4.875V11.625ZM13.875 8.25H13.125V9H13.875V8.25ZM13.875 11.625H13.125V12.375H13.875V11.625ZM9 9C9.39782 9 9.77935 8.84196 10.0607 8.56066C10.342 8.27935 10.5 7.89782 10.5 7.5C10.5 7.10217 10.342 6.72064 10.0607 6.43934C9.77935 6.15804 9.39782 6 9 6C8.60217 6 8.22064 6.15804 7.93934 6.43934C7.65803 6.72064 7.5 7.10217 7.5 7.5C7.5 7.89782 7.65803 8.27935 7.93934 8.56066C8.22064 8.84196 8.60217 9 9 9Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>PROFIL SEKOLAH</span>
                </div>

                <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div>
                        <label class="block mb-2 font-semibold">Nama sekolah</label>
                        <input
                            type="text"
                            name="nama_sekolah"
                            value="<?= $data['nama_sekolah']; ?>"
                            placeholder="Silakan masukkan nama profil sekolah."
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                            required
                            oninvalid="this.setCustomValidity('Nama profil sekolah tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')">
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Wilayah Sekolah</label>
                        <input
                            type="text"
                            name="kota"
                            value="<?= $data['kota']; ?>"
                            placeholder="Silakan masukkan wilayah sekolah."
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black "
                            required
                            oninvalid="this.setCustomValidity('Wilayah sekolah tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')">
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Alamat Sekolah</label>
                        <textarea
                            name="alamat_sekolah"
                            placeholder="Silakan masukkan alamat sekolah."
                            class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black"
                            required
                            oninvalid="this.setCustomValidity('Alamat tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')"
                            rows="4"><?= $data['alamat_sekolah']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
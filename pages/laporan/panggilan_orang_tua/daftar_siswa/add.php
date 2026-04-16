<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

// untuk mendapatkan data nis
if (!empty($_POST)) {
    @$nis = $_POST['nis'];
} else {
    @$nis = $_GET['nis'];
}

$resultNis = mysqli_query($conn, "SELECT COUNT(*) as data FROM surat_keluar WHERE nis='$nis'");
$count_nis = mysqli_fetch_assoc($resultNis);

if ($count_nis['data'] > 0) {
    echo "<script>window.alert('Maaf, Surat Pemanggilan Orang Tua Sudah Ada')
    window.location='pages/laporan/panggilan_orang_tua/daftar_siswa/list.php'</script>";
}

//query untuk dropdown NIS
$resultSiswa = mysqli_query($conn, "SELECT nis, nama_siswa FROM siswa");
?>

<div class="flex justify-between items-start px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Surat Panggilan Orang Tua</h2>
        <p>Silahkan isi data pelanggaran siswa yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="pages/laporan/panggilan_orang_tua/daftar_siswa/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formPanggilan_orang_tua"
            class="inline-flex items-center rounded-lg py-4 px-8 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Data
        </button>
    </div>
</div>

<form id="formPanggilan_orang_tua" action="/poin_pelanggaran_siswa/process/laporan_surat_panggilan_orang_tua/insert.php" method="POST">
    <div class="w-full mt-16 flex gap-8 px-28">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.7333 5.84753L14.7117 6.90669M9.88166 9.01086L11.87 9.54086M9.98083 14.9717L10.7758 15.1842C13.0258 15.7842 14.1508 16.0834 15.0375 15.5742C15.9233 15.0659 16.225 13.9467 16.8275 11.71L17.68 8.54586C18.2833 6.30836 18.5842 5.19003 18.0725 4.30836C17.5608 3.4267 16.4367 3.12753 14.1858 2.52836L13.3908 2.31586C11.1408 1.71586 10.0158 1.41669 9.13 1.92586C8.24333 2.43419 7.94166 3.55336 7.33833 5.79003L6.48666 8.95419C5.88333 11.1917 5.58166 12.31 6.09416 13.1917C6.60583 14.0725 7.73083 14.3725 9.98083 14.9717Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M10 17.455L9.20666 17.6717C6.96166 18.2825 5.84 18.5884 4.955 18.0692C4.07166 17.5509 3.77 16.4101 3.16916 14.1292L2.31833 10.9025C1.71666 8.62172 1.41583 7.48088 1.92666 6.58255C2.36833 5.80505 3.33333 5.83338 4.58333 5.83338" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <span>PELANGGARAN SISWA</span>
                </div>

                <div class="p-10 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">
                        <!-- NIS -->
                        <div class="flex-3">
                            <label class="block mb-2 font-semibold">NIS & Nama Siswa</label>
                            <div class="relative">
                                <select
                                    name="nis"
                                    class="w-full border border-gray-300 p-3 pr-10 rounded-md appearance-none">
                                    <option value="" disabled selected hidden>Pilih NIS Siswa</option>

                                    <?php
                                    while ($siswa = mysqli_fetch_assoc($resultSiswa)) { ?>
                                        <option value="<?= $siswa['nis'] ?>" <?php echo ($nis == $siswa['nis']) ? 'selected' : ''; ?>>
                                            <?= $siswa['nis'] ?> - <?= $siswa['nama_siswa'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                                </svg>
                            </div>
                        </div>

                        <!-- Select Nama Siswa -->
                        <div class="flex-1">
                            <label class="block mb-2 font-semibold">Nomor Surat</label>
                            <input
                                type="number"
                                name="no_surat"
                                placeholder="550"
                                class="w-full border border-gray-300 p-3 rounded-md box-border"
                                required
                                oninvalid="this.setCustomValidity('No. Surat tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="flex-2">
                            <label class="block mb-2 font-semibold">Tanggal Pemanggilan</label>
                            <input
                                type="date"
                                name="tanggal_pemanggilan"
                                placeholder="Silakan masukkan nomor surat"
                                class="w-full border border-gray-300 p-3 rounded-md box-border"
                                required
                                oninvalid="this.setCustomValidity('Pilih tanggal pemanggilan!')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="flex-1">
                            <label class="block mb-2 font-semibold">Jam</label>
                            <input
                                type="time"
                                name="jam"
                                placeholder="Silakan masukkan nomor surat"
                                class="w-full border border-gray-300 p-3 rounded-md box-border"
                                required
                                oninvalid="this.setCustomValidity('Pilih Jam!')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>

                    <!-- Keterangan Pelanggaran -->
                    <div>
                        <label class="block mb-2 font-semibold">Keperluan</label>
                        <textarea
                            name="keperluan"
                            placeholder="Silakan masukkan keperluan."
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                            rows="4"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
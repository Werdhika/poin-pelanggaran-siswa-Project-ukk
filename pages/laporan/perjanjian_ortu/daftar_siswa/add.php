<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

//untuk mendapatkan data nis
if (!empty($_POST)) {
    @$nis = $_POST['nis'];
} else {
    @$nis = $_GET['nis'];
}

$resultNis = mysqli_query($conn, "SELECT COUNT(*) as data FROM perjanjian_orang_tua WHERE nis='$nis'");
$count_nis = mysqli_fetch_assoc($resultNis);
if ($count_nis['data'] > 0) {
    echo "<script>window.alert('Maaf, Surat Pemanggilan Orang Tua Sudah Ada')
    window.location='pages/laporan/perjanjian_ortu/daftar_siswa/init.php'</script>";
}

//query untuk dropdown NIS
$dropdown = mysqli_query($conn, "SELECT nis, nama_siswa FROM siswa");

$resultSiswa = mysqli_query($conn, "SELECT 
                                a.nis, 
                                a.nama_siswa,
                                b.ayah,
                                b.ibu,
                                b.wali,
                                b.tempat_lahir_ayah,
                                b.tempat_lahir_ibu,
                                b.tempat_lahir_wali,
                                b.tanggal_lahir_ayah,
                                b.tanggal_lahir_ibu,
                                b.tanggal_lahir_wali,
                                b.pekerjaan_ayah,
                                b.pekerjaan_ibu,
                                b.pekerjaan_wali,
                                b.no_telp_ayah,
                                b.no_telp_ibu,
                                b.no_telp_wali,
                                b.alamat_ayah,
                                b.alamat_ibu,
                                b.alamat_wali
                        FROM siswa a
                        LEFT JOIN ortu_wali b ON a.nis = b.nis
                        WHERE a.nis = '$nis';
                        ");

$data = mysqli_fetch_assoc($resultSiswa);



// print_r($data);
// exit;
?>

<div class="flex justify-between items-start px-24">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Surat Perjanjian Ortu</h2>
        <p>Silahkan isi data surat perjanjian ortu yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/laporan/perjanjian_ortu/daftar_siswa/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formPerjanjian_ortu"
            class="inline-flex items-center rounded-lg py-4 px-8 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Print Surat
        </button>
    </div>
</div>

<form id="formPerjanjian_ortu" action="/poin_pelanggaran_siswa/process/laporan_surat_perjanjian_ortu/insert.php" method="POST">
    <div class="w-full mt-16 flex gap-8 px-24">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>DATA SISWA</span>
                </div>

                <div class="p-10 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">
                        <!-- NIS -->
                        <div class="flex-3">
                            <label class="block mb-2 font-semibold">NIS Siswa</label>
                            <div class="relative">
                                <select
                                    name="nis"
                                    class="w-full border border-gray-300 p-3 pr-10 rounded-md appearance-none"
                                    required
                                    oninvalid="this.setCustomValidity('Nama ')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected hidden>Pilih NIS Siswa</option>

                                    <?php
                                    while ($siswa = mysqli_fetch_assoc($dropdown)) { ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="w-full mt-16 flex gap-8 px-24">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>PERJANJIAN ORTU</span>
                </div>

                <div class="p-10 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">
                        <!-- Input Nama Ayah -->
                        <?php if (!empty($data['ayah'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Nama Ayah</label>
                                <input
                                    type="text"
                                    name="ayah"
                                    value="<?= $data['ayah']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>

                        <!-- Input Nama Ibu -->
                        <?php if (!empty($data['ibu'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Nama Ibu</label>
                                <input
                                    type="text"
                                    name="ibu"
                                    value="<?= $data['ibu']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>

                        <?php if (!empty($data['wali'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Nama wali</label>
                                <input
                                    type="text"
                                    name="wali"
                                    value="<?= $data['wali']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="flex gap-4 w-full">
                        <!-- Input Tempat Lahir Ayah -->
                        <?php if (!empty($data['ayah'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Tempat Lahir Ayah</label>
                                <input
                                    type="text"
                                    name="tempat_lahir_ayah"
                                    value="<?= $data['tempat_lahir_ayah']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>

                        <!-- Input Tempat Lahir Ibu -->
                        <?php if (!empty($data['ibu'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Tempat Lahir Ibu</label>
                                <input
                                    type="text"
                                    name="tempat_lahir_ibu"
                                    value="<?= $data['tempat_lahir_ibu']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>

                        <!-- Input Tempat Lahir Wai -->
                        <?php if (!empty($data['wali'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Tempat Lahir Wali</label>
                                <input
                                    type="text"
                                    name="tempat_lahir_wali"
                                    value="<?= $data['tempat_lahir_wali']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="flex gap-4 w-full">
                        <!-- Input Tanggal Lahir Ayah -->
                        <?php if (!empty($data['ayah'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Tanggal Lahir Ayah</label>
                                <input
                                    type="text"
                                    name="tanggal_lahir_ayah"
                                    value="<?= $data['tanggal_lahir_ayah']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black">
                            </div>
                        <?php } ?>

                        <!-- Input Tanggal Lahir Ibu -->
                        <?php if (!empty($data['ibu'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Tanggal Lahir Ibu</label>
                                <input
                                    type="text"
                                    name="tanggal_lahir_ibu"
                                    value="<?= $data['tanggal_lahir_ibu']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black">
                            </div>
                        <?php } ?>

                        <!-- Input Tanggal Lahir Wali -->
                        <?php if (!empty($data['wali'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Tanggal Lahir Wali</label>
                                <input
                                    type="text"
                                    name="tanggal_lahir_wali"
                                    value="<?= $data['tanggal_lahir_wali']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="flex gap-4 w-full">
                        <!-- Input Pekerjaan Ayah -->
                        <?php if (!empty($data['ayah'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Pekerjaan Ayah</label>
                                <input
                                    type="text"
                                    name="pekerjaan_ayah"
                                    value="<?= $data['pekerjaan_ayah']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>

                        <!-- Input Pekerjaan Ibu -->
                        <?php if (!empty($data['ibu'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Pekerjaan Ibu</label>
                                <input
                                    type="text"
                                    name="pekerjaan_ibu"
                                    value="<?= $data['pekerjaan_ibu']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>

                        <!-- Input Pekerjaan Wali -->
                        <?php if (!empty($data['wali'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Pekerjaan wali</label>
                                <input
                                    type="text"
                                    name="pekerjaan_wali"
                                    value="<?= $data['pekerjaan_wali']; ?>"
                                    readonly
                                    class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="flex gap-4 w-full">
                        <!-- Input No. Telp Ayah -->
                        <?php if (!empty($data['ayah'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">No. Telp Ayah</label>
                                <div class="flex">
                                    <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                                        +62
                                    </span>

                                    <input
                                        type="number"
                                        name="no_telp_ayah"
                                        placeholder="8123456789"
                                        value="<?= $data['no_telp_ayah']; ?>"
                                        readonly
                                        class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-black ">
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Input No. Telp Ibu -->
                        <?php if (!empty($data['ibu'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">No. Telp Ibu</label>
                                <div class="flex">
                                    <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                                        +62
                                    </span>

                                    <input
                                        type="number"
                                        name="no_telp_ibu"
                                        placeholder="8123456789"
                                        value="<?= $data['no_telp_ibu']; ?>"
                                        readonly
                                        class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-black ">
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Input No. Telp Wali -->
                        <?php if (!empty($data['wali'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">No. Telp Wali</label>
                                <div class="flex">
                                    <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                                        +62
                                    </span>

                                    <input
                                        type="number"
                                        name="no_telp_wali"
                                        placeholder="8123456789"
                                        value="<?= $data['no_telp_wali']; ?>"
                                        readonly
                                        class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-black">
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="flex gap-4 w-full">
                        <!-- Input Alamat Ayah -->
                        <?php if (!empty($data['ayah'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Alamat Ayah</label>
                                <textarea
                                    name="alamat_ayah"
                                    class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black"
                                    readonly
                                    rows="2"><?= $data['alamat_ayah']; ?></textarea>
                            </div>
                        <?php } ?>

                        <!-- Input Alamat Ibu -->
                        <?php if (!empty($data['ibu'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Alamat Ibu</label>
                                <textarea
                                    name="alamat_ibu"
                                    class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black"
                                    readonly
                                    rows="2"><?= $data['alamat_ibu']; ?></textarea>
                            </div>
                        <?php } ?>

                        <!-- Input Alamat Wali -->
                        <?php if (!empty($data['wali'])) { ?>
                            <div class="flex-1">
                                <label class="block mb-2 font-semibold">Alamat wali</label>
                                <textarea
                                    name="alamat_wali"
                                    class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black"
                                    readonly
                                    rows="2"><?= $data['alamat_wali']; ?></textarea>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
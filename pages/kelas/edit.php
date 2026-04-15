<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$id = $_GET['id_kelas'];
$result = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = '$id'");
$data = mysqli_fetch_assoc($result);

$resultTingkat = mysqli_query($conn, "SELECT * FROM tingkat");
$resultProgram = mysqli_query($conn, "SELECT * FROM program_keahlian");
$resultGuru = mysqli_query($conn, "SELECT kode_guru, nama FROM guru");
?>

<div class="flex justify-between items-center px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Edit Kelas</h2>
        <p>Perbarui data Kelas yang dipilih.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300" href="/poin_pelanggaran_siswa/pages/kelas/list.php">
            Batal
        </a>

        <!-- button Simpan -->
        <button type="submit" form="formKelas"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">
            Simpan Perubahan
        </button>
    </div>
</div>

<form id="formKelas" action="/poin_pelanggaran_siswa/process/kelas/update.php" method="POST">
    <input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>">
    <div class="w-full mt-16 flex gap-8 px-28">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.25 9.99998C15.805 10.0023 15.3689 10.1245 14.9875 10.3537L13.2006 8.56685L14.6338 7.13373C14.8681 6.89932 14.9997 6.58143 14.9997 6.24998C14.9997 5.91852 14.8681 5.60064 14.6338 5.36623L10.8838 1.61623C10.6493 1.38189 10.3315 1.25024 10 1.25024C9.66855 1.25024 9.35066 1.38189 9.11625 1.61623L5.36625 5.36623C5.13191 5.60064 5.00027 5.91852 5.00027 6.24998C5.00027 6.58143 5.13191 6.89932 5.36625 7.13373L6.79938 8.56685L5.0125 10.3537C4.48305 10.0396 3.85713 9.92954 3.25228 10.0442C2.64743 10.159 2.10526 10.4905 1.72759 10.9767C1.34992 11.4629 1.16272 12.0702 1.20116 12.6846C1.2396 13.2991 1.50102 13.8783 1.93634 14.3136C2.37165 14.749 2.95092 15.0104 3.56534 15.0488C4.17977 15.0873 4.7871 14.9001 5.27327 14.5224C5.75945 14.1447 6.09102 13.6025 6.20573 12.9977C6.32044 12.3928 6.21039 11.7669 5.89625 11.2375L7.68313 9.4506L9.11625 10.8837C9.19375 10.9592 9.28073 11.0244 9.375 11.0775V13.75H7.5V18.75H12.5V13.75H10.625V11.0769C10.7192 11.0239 10.8062 10.959 10.8838 10.8837L12.3169 9.4506L14.1038 11.2375C13.827 11.7123 13.7148 12.2652 13.7848 12.8104C13.8547 13.3555 14.1028 13.8622 14.4905 14.2518C14.8782 14.6413 15.3838 14.8919 15.9285 14.9644C16.4733 15.0369 17.0268 14.9274 17.5029 14.6529C17.9791 14.3784 18.3511 13.9542 18.5613 13.4464C18.7714 12.9386 18.8079 12.3755 18.665 11.8448C18.5221 11.3141 18.2078 10.8455 17.7711 10.5119C17.3343 10.1783 16.7996 9.9983 16.25 9.99998ZM5 12.5C5 12.7472 4.92669 12.9889 4.78934 13.1944C4.65199 13.4 4.45676 13.5602 4.22836 13.6548C3.99995 13.7494 3.74861 13.7742 3.50614 13.726C3.26366 13.6777 3.04093 13.5587 2.86612 13.3839C2.6913 13.209 2.57225 12.9863 2.52402 12.7438C2.47579 12.5014 2.50054 12.25 2.59515 12.0216C2.68976 11.7932 2.84998 11.598 3.05554 11.4606C3.2611 11.3233 3.50277 11.25 3.75 11.25C4.08152 11.25 4.39946 11.3817 4.63388 11.6161C4.86831 11.8505 5 12.1685 5 12.5ZM11.25 15V17.5H8.75V15H11.25ZM10 9.99998L6.25 6.24998L10 2.49998L13.75 6.24998L10 9.99998ZM16.25 13.75C16.0028 13.75 15.7611 13.6767 15.5555 13.5393C15.35 13.402 15.1898 13.2067 15.0952 12.9783C15.0005 12.7499 14.9758 12.4986 15.024 12.2561C15.0723 12.0136 15.1913 11.7909 15.3661 11.6161C15.5409 11.4413 15.7637 11.3222 16.0061 11.274C16.2486 11.2258 16.4999 11.2505 16.7284 11.3451C16.9568 11.4397 17.152 11.6 17.2893 11.8055C17.4267 12.0111 17.5 12.2528 17.5 12.5C17.5 12.8315 17.3683 13.1494 17.1339 13.3839C16.8995 13.6183 16.5815 13.75 16.25 13.75Z" fill="#0088FF" />
                        </svg>
                    </div>
                    <span>JENIS PELANGGARAN</span>
                </div>

                <div class="p-10 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">

                        <div class="flex-6">
                            <label class="block mb-2 font-semibold">Nama Wali Kelas</label>
                            <div class="relative">
                                <select
                                    name="kode_guru"
                                    class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                    required
                                    oninvalid="this.setCustomValidity('Pilih wali kelas!')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected hidden>Pilih Wali Kelas</option>

                                    <?php
                                    while ($guru = mysqli_fetch_assoc($resultGuru)) {
                                        $selected = ($guru['kode_guru'] == $data['kode_guru']) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $guru['kode_guru'] ?>" <?= $selected ?>>
                                            <?= $guru['kode_guru'] ?> - <?= $guru['nama'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex-2">
                            <label class="block mb-2 font-semibold">Tingkat</label>
                            <div class="relative">
                                <select
                                    name="id_tingkat"
                                    class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                    required
                                    oninvalid="this.setCustomValidity('Pilih tingkat!')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected hidden>Pilih Tingkat</option>

                                    <?php
                                    while ($tingkat = mysqli_fetch_assoc($resultTingkat)) {
                                        $selected = ($tingkat['id_tingkat'] == $data['id_tingkat']) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $tingkat['id_tingkat'] ?>" <?= $selected ?>>
                                            <?= $tingkat['tingkat'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex-2">
                            <label class="block mb-2 font-semibold">Program Keahlian</label>
                            <div class="relative">
                                <select
                                    name="id_program_keahlian"
                                    class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                    required
                                    oninvalid="this.setCustomValidity('Pilih program keahlian!')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected hidden>Pilih Program</option>

                                    <?php while ($program = mysqli_fetch_assoc($resultProgram)) {
                                        $selected = ($program['id_program_keahlian'] == $data['id_program_keahlian']) ? 'selected' : '';
                                    ?>
                                        <option value="<?= $program['id_program_keahlian'] ?>" <?= $selected ?>>
                                            <?= $program['program_keahlian'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex-2">
                            <label class="block mb-2 font-semibold">Rombel</label>
                            <input
                                type="number"
                                name="rombel"
                                value="<?= $data['rombel']; ?>"
                                placeholder="Contoh: 1"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                required
                                oninvalid="this.setCustomValidity('Rombel tidak boleh kosong!')"
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
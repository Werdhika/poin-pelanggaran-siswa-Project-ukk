<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$kode_guru = $_GET['kode_guru'];
$result = mysqli_query($conn, "SELECT * FROM guru WHERE kode_guru = '$kode_guru'");
$data = mysqli_fetch_assoc($result);
$query_jabatan = mysqli_query($conn, "SELECT DISTINCT jabatan FROM guru")
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Edit Data Guru</h2>
        <p>Perbarui data guru yang dipilih.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="pages/guru/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formGuru"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Perubahan
        </button>
    </div>
</div>

<!-- Form Data Edit Guru -->
<form id="formGuru" action="/poin_pelanggaran_siswa/process/guru/update.php" method="POST" autocomplete="off">
    <div class="w-full mt-16 flex gap-8 mb-10">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Identitas Siswa -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>IDENTITAS GURU</span>
                </div>

                <!-- Input Data Siswa -->
                <div class="p-8 pb-42 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">
                        <!-- Input NIS -->
                        <div class="flex-[1%]">
                            <label class="block mb-2 font-semibold">Kode Guru</label>
                            <input
                                type="text"
                                name="kode_guru"
                                value="<?= $data['kode_guru']; ?>"
                                class="w-full border border-gray-300 p-3 rounded-md box-border text-center focus:outline-none focus:border-black"
                                readonly>
                        </div>

                        <!-- Input Username -->
                        <div class="flex-2.5">
                            <label class="block mb-2 font-semibold">Username</label>
                            <input
                                type="text"
                                value="<?= $data['username']; ?>"
                                name="username"
                                placeholder="Masukkan username"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Username tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <!-- Input Nama Guru -->
                        <div class="flex-5">
                            <label class="block mb-2 font-semibold">Nama Guru</label>
                            <input
                                type="text"
                                name="nama"
                                value="<?= $data['nama']; ?>"
                                placeholder="Silakan masukkan nama guru"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Nama guru tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>

                    <!-- Pilih Jabatan -->
                    <div class="flex-3">
                        <label class="block mb-2 font-semibold">Jabatan</label>
                        <div class="relative">
                            <select
                                name="jabatan"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                required
                                oninvalid="this.setCustomValidity('Jabatan tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                                <option value="" disabled selected hidden>Pilih Jabatan</option>

                                <!-- Query Jabatan Guru -->
                                <?php while ($jabatan = mysqli_fetch_assoc($query_jabatan)) { ?>
                                    <option
                                        value="<?= $jabatan['jabatan'] ?>"
                                        <?= ($jabatan['jabatan'] == $data['jabatan']) ? 'selected' : ''; ?>>
                                        <?= $jabatan['jabatan'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                            </svg>
                        </div>
                    </div>

                    <!-- Input NO. Telp Guru -->
                    <div>
                        <label class="block mb-2 font-semibold">No. Telepon</label>
                        <input
                            type="number"
                            name="telp" value="<?= $data['telp']; ?>"
                            placeholder="Silakan masukkan nomor telepon"
                            class="w-full border border-gray-300 p-3 rounded-md box-border"
                            required
                            oninvalid="this.setCustomValidity('No. Telp tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Jenis Kelamin & Status -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.8333 6.99996C12.8333 10.2217 10.2217 12.8333 6.99999 12.8333C3.77824 12.8333 1.16666 10.2217 1.16666 6.99996C1.16666 3.77821 3.77824 1.16663 6.99999 1.16663C10.2217 1.16663 12.8333 3.77821 12.8333 6.99996Z" stroke="#0088FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="4 4" />
                        </svg>
                    </div>
                    <span>ROLE & STATUS</span>
                </div>

                <!-- Pilih Role & Status Guru -->
                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins text-sm border-2 border-t-0 border-gray-200">
                    <!-- Role Guru -->
                    <div>
                        <label class="block mb-2 font-semibold font-poppins">Role</label>
                        <div class="flex flex-col gap-4">
                            <div class="flex gap-4">

                                <div class="w-full">
                                    <label for="Kepala Sekolah" class="flex gap-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-blue-800 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                        <p>Kepala Sekolah</p>
                                        <input type="radio"
                                            name="role"
                                            value="Kepala Sekolah"
                                            <?= $data['role'] == 'Kepala Sekolah' ? 'checked' : ''; ?>
                                            id="Kepala Sekolah"
                                            class="sr-only">
                                    </label>
                                </div>

                                <div class="w-full">
                                    <label for="Wakasek" class="flex gap-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-blue-800 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                        <p>Wakasek</p>
                                        <input
                                            type="radio"
                                            name="role"
                                            value="Wakasek"
                                            <?= $data['role'] == 'Wakasek' ? 'checked' : ''; ?>
                                            id="Wakasek"
                                            class="sr-only">
                                    </label>
                                </div>
                            </div>

                            <div class="flex gap-4">

                                <div class="w-full">
                                    <label for="Guru" class="flex gap-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-blue-800
                                    has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                        <p>Guru</p>
                                        <input
                                            type="radio"
                                            name="role"
                                            value="Guru"
                                            <?= $data['role'] == 'Guru' ? 'checked' : ''; ?>
                                            id="Guru"
                                            class="sr-only"
                                            required
                                            oninvalid="this.setCustomValidity('Pilih jenis kelamin terlebih dahulu')"
                                            oninput="this.setCustomValidity('')">
                                    </label>
                                </div>

                                <div class="w-full">
                                    <label for="Guru BK" class="flex gap-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-blue-800 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                        <p>Guru BK</p>
                                        <input
                                            type="radio"
                                            name="role"
                                            value="Guru BK"
                                            <?= $data['role'] == 'Guru BK' ? 'checked' : ''; ?>
                                            id="Guru BK"
                                            class="sr-only">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Siswa -->
                    <div class="pb-0.5">
                        <label class="block mb-2 font-semibold">Status</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="w-full">
                                <label for="status_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-green-800 has-checked:border-green-600 has-checked:ring-1 has-checked:ring-green-600 has-checked:bg-green-100">
                                    <p>Aktif</p>
                                    <input type="radio"
                                        name="status"
                                        value="1"
                                        <?= $data['status'] == '1' ? 'checked' : ''; ?>
                                        id="status_aktif"
                                        class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih Status terlebih dahulu!')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-red-800 has-checked:border-red-600 has-checked:ring-1 has-checked:ring-red-600 has-checked:bg-red-100">
                                    <p>Tidak Aktif</p>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="0"
                                        <?= $data['status'] == '0' ? 'checked' : ''; ?>
                                        id="status_tidak_aktif"
                                        class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold font-poppins">password</label>
                        <div class="w-full">
                            <input
                                type="password"
                                name="password"
                                value="<?= @$data['']; ?>"
                                placeholder="Silakan masukkan password"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                        </div>
                        <div class="mt-3 text-xs text-yellow-700 bg-yellow-50 border border-yellow-300 rounded-md p-3 gap-1 leading-4.5 flex font-medium">
                            <svg class="size-5 shrink-0" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.2875 2.60848L1.7585 8.49998C1.68579 8.626 1.64733 8.76886 1.64695 8.91435C1.64656 9.05984 1.68427 9.20289 1.75632 9.32929C1.82836 9.45569 1.93224 9.56103 2.05762 9.63483C2.183 9.70864 2.32552 9.74834 2.471 9.74998H9.529C9.67454 9.74848 9.81714 9.70888 9.94261 9.63511C10.0681 9.56134 10.172 9.45598 10.2441 9.32953C10.3162 9.20308 10.3539 9.05996 10.3534 8.91441C10.353 8.76886 10.3144 8.62598 10.2415 8.49998L6.713 2.60848C6.63878 2.48595 6.53421 2.38462 6.4094 2.3143C6.28459 2.24398 6.14376 2.20703 6.0005 2.20703C5.85724 2.20703 5.7164 2.24398 5.59159 2.3143C5.46678 2.38462 5.36221 2.48595 5.288 2.60848" fill="currentColor" fill-opacity="0.16" />
                                <path d="M6 7.99998H6.004M6 4.99998V6.49998M5.2875 2.60848L1.7585 8.49998C1.68579 8.626 1.64733 8.76886 1.64695 8.91435C1.64656 9.05984 1.68427 9.20289 1.75632 9.32929C1.82836 9.45569 1.93224 9.56103 2.05762 9.63483C2.183 9.70864 2.32552 9.74834 2.471 9.74998H9.529C9.67454 9.74848 9.81714 9.70888 9.94261 9.63511C10.0681 9.56134 10.172 9.45598 10.2441 9.32953C10.3162 9.20308 10.3539 9.05996 10.3534 8.91441C10.353 8.76886 10.3144 8.62598 10.2415 8.49998L6.713 2.60848C6.63878 2.48595 6.53421 2.38462 6.4094 2.3143C6.28459 2.24398 6.14376 2.20703 6.0005 2.20703C5.85724 2.20703 5.7164 2.24398 5.59159 2.3143C5.46678 2.38462 5.36221 2.48595 5.288 2.60848" stroke="currentColor" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p>
                                <span class="font-semibold">Catatan:</span>
                                Biarkan kosong jika tidak ingin mengganti password
                            </p>
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
<?php
// Menentukan lokasi root folder proyek di server
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
// Menghubungkan ke file konfigurasi (koneksi database)
include ROOTPATH . "/config/config.php";
// Menghubungkan ke file header
include ROOTPATH . "/includes/header.php";

$nis = $_GET['nis'];

$result = mysqli_query($conn, "SELECT
        a.nis,
        a.nama_siswa,
        a.id_kelas,
        a.jenis_kelamin,
        a.alamat,
        a.password,
        a.status,
        b.nis as nis_ortu,
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
    WHERE a.nis = '$nis'
");

$data = mysqli_fetch_assoc($result);

$query_kelas = mysqli_query($conn, "SELECT 
            a.rombel, 
            a.id_kelas, 
            a.id_tingkat,
            a.id_program_keahlian,
            b.tingkat, 
            c.program_keahlian
    FROM kelas a
    LEFT JOIN tingkat b ON a.id_tingkat = b.id_tingkat
    LEFT JOIN program_keahlian c ON a.id_program_keahlian = c.id_program_keahlian
");
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Edit Data Siswa & Ortu Wali</h2>
        <p>Silakan perbarui data siswa yang dipilih.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="pages/siswa/list.php" class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal</a>

        <!-- button Simpan -->
        <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
            <button type="submit"
                form="formSiswa"
                class="inline-flex items-center rounded-lg py-4 px-8 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Perubahan
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Form Data Siswa -->
<form id="formSiswa" action="/poin_pelanggaran_siswa/process/siswa/siswa_update.php" method="POST" autocomplete="off">
    <div class="w-full mt-16 flex gap-8">
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
                    <span>IDENTITAS SISWA</span>
                </div>

                <!-- Input Data Siswa -->
                <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">
                        <!-- Input NIS -->
                        <div class="flex-[1%]">
                            <label class="block mb-2 font-semibold">NIS</label>
                            <input
                                type="text"
                                name="nis"
                                value="<?= $data['nis']; ?>"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black text-center"
                                readonly>
                        </div>

                        <!-- Input Nama Siswa -->
                        <div class="flex-7">
                            <label class="block mb-2 font-semibold">Nama Siswa</label>
                            <input
                                type="text"
                                name="nama_siswa"
                                value="<?= $data['nama_siswa']; ?>"
                                placeholder="Silakan masukkan nama siswa"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Nama siswa tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>

                    <!-- Input Kelas -->
                    <div class="mb-14">
                        <label class="block mb-2 font-semibold">Kelas</label>
                        <div class="relative">
                            <select
                                name="id_kelas"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                required
                                oninvalid="this.setCustomValidity('Kelas tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                                <option value="" disabled selected hidden>Pilih Kelas</option>

                                <!-- Query Kelas -->
                                <?php while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>
                                    <option value="<?= $kelas['id_kelas'] ?>"
                                        <?= ($kelas['id_kelas'] == $data['id_kelas']) ? 'selected' : ''; ?>>
                                        <?= "$kelas[tingkat] $kelas[program_keahlian] $kelas[rombel]" ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                            </svg>
                        </div>
                    </div>

                    <!-- Input Alamat Siswa -->
                    <div>
                        <label class="block mb-2 font-semibold">Alamat</label>
                        <textarea
                            name="alamat"
                            placeholder="Silakan masukkan alamat"
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                            rows="6"
                            required
                            oninvalid="this.setCustomValidity('Alamat siswa tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')"><?= $data['alamat']; ?></textarea>
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
                    <P>JENIS KELAMIN & STATUS</P>
                </div>

                <!-- Pilih Jenis Kelamin & Status Siswa -->
                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins text-sm border-2 border-t-0 border-gray-200">
                    <!-- Jenis Kelamin Siswa -->
                    <div>
                        <p class="block mb-2 font-semibold font-poppins">Jenis Kelamin</p>
                        <div class="flex gap-4">
                            <!-- Laki-laki -->
                            <div class="w-full">
                                <label for="laki-laki" class="flex items-center justify-center gap-2 rounded-lg border text-gray-700 has-checked:text-blue-600 border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <svg class="size-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.75 0.75L9.35 6.15M14.75 0.75H9.75M14.75 0.75V5.75M0.75 9.75C0.75 11.0761 1.27678 12.3479 2.21447 13.2855C3.15215 14.2232 4.42392 14.75 5.75 14.75C7.07608 14.75 8.34785 14.2232 9.28553 13.2855C10.2232 12.3479 10.75 11.0761 10.75 9.75C10.75 8.42392 10.2232 7.15215 9.28553 6.21447C8.34785 5.27678 7.07608 4.75 5.75 4.75C4.42392 4.75 3.15215 5.27678 2.21447 6.21447C1.27678 7.15215 0.75 8.42392 0.75 9.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p>Laki-laki</p>
                                    <input type="radio"
                                        name="jenis_kelamin"
                                        value="Laki - Laki"
                                        <?= @$data['jenis_kelamin'] == 'Laki - Laki' ? 'checked' : '' ?>
                                        id="laki-laki"
                                        class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih jenis kelamin terlebih dahulu')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>

                            <!-- Perempuan -->
                            <div class="w-full">
                                <label for="perempuan" class="flex items-center justify-center gap-1 rounded-lg border text-gray-700 has-checked:text-pink-600 border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-pink-600 has-checked:ring-1 has-checked:ring-pink-600 has-checked:bg-pink-100">
                                    <svg class="size-5" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 14C10.6739 14 9.40215 13.4732 8.46447 12.5355C7.52678 11.5979 7 10.3261 7 9C7 7.67392 7.52678 6.40215 8.46447 5.46447C9.40215 4.52678 10.6739 4 12 4C13.3261 4 14.5979 4.52678 15.5355 5.46447C16.4732 6.40215 17 7.67392 17 9C17 10.3261 16.4732 11.5979 15.5355 12.5355C14.5979 13.4732 13.3261 14 12 14ZM12 14V21M9 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p>Perempuan</p>
                                    <input type="radio"
                                        name="jenis_kelamin"
                                        value="Perempuan"
                                        <?= @$data['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>
                                        id="perempuan"
                                        class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Status Siswa -->
                    <div>
                        <p class="block mb-2 font-semibold">Status</p>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Status aktif -->
                            <div class="w-full">
                                <label for="status_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors text-gray-700 hover:bg-zinc-50 has-checked:text-green-600 has-checked:border-green-600 has-checked:ring-1 has-checked:ring-green-600 has-checked:bg-green-100">
                                    <p>Aktif</p>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="aktif"
                                        <?= @$data['status'] == 'aktif' ? 'checked' : '' ?>
                                        id="status_aktif"
                                        class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih Status terlebih dahulu')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>

                            <!-- Status tidak aktif -->
                            <div class="w-full">
                                <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors text-gray-700 hover:bg-zinc-50 has-checked:text-red-600 has-checked:border-red-600 has-checked:ring-1 has-checked:ring-red-600 has-checked:bg-red-100">
                                    <p>Tidak Aktif</p>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="tidak aktif"
                                        <?= @$data['status'] == 'tidak aktif' ? 'checked' : '' ?>
                                        id="status_tidak_aktif"
                                        class="sr-only">
                                </label>
                            </div>

                            <!-- Status pindah -->
                            <div class="w-full">
                                <label for="status_pindah" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors text-gray-700 hover:bg-zinc-50 has-checked:text-yellow-600 has-checked:border-yellow-600 has-checked:ring-1 has-checked:ring-yellow-600 has-checked:bg-yellow-100">
                                    <p>Pindah</p>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="pindah"
                                        <?= @$data['status'] == 'pindah' ? 'checked' : '' ?>
                                        id="status_pindah"
                                        class="sr-only">
                                </label>
                            </div>

                            <!-- Status Lulus -->
                            <div class="w-full">
                                <label for="status_lulus" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors text-gray-700 hover:bg-zinc-50 has-checked:text-blue-600 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p>Lulus</p>
                                    <input
                                        type="radio"
                                        name="status"
                                        value="lulus"
                                        <?= @$data['status'] == 'lulus' ? 'checked' : '' ?>
                                        id="status_lulus"
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
                                placeholder="Silakan masukkan password" value="<?= @$data[''] ?>"
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

    <!-- Form Data Orang Tua -->
    <div class="w-full bg-white rounded-md shadow-md mt-16 mb-32">
        <!-- Header Identitas Orang Tua -->
        <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
            <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                <svg class="size-5" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.08334 5.24996C4.47011 5.24996 4.84105 5.09631 5.11454 4.82282C5.38803 4.54933 5.54167 4.1784 5.54167 3.79163C5.54167 3.40485 5.38803 3.03392 5.11454 2.76043C4.84105 2.48694 4.47011 2.33329 4.08334 2.33329C3.69656 2.33329 3.32563 2.48694 3.05214 2.76043C2.77865 3.03392 2.62501 3.40485 2.62501 3.79163C2.62501 4.1784 2.77865 4.54933 3.05214 4.82282C3.32563 5.09631 3.69656 5.24996 4.08334 5.24996ZM4.08334 6.41663C3.73862 6.41663 3.39727 6.34873 3.07879 6.21681C2.76031 6.08489 2.47094 5.89153 2.22718 5.64778C1.98343 5.40403 1.79007 5.11465 1.65815 4.79617C1.52624 4.47769 1.45834 4.13635 1.45834 3.79163C1.45834 3.44691 1.52624 3.10556 1.65815 2.78708C1.79007 2.4686 1.98343 2.17922 2.22718 1.93547C2.47094 1.69172 2.76031 1.49836 3.07879 1.36644C3.39727 1.23452 3.73862 1.16663 4.08334 1.16663C4.77953 1.16663 5.44721 1.44319 5.93949 1.93547C6.43178 2.42775 6.70834 3.09543 6.70834 3.79163C6.70834 4.48782 6.43178 5.1555 5.93949 5.64778C5.44721 6.14006 4.77953 6.41663 4.08334 6.41663ZM10.2083 7.58329C10.5178 7.58329 10.8145 7.46038 11.0333 7.24158C11.2521 7.02279 11.375 6.72605 11.375 6.41663C11.375 6.10721 11.2521 5.81046 11.0333 5.59167C10.8145 5.37288 10.5178 5.24996 10.2083 5.24996C9.89892 5.24996 9.60217 5.37288 9.38338 5.59167C9.16459 5.81046 9.04167 6.10721 9.04167 6.41663C9.04167 6.72605 9.16459 7.02279 9.38338 7.24158C9.60217 7.46038 9.89892 7.58329 10.2083 7.58329ZM10.2083 8.74996C9.5895 8.74996 8.99601 8.50413 8.55842 8.06654C8.12084 7.62896 7.87501 7.03546 7.87501 6.41663C7.87501 5.79779 8.12084 5.20429 8.55842 4.76671C8.99601 4.32913 9.5895 4.08329 10.2083 4.08329C10.8272 4.08329 11.4207 4.32913 11.8583 4.76671C12.2958 5.20429 12.5417 5.79779 12.5417 6.41663C12.5417 7.03546 12.2958 7.62896 11.8583 8.06654C11.4207 8.50413 10.8272 8.74996 10.2083 8.74996ZM11.6667 12.25V11.9583C11.6667 11.5715 11.513 11.2006 11.2395 10.9271C10.966 10.6536 10.5951 10.5 10.2083 10.5C9.82156 10.5 9.45063 10.6536 9.17714 10.9271C8.90365 11.2006 8.75001 11.5715 8.75001 11.9583V12.25H7.58334V11.9583C7.58334 11.6136 7.65124 11.2722 7.78315 10.9537C7.91507 10.6353 8.10843 10.3459 8.35218 10.1021C8.59594 9.85838 8.88532 9.66503 9.20379 9.53311C9.52227 9.40119 9.86362 9.33329 10.2083 9.33329C10.5531 9.33329 10.8944 9.40119 11.2129 9.53311C11.5314 9.66503 11.8207 9.85838 12.0645 10.1021C12.3082 10.3459 12.5016 10.6353 12.6335 10.9537C12.7654 11.2722 12.8333 11.6136 12.8333 11.9583V12.25H11.6667ZM5.83334 12.25V9.91663C5.83334 9.68681 5.78807 9.45925 5.70013 9.24693C5.61218 9.03461 5.48328 8.84169 5.32078 8.67919C5.15827 8.51669 4.96535 8.38778 4.75303 8.29984C4.54071 8.21189 4.31315 8.16663 4.08334 8.16663C3.85353 8.16663 3.62596 8.21189 3.41364 8.29984C3.20132 8.38778 3.0084 8.51669 2.8459 8.67919C2.6834 8.84169 2.5545 9.03461 2.46655 9.24693C2.3786 9.45925 2.33334 9.68681 2.33334 9.91663V12.25H1.16667V9.91663C1.16667 9.14308 1.47396 8.40121 2.02094 7.85423C2.56792 7.30725 3.30979 6.99996 4.08334 6.99996C4.85689 6.99996 5.59875 7.30725 6.14573 7.85423C6.69271 8.40121 7.00001 9.14308 7.00001 9.91663V12.25H5.83334Z" fill="#0088FF" />
                </svg>
            </div>
            <span>IDENTITAS ORANG TUA / WALI</span>
        </div>

        <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
            <!-- Catatan -->
            <div class="mb-8 p-4 rounded-lg bg-yellow-50 border border-yellow-300 text-sm text-yellow-800 flex items-center gap-1.5">
                <svg class="size-8 shrink-0" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.2875 2.60848L1.7585 8.49998C1.68579 8.626 1.64733 8.76886 1.64695 8.91435C1.64656 9.05984 1.68427 9.20289 1.75632 9.32929C1.82836 9.45569 1.93224 9.56103 2.05762 9.63483C2.183 9.70864 2.32552 9.74834 2.471 9.74998H9.529C9.67454 9.74848 9.81714 9.70888 9.94261 9.63511C10.0681 9.56134 10.172 9.45598 10.2441 9.32953C10.3162 9.20308 10.3539 9.05996 10.3534 8.91441C10.353 8.76886 10.3144 8.62598 10.2415 8.49998L6.713 2.60848C6.63878 2.48595 6.53421 2.38462 6.4094 2.3143C6.28459 2.24398 6.14376 2.20703 6.0005 2.20703C5.85724 2.20703 5.7164 2.24398 5.59159 2.3143C5.46678 2.38462 5.36221 2.48595 5.288 2.60848" fill="currentColor" fill-opacity="0.16" />
                    <path d="M6 7.99998H6.004M6 4.99998V6.49998M5.2875 2.60848L1.7585 8.49998C1.68579 8.626 1.64733 8.76886 1.64695 8.91435C1.64656 9.05984 1.68427 9.20289 1.75632 9.32929C1.82836 9.45569 1.93224 9.56103 2.05762 9.63483C2.183 9.70864 2.32552 9.74834 2.471 9.74998H9.529C9.67454 9.74848 9.81714 9.70888 9.94261 9.63511C10.0681 9.56134 10.172 9.45598 10.2441 9.32953C10.3162 9.20308 10.3539 9.05996 10.3534 8.91441C10.353 8.76886 10.3144 8.62598 10.2415 8.49998L6.713 2.60848C6.63878 2.48595 6.53421 2.38462 6.4094 2.3143C6.28459 2.24398 6.14376 2.20703 6.0005 2.20703C5.85724 2.20703 5.7164 2.24398 5.59159 2.3143C5.46678 2.38462 5.36221 2.48595 5.288 2.60848" stroke="currentColor" stroke-width="0.8" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p>
                    <strong>Catatan:</strong>
                    Nama Ayah dan Ibu wajib diisi. Jika tidak tersedia, silakan isi data Wali.
                </p>
            </div>

            <!-- Input Nama Wali -->
            <div class="flex gap-6 w-full">
                <!-- Input Nama Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama Ayah</label>
                    <input
                        type="text"
                        name="ayah"
                        value="<?= $data['ayah']; ?>"
                        placeholder="Silakan masukkan nama ayah"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>

                <!-- Input Nama Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama Ibu</label>
                    <input
                        type="text"
                        name="ibu"
                        value="<?= $data['ibu']; ?>"
                        placeholder="Silakan masukkan nama ibu"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Nama Wali -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama wali</label>
                    <input
                        type="text"
                        name="wali"
                        value="<?= $data['wali']; ?>"
                        placeholder="Silakan masukkan nama wali"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>
            </div>

            <!-- Input Tempat Lahir Wali -->
            <div class="flex gap-6 w-full">
                <!-- Input Tempat Lahir Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tempat Lahir Ayah</label>
                    <input
                        type="text"
                        name="tempat_lahir_ayah"
                        value="<?= $data['tempat_lahir_ayah']; ?>"
                        placeholder="Silakan masukkan tempat lahir ayah"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>

                <!-- Input Tempat Lahir Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tempat Lahir Ibu</label>
                    <input
                        type="text"
                        name="tempat_lahir_ibu"
                        value="<?= $data['tempat_lahir_ibu']; ?>"
                        placeholder="Silakan masukkan tempat lahir ibu"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>

                <!-- Input Tempat Lahir Wali -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tempat Lahir Wali</label>
                    <input
                        type="text"
                        name="tempat_lahir_wali"
                        value="<?= $data['tempat_lahir_wali']; ?>"
                        placeholder="Silakan masukkan tempat lahir wali"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>
            </div>

            <!-- Pilih Tanggal Lahir Wali -->
            <div class="flex gap-6 w-full">
                <!-- Pilih Tanggal Lahir Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tanggal Lahir Ayah</label>
                    <input
                        type="date"
                        name="tanggal_lahir_ayah"
                        value="<?= $data['tanggal_lahir_ayah']; ?>"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>

                <!-- Pilih Tanggal Lahir Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tanggal Lahir Ibu</label>
                    <input
                        type="date"
                        name="tanggal_lahir_ibu"
                        value="<?= $data['tanggal_lahir_ibu']; ?>"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>

                <!-- Pilih Tanggal Lahir Wali -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tanggal Lahir Wali</label>
                    <input
                        type="date"
                        name="tanggal_lahir_wali"
                        value="<?= $data['tanggal_lahir_wali']; ?>"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                </div>
            </div>

            <!-- Input Pekerjaan Wali -->
            <div class="flex gap-6 w-full">
                <!-- Input Pekerjaan Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Pekerjaan Ayah</label>
                    <input
                        type="text"
                        name="pekerjaan_ayah"
                        value="<?= $data['pekerjaan_ayah']; ?>"
                        placeholder="Silakan masukkan pekerjaan ayah"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Pekerjaan Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Pekerjaan Ibu</label>
                    <input
                        type="text"
                        name="pekerjaan_ibu"
                        value="<?= $data['pekerjaan_ibu']; ?>"
                        placeholder="Silakan masukkan pekerjaan ibu"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Pekerjaan wali -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Pekerjaan wali</label>
                    <input
                        type="text"
                        name="pekerjaan_wali"
                        value="<?= $data['pekerjaan_wali']; ?>"
                        placeholder="Silakan masukkan pekerjaan wali"
                        class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
                </div>
            </div>

            <!-- Input No. Telp Wali -->
            <div class="flex gap-6 w-full">
                <!-- Input No. Telp Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Ayah</label>
                    <div class="flex">
                        <input
                            type="number"
                            name="no_telp_ayah"
                            value="<?= $data['no_telp_ayah']; ?>"
                            placeholder="08123456789"
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
                    </div>
                </div>

                <!-- Input No. Telp Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Ibu</label>
                    <div class="flex">
                        <input
                            type="number"
                            name="no_telp_ibu"
                            value="<?= $data['no_telp_ibu']; ?>"
                            placeholder="08123456789"
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
                    </div>
                </div>

                <!-- Input No. Telp Wali -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Wali</label>
                    <div class="flex">
                        <input
                            type="number"
                            name="no_telp_wali"
                            value="<?= $data['no_telp_wali']; ?>"
                            placeholder="08123456789"
                            class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black">
                    </div>
                </div>
            </div>

            <!-- Input Alamat Wali -->
            <div class="flex gap-6 w-full">
                <!-- Input Alamat Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat Ayah</label>
                    <textarea
                        name="alamat_ayah"
                        placeholder="Silakan masukkan alamat ayah"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black "
                        rows="3"><?= $data['alamat_ayah']; ?></textarea>
                </div>

                <!-- Input Alamat Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat Ibu</label>
                    <textarea
                        name="alamat_ibu"
                        placeholder="Silakan masukkan alamat ibu"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black "
                        rows="3"><?= $data['alamat_ibu']; ?></textarea>
                </div>

                <!-- Input Alamat Wali -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat wali</label>
                    <textarea
                        name="alamat_wali"
                        placeholder="Silakan masukkan alamat wali"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black"
                        rows="3"><?= $data['alamat_wali']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
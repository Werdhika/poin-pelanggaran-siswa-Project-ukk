<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$query_kelas = mysqli_query($conn, "SELECT 
        a.id_kelas,
        a.id_tingkat,
        a.id_program_keahlian,
        a.rombel,
        b.tingkat,
        c.program_keahlian
    FROM kelas a
    LEFT JOIN tingkat b ON a.id_tingkat = b.id_tingkat
    LEFT JOIN program_keahlian c ON a.id_program_keahlian = c.id_program_keahlian
");

$query_nis = mysqli_query($conn, "SELECT MAX(nis) as nis_akhir FROM siswa");
$nis = mysqli_fetch_assoc($query_nis);

$nis_akhir = $nis['nis_akhir'];
if ($nis_akhir == null) {
    $nis_baru = 1;
} else {
    $nis_baru = $nis_akhir + 1;
}
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Data Siswa & Ortu Wali</h2>
        <p>Silahkan isi data siswa & ortu wali yang akan ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="pages/siswa/list.php" class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal</a>

        <!-- button Simpan -->
        <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
            <button type="submit"
                form="formSiswa"
                class="inline-flex items-center rounded-lg py-4 px-8 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Data
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- Form Data Siswa -->
<form id="formSiswa" action="/poin_pelanggaran_siswa/process/siswa/siswa_insert.php" method="POST" autocomplete="off">
    <div class="w-full mt-16 flex gap-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Identitas Siswa -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                value="<?= $nis_baru; ?>"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black text-center"
                                readonly>
                        </div>

                        <!-- Input Nama Siswa -->
                        <div class="flex-7">
                            <label class="block mb-2 font-semibold">Nama Siswa</label>
                            <input
                                type="text"
                                name="nama_siswa"
                                placeholder="Silakan masukkan nama siswa"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Nama siswa tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>

                    <!-- Input Kelas -->
                    <div class="mb-5">
                        <label class="block mb-2 font-semibold">Kelas</label>
                        <div class="relative">
                            <select
                                name="id_kelas"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black appearance-none"
                                required
                                oninvalid="this.setCustomValidity('Kelas tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                                <option value="" disabled selected hidden>Pilih Kelas</option>

                                <?php
                                while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>
                                    <option value="<?= $kelas['id_kelas'] ?>">
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
                            rows="4"
                            required
                            oninvalid="this.setCustomValidity('Alamat siswa tidak boleh kosong!')"
                            oninput="this.setCustomValidity('')"></textarea>
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
                            <div class="w-full">
                                <label for="laki-laki" class="flex items-center justify-center gap-2 rounded-lg border text-gray-700 has-checked:text-blue-600 border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <svg class="size-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.75 0.75L9.35 6.15M14.75 0.75H9.75M14.75 0.75V5.75M0.75 9.75C0.75 11.0761 1.27678 12.3479 2.21447 13.2855C3.15215 14.2232 4.42392 14.75 5.75 14.75C7.07608 14.75 8.34785 14.2232 9.28553 13.2855C10.2232 12.3479 10.75 11.0761 10.75 9.75C10.75 8.42392 10.2232 7.15215 9.28553 6.21447C8.34785 5.27678 7.07608 4.75 5.75 4.75C4.42392 4.75 3.15215 5.27678 2.21447 6.21447C1.27678 7.15215 0.75 8.42392 0.75 9.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class=" font-medium">Laki-laki</p>
                                    <input type="radio" name="jenis_kelamin" value="Laki - Laki" id="laki-laki" class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih jenis kelamin terlebih dahulu')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>

                            <div class="w-full">
                                <label for="perempuan" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-pink-600 has-checked:ring-1 has-checked:ring-pink-600 has-checked:bg-pink-100">
                                    <p class="text-gray-700">Perempuan</p>
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" id="perempuan" class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Status Siswa -->
                    <div>
                        <p class="block mb-2 font-medium">Status</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="w-full">
                                <label for="status_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Aktif</p>
                                    <input type="radio" name="status_siswa" value="aktif" id="status_aktif" class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih Status terlebih dahulu')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Tidak Aktif</p>
                                    <input type="radio" name="status_siswa" value="tidak_aktif" id="status_tidak_aktif" class="sr-only">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_pindah" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Pindah</p>
                                    <input type="radio" name="status_siswa" value="pindah" id="status_pindah" class="sr-only">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_lulus" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Lulus</p>
                                    <input type="radio" name="status_siswa" value="lulus" id="status_lulus" class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium font-poppins">password</label>
                        <div class="w-full">
                            <input
                                type="password"
                                name="password"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black ">
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
            <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                    <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                </svg>
            </div>
            <span>IDENTITAS ORANG TUA</span>
        </div>

        <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
            <div class="flex gap-4 w-full">
                <!-- Input Nama Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama Ayah</label>
                    <input
                        type="text"
                        name="ayah"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Nama Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama Ibu</label>
                    <input
                        type="text"
                        name="ibu"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Nama wali</label>
                    <input
                        type="text"
                        name="wali"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input Nama Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tempat Lahir Ayah</label>
                    <input
                        type="text"
                        name="tempat_lahir_ayah"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Nama Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tempat Lahir Ibu</label>
                    <input
                        type="text"
                        name="tempat_lahir_ibu"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tempat Lahir Wali</label>
                    <input
                        type="text"
                        name="tempat_lahir_wali"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input Nama Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tanggal Lahir Ayah</label>
                    <input
                        type="date"
                        name="tanggal_lahir_ayah"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Nama Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tanggal Lahir Ibu</label>
                    <input
                        type="date"
                        name="tanggal_lahir_ibu"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Tanggal Lahir Wali</label>
                    <input
                        type="date"
                        name="tanggal_lahir_wali"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input Nama Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Pekerjaan Ayah</label>
                    <input
                        type="text"
                        name="pekerjaan_ayah"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <!-- Input Nama Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Pekerjaan Ibu</label>
                    <input
                        type="text"
                        name="pekerjaan_ibu"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>

                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Pekerjaan wali</label>
                    <input
                        type="text"
                        name="pekerjaan_wali"
                        class="w-full border border-gray-300 p-2.5 rounded-md box-border focus:outline-none focus:border-black ">
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input No. Telp Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Ayah</label>
                    <div class="flex">
                        <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                            +62
                        </span>

                        <input
                            type="text"
                            name="no_telp_ayah"
                            placeholder="8123456789"
                            class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-black ">
                    </div>
                </div>

                <!-- Input No. Telp Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Ibu</label>
                    <div class="flex">
                        <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                            +62
                        </span>

                        <input
                            type="text"
                            name="no_telp_ibu"
                            placeholder="8123456789"
                            class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-black ">
                    </div>
                </div>

                <div class="flex-1">
                    <label class="block mb-2 font-semibold">No. Telp Wali</label>
                    <div class="flex">
                        <span class="bg-gray-100 border border-r-0 border-gray-300 px-3 flex items-center rounded-l-lg text-gray-800 font-semibold">
                            +62
                        </span>

                        <input
                            type="text"
                            name="no_telp_wali"
                            placeholder="8123456789"
                            class="w-full border border-gray-300 p-3 rounded-r-md box-border focus:outline-none focus:border-black">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <!-- Input Alamat Ayah -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat Ayah</label>
                    <textarea
                        name="alamat_ayah"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black "
                        rows="2"></textarea>
                </div>

                <!-- Input Alamat Ibu -->
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat Ibu</label>
                    <textarea
                        name="alamat_ibu"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black "
                        rows="2"></textarea>
                </div>
                <div class="flex-1">
                    <label class="block mb-2 font-semibold">Alamat wali</label>
                    <textarea
                        name="alamat_wali"
                        class="w-full border border-gray-300 p-3.5 rounded-md box-border focus:outline-none focus:border-black"
                        rows="2"></textarea>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
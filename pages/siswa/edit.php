<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$nis = $_GET['nis'];
$result = mysqli_query($conn, "SELECT * FROM siswa
    LEFT JOIN ortu_wali ON siswa.id_ortu_wali = ortu_wali.id_ortu_wali
    LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    LEFT JOIN tingkat ON kelas.id_tingkat = tingkat.id_tingkat
    LEFT JOIN program_keahlian ON kelas.id_program_keahlian = program_keahlian.id_program_keahlian
    LEFT JOIN guru on kelas.kode_guru = guru.kode_guru
    WHERE nis='$nis'
");
$data = mysqli_fetch_assoc($result);

$query_kelas = mysqli_query($conn, "SELECT * FROM kelas
LEFT JOIN tingkat ON kelas.id_tingkat = tingkat.id_tingkat
LEFT JOIN program_keahlian ON kelas.id_program_keahlian = program_keahlian.id_program_keahlian
");
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="mt-4 font-urbanist font-extrabold text-5xl mb-8 ">Data Siswa</h2>
        <div class="flex font-urbanist font-semibold">
            <a href="/poin_pelanggaran_siswa/pages/siswa/list.php">Data Siswa</a>
            <svg class="rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
            </svg>
            <a class=" text-blue-600">Edit Siswa</a>
        </div>
    </div>
    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a class="inline-flex items-center rounded-lg border border-gray-300 py-3.5 px-8 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300" href="/poin_pelanggaran_siswa/pages/siswa/list.php">
            Batal Simpan
        </a>

        <!-- button Simpan -->
        <button type="submit" form="formSiswa"
            class="group inline-flex items-center rounded-lg py-3.5 px-14 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">
            Simpan
        </button>
    </div>
</div>

<!-- Form Data Siswa -->
<form id="formSiswa" action="/poin_pelanggaran_siswa/process/siswa/siswa_process.php" method="POST">
    <div class="w-full mt-16 flex gap-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">

                <!-- Header Identitas Siswa -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold   items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-blue-100 rounded-md items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>IDENTITAS SISWA</span>
                </div>

                <!-- Input Data Siswa -->
                <div class="p-8 space-y-6 font-poppins text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">

                        <!-- Input Nama Siswa -->
                        <div class="flex-2">
                            <label class="block mb-2 font-medium">Nama Siswa</label>
                            <input
                                type="text"
                                name="nama_siswa"
                                value="<?= $data['nama_siswa']; ?>"
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                        </div>

                        <!-- Pilih Kelas -->
                        <div class="flex-1">
                            <label class="block mb-2 font-medium">Kelas</label>
                            <div class="relative">
                                <select
                                    name="id_kelas"
                                    class="w-full border border-gray-300 p-2 pr-10 rounded-md appearance-none">
                                    <option value="" disabled selected hidden>Pilih Kelas</option>

                                    <!-- Query Kelas -->
                                    <?php while ($kelas = mysqli_fetch_assoc($query_kelas)) { ?>
                                        <option value="<?= $kelas['id_kelas'] ?>"
                                            <?= ($kelas['id_kelas'] == $data['id_kelas']) ? 'selected' : '' ?>>
                                            <?= "$kelas[tingkat] $kelas[program_keahlian] $kelas[rombel]" ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                                </svg>
                            </div>
                        </div>

                        <!-- Input NIS -->
                        <div class="flex-1">
                            <label class="block mb-2 font-medium">NIS</label>
                            <input
                                type="text"
                                name="nis"
                                value="<?= $data['nis']; ?>"
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                        </div>
                    </div>

                    <!-- Input Alamat Siswa -->
                    <div>
                        <label class="block mb-2 font-medium">Alamat</label>
                        <textarea
                            name="alamat"
                            class="w-full border border-gray-300 p-3.5 rounded-md box-border"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white rounded-md shadow-md overflow-hidden">

                <!-- Header Jenis Kelamin & Status -->
                <div class="flex px-7 p-3.5 gap-3 text-gray-700 text-[18px] font-urbanist font-bold rounded-t-md items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-2.5 bg-yellow-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#efb100" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#efb100" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>JENIS KELAMIN & STATUS</span>
                </div>

                <!-- Pilih Jenis Kelamin & Status Siswa -->
                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins text-sm border-2 border-t-0 border-gray-200">

                    <!-- Jenis Kelamin Siswa -->
                    <div>
                        <p class="block mb-2 font-medium font-poppins">Jenis Kelamin</p>

                        <div class="flex gap-4">

                            <div class="w-full">
                                <label for="laki-laki" class="flex items-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 14a5 5 0 1 0 10 0a5 5 0 1 0-10 0m14-9l-5.4 5.4M19 5h-5m5 0v5" />
                                    </svg>
                                    <p class="text-gray-700">Laki-Laki</p>
                                    <input type="radio" name="jenis_kelamin" value="Laki - Laki" id="laki-laki" class="sr-only">
                                </label>
                            </div>

                            <div class="w-full">
                                <label for="perempuan" class="flex items-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-pink-600 has-checked:ring-1 has-checked:ring-pink-600 has-checked:bg-pink-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19.75 7.75a7.75 7.75 0 1 0-9.2 7.6a.27.27 0 0 1 .2.25v2.65a.25.25 0 0 1-.25.25H9A1.25 1.25 0 0 0 9 21h1.5a.25.25 0 0 1 .25.25v1.5a1.25 1.25 0 0 0 2.5 0v-1.5a.25.25 0 0 1 .25-.25H15a1.25 1.25 0 0 0 0-2.5h-1.5a.25.25 0 0 1-.25-.25V15.6a.27.27 0 0 1 .2-.25a7.75 7.75 0 0 0 6.3-7.6m-13 0A5.25 5.25 0 1 1 12 13a5.26 5.26 0 0 1-5.25-5.25" />
                                    </svg>
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
                                <label for="status_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Aktif</p>
                                    <input type="radio" name="status" value="aktif" id="status_aktif" class="sr-only">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Tidak Aktif</p>
                                    <input type="radio" name="status" value="tidak_aktif" id="status_tidak_aktif" class="sr-only">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_pindah" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Pindah</p>
                                    <input type="radio" name="status" value="pindah" id="status_pindah" class="sr-only">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_lulus" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Lulus</p>
                                    <input type="radio" name="status" value="lulus" id="status_lulus" class="sr-only">
                                </label>
                            </div>
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
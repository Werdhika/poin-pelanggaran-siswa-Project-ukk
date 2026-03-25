<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
$result = mysqli_query($conn, "SELECT DISTINCT jabatan FROM guru");
$query = mysqli_query($conn, "SELECT MAX(kode_guru) as kode FROM guru");

$prefix = "00";
$data = mysqli_fetch_assoc($query);

if ($data['kode']) {
    $kode = $data['kode'];
    list($depan, $belakang) = explode('.', $kode);
    $urutan = (int)$belakang + 1;

    if ($urutan > 999) {
        $depan = str_pad((int)$depan + 1, 4, "0", STR_PAD_LEFT);
        $urutan = 1;
    }

} else {
    $depan = "0001";
    $urutan = 1;
}

$kodeGuru = $depan . '.' . str_pad($urutan, 3, "0", STR_PAD_LEFT);
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class=" font-urbanist font-extrabold text-5xl mb-4 ">Data Guru</h2>
        <div class="flex font-urbanist font-semibold">
            <a href="/poin_pelanggaran_siswa/pages/guru/list.php">Data Guru</a>
            <svg class="rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
            </svg>
            <a class=" text-blue-600">Tambah Data Guru</a>
        </div>
    </div>
    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-8 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300" href="/poin_pelanggaran_siswa/pages/guru/list.php">
            Batal
        </a>

        <!-- button Simpan -->
        <button type="submit" form="formGuru"
            class="group inline-flex items-center rounded-lg py-4 px-8 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">
            Simpan
        </button>
    </div>
</div>

<!-- Form Data Siswa -->
<form id="formGuru" action="/poin_pelanggaran_siswa/process/guru/insert.php" method="POST">
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
                    <span>IDENTITAS GURU</span>
                </div>

                <!-- Input Data Siswa -->
                <div class="p-8 space-y-6 font-poppins font-semibold text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">

                        <!-- Input NIS -->
                        <div class="flex-2">
                            <label class="block mb-2 font-medium">Kode Guru</label>
                            <input
                                type="text"
                                name="kode_guru"
                                value="<?= $kodeGuru; ?>"
                                class="w-full border border-gray-300 p-2.5 rounded-md box-border"
                                readonly>
                        </div>

                        <!-- Pilih Kelas -->
                        <div class="flex-3">
                            <label class="block mb-2 font-medium">Jabatan</label>
                            <div class="relative">
                                <select
                                    name="jabatan"
                                    class="w-full border border-gray-300 p-2.5 pr-10 rounded-md appearance-none"
                                    required
                                    oninvalid="this.setCustomValidity('Jabatan guru wajib diisi')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" disabled selected hidden>Pilih Jabatan</option>

                                    <!-- Query Kelas -->
                                    <?php
                                    while ($jabatan = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?= $jabatan['jabatan'] ?>">
                                            <?= $jabatan['jabatan']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <svg class="-rotate-90 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
                                </svg>
                            </div>
                        </div>

                        <!-- Input Nama Guru -->
                        <div class="flex-5">
                            <label class="block mb-2 font-medium">Nama Guru</label>
                            <input
                                type="text"
                                name="nama"
                                class="w-full border border-gray-300 p-2.5 rounded-md box-border"
                                required
                                oninvalid="this.setCustomValidity('Nama guru wajib diisi')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>

                    <!-- Input Alamat Siswa -->
                    <div>
                        <label class="block mb-2 font-medium">No. Telepon</label>
                        <input
                            type="tel"
                            name="telp"
                            class="w-full border border-gray-300 p-3.5 rounded-md box-border"
                            required
                            oninvalid="this.setCustomValidity('Alamat siswa wajib diisi')"
                            oninput="this.setCustomValidity('')"></input>
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
                <div class="bg-white p-9 rounded-b-md space-y-6 font-poppins text-sm border-2 border-t-0 border-gray-200">

                    <!-- Jenis Kelamin Siswa -->
                    <div>
                        <p class="block mb-2 font-medium font-poppins">Role</p>

                        <div class="flex gap-4">
                            <div class="w-full">
                                <label for="guru-mapel" class="flex gap-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Guru Mapel</p>
                                    <input type="radio" name="role" value="guru-mapel" id="guru-mapel" class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih jenis kelamin terlebih dahulu')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>

                            <div class="w-full">
                                <label for="guru-bk" class="flex gap-4 items-center justify-center rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                    <p class="text-gray-700">Guru BK</p>
                                    <input type="radio" name="role" value="guru-bk" id="guru-bk" class="sr-only">
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
                                    <input type="radio" name="status_guru" value="1" id="status_aktif" class="sr-only"
                                        required
                                        oninvalid="this.setCustomValidity('Pilih Status terlebih dahulu')"
                                        oninput="this.setCustomValidity('')">
                                </label>
                            </div>
                            <div class="w-full">
                                <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-2.5 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:border-red-600 has-checked:ring-1 has-checked:ring-red-600 has-checked:bg-red-100">
                                    <p class="text-gray-700">Tidak Aktif</p>
                                    <input type="radio" name="status_guru" value="0" id="status_tidak_aktif" class="sr-only">
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
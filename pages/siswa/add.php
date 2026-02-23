<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
?>

<h2 class="mt-12 font-heading text-3xl mb-8  font-semibold">Tambah Data Informasi Siswa</h2>
<hr class="text-gray-300 border-t-1.5 w-full">

<!-- Form Data Siswa -->
<div class="w-full flex gap-8">

    <!-- Form -->
    <div class="flex-3">

        <!-- Form Siswa -->
        <h3 class="text-2xl mt-12 font-semibold">Data Siswa</h3>
        <div class="bg-gray-100 mt-4 p-8 rounded">
            <form action="add-proses.php" method="POST" class="space-y-6">
                <!-- Nama Siswa, NIS, dan Kelas Siswa -->
                <div class="flex gap-4">
                    <div class="flex-2">
                        <label class="block mb-2 font-medium">Nama Siswa</label>
                        <input type="text" name="nama"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">NIS</label>
                        <input type="text" name="nis"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Kelas</label>
                        <select name="kelas"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded">
                            <option value="">None</option>
                            <option>XII RPL 1</option>
                            <option>XII RPL 2</option>
                        </select>
                    </div>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <span class="block mb-2 font-medium">Jenis Kelamin</span>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki">
                            <span class="ml-2">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Perempuan">
                            <span class="ml-2">Perempuan</span>
                        </label>
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block mb-2 font-medium">Alamat</label>
                    <textarea name="alamat"
                        class="w-full border-2 border-gray-200 bg-white p-2 rounded"
                        rows="3" required></textarea>
                </div>
            </form>
        </div>

        <!-- Form Orang Tua -->
        <h3 class="text-2xl mt-12 font-semibold">Data Orang Tua</h3>
        <div class="bg-gray-100 mt-5 p-8 rounded">
            <form action="add-proses.php" method="POST" class="space-y-6">
                <!-- Nama Orang Tua -->
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Nama Ayah</label>
                        <input type="text" name="nama_ayah"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Nama Ibu</label>
                        <input type="text" name="nama_ibu"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                </div>

                <!-- Pekerjaan Orang tua -->
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                </div>

                <!-- Nomor Telepon Orang tua -->
                <div class="flex gap-4">
                    <!-- No. Telp Ayah -->
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">No. Telp Ayah</label>
                        <input type="text" name="nomor_ayah"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                    <!-- No. Telp Ibu -->
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">No. Telp Ibu</label>
                        <input type="text" name="nomor_ibu"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                </div>

                <!-- Alamat Orang Tua -->
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Alamat Ayah</label>
                        <textarea name="alamat_ayah"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded"
                            rows="3" required></textarea>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Alamat Ibu</label>
                        <textarea name="alamat_ibu"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded"
                            rows="3" required></textarea>
                    </div>
                </div>
            </form>
        </div>

        <!-- Form Wali -->
        <h3 class="text-2xl mt-12 font-semibold">Data Wali</h3>
        <div class="bg-gray-100 mt-5 p-8 rounded">
            <form action="add-proses.php" method="POST" class="space-y-6">
                <!-- Nama Wali -->
                <div>
                    <label class="block mb-2 font-medium">Nama wali</label>
                    <input type="text" name="nama_ayah" class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                </div>

                <!-- Pekerjaan dan No. Telp Wali -->
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">Pekerjaan Wali</label>
                        <input type="text" name="pekerjaan_ayah"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 font-medium">No. Telp Wali</label>
                        <input type="text" name="nomor_ayah"
                            class="w-full border-2 border-gray-200 bg-white p-2 rounded" required>
                    </div>
                </div>

                <!-- Alamat Wali -->
                <div>
                    <label class="block mb-2 font-medium">Alamat Wali</label>
                    <textarea name="alamat_ayah"
                        class="w-full border-2 border-gray-200 bg-white p-2 rounded"
                        rows="3" required></textarea>
                </div>
            </form>
        </div>
    </div>



    <!-- Button -->
    <div class="flex-1 flex flex-col gap-4 mt-24">

        <button type="button"
            class="border border-blue-500 text-blue-500 px-4 py-3 rounded">
            Batal Simpan
        </button>

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-3 rounded">
            Simpan Data
        </button>

    </div>
</div>
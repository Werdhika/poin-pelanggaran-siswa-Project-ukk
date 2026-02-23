<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
$result = mysqli_query($conn, "SELECT * FROM siswa");
?>

<div class="px-20 md:px-8 lg:px-16">
    <h2 class="mt-12 font-heading text-4xl mb-8  font-semibold">Edit Data Siswa</h2>
    <hr class="text-gray-300 border-t-1.5 w-full">

    <div class="flex content-between justify-between mt-15">
        <div class=" mr-10">
            <h3 class="text-4xl font-semibold">Data Siswa</h3>
        </div>
        <div>
            <form action="add-proses.php" method="POST" class="space-y-6">
                <div>
                    <label for="nama" class="block mb-1 font-medium">Nama Siswa</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-300 p-2 pe-96 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">NIS</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="kelas">
                        <span class="block mb-1 font-medium"> Kelas </span>
                        <select name="kelas" id="kelas" class="w-full border border-gray-300 p-2 rounded">
                            <option value="">None</option>
                            <option value="JM">John Mayer</option>
                            <option value="SRV">Stevie Ray Vaughn</option>
                            <option value="JH">Jimi Hendrix</option>
                            <option value="BBK">B.B King</option>
                            <option value="AK">Albert King</option>
                            <option value="BG">Buddy Guy</option>
                            <option value="EC">Eric Clapton</option>
                        </select>
                    </label>
                </div>
                <div>
                    <span class="block mb-3 font-medium">Jenis Kelamin</span>
                    <div class="flex items-center space-x-5">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Laki-laki" class="form-radio text-blue-500">
                            <span class="ml-2">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-radio text-blue-500">
                            <span class="ml-2">Perempuan</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label for="alamat" class="block mb-1 font-medium">Alamat</label>
                    <textarea id="alamat" name="alamat" class="w-full border border-gray-300 p-2 rounded" required></textarea>
                </div>
            </form>
        </div>
    </div>

    <hr class="text-gray-300 mt-15 border-t-1.5 w-full">

    <div class="flex content-between justify-between mt-15">
        <div class="mr-10">
            <h3 class="text-4xl font-semibold">Data Ayah</h3>
        </div>
        <div>
            <form action="add-proses.php" method="POST" class="space-y-6">
                <div>
                    <label for="nama" class="block mb-1 font-medium">Nama Ayah</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-300 p-2 pe-96 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">Pekerjaan Ayah</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">No. Telp Ibu</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="alamat" class="block mb-1 font-medium">Alamat</label>
                    <textarea id="alamat" name="alamat" class="w-full border border-gray-300 p-2 rounded" required></textarea>
                </div>
            </form>
        </div>
    </div>

    <hr class="text-gray-300 mt-15 border-t-1.5 w-full">

    <div class="flex content-between justify-between mt-15">
        <div class="mr-10">
            <h3 class="text-4xl font-semibold">Data Ibu</h3>
        </div>
        <div>
            <form action="add-proses.php" method="POST" class="space-y-6">
                <div>
                    <label for="nama" class="block mb-1 font-medium">Nama Ibu</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-300 p-2 pe-96 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">Pekerjaan Ibu</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">No. Telp Ibu</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="alamat" class="block mb-1 font-medium">Alamat</label>
                    <textarea id="alamat" name="alamat" class="w-full border border-gray-300 p-2 rounded" required></textarea>
                </div>
            </form>
        </div>
    </div>

    <hr class="text-gray-300 mt-15 border-t-1.5 w-full">

    <div class="flex content-between justify-between mt-15">
        <div class="mr-10">
            <h3 class="text-4xl font-semibold">Data Wali</h3>
        </div>
        <div>
            <form action="add-proses.php" method="POST" class="space-y-6">
                <div>
                    <label for="nama" class="block mb-1 font-medium">Nama Wali</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-300 p-2 pe-96 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">Pekerjaan Wali</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="kelas" class="block mb-1 font-medium">No. Telp Wali</label>
                    <input type="text" id="kelas" name="kelas" class="w-full border border-gray-300 p-2 rounded" required>
                </div>
                <div>
                    <label for="alamat" class="block mb-1 font-medium">Alamat</label>
                    <textarea id="alamat" name="alamat" class="w-full border border-gray-300 p-2 rounded" required></textarea>
                </div>
            </form>
        </div>
    </div>
    <hr class="text-gray-300 my-12 border-t-1.5 w-full">
    <div class="gap-2 flex justify-end">
        <button type="submit" class="bg-white text-blue-500 outline-1 px-4 py-2 mb-32 rounded">Batal Simpan</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mb-32 rounded">Simpan Data</button>
    </div>
</div>
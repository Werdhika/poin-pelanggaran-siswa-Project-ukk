<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$id = $_GET['id_tahun_ajaran'];
$result = mysqli_query($conn, "SELECT * FROM tahun_ajaran WHERE id_tahun_ajaran = '$id'");
$data = mysqli_fetch_assoc($result);
?>

<div class="flex justify-between items-center">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Edit Data Tahun Ajaran</h2>
        <p>Perbarui data tahun ajaran yang dipilih.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a href="/poin_pelanggaran_siswa/pages/tahun_ajaran/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">Batal
        </a>
        <!-- button Simpan -->
        <button type="submit"
            form="formTahun_ajaran"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">Simpan Perubahan
        </button>
    </div>
</div>

<form id="formTahun_ajaran" action="/poin_pelanggaran_siswa/process/tahun_ajaran/update.php" method="POST" autocomplete="off">
    <input type="hidden" name="id_tahun_ajaran" value="<?= $data['id_tahun_ajaran']; ?>">
    <!-- Form Data Tahun Ajaran -->
    <div class="w-full mt-16 flex gap-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Tahun Ajaran -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6667 5.66668V9.00002M9.47799 2.33335C9.01612 2.11411 8.51126 2.00037 7.99999 2.00037C7.48873 2.00037 6.98387 2.11411 6.52199 2.33335L2.06133 4.42468C1.09066 4.87935 1.09066 6.45402 2.06133 6.90868L6.52133 9.00002C6.98329 9.21936 7.48827 9.33316 7.99966 9.33316C8.51105 9.33316 9.01603 9.21936 9.47799 9.00002L13.9387 6.90868C14.9093 6.45402 14.9093 4.87935 13.9387 4.42468L9.47799 2.33335Z" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M3.33333 7.99976V11.4164C3.33333 13.3618 6.46266 14.3331 8 14.3331C9.53733 14.3331 12.6667 13.3618 12.6667 11.4164V7.99976" stroke="#0088FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>TAHUN AJARAN</span>
                </div>

                <div class="p-8 space-y-6 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="w-full">
                        <!-- Input Tahun Ajaran -->
                        <div>
                            <label class="block mb-2 font-semibold">Tahun Ajaran</label>
                            <input
                                type="text"
                                name="tahun"
                                value="<?= $data['tahun']; ?>"
                                placeholder="Silakan masukkan data tahun ajaran"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Tahun ajaran tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <!-- Header Jenis Kelamin & Status -->
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4.5" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.8333 6.99996C12.8333 10.2217 10.2217 12.8333 6.99999 12.8333C3.77824 12.8333 1.16666 10.2217 1.16666 6.99996C1.16666 3.77821 3.77824 1.16663 6.99999 1.16663C10.2217 1.16663 12.8333 3.77821 12.8333 6.99996Z" stroke="#0088FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="4 4" />
                        </svg>
                    </div>
                    <span>STATUS</span>
                </div>

                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins font-medium text-sm border-2 border-t-0 border-gray-200">
                    <!-- Status Siswa -->
                    <p class="block mb-2 font-semibold">Status</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="w-full">
                            <label for="status_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-blue-600 has-checked:border-blue-600 has-checked:ring-1 has-checked:ring-blue-600 has-checked:bg-blue-100">
                                <p>Aktif</p>
                                <input
                                    type="radio"
                                    name="status"
                                    value="1" <?= $data['status'] == '1' ? 'checked' : ''; ?>
                                    id="status_aktif"
                                    class="sr-only"
                                    required
                                    oninvalid="this.setCustomValidity('Pilih Status terlebih dahulu')"
                                    oninput="this.setCustomValidity('')">
                            </label>
                        </div>
                        <div class="w-full">
                            <label for="status_tidak_aktif" class="flex items-center justify-center gap-4 rounded-lg border border-gray-300 bg-white p-3 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-50 has-checked:text-red-600 has-checked:border-red-600 has-checked:ring-1 has-checked:ring-red-600 has-checked:bg-red-100">
                                <p>Tidak Aktif</p>
                                <input
                                    type="radio"
                                    name="status"
                                    value="0" <?= $data['status'] == '0' ? 'checked' : ''; ?>
                                    id="status_tidak_aktif"
                                    class="sr-only">
                            </label>
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
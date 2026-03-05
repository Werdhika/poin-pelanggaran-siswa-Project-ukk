<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
?>

<h2 class="mt-4 font-urbanist font-extrabold text-5xl mb-8 ">Data Siswa</h2>
<div class="flex font-urbanist font-semibold">
    <a href="/poin_pelanggaran_siswa/pages/siswa/list.php">Data Siswa</a>
    <svg class="rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.7158 6.2958C14.6228 6.20207 14.5122 6.12768 14.3904 6.07691C14.2685 6.02614 14.1378 6 14.0058 6C13.8738 6 13.7431 6.02614 13.6212 6.07691C13.4994 6.12768 13.3888 6.20207 13.2958 6.2958L8.2958 11.2958C8.20207 11.3888 8.12768 11.4994 8.07691 11.6212C8.02614 11.7431 8 11.8738 8 12.0058C8 12.1378 8.02614 12.2685 8.07691 12.3904C8.12768 12.5122 8.20207 12.6228 8.2958 12.7158L13.2958 17.7158C13.3888 17.8095 13.4994 17.8839 13.6212 17.9347C13.7431 17.9855 13.8738 18.0116 14.0058 18.0116C14.1378 18.0116 14.2685 17.9855 14.3904 17.9347C14.5122 17.8839 14.6228 17.8095 14.7158 17.7158C14.8095 17.6228 14.8839 17.5122 14.9347 17.3904C14.9855 17.2685 15.0116 17.1378 15.0116 17.0058C15.0116 16.8738 14.9855 16.7431 14.9347 16.6212C14.8839 16.4994 14.8095 16.3888 14.7158 16.2958L10.4158 12.0058L14.7158 7.7158C14.8095 7.62284 14.8839 7.51223 14.9347 7.39038C14.9855 7.26852 15.0116 7.13781 15.0116 7.0058C15.0116 6.87379 14.9855 6.74308 14.9347 6.62122C14.8839 6.49936 14.8095 6.38876 14.7158 6.2958Z" fill="black" />
    </svg>
    <a class=" text-blue-600">Tambah Siswa</a>
</div>


<!-- Form Data Siswa -->
<form action="">
    <div class="w-full mt-16 flex gap-8">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden border border-gray-200">

                <!-- Header -->
                <div class="flex px-7 py-4 gap-3 text-gray-500 text-[18px] font-urbanist font-bold items-center bg-gray-100">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#0088FF" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#0088FF" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>IDENTITAS SISWA</span>
                </div>

                <!-- Body -->
                <div class="p-8 space-y-6 font-poppins text-sm">
                    <div class="flex gap-4 w-full">

                        <div class="flex-1">
                            <label class="block mb-2 font-medium">Nama Siswa</label>
                            <input type="text"
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                        </div>

                        <div class="flex-1">
                            <label class="block mb-2 font-medium">NIS</label>
                            <input type="text"
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                        </div>

                        <div class="flex-1">
                            <label class="block mb-2 font-medium">Kelas</label>
                            <select
                                class="w-full border border-gray-300 p-2 rounded-md box-border">
                                <option>Pilih Kelas</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Alamat</label>
                        <textarea
                            class="w-full border border-gray-300 p-2 rounded-md box-border"
                            rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-white rounded-md shadow-md overflow-hidden border border-gray-200">

                <!-- Header -->
                <div class="flex px-7 p-4 gap-3 text-gray-500 text-[18px] font-urbanist font-bold rounded-t-md items-center bg-gray-100">
                    <div class="flex p-3 bg-yellow-100 rounded-xl items-center justify-center">
                        <svg class="size-4" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 5.83335C8.28801 5.83335 9.33268 4.78868 9.33268 3.50002C9.33268 2.21136 8.28801 1.16669 6.99935 1.16669C5.71068 1.16669 4.66602 2.21136 4.66602 3.50002C4.66602 4.78868 5.71068 5.83335 6.99935 5.83335Z" stroke="#efb100" stroke-width="1.5" />
                            <path d="M11.6663 10.2084C11.6663 11.658 11.6663 12.8334 6.99967 12.8334C2.33301 12.8334 2.33301 11.658 2.33301 10.2084C2.33301 8.75879 4.42251 7.58337 6.99967 7.58337C9.57684 7.58337 11.6663 8.75879 11.6663 10.2084Z" stroke="#efb100" stroke-width="1.5" />
                        </svg>
                    </div>
                    <span>JENIS KELAMIN & STATUS</span>
                </div>

                <!-- Body -->
                <div class="bg-white p-8 rounded-b-md space-y-6 font-poppins text-sm">

                    <!-- Jenis Kelamin Siswa -->
                    <div>
                        <label class="block mb-2 font-medium font-poppins">Jenis Kelamin</label>
                        <div class="flex gap-4">
                            <button type="button" data-value="Laki-laki" class="btn gender-btn flex-1 py-2.5 outline rounded-md outline-blue-300 text-blue-500 bg-blue-100 font-medium">Laki - Laki</button>
                            <button type="button" data-value="Perempuan" class="btn gender-btn flex-1 py-2.5 outline rounded-md outline-red-300 text-red-500 bg-red-100 font-medium">Perempuan</button>
                        </div>
                        <input type="hidden" name="jenis_kelamin" id="jenis_kelamin">
                    </div>

                    <!-- Status Siswa -->
                    <div>
                        <label class="block mb-2 font-medium">Status</label>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" data-value="aktif" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-green-300 text-green-500 bg-green-100 font-medium">Aktif</button>
                            <button type="button" data-value="tidak_aktif" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-red-300 text-red-500 bg-red-100 font-medium">Tidak Aktif</button>
                            <button type="button" data-value="lulus" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-orange-300 text-orange-500 bg-orange-100 font-medium">Pindah</button>
                            <button type="button" data-value="pindah" class="btn status-btn flex-1 py-2.5 outline rounded-md outline-blue-300 text-blue-500 bg-blue-100 font-medium">Lulus Sekolah</button>
                        </div>
                        <input type="hidden" name="status" id="status">
                    </div>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-4 mt-4">

                <a href="/poin_pelanggaran_siswa/pages/siswa/list.php"
                    class="text-center border border-blue-500 text-blue-500 px-4 py-3 rounded">
                    Batal Simpan
                </a>

                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-3 rounded">
                    Simpan Data
                </button>

            </div>
        </div>
    </div>
</form>

<?php
include ROOTPATH . "/includes/footer.php";
?>
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

?>

<div class="flex justify-between items-center px-28">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Tambah Jenis Pelanggaran</h2>
        <p>Silakan isi data pelanggaran yang ingin ditambahkan.</p>
    </div>

    <div class="flex gap-3">
        <!-- button batal simpan -->
        <a class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 gap-1 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300" href="/poin_pelanggaran_siswa/pages/jenis_pelanggaran/list.php">
            Batal
        </a>

        <!-- button Simpan -->
        <button type="submit" form="formPelanggaran"
            class="inline-flex items-center rounded-lg py-4 px-10 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300 cursor-pointer">
            Simpan Data
        </button>
    </div>
</div>

<form id="formPelanggaran" action="/poin_pelanggaran_siswa/process/jenis_pelanggaran/insert.php" method="POST">
    <div class="w-full mt-16 flex gap-8 px-28">
        <div class="flex-2">
            <div class="bg-white rounded-md shadow-md overflow-hidden">
                <div class="flex px-7 py-3.5 gap-3 text-gray-700 text-[18px] font-urbanist rounded-t-lg font-extrabold items-center bg-gray-100 border-2 border-gray-200">
                    <div class="flex p-3 bg-blue-100 rounded-xl items-center justify-center">
                        <svg class="size-5.5" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.1163 6.42625C13.8806 6.18 13.6369 5.92625 13.545 5.70312C13.46 5.49875 13.455 5.16 13.45 4.83187C13.4406 4.22187 13.4306 3.53062 12.95 3.05C12.4694 2.56937 11.7781 2.55937 11.1681 2.55C10.84 2.545 10.5012 2.54 10.2969 2.455C10.0744 2.36312 9.82 2.11937 9.57375 1.88375C9.1425 1.46937 8.6525 1 8 1C7.3475 1 6.85812 1.46937 6.42625 1.88375C6.18 2.11937 5.92625 2.36312 5.70312 2.455C5.5 2.54 5.16 2.545 4.83187 2.55C4.22187 2.55937 3.53062 2.56937 3.05 3.05C2.56937 3.53062 2.5625 4.22187 2.55 4.83187C2.545 5.16 2.54 5.49875 2.455 5.70312C2.36312 5.92562 2.11937 6.18 1.88375 6.42625C1.46937 6.8575 1 7.3475 1 8C1 8.6525 1.46937 9.14187 1.88375 9.57375C2.11937 9.82 2.36312 10.0738 2.455 10.2969C2.54 10.5012 2.545 10.84 2.55 11.1681C2.55937 11.7781 2.56937 12.4694 3.05 12.95C3.53062 13.4306 4.22187 13.4406 4.83187 13.45C5.16 13.455 5.49875 13.46 5.70312 13.545C5.92562 13.6369 6.18 13.8806 6.42625 14.1163C6.8575 14.5306 7.3475 15 8 15C8.6525 15 9.14187 14.5306 9.57375 14.1163C9.82 13.8806 10.0738 13.6369 10.2969 13.545C10.5012 13.46 10.84 13.455 11.1681 13.45C11.7781 13.4406 12.4694 13.4306 12.95 12.95C13.4306 12.4694 13.4406 11.7781 13.45 11.1681C13.455 10.84 13.46 10.5012 13.545 10.2969C13.6369 10.0744 13.8806 9.82 14.1163 9.57375C14.5306 9.1425 15 8.6525 15 8C15 7.3475 14.5306 6.85812 14.1163 6.42625ZM13.3944 8.88188C13.095 9.19438 12.785 9.5175 12.6206 9.91438C12.4631 10.2956 12.4562 10.7312 12.45 11.1531C12.4437 11.5906 12.4369 12.0488 12.2425 12.2425C12.0481 12.4363 11.5931 12.4437 11.1531 12.45C10.7312 12.4562 10.2956 12.4631 9.91438 12.6206C9.5175 12.785 9.19438 13.095 8.88188 13.3944C8.56938 13.6937 8.25 14 8 14C7.75 14 7.42812 13.6925 7.11812 13.3944C6.80812 13.0962 6.4825 12.785 6.08563 12.6206C5.70438 12.4631 5.26875 12.4562 4.84688 12.45C4.40938 12.4437 3.95125 12.4369 3.7575 12.2425C3.56375 12.0481 3.55625 11.5931 3.55 11.1531C3.54375 10.7312 3.53687 10.2956 3.37937 9.91438C3.215 9.5175 2.905 9.19438 2.60562 8.88188C2.30625 8.56938 2 8.25 2 8C2 7.75 2.3075 7.42812 2.60562 7.11812C2.90375 6.80812 3.215 6.4825 3.37937 6.08563C3.53687 5.70438 3.54375 5.26875 3.55 4.84688C3.55625 4.40938 3.56312 3.95125 3.7575 3.7575C3.95187 3.56375 4.40688 3.55625 4.84688 3.55C5.26875 3.54375 5.70438 3.53687 6.08563 3.37937C6.4825 3.215 6.80562 2.905 7.11812 2.60562C7.43062 2.30625 7.75 2 8 2C8.25 2 8.57188 2.3075 8.88188 2.60562C9.19188 2.90375 9.5175 3.215 9.91438 3.37937C10.2956 3.53687 10.7312 3.54375 11.1531 3.55C11.5906 3.55625 12.0488 3.56312 12.2425 3.7575C12.4363 3.95187 12.4437 4.40688 12.45 4.84688C12.4562 5.26875 12.4631 5.70438 12.6206 6.08563C12.785 6.4825 13.095 6.80562 13.3944 7.11812C13.6937 7.43062 14 7.75 14 8C14 8.25 13.6925 8.57188 13.3944 8.88188ZM7.5 8.5V5C7.5 4.86739 7.55268 4.74021 7.64645 4.64645C7.74021 4.55268 7.86739 4.5 8 4.5C8.13261 4.5 8.25979 4.55268 8.35355 4.64645C8.44732 4.74021 8.5 4.86739 8.5 5V8.5C8.5 8.63261 8.44732 8.75979 8.35355 8.85355C8.25979 8.94732 8.13261 9 8 9C7.86739 9 7.74021 8.94732 7.64645 8.85355C7.55268 8.75979 7.5 8.63261 7.5 8.5ZM8.75 10.75C8.75 10.8983 8.70601 11.0433 8.6236 11.1667C8.54119 11.29 8.42406 11.3861 8.28701 11.4429C8.14997 11.4997 7.99917 11.5145 7.85368 11.4856C7.7082 11.4567 7.57456 11.3852 7.46967 11.2803C7.36478 11.1754 7.29335 11.0418 7.26441 10.8963C7.23547 10.7508 7.25032 10.6 7.30709 10.463C7.36386 10.3259 7.45999 10.2088 7.58332 10.1264C7.70666 10.044 7.85166 10 8 10C8.19891 10 8.38968 10.079 8.53033 10.2197C8.67098 10.3603 8.75 10.5511 8.75 10.75Z" fill="#0088FF" />
                        </svg>
                    </div>
                    <span>JENIS PELANGGARAN</span>
                </div>

                <div class="p-10 font-poppins font-medium text-sm rounded-b-lg border-2 border-t-0 border-gray-200">
                    <div class="flex gap-4 w-full">
                        <div class="flex-5">
                            <label class="block mb-2 font-semibold">Nama Pelanggaran</label>
                            <input
                                type="text"
                                name="jenis"
                                placeholder="Silakan masukkan nama pelanggaran"
                                class="w-full border border-gray-300 p-3 rounded-md box-border focus:outline-none focus:border-black"
                                required
                                oninvalid="this.setCustomValidity('Nama pelanggaran tidak boleh kosong!')"
                                oninput="this.setCustomValidity('')">
                        </div>

                        <div class="flex-2">
                            <label class="block mb-2 font-semibold">Poin Pelanggaran</label>
                            <div class="flex">
                                <input
                                    type="number"
                                    name="poin"
                                    placeholder="Contoh: 1"
                                    class="w-full border border-gray-300 p-3 rounded-l-md box-border focus:outline-none focus:border-black"
                                    required
                                    oninvalid="this.setCustomValidity('Poin pelanggaran tidak boleh kosong!')"
                                    oninput="this.setCustomValidity('')">
                                <span class="bg-gray-100 border border-l-0 border-gray-300 px-4 flex items-center rounded-r-md text-gray-600">
                                    poin
                                </span>
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
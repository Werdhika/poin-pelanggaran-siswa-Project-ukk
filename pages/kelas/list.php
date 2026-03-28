<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$result = mysqli_query($conn, "SELECT  
kelas.id_kelas,
tingkat.tingkat,
program_keahlian.program_keahlian,
kelas.rombel,
guru.nama,
guru.kode_guru
FROM kelas
    LEFT JOIN tingkat ON kelas.id_tingkat = tingkat.id_tingkat
    LEFT JOIN program_keahlian ON kelas.id_program_keahlian = program_keahlian.id_program_keahlian
    LEFT JOIN guru on kelas.kode_guru = guru.kode_guru
    ");
?>

<!-- Title -->
<div class="flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-urbanist font-bold mb-2">Data Kelas</h2>
        <p>Kelola daftar kelas yang tersedia di sekolah.</p>
    </div>

    <!-- Button -->
    <div class="flex py-2 justify-center gap-3">
        <a href="pages/kelas/add.php" class="group inline-flex items-center rounded-lg py-4 px-6 gap-1 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
            <svg class="w-4 h-4 transition-transform duration-600 group-hover:rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
            </svg>
            Tambah Data
        </a>
    </div>
</div>

<div class="relative overflow-visible border border-gray-200 rounded-lg shadow-sm mt-14 mb-48">
    <table class="w-full text-sm text-left">
        <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-10 shadow-md">
            <tr>
                <th scope="col" class="px-2 py-5 font-bold text-gray-700 text-center">
                    NO
                </th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700">
                    Wali Kelas
                </th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700 text-center">
                    Kelas
                </th>
                <th scope="col" class="px-4 py-5 font-semibold text-gray-700 justify-center text-center">
                    Aksi
                </th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr class="bg-white hover:bg-gray-100 font-medium font-poppins transition text-sm">
                    <td class="px-2 py-4 font-bold text-[16px] text-center"><?= $no++; ?></td>
                    <td class="px-4 py-4">
                        <?= $row['nama']; ?><br>
                        <span class="text-gray-500 text-sm">
                            <?= $row['kode_guru']; ?>
                        </span>
                    </td>
                    
                    <td class="px-4 py-4 text-center">
                        <div class="inline-block bg-gray-100 px-4.5 py-2 rounded-3xl border-2 border-gray-400 text-[12px] font-semibold">
                            <?= "$row[tingkat] $row[program_keahlian] $row[rombel]"; ?>
                        </div>
                    </td>

                    <!-- Dropdowns -->
                    <td class="px-4 py-4 relative flex justify-center">
                        <span class="inline-flex divide-x divide-gray-300 overflow-hidden rounded-lg border border-gray-300 bg-white">
                            <button type="button"
                                class="dropdown-btn px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 12C7 12.5304 6.78929 13.0391 6.41421 13.4142C6.03914 13.7893 5.53043 14 5 14C4.46957 14 3.96086 13.7893 3.58579 13.4142C3.21071 13.0391 3 12.5304 3 12C3 11.4696 3.21071 10.9609 3.58579 10.5858C3.96086 10.2107 4.46957 10 5 10C5.53043 10 6.03914 10.2107 6.41421 10.5858C6.78929 10.9609 7 11.4696 7 12ZM14 12C14 12.5304 13.7893 13.0391 13.4142 13.4142C13.0391 13.7893 12.5304 14 12 14C11.4696 14 10.9609 13.7893 10.5858 13.4142C10.2107 13.0391 10 12.5304 10 12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10C12.5304 10 13.0391 10.2107 13.4142 10.5858C13.7893 10.9609 14 11.4696 14 12ZM21 12C21 12.5304 20.7893 13.0391 20.4142 13.4142C20.0391 13.7893 19.5304 14 19 14C18.4696 14 17.9609 13.7893 17.5858 13.4142C17.2107 13.0391 17 12.5304 17 12C17 11.4696 17.2107 10.9609 17.5858 10.5858C17.9609 10.2107 18.4696 10 19 10C19.5304 10 20.0391 10.2107 20.4142 10.5858C20.7893 10.9609 21 11.4696 21 12Z" fill="black" />
                                </svg>
                            </button>
                        </span>

                        <div role="menu" class="dropdown-menu hidden absolute end-0 top-12 z-10 w-40 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-300 bg-white">
                            <div>
                                <a href="pages/kelas/edit.php?id_kelas=<?= $row['id_kelas']; ?>" class="block px-3 py-3 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600" role="menuitem">
                                    Edit
                                </a>
                            </div>

                            <a href="/poin_pelanggaran_siswa/process/kelas/delete.php?id_kelas=<?= $row['id_kelas']; ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="block w-full px-3 py-3 text-sm font-medium text-red-700 transition-colors hover:bg-red-50 ltr:text-left rtl:text-right">
                                Hapus
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>
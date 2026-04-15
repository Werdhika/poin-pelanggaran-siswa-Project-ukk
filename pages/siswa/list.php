<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";

$result = mysqli_query($conn, "SELECT 
    a.nis,
    a.nama_siswa,
    a.jenis_kelamin,
    a.status,
    a.id_ortu_wali,
    b.rombel,
    c.tingkat,
    d.program_keahlian,
    e.ayah,
    e.ibu,
    e.wali
    FROM siswa a
    LEFT JOIN kelas b ON a.id_kelas = b.id_kelas
    LEFT JOIN tingkat c ON b.id_tingkat = c.id_tingkat
    LEFT JOIN program_keahlian d ON b.id_program_keahlian = d.id_program_keahlian
    LEFT JOIN ortu_wali e ON a.nis = e.nis
    where a.nis != 0;
");
?>

<div class="flex justify-between">
    <div>
        <h2 class="text-3xl font-urbanist font-extrabold mb-1">Daftar Data Siswa</h2>
        <p>Kelola data siswa yang tersimpan pada sistem sekolah.</p>
    </div>

    <!-- Button -->
    <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
        <div>
            <a href="pages/siswa/add.php" class="group inline-flex items-center rounded-lg py-4 px-6 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                <svg class="w-5 h-5 transition-transform duration-600 group-hover:rotate-180" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
                </svg>
                Tambah Data
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Table Siswa -->
<div class="relative overflow-y-auto max-h-112 border border-gray-200 rounded-lg shadow-sm mt-8">
    <table class="w-full text-sm text-left">
        <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-1 shadow-md">
            <tr>
                <th scope="col" class="px-5 pl-6 py-5 font-bold text-gray-700 text-center">NIS</th>
                <th scope="col" class="px-4 py-5 font-bold text-gray-700">Nama Siswa</th>
                <th scope="col" class="px-0 py-5 font-bold text-gray-700 text-center">Status</th>
                <th scope="col" class="px-0 py-5 font-bold text-gray-700 text-center">Kelas</th>
                <th scope="col" class="px-4 pr-0 py-5 font-bold text-gray-700">Jenis Kelamin</th>
                <th scope="col" class="px-0 py-5 font-bold text-gray-700">Nama Wali</th>
                <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
                    <th scope="col" class="px-4 py-5 font-bold text-gray-700 items-center">
                        Aksi
                    </th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr class="bg-white font-medium font-poppins transition text-sm">
                    <td class="px-4 pl-6 py-4 font-bold text-center"><?= $row['nis']; ?></td>
                    <td class="px-4 py-4 font-semibold"><?= $row['nama_siswa']; ?></td>
                    <td class="px-0 py-4 text-center">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-3xl border-2 text-[12px] font-semibold
                            <?= match ($row['status']) {
                                'aktif' => 'bg-green-50 border-green-600 text-black',
                                'tidak aktif' => 'bg-red-50 border-red-400 text-black',
                                'pindah' => 'bg-yellow-50 border-yellow-400 text-black',
                                'lulus' => 'bg-blue-50 border-blue-400 text-black',
                                default => 'bg-gray-100 border-gray-400 text-black'
                            }; ?>
                    ">
                            <span class="w-1.5 h-1.5 rounded-full
                                <?= match ($row['status']) {
                                    'aktif' => 'bg-green-600',
                                    'tidak aktif' => 'bg-red-500',
                                    'pindah' => 'bg-yellow-500',
                                    'lulus' => 'bg-blue-500',
                                    default => 'bg-gray-500'
                                }; ?>
                            ">
                            </span>
                            <?= $row['status']; ?>
                        </div>
                    </td>
                    <td class="px-0 py-4 font-semibold text-center"><?= "$row[tingkat] $row[program_keahlian] $row[rombel]"; ?></td>
                    <td class="px-4 py-4 pr-0 font-semibold">
                        <div class="inline-flex items-center justify-center gap-1.5">
                            <span class="inline-flex items-center justify-center w-5 h-5 shrink-0">
                                <?php if ($row['jenis_kelamin'] == 'Laki - Laki') { ?>
                                    <svg class="size-3.5 text-blue-600" viewBox="0 0 16 16" fill="none">
                                        <path d="M14.75 0.75L9.35 6.15M14.75 0.75H9.75M14.75 0.75V5.75M0.75 9.75C0.75 11.0761 1.27678 12.3479 2.21447 13.2855C3.15215 14.2232 4.42392 14.75 5.75 14.75C7.07608 14.75 8.34785 14.2232 9.28553 13.2855C10.2232 12.3479 10.75 11.0761 10.75 9.75C10.75 8.42392 10.2232 7.15215 9.28553 6.21447C8.34785 5.27678 7.07608 4.75 5.75 4.75C4.42392 4.75 3.15215 5.27678 2.21447 6.21447C1.27678 7.15215 0.75 8.42392 0.75 9.75Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                <?php } else { ?>
                                    <svg class="size-6 text-pink-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 14C10.6739 14 9.40215 13.4732 8.46447 12.5355C7.52678 11.5979 7 10.3261 7 9C7 7.67392 7.52678 6.40215 8.46447 5.46447C9.40215 4.52678 10.6739 4 12 4C13.3261 4 14.5979 4.52678 15.5355 5.46447C16.4732 6.40215 17 7.67392 17 9C17 10.3261 16.4732 11.5979 15.5355 12.5355C14.5979 13.4732 13.3261 14 12 14ZM12 14V21M9 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                <?php } ?>
                            </span>
                            <span class="leading-none"><?= $row['jenis_kelamin']; ?></span>
                        </div>
                    </td>
                    <td class="px-0 py-4 font-semibold">
                        <?php if ($row['ayah'] != NULL) {
                            echo $row['ayah'];
                        } elseif ($row['ibu'] != NULL) {
                            echo $row['ibu'];
                        } else {
                            echo $row['wali'];
                        } ?>
                    </td>

                    <!-- Tombol Aksi -->
                    <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
                        <td class="flex px-4 py-4 relative">
                            <span class="inline-flex divide-x divide-gray-300 overflow-hidden rounded-lg border hover:border-black focus-within:border-black border-gray-300 bg-white transition">
                                <button type="button"
                                    class="dropdown-btn px-2 py-2 cursor-pointer transition">
                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 12C7 12.5304 6.78929 13.0391 6.41421 13.4142C6.03914 13.7893 5.53043 14 5 14C4.46957 14 3.96086 13.7893 3.58579 13.4142C3.21071 13.0391 3 12.5304 3 12C3 11.4696 3.21071 10.9609 3.58579 10.5858C3.96086 10.2107 4.46957 10 5 10C5.53043 10 6.03914 10.2107 6.41421 10.5858C6.78929 10.9609 7 11.4696 7 12ZM14 12C14 12.5304 13.7893 13.0391 13.4142 13.4142C13.0391 13.7893 12.5304 14 12 14C11.4696 14 10.9609 13.7893 10.5858 13.4142C10.2107 13.0391 10 12.5304 10 12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10C12.5304 10 13.0391 10.2107 13.4142 10.5858C13.7893 10.9609 14 11.4696 14 12ZM21 12C21 12.5304 20.7893 13.0391 20.4142 13.4142C20.0391 13.7893 19.5304 14 19 14C18.4696 14 17.9609 13.7893 17.5858 13.4142C17.2107 13.0391 17 12.5304 17 12C17 11.4696 17.2107 10.9609 17.5858 10.5858C17.9609 10.2107 18.4696 10 19 10C19.5304 10 20.0391 10.2107 20.4142 10.5858C20.7893 10.9609 21 11.4696 21 12Z" fill="black" />
                                    </svg>
                                </button>
                            </span>

                            <div role="menu"
                                class="dropdown-menu hidden absolute end-0 top-12 z-10 w-30 divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-300 bg-white transition-all duration-200 origin-top-right scale-95 opacity-0">
                                <div>
                                    <a href="pages/siswa/edit.php?nis=<?= $row['nis']; ?>" class="block px-2.5 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 hover:text-blue-600" role="menuitem">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>
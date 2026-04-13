<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/includes/header.php";
include ROOTPATH . "/config/config.php";

if (isset($_GET['cari']) && $_GET['cari'] !== '') {
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);
    $result = mysqli_query($conn, "SELECT 
            sp.*,
            a.nis,
            a.nama_siswa,
            sp.alasan_pindah
        FROM surat_pindah sp
        JOIN siswa a ON sp.nis = a.nis
        WHERE a.nama_siswa != NULL
          AND (a.nama_siswa LIKE '%$cari%' OR a.nis LIKE '%$cari%' OR sp.no_surat LIKE '%$cari%')
        ORDER BY sp.tanggal_pembuatan_surat DESC
    ");
} else {

    $result = mysqli_query($conn, "SELECT 
            sp.*,
            a.nama_siswa,
            sp.sekolah_tujuan,
            sp.alasan_pindah
        FROM surat_pindah sp
        JOIN siswa a ON sp.nis = a.nis
    ");
}

// print_r($result);
// exit;


$result_siswa = mysqli_query($conn, "
    SELECT sk.nis, s.nama_siswa
    FROM surat_keluar sk
    JOIN siswa s ON sk.nis = s.nis
    WHERE sk.jenis_surat = 'Pindah Sekolah'
    GROUP BY sk.nis, s.nama_siswa
    ORDER BY s.nama_siswa ASC
");

$bulan = [
    "01" => "Januari",
    "02" => "Februari",
    "03" => "Maret",
    "04" => "April",
    "05" => "Mei",
    "06" => "Juni",
    "07" => "Juli",
    "08" => "Agustus",
    "09" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember"
];
?>

<div class="space-y-8">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
        <div>
            <h2 class="text-3xl font-urbanist font-extrabold mb-2">Daftar Surat Pindah</h2>
            <p>Daftar Surat Pindah Sekolah.</p>
        </div>

        <?php if (
            $_SESSION['user']['role'] == 'Guru BK' ||
            $_SESSION['user']['role'] == 'Kepala Sekolah' ||
            $_SESSION['user']['role'] == 'Wakasek'
        ): ?>
            <div>
                <a href="/poin_pelanggaran_siswa/pages/laporan/surat_pindah/init.php"
                    class="group inline-flex items-center rounded-lg py-4 px-6 gap-1.5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
                    <svg class="w-5 h-5 transition-transform duration-600 group-hover:rotate-180" viewBox="0 0 24 24" fill="none">
                        <path d="M19 12.998H13V18.998H11V12.998H5V10.998H11V4.99805H13V10.998H19V12.998Z" fill="currentColor" />
                    </svg>
                    Cetak Surat Pindah Sekolah
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="border border-gray-200 rounded-lg shadow-sm bg-white">
        <div class="flex flex-col gap-4 p-4 border-b border-gray-200 md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-lg font-poppins font-semibold text-gray-800">Daftar Surat Pindah Sekolah</h3>
                <p class="text-sm text-gray-500">Cari berdasarkan NIS, nama siswa, atau nomor surat.</p>
            </div>

            <form action="" method="get" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <datalist id="nama_siswa">
                    <?php while ($row_siswa = mysqli_fetch_assoc($result_siswa)) { ?>
                        <option value="<?= htmlspecialchars($row_siswa['nis']) ?>">
                        <option value="<?= htmlspecialchars($row_siswa['nama_siswa']) ?>">
                        <?php } ?>
                </datalist>

                <input
                    type="text"
                    name="cari"
                    value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>"
                    placeholder="Masukkan NIS / Nama Siswa / No Surat"
                    list="nama_siswa"
                    autocomplete="off"
                    class="w-full sm:w-72 rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-poppins focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg py-2.5 px-4 text-sm text-white font-poppins font-medium bg-amber-500 hover:bg-amber-600 shadow-sm transition">
                    Cari
                </button>

                <a href=""
                    class="inline-flex items-center justify-center rounded-lg py-2.5 px-4 text-sm text-white font-poppins font-medium bg-red-500 hover:bg-red-600 shadow-sm transition">
                    Reset
                </a>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="font-poppins font-medium bg-gray-100 text-sm text-gray-700 sticky top-0 z-[1] shadow-md">
                    <tr>
                        <th class="px-2 py-5 font-bold text-center">NO</th>
                        <th class="px-4 py-5">Tanggal</th>
                        <th class="px-4 py-5">No Surat</th>
                        <th class="px-4 py-5">NIS</th>
                        <th class="px-4 py-5">Nama</th>
                        <th class="px-4 py-5">Sekolah Tujuan</th>
                        <th class="px-4 py-5">Alasan Pindah</th>
                        <?php if ($_SESSION['user']['role'] == 'Guru BK'): ?>
                            <th class="px-4 py-5 text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($result) == 0):
                    ?>
                        <tr class="bg-white font-medium font-poppins text-sm">
                            <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                Data Tidak Ditemukan
                            </td>
                        </tr>
                        <?php
                    else:
                        while ($row = mysqli_fetch_assoc($result)):
                            $tgl = '';
                            if (!empty($row['tanggal_pembuatan_surat'])) {
                                $pecah = explode('-', date("d-m-Y", strtotime($row['tanggal_pembuatan_surat'])));
                                $tgl = $pecah[0] . ' ' . $bulan[$pecah[1]] . ' ' . $pecah[2];
                            }
                        ?>
                            <tr class="bg-white hover: bg-gray-100 font-medium font-poppins transition text-sm align-top">
                                <td class="px-2 py-4 font-bold text-center"><?= $no++; ?></td>

                                <td class="px-4 py-4">
                                    <div><?= htmlspecialchars($tgl) ?></div>
                                </td>

                                <td class="px-4 py-4"><?= htmlspecialchars($row['no_surat']) ?></td>

                                <td class="px-4 py-4"><?= htmlspecialchars($row['nis']) ?></td>

                                <td class="px-4 py-4"><?= htmlspecialchars($row['nama_siswa']) ?></td>

                                <td class="px-4 py-4"><?= htmlspecialchars($row['sekolah_tujuan']) ?></td>

                                <td class="px-4 py-4"><?= htmlspecialchars($row['alasan_pindah']) ?></td>

                                <?php if (
                                    $_SESSION['user']['role'] == 'Guru BK' ||
                                    $_SESSION['user']['role'] == 'Kepala Sekolah' ||
                                    $_SESSION['user']['role'] == 'Wakasek'
                                ): ?>
                                    <td class="px-4 py-4 text-center">
                                        <a href="/poin_pelanggaran_siswa/pages/cetak/surat_pindah_sekolah.php?nis=<?= urlencode($row['nis']) ?>"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                <path d="M6 9V3H18V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6 18H5C3.89543 18 3 17.1046 3 16V11C3 9.89543 3.89543 9 5 9H19C20.1046 9 21 9.89543 21 11V16C21 17.1046 20.1046 18 19 18H18" stroke="currentColor" stroke-width="2" />
                                                <path d="M6 14H18V21H6V14Z" stroke="currentColor" stroke-width="2" />
                                            </svg>
                                            Cetak
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ROOTPATH . "/includes/footer.php"; ?>
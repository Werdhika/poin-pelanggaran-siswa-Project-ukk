<?php
// Menentukan lokasi root folder proyek di server
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');

// Menghubungkan ke file konfigurasi (koneksi database)
include ROOTPATH . "/config/config.php";

$nis = $_GET['nis'];

// mengambil data siswa dari database join ke tabel ortu_wali, kelas, tingkat, program_keahlian, dan guru
$query_siswa = mysqli_query($conn, "SELECT nis, nama_siswa, tingkat, program_keahlian, rombel, deskripsi FROM siswa
JOIN kelas USING(id_kelas)
JOIN tingkat USING(id_tingkat)
JOIN program_keahlian USING(id_program_keahlian)
WHERE nis = '$nis'");
$row_siswa = mysqli_fetch_assoc($query_siswa);

// Menyertakan tampilan header (bagian atas halaman)
include ROOTPATH . "/includes/header.php";
?>

<!-- ===== TOMBOL KEMBALI & CETAK ===== -->
<!-- ===== TOMBOL KEMBALI & CETAK ===== -->
<div class="no-print flex justify-center my-4">

    <div class="flex items-center gap-3">

        <!-- Tombol Kembali -->
        <form action="/poin_pelanggaran_siswa/pages/laporan/list_perjanjian.php">
            <button
                type="submit"
                class="flex items-center justify-center h-12 px-4 bg-white rounded tracking-wider transition-all duration-200">

                <svg height="16" width="16"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                    class="mr-2 transition-all">
                    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z" />
                </svg>

                <span>Kembali</span>

            </button>
        </form>

        <!-- Tombol Cetak -->
        <button
            onclick="window.print()"
            class="print-btn flex items-center justify-center h-12 px-4 bg-white rounded tracking-wider transition-all duration-200">

            <!-- Icon Printer -->
            <span class="flex flex-col items-center justify-center w-5 h-full">

                <span class="flex items-end justify-center w-full h-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 92 75"
                        class="w-full translate-y-1">

                        <path stroke-width="5" stroke="black"
                            d="M12 37.5H80C85.2467 37.5 89.5 41.7533 89.5 47V69C89.5 70.933 87.933 72.5 86 72.5H6C4.067 72.5 2.5 70.933 2.5 69V47C2.5 41.7533 6.75329 37.5 12 37.5Z" />

                        <circle fill="black" r="3" cy="49" cx="78" />

                    </svg>
                </span>

                <span class="flex items-start justify-center w-full h-1/2">
                    <span class="printer-page"></span>
                </span>
            </span>
            <span class="ml-2">Cetak</span>
        </button>
    </div>
</div>


<!-- ===== HALAMAN LAPORAN ===== -->
<div class="page max-w-3xl mx-auto my-6 p-6 bg-white">

    <!-- Header / Kop Surat -->
    <div class="header mb-4">
        <img src="/poin_pelanggaran_siswa/src/img/kop.jpg" alt="kepala surat" class="w-full">
    </div>

    <!-- Judul -->
    <div class="title text-center font-bold text-lg uppercase tracking-wide my-4">
        LAPORAN PELANGGARAN SISWA
    </div>

    <!-- Konten -->
    <div class="content">
        <div class="indent ml-6">

            <!-- Data Siswa -->
            <div class="flex mb-1">
                <div class="w-40 font-medium">Nama</div>
                <div class="w-4">:</div>
                <div><?php echo $row_siswa['nama_siswa']; ?></div>
            </div>
            <div class="flex mb-1">
                <div class="w-40 font-medium">NIS</div>
                <div class="w-4">:</div>
                <div><?php echo $row_siswa['nis']; ?></div>
            </div>
            <div class="flex mb-1">
                <div class="w-40 font-medium">Kelas</div>
                <div class="w-4">:</div>
                <div><?php echo $row_siswa['tingkat'] . ' ' . $row_siswa['program_keahlian'] . ' ' . $row_siswa['rombel']; ?></div>
            </div>
            <div class="flex mb-1">
                <div class="w-40 font-medium">Program Keahlian</div>
                <div class="w-4">:</div>
                <div><?php echo $row_siswa['deskripsi']; ?></div>
            </div>
            <div class="flex mb-1">
                <div class="w-40 font-medium">Pelanggaran</div>
                <div class="w-4">:</div>
            </div>

            <br>

            <!-- Tabel Pelanggaran -->
            <table class="w-full border-collapse border border-black text-sm">
                <thead>
                    <tr class="bg-gray-100 text-center">
                        <th class="border border-black px-2 py-2">No</th>
                        <th class="border border-black px-2 py-2">Tanggal</th>
                        <th class="border border-black px-2 py-2">Jenis Pelanggaran</th>
                        <th class="border border-black px-2 py-2">Point</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $result_pelanggaran = mysqli_query($conn, "SELECT id_pelanggaran_siswa, tanggal, jenis, keterangan, poin FROM pelanggaran_siswa JOIN siswa USING(nis) JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$nis'");

                    while ($row_pelanggaran = mysqli_fetch_assoc($result_pelanggaran)) {
                        // Format tanggal ke bahasa Indonesia
                        $datetime = date("d-m-Y H:i:s", strtotime($row_pelanggaran['tanggal']));
                        $tanggal = explode(" ", $datetime);
                        $jam = $tanggal[1];
                        $tanggal = explode("-", $tanggal[0]);
                        $bulan = [
                            "01" => "Januari",
                            "02" => "Pebruari",
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
                        $tanggal_indo = $tanggal[0] . " " . $bulan[$tanggal[1]] . " " . $tanggal[2];
                    ?>
                        <tr>
                            <td class="border border-black px-2 py-2 text-center"><?= $no++ ?></td>
                            <td class="border border-black px-2 py-2">
                                <?= $tanggal_indo ?><br><?= $jam ?>
                            </td>
                            <td class="border border-black px-2 py-2"><?= htmlspecialchars($row_pelanggaran['jenis']) ?></td>
                            <td class="border border-black px-2 py-2 text-center" rowspan="2"><?= htmlspecialchars($row_pelanggaran['poin']) ?></td>
                        </tr>
                        <tr>
                            <td class="border border-black px-2 py-2" colspan="3">
                                Detail Pelanggaran : <?= htmlspecialchars($row_pelanggaran['keterangan']) ?>
                            </td>
                        </tr>
                    <?php } ?>

                    <!-- Total Poin -->
                    <tr>
                        <td class="border border-black px-2 py-2 text-right font-semibold" colspan="3">Total Poin</td>
                        <td class="border border-black px-2 py-2 text-center font-semibold">
                            <?php
                            $total_poin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(poin) FROM pelanggaran_siswa JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$nis'"))['SUM(poin)'];
                            echo $total_poin;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>


<?php
// Menyertakan bagian footer (penutup halaman)
include "../../includes/footer.php";
?>
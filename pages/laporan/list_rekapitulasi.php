<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/includes/header.php";
include ROOTPATH . "/config/config.php";

// ----------------------------------------------------------------------------------------------------------
// QUERY 1: Mengambil data siswa dan menjumlahkan total poin pelanggaran khusus bagian Surat Perjanjian Siswa
// ----------------------------------------------------------------------------------------------------------
$query_siswa = "SELECT 
    a.*,
    b.nama_siswa,
    b.id_kelas,
    c.id_tingkat,
    e.tingkat,
    COALESCE(p.jumlah_point, 0) AS jumlah_point
FROM perjanjian_siswa a
LEFT JOIN siswa b 
    ON a.nis = b.nis
LEFT JOIN kelas c 
    ON b.id_kelas = c.id_kelas
LEFT JOIN tingkat e 
    ON c.id_tingkat = e.id_tingkat
LEFT JOIN (
    SELECT 
        ps.nis,
        SUM(jp.poin) AS jumlah_point
    FROM pelanggaran_siswa ps
    LEFT JOIN jenis_pelanggaran jp 
        ON ps.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
    GROUP BY ps.nis
) p 
    ON a.nis = p.nis
WHERE a.status = 'Masih Proses'";
$query_perjanjian_siswa = mysqli_query($conn, $query_siswa);

// ----------------------------------------------------------------------------------------------------------
// QUERY 2: Mengambil data untuk Surat Panggilan Orang Tua
// ----------------------------------------------------------------------------------------------------------
$query_ortu = "SELECT 
    a.*,
    b.nama_siswa,
    b.id_kelas,
    c.id_tingkat,
    e.tingkat,
    COALESCE(p.jumlah_point, 0) AS jumlah_point
FROM perjanjian_orang_tua a
INNER JOIN (
    SELECT nis, MAX(id_perjanjian_ortu) AS max_id
    FROM perjanjian_orang_tua
    GROUP BY nis
) x
    ON a.id_perjanjian_ortu = x.max_id
LEFT JOIN siswa b 
    ON a.nis = b.nis
LEFT JOIN kelas c 
    ON b.id_kelas = c.id_kelas
LEFT JOIN tingkat e 
    ON c.id_tingkat = e.id_tingkat
LEFT JOIN (
    SELECT 
        ps.nis,
        SUM(jp.poin) AS jumlah_point
    FROM pelanggaran_siswa ps
    LEFT JOIN jenis_pelanggaran jp 
        ON ps.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
    GROUP BY ps.nis
) p 
    ON a.nis = p.nis
WHERE a.status = 'Selesai'";
$query_perjanjian_ortu_wali = mysqli_query($conn, $query_ortu);


// print_r($query_perjanjian_ortu_wali);
// exit;

$resul_kelas = mysqli_query($conn, "SELECT  
                                a.id_kelas,
                                b.tingkat,
                                c.program_keahlian,
                                a.rombel,
                                d.kode_guru,
                                d.nama
                            FROM kelas a
    LEFT JOIN tingkat b ON a.id_tingkat = b.id_tingkat
    LEFT JOIN program_keahlian c ON a.id_program_keahlian = c.id_program_keahlian
    LEFT JOIN guru d on a.kode_guru = d.kode_guru
");

function formatTanggalIndonesia($tanggal_db)
{
    $waktu_lengkap = date("d-m-Y H:i:s", strtotime($tanggal_db));
    $pecah_waktu = explode(" ", $waktu_lengkap);
    $jam_saja = $pecah_waktu[1];
    $pecah_tanggal = explode("-", $pecah_waktu[0]);

    $nama_bulan_indonesia = [
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

    $tanggal_bersih = $pecah_tanggal[0] . " " . $nama_bulan_indonesia[$pecah_tanggal[1]] . " " . $pecah_tanggal[2];
    return $tanggal_bersih . "<br>" . $jam_saja;
}
?>

<!-- ===== TOMBOL CETAK ===== -->
<div class="no-print flex justify-center my-4">
    <?php if (
        $_SESSION['user']['role'] == 'Guru BK' ||
        $_SESSION['user']['role'] == 'Kepala Sekolah' ||
        $_SESSION['user']['role'] == 'Wakasek'
    ): ?>
        <div class="flex items-center gap-3">
            <button
                onclick="window.print()"
                class="inline-flex items-center gap-2 rounded-lg py-3 px-5 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow transition duration-300">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="white"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6z" />
                </svg>

                Cetak Dokumen
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- ===== HALAMAN LAPORAN ===== -->
<div class="min-h-screen bg-gray-100 py-10">
    <div class="page max-w-6xl mx-auto my-6 p-10 bg-white border border-gray-300 shadow-xl rounded-sm ring-1 ring-gray-200">

        <!-- Header / Kop Surat -->
        <div class="header mb-4">
            <img src="/poin_pelanggaran_siswa/src/img/kop.jpg" alt="kepala surat" class="w-full">
        </div>

        <!-- Judul -->
        <div class="title text-center font-bold text-lg uppercase tracking-wide my-4">
            LAPORAN REKAPITULASI SURAT PERJANJIAN
        </div>

        <!-- Konten -->
        <div class="content space-y-10">

            <!-- TABEL 1 -->
            <div>
                <h1 class="text-lg font-bold mb-4">Surat Perjanjian Siswa</h1>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-black text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-center">
                                <th class="border border-black px-2 py-2">No</th>
                                <th class="border border-black px-2 py-2">Tanggal Pembuatan Surat</th>
                                <th class="border border-black px-2 py-2">NIS</th>
                                <th class="border border-black px-2 py-2">Nama Siswa</th>
                                <th class="border border-black px-2 py-2">Tingkat</th>
                                <th class="border border-black px-2 py-2">Status Dokumen</th>
                                <th class="border border-black px-2 py-2">Total Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($query_perjanjian_siswa) > 0) {
                                $nomor_urut = 1;
                                while ($data_siswa = mysqli_fetch_assoc($query_perjanjian_siswa)) {
                            ?>
                                    <tr>
                                        <td class="border border-black px-2 py-2 text-center"><?= $nomor_urut++ ?></td>
                                        <td class="border border-black px-2 py-2">
                                            <?= formatTanggalIndonesia($data_siswa['tanggal']) ?>
                                        </td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_siswa['nis']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_siswa['nama_siswa']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_siswa['tingkat']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_siswa['status']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_siswa['jumlah_point']) ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center py-10">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 17v-2a4 4 0 014-4h4M9 7h.01M15 7h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                            </svg>
                                            <p class="font-medium">Tidak ada data</p>
                                            <p class="text-sm">Belum ada surat perjanjian siswa</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABEL 2 -->
            <div>
                <h1 class="text-lg font-bold mb-4">Surat Perjanjian Orang Tua</h1>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-black text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-center">
                                <th class="border border-black px-2 py-2">No</th>
                                <th class="border border-black px-2 py-2">Tanggal Pembuatan Surat</th>
                                <th class="border border-black px-2 py-2">NIS</th>
                                <th class="border border-black px-2 py-2">Nama Siswa</th>
                                <th class="border border-black px-2 py-2">Tingkat</th>
                                <th class="border border-black px-2 py-2">Status Dokumen</th>
                                <th class="border border-black px-2 py-2">Total Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($query_perjanjian_ortu_wali) > 0) {
                                $nomor_urut = 1;
                                while ($data_ortu = mysqli_fetch_assoc($query_perjanjian_ortu_wali)) {
                            ?>
                                    <tr>
                                        <td class="border border-black px-2 py-2 text-center"><?= $nomor_urut++ ?></td>
                                        <td class="border border-black px-2 py-2">
                                            <?= formatTanggalIndonesia($data_ortu['tanggal']) ?>
                                        </td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_ortu['nis']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_ortu['nama_siswa']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_ortu['tingkat']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_ortu['status']) ?></td>
                                        <td class="border border-black px-2 py-2 text-center"><?= htmlspecialchars($data_ortu['jumlah_point']) ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center py-10">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 17v-2a4 4 0 014-4h4M9 7h.01M15 7h.01M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                            </svg>
                                            <p class="font-medium">Tidak ada data</p>
                                            <p class="text-sm">Belum ada surat perjanjian orang tua</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include "../../includes/footer.php";
?>
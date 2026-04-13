<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_GET['nis'];
$result = mysqli_query($conn, "SELECT 
                                a.no_surat,
                                a.tanggal_pembuatan_surat,
                                a.tanggal_pemanggilan,
                                a.keperluan,
                                a.nis,
                                b.ayah,
                                b.ibu,
                                b.wali,
                                d.rombel,
                                e.tingkat,
                                f.program_keahlian
                            FROM surat_keluar a
    LEFT JOIN ortu_wali b ON a.nis = b.nis
    LEFT JOIN siswa c ON a.nis = c.nis
    LEFT JOIN kelas d ON c.id_kelas = d.id_kelas
    LEFT JOIN tingkat e ON d.id_tingkat = e.id_tingkat
    LEFT JOIN program_keahlian f ON d.id_program_keahlian = f.id_program_keahlian
    WHERE a.nis = '$nis';
");

$data = mysqli_fetch_assoc($result);

$queryNosurat = mysqli_query($conn, "SELECT no_surat FROM surat_keluar WHERE nis = '$nis'");
$no_surat = mysqli_fetch_assoc($queryNosurat);

$queryWakasek = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Waka Kesiswaan' AND status = '1'");
$waka_kesiswaan = mysqli_fetch_assoc($queryWakasek);

$tingkat = $data['tingkat'];
if ($tingkat == 'XII') {
    $queryBK = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Guru BK XII' AND status = '1'");
} else if ($tingkat == 'XI') {
    $queryBK = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Guru BK XI' AND status = '1'");
} else {
    $queryBK = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Guru BK X' AND status = '1'");
}
$guru_bk = mysqli_fetch_assoc($queryBK);

$bulan_romawi = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
$bulan_romawi = $bulan_romawi[date("n")];
$no_surat = $no_surat['no_surat'] . "/SMK TI/BG/" . $bulan_romawi . "/" . date("Y");

$hari = [
    "Sunday" => "Minggu",
    "Monday" => "Senin",
    "Tuesday" => "Selasa",
    "Wednesday" => "Rabu",
    "Thursday" => "Kamis",
    "Friday" => "Jumat",
    "Saturday" => "Sabtu"
];

$bulan = [
    "January" => "Januari",
    "February" => "Februari",
    "March" => "Maret",
    "April" => "April",
    "May" => "Mei",
    "June" => "Juni",
    "July" => "Juli",
    "August" => "Agustus",
    "September" => "September",
    "October" => "Oktober",
    "November" => "November",
    "December" => "Desember"
];

include ROOTPATH . "/includes/header.php";
?>

<style>
    * {
        box-sizing: border-box;
    }

    /* ── Halaman A4 ── */
    .page {
        width: 210mm;
        min-height: 297mm;
        background: #fff;
        margin: 0 auto;
        /* margin kertas: atas 0.5cm | kanan 1.5cm | bawah 2cm | kiri 2cm */
        padding: 12mm 15mm 20mm 20mm;
        font-family: 'Times New Roman', Times, serif;
    }

    /* ── Baris form (label : nilai) ── */
    .form-row {
        display: grid;
        align-items: start;
        margin-bottom: 3px;
        font-size: 12pt;
        line-height: 1.6;
    }

    .form-row-sm {
        grid-template-columns: 120px 12px 1fr;
    }

    /* No/Lampiran/Perihal */
    .form-row-md {
        grid-template-columns: 175px 12px 1fr;
    }

    /* Orang tua / Kelas  */
    .form-row-lg {
        grid-template-columns: 145px 12px 1fr;
    }

    /* Hari/Pukul/Tempat  */

    /* ── Tanda tangan ── */
    .ttd-name {
        margin-top: 60px;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    /* ── Print ── */
    @media print {
        body {
            background: #fff !important;
        }

        .no-print {
            display: none !important;
        }

        .page {
            box-shadow: none;
            margin: 0;
            padding: 12mm 15mm 20mm 20mm;
            font-family: 'Times New Roman', Times, serif;
            background-color: #d1d5db;
        }
    }
</style>

<!-- ══ Tombol Aksi ══ -->
<div class="no-print flex justify-center items-center gap-3 mb-6">

    <!-- Kembali -->
    <form action="/poin_pelanggaran_siswa/pages/laporan/panggilan_orang_tua/daftar_siswa/list.php" style="margin:0">
        <button type="submit"
            class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded shadow-sm
                       text-sm font-sans hover:bg-gray-100 transition">
            <svg height="14" width="14" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                <path d="M874.69 495.52c0 11.3-9.17 20.47-20.47 20.47H249.45l188.08 188.08c8 8 8 20.95 0 28.94-4 3.99-9.24 6-14.47 6s-10.48-2-14.48-6L185.52 510c-3.84-3.84-6-9.05-6-14.47 0-5.43 2.16-10.63 6-14.47L408.54 258.06c8-8 20.96-8 28.95 0 8 8 8 20.96 0 28.95L249.42 475.06H854.2c11.3 0 20.47 9.17 20.47 20.47z" />
            </svg>
            Kembali
        </button>
    </form>

    <!-- Cetak -->
    <button onclick="window.print()"
        class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded shadow-sm
                   text-sm font-sans hover:bg-blue-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 92 75" width="18" height="18">
            <path stroke-width="5" stroke="white"
                d="M12 37.5H80C85.2 37.5 89.5 41.75 89.5 47V69c0 1.93-1.57 3.5-3.5 3.5H6C4.07 72.5 2.5 70.93 2.5 69V47C2.5 41.75 6.75 37.5 12 37.5Z" />
            <mask fill="white" id="pm">
                <path d="M12 12C12 5.37 17.37 0 24 0H57C70.25 0 81 10.75 81 24V29H12V12Z" />
            </mask>
            <path mask="url(#pm)" fill="white"
                d="M7 12C7 2.61 14.61-5 24-5H57C73.02-5 86 7.98 86 24H76C76 13.51 67.49 5 57 5H24C20.13 5 17 8.13 17 12H7ZM81 29H12H81ZM7 29V12C7 2.61 14.61-5 24-5V5C20.13 5 17 8.13 17 12V29H7ZM57-5C73.02-5 86 7.98 86 24V29H76V24C76 13.51 67.49 5 57 5V-5Z" />
            <circle fill="white" r="3" cy="49" cx="78" />
        </svg>
        Cetak
    </button>
</div>

<!-- ══ Halaman Surat ══ -->
<div class="page shadow-xl">

    <!-- ── KOP SURAT ── -->
    <div class="mb-3">
        <img src="/poin_pelanggaran_siswa/src/img/kop.jpg" alt="Kop Surat" class="w-full">
    </div>

    <!-- ── JUDUL ── -->
    <div class="text-center font-bold mb-6"
        style="font-size:14pt; letter-spacing:.4px;">
        PEMANGGILAN ORANG TUA / WALI SISWA
    </div>

    <!-- ── ISI SURAT ── -->
    <div style="font-size:12pt; line-height:1.7;">

        <!-- Nomor / Lampiran / Perihal -->
        <div class="form-row form-row-sm">
            <span>No</span><span>:</span>
            <span><?= htmlspecialchars($no_surat) ?></span>
        </div>
        <div class="form-row form-row-sm">
            <span>Lampiran</span><span>:</span>
            <span>-</span>
        </div>
        <div class="mb-5">
            <div class="form-row form-row-sm mb-5">
                <span>Perihal</span><span>:</span>
                <span class="font-semibold">Pemanggilan Orang Tua / Wali Siswa</span>
            </div>
        </div>

        <!-- Kepada -->
        <p class="mb-1">Kepada<br>Yth. Bapak / Ibu</p>

        <div class="pl-8 mb-5">
            <div class="form-row form-row-md">
                <span>Orang Tua / Wali dari</span><span>:</span>
                <span>
                    <?php
                    if (!empty($data['ayah']))       echo htmlspecialchars($data['ayah']);
                    elseif (!empty($data['ibu']))    echo htmlspecialchars($data['ibu']);
                    else                             echo htmlspecialchars($data['wali'] ?? '');
                    ?>
                </span>
            </div>
            <div class="form-row form-row-md">
                <span>Kelas / NIS</span><span>:</span>
                <span>
                    <?= htmlspecialchars($data['tingkat'] . ' ' . $data['program_keahlian'] . ' ' . $data['rombel']) ?>
                    / <?= htmlspecialchars($data['nis']) ?>
                </span>
            </div>
        </div>

        <!-- Salam -->
        <p class="mb-1">Dengan hormat,</p>
        <p class="mb-4">Bersama surat ini, kami mengharapkan kehadiran Bapak / Ibu pada :</p>

        <!-- Info Pertemuan -->
        <div class="pl-8 mb-6">
            <div class="form-row form-row-lg">
                <span>Hari / Tanggal</span><span>:</span>
                <span>
                    <?= $hari[date("l", strtotime($data['tanggal_pemanggilan']))] ?>,
                    <?= date("d", strtotime($data['tanggal_pemanggilan'])) ?>
                    <?= $bulan[date("F", strtotime($data['tanggal_pemanggilan']))] ?>
                    <?= date("Y", strtotime($data['tanggal_pemanggilan'])) ?>
                </span>
            </div>
            <div class="form-row form-row-lg">
                <span>Pukul</span><span>:</span>
                <span><?= date("H:i", strtotime($data['tanggal_pemanggilan'])) ?> WITA</span>
            </div>
            <div class="form-row form-row-lg">
                <span>Tempat</span><span>:</span>
                <span>SMK TI Bali Global Denpasar</span>
            </div>
            <div class="form-row form-row-lg">
                <span>Keperluan</span><span>:</span>
                <span><?= htmlspecialchars($data['keperluan']) ?></span>
            </div>
        </div>

        <!-- Penutup -->
        <p class="mb-8" style="text-align:justify;">
            <span style="display:inline-block; width:2.5em;"></span>
            Demikian surat ini kami sampaikan, besar harapan kami agar pertemuan ini tidak diwakilkan.
            Atas perhatian dan kerjasamanya kami ucapkan terimakasih.
        </p>

        <!-- ── Tanda Tangan ── -->
        <div style="display:grid; grid-template-columns:3fr 2fr; font-size:12pt; line-height:1.8;">

            <!-- Kiri: Waka Kesiswaan -->
            <div>
                <div>Mengetahui,</div>
                <div>Waka Kesiswaan</div>
                <div class="ttd-name"><?= htmlspecialchars($waka_kesiswaan['nama'] ?? '') ?></div>
            </div>

            <!-- Kanan: Guru BK -->
            <div>
                <div>
                    Denpasar,
                    <?= date("d", strtotime($data['tanggal_pembuatan_surat'])) ?>
                    <?= $bulan[date("F", strtotime($data['tanggal_pembuatan_surat']))] ?>
                    <?= date("Y", strtotime($data['tanggal_pembuatan_surat'])) ?>
                </div>
                <div>Guru BK</div>
                <div class="ttd-name"><?= htmlspecialchars($guru_bk['nama'] ?? '') ?></div>
            </div>

        </div>

    </div><!-- /isi surat -->
</div><!-- /page -->

<script>
    window.onload = function() {
        window.print();
    };
</script>

<?php include ROOTPATH . "/includes/footer.php"; ?>
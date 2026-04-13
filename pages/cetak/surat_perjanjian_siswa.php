<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (!isset($_GET['nis']) || empty($_GET['nis'])) {
    die('NIS tidak ditemukan.');
}

$nis = mysqli_real_escape_string($conn, $_GET['nis']);

$query = mysqli_query($conn, "
    SELECT 
        ps.*,
        ps.tanggal AS tanggal_surat,
        s.nama_siswa,
        s.nis,
        k.rombel,
        t.tingkat,
        pk.program_keahlian,
        pk.deskripsi AS deskripsi_program
    FROM perjanjian_siswa ps
    LEFT JOIN siswa s ON ps.nis = s.nis
    LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
    LEFT JOIN tingkat t ON k.id_tingkat = t.id_tingkat
    LEFT JOIN program_keahlian pk ON k.id_program_keahlian = pk.id_program_keahlian
    WHERE ps.nis = '$nis'
    ORDER BY ps.id_perjanjian_siswa DESC
    LIMIT 1
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die('Data tidak ditemukan.');
}

/* Ambil pelanggaran */
$q_pelanggaran = mysqli_query($conn, "
    SELECT DISTINCT jp.jenis
    FROM pelanggaran_siswa p
    LEFT JOIN jenis_pelanggaran jp ON p.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
    WHERE p.nis = '$nis'
");

$list = [];
while ($r = mysqli_fetch_assoc($q_pelanggaran)) {
    $list[] = $r['jenis'];
}

$masalah = !empty($list) ? implode(', ', $list) . '.' : '-';

/* Format tanggal */
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

$t = strtotime($data['tanggal_surat']);
$tanggal = date("d", $t) . ' ' . $bulan[date("F", $t)] . ' ' . date("Y", $t);

include ROOTPATH . "/includes/header.php";
?>

<style>
    .page {
        width: 210mm;
        min-height: 297mm;
        background: #fff;
        margin: 0 auto;
        /*  atas | kanan | bawah | kiri  */
        padding: 10mm 15mm 15mm 15mm;
        font-family: 'Times New Roman', Times, serif;
    }

    .form-row {
        display: grid;
        grid-template-columns: 150px 10px 1fr;
        font-size: 11.5pt;
        line-height: 1.4;
        margin-bottom: 2px;
    }

    .ttd-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .ttd-name {
        margin-top: 50px;
        text-decoration: underline;
        font-weight: bold;
    }

    .ttd-name-plain {
        margin-top: 50px;
        font-weight: bold;
    }

    @media print {
        .no-print {
            display: none
        }

        body {
            background: #fff
        }

        .page {
            margin: 0;
            padding: 8mm 12mm;
        }
    }
</style>

<body class="bg-gray-100 py-6">

    <!-- tombol -->
    <div class="no-print flex justify-center gap-3 mb-4">

        <button onclick="window.location.href='/poin_pelanggaran_siswa/pages/laporan/perjanjian_siswa/daftar_siswa/list.php'"
            class="px-4 py-2 bg-white border rounded text-sm hover:bg-gray-100">
            ← Kembali
        </button>

        <button onclick="window.print()"
            class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
            Cetak
        </button>

    </div>

    <div class="page shadow">

        <!-- KOP -->
        <img src="/poin_pelanggaran_siswa/src/img/kop.jpg" class="w-full mb-2">

        <!-- JUDUL -->
        <div class="text-center font-bold mb-4" style="font-size:14pt">
            SURAT PERNYATAAN SISWA
        </div>

        <div style="font-size:11.5pt; line-height:1.4">

            <p class="mb-2">Yang bertandatangan di bawah ini :</p>

            <!-- DATA SISWA -->
            <div class="pl-6 mb-3">
                <div class="form-row"><span>Nama</span><span>:</span><span><?= $data['nama_siswa'] ?></span></div>
                <div class="form-row"><span>NIS</span><span>:</span><span><?= $data['nis'] ?></span></div>
                <div class="form-row"><span>Kelas</span><span>:</span>
                    <span><?= $data['tingkat'] . ' ' . $data['program_keahlian'] . ' ' . $data['rombel'] ?></span>
                </div>
                <div class="form-row"><span>Program Keahlian</span><span>:</span>
                    <span><?= $data['deskripsi_program'] ?></span>
                </div>
                <div class="form-row"><span>Masalah</span><span>:</span><span><?= $masalah ?></span></div>
            </div>

            <!-- DATA ORTU -->
            <div class="pl-6 mb-3">
                <div class="form-row"><span>Nama Orang Tua</span><span>:</span><span><?= $data['nama_ortu'] ?></span></div>
                <div class="form-row"><span>Pekerjaan</span><span>:</span><span><?= $data['pekerjaan_ortu'] ?></span></div>
                <div class="form-row"><span>Alamat</span><span>:</span><span><?= $data['alamat_ortu'] ?></span></div>
                <div class="form-row"><span>No HP</span><span>:</span><span><?= $data['no_telp_ortu'] ?></span></div>
            </div>

            <!-- PARAGRAF -->
            <p class="mb-3" style="text-indent:2em; text-align:justify;">
                Menyatakan dan berjanji akan bersungguh-sungguh berubah dan bersedia mentaati aturan sekolah.
                Apabila selama masa pembinaan tidak mengalami perubahan, maka siswa dikembalikan kepada orang tua/wali.
                Demikian surat ini dibuat tanpa paksaan.
            </p>

            <!-- TTD ATAS -->
            <div class="ttd-grid mb-3">

                <div style="text-align:center">
                    Mengetahui,<br>
                    Orang Tua/Wali<br>
                    <div class="ttd-name-plain"><?= $data['nama_ortu'] ?></div>
                </div>

                <div style="text-align:center">
                    Denpasar, <?= $tanggal ?><br>
                    Siswa<br>
                    <div class="ttd-name-plain"><?= $data['nama_siswa'] ?></div>
                </div>

            </div>

            <!-- TTD BAWAH -->
            <div class="ttd-grid mb-3">

                <div style="text-align:center">
                    Guru BK<br>
                    <div class="ttd-name"><?= $data['guru_bk'] ?></div>
                </div>

                <div style="text-align:center">
                    Wali Kelas<br>
                    <div class="ttd-name"><?= $data['wali_kelas'] ?></div>
                </div>

            </div>

            <div style="text-align:center">
                Wakasek Kesiswaan<br>
                <div class="ttd-name"><?= $data['wakasek_kesiswaan'] ?></div>
            </div>

        </div>

    </div>

    <script>
        window.onload = () => window.print();
    </script>

</body>

</html>

<?php include ROOTPATH . "/includes/footer.php"; ?>
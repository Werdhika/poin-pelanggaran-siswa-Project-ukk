<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_GET['nis'];
$tanggal = date('Y-m-d');

// print_r($_POST);
// exit;

// if (isset($_GET['no_surat'])) {
//     $no_surat = mysqli_real_escape_string($conn, $_GET['no_surat']);
// } else {
//     $no_surat_input = $_POST['no_surat'] ?? '';
//     $nis = $_GET['nis'];

// ubah format bulan menjadi romawi (untuk bagian no surat)


//     // cek apakah data sudah ada di tabel surat_keluar
//     $cek_data = mysqli_query($conn, "SELECT no_surat FROM surat_keluar WHERE no_surat = '$no_surat'");
//     if (mysqli_num_rows($cek_data) > 0) {
//         echo "<script>alert('No surat sudah ada di database'); window.location.href = 'add_pindah_sekolah.php';</script>";
//         exit;
//     } else {
//         $id_ortu_wali = $_POST['id_ortu_wali'] ?? '';
//         $orang_tua = $_POST['orang_tua'] ?? '';
//         $nama_ortu = $_POST['nama_ortu'] ?? '';
//         $alamat_ortu = $_POST['alamat'] ?? '';
//         $jenis_surat = "Pindah Sekolah";

//         // update data ortu/wali jika tidak ada di database atau data baru diinput
//         if ($orang_tua == "ayah") {
//             mysqli_query($conn, "UPDATE ortu_wali SET ayah = '$nama_ortu', alamat_ayah = '$alamat_ortu' WHERE id_ortu_wali = '$id_ortu_wali'");
//         } else if ($orang_tua == "ibu") {
//             mysqli_query($conn, "UPDATE ortu_wali SET ibu = '$nama_ortu', alamat_ibu = '$alamat_ortu' WHERE id_ortu_wali = '$id_ortu_wali'");
//         } else {
//             mysqli_query($conn, "UPDATE ortu_wali SET wali = '$nama_ortu', alamat_wali = '$alamat_ortu' WHERE id_ortu_wali = '$id_ortu_wali'");
//         }

//         $sekolah_tujuan = $_POST['pindah_ke'] ?? '';
//         $alasan_pindah = $_POST['alasan_pindah'] ?? '';

//         // insert data ke database tabel surat_pindah
//         mysqli_query($conn, "INSERT INTO surat_pindah VALUES (NULL, '$sekolah_tujuan', '$alasan_pindah', '$nama_ortu', '$alamat_ortu', '$nis', '$tanggal')");

//         // Mengambil ID terakhir yang di-generate oleh tabel surat_pindah
//         $id_surat_pindah = mysqli_insert_id($conn);
//         // print_r($nis);
//         // exit;
//         $tanggal_pembuatan_surat = date("Y-m-d");
//         $id_profil_sekolah = 1;
//         $id_tahun_ajaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_tahun_ajaran FROM tahun_ajaran WHERE aktif = 'Y'"))['id_tahun_ajaran'];
//         $tingkat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT tingkat FROM siswa JOIN kelas USING(id_kelas) JOIN tingkat USING(id_tingkat) WHERE nis = '$nis'"))['tingkat'];

//         // insert data ke database tabel surat_keluar
//         mysqli_query($conn, "INSERT INTO surat_keluar (no_surat, jenis_surat, id_surat_pindah, nis, tanggal_pembuatan_surat, id_profil_sekolah, id_tahun_ajaran, tingkat) 
//             VALUES ('$no_surat', '$jenis_surat', '$id_surat_pindah', '$nis', '$tanggal_pembuatan_surat', '$id_profil_sekolah', '$id_tahun_ajaran', '$tingkat')");
//     }
// }

$query_siswa = mysqli_query($conn, "
    SELECT 
        a.no_surat,
        a.tanggal_pembuatan_surat,
        a.nis,
        a.alamat_ortu,
        a.nama_ortu,
        a.alasan_pindah,
        a.sekolah_tujuan,
        b.rombel,
        c.program_keahlian,
        d.tingkat,
        e.nama_siswa,
        e.jenis_kelamin,
        e.alamat
        FROM surat_pindah a
        JOIN siswa e on e.nis = a.nis
        JOIN kelas b on b.id_kelas = e.id_kelas
        JOIN program_keahlian c on c.id_program_keahlian = b.id_program_keahlian
        JOIN tingkat d on d.id_tingkat = b.id_tingkat
        WHERE a.nis = '$nis';
");

$row_siswa = mysqli_fetch_assoc($query_siswa);

$bulan_romawi = ["", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
$bulan_romawi = $bulan_romawi[date("n")];
$no_surat = $row_siswa['no_surat'] . "/SMK TI/BG/" . $bulan_romawi . "/" . date("Y");

// mengambil data wakasek kesiswaan dari database
$waka_kesiswaan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Waka Kesiswaan' AND status = 1"))['nama'] ?? '';

// mengambil data kepala sekolah dari database
$kepala_sekolah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Kepala Sekolah' AND status = 1"))['nama'] ?? '';

// buat array bulan indonesia
$bulan_indo = ["", "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

// format tanggal
$tanggal = explode("-", $row_siswa['tanggal_pembuatan_surat']);
$tanggal_cetak_surat = $tanggal[2] . " " . $bulan_indo[(int)$tanggal[1]] . " " . $tanggal[0];

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
        grid-template-columns: 150px 12px 1fr;
        align-items: start;
        margin-bottom: 4px;
        font-size: 12pt;
        line-height: 1.5;
    }

    .value-line {
        border-bottom: 1px dotted #000;
        padding-bottom: 2px;
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        line-height: 1.5;
        margin-top: 25px;
        margin-bottom: 25px;
    }

    .content {
        font-size: 12pt;
        line-height: 1.7;
        text-align: justify;
    }

    .indent {
        margin-left: 2rem;
        margin-top: 8px;
        margin-bottom: 14px;
    }

    .signature-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 20px;
    }

    .sig-block {
        font-size: 12pt;
        line-height: 1.8;
    }

    .sig-right {
        text-align: center;
    }

    .sig-name-plain {
        margin-top: 70px;
        font-weight: bold;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    @media print {
        body {
            background: #fff !important;
        }

        .no-print {
            display: none !important;
        }

        .page {
            margin: 0;
            box-shadow: none !important;
        }
    }
</style>

<!-- ACTION BAR -->
<div class="flex justify-between items-center px-24 mt-6 no-print">
    <div>
        <h2 class="font-urbanist font-extrabold text-3xl mb-2">Preview Surat Pindah</h2>
        <p>Silahkan cek atau cetak surat pindah sekolah.</p>
    </div>

    <div class="flex gap-3">
        <a href="pages/laporan/surat_pindah/list.php"
            class="inline-flex items-center rounded-lg border border-gray-300 py-4 px-10 text-sm font-poppins font-medium bg-linear-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:shadow-[0_8px_20px_rgba(59,130,246,0.5)] hover:border-transparent transition duration-300">
            Batal
        </a>

        <button onclick="window.print()"
            class="inline-flex items-center rounded-lg py-4 px-6 gap-2 text-sm text-white font-poppins font-medium bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-[0_3px_4px_rgba(59,130,246,0.4)] transition duration-300">
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
</div>

<div class="page shadow-xl mt-6">
    <div class="header mb-2">
        <img src="/poin_pelanggaran_siswa/src/img/kop.jpg" alt="Kepala Surat" class="w-full">
    </div>

    <div class="title">
        <u style="text-underline-offset: 3px;">KETERANGAN PINDAH SEKOLAH</u><br>
        <?= htmlspecialchars($no_surat) ?>
    </div>

    <div class="content mt-4">
        <p>
            Yang bertandatangan di bawah ini Kepala SMK TI BALI GLOBAL Denpasar, Kecamatan Denpasar Selatan,
            Kota Denpasar, Provinsi Bali, menerangkan bahwa :
        </p>

        <div class="indent">
            <div class="form-row">
                <div>Nama Siswa</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['nama_siswa']) ?></div>
            </div>
            <div class="form-row">
                <div>Kelas/Program</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['tingkat'] . ' ' . $row_siswa['program_keahlian'] . ' ' . $row_siswa['rombel']) ?></div>
            </div>
            <div class="form-row">
                <div>NIS</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['nis']) ?></div>
            </div>
            <div class="form-row">
                <div>Jenis Kelamin</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['jenis_kelamin']) ?></div>
            </div>
            <div class="form-row">
                <div>Alamat</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['alamat']) ?></div>
            </div>
        </div>

        <p>
            Sesuai dengan surat permohonan pindah sekolah dari Orang Tua/Wali siswa :
        </p>

        <div class="indent">
            <div class="form-row">
                <div>Nama</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['nama_ortu']) ?></div>
            </div>
            <div class="form-row">
                <div>Alamat</div>
                <div>:</div>
                <div class="value-line"><?= htmlspecialchars($row_siswa['alamat_ortu']) ?></div>
            </div>
        </div>

        <p>
            Telah mengajukan surat permohonan pindah ke <?= htmlspecialchars($row_siswa['sekolah_tujuan']) ?>,
            dengan alasan <?= htmlspecialchars($row_siswa['alasan_pindah']) ?> dan untuk kelengkapan administrasi
            sudah diselesaikan.
            <br>
            Demikian surat pindah ini dibuat untuk dipergunakan sebagaimana mestinya.
        </p>

        <div class="signature-section">
            <div class="sig-block"></div>
            <div class="sig-block sig-right">
                <div>Denpasar, <?= htmlspecialchars($tanggal_cetak_surat) ?></div>
                <div>Kepala SMK TI Bali Global Denpasar</div>
                <div class="sig-name-plain"><?= htmlspecialchars($kepala_sekolah) ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
    }
</script>

<?php include ROOTPATH . "/includes/footer.php"; ?>
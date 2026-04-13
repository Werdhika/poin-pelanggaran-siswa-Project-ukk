<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_GET['nis'];
$result = mysqli_query($conn, "SELECT 
                                a.nis,
                                a.nama_ortu,
                                a.pekerjaan_ortu,
                                a.alamat_ortu,
                                a.no_telp_ortu,
                                a.tanggal,
                                b.ayah,
                                b.tempat_lahir_ayah,
                                b.tempat_lahir_ibu,
                                b.tempat_lahir_wali,
                                b.tanggal_lahir_ayah,
                                c.id_kelas,
                                c.nama_siswa,
                                e.id_tingkat,
                                e.id_program_keahlian,
                                e.rombel,
                                f.tingkat,
                                g.program_keahlian
                            FROM perjanjian_orang_tua a
    LEFT JOIN ortu_wali b ON a.nis = b.nis
    LEFT JOIN siswa c ON a.nis = c.nis
    LEFT JOIN kelas e ON c.id_kelas = e.id_kelas
    LEFT JOIN tingkat f ON e.id_kelas = f.id_tingkat
    LEFT JOIN program_keahlian g ON e.id_program_keahlian = g.id_program_keahlian
    WHERE a.nis = '$nis';
");

$data = mysqli_fetch_assoc($result);

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

$tiga_bulan = strtotime("+3 months", strtotime($data['tanggal']));

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
        /*  atas | kanan | bawah | kiri  */
        padding: 10mm 15mm 15mm 15mm;
        font-family: 'Times New Roman', Times, serif;
    }

    /* ── Baris form (label : nilai) ── */
    .form-row {
        display: grid;
        grid-template-columns: 155px 12px 1fr;
        align-items: start;
        margin-bottom: 3px;
        font-size: 12pt;
        line-height: 1.5;
    }

    /* nilai dengan garis bawah titik-titik */
    .field-value {
        border-bottom: 1px dotted #000;
        padding-bottom: 1px;
        min-height: 18px;
    }

    /* ── Tanda tangan ── */
    .ttd-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .ttd-name {
        margin-top: 56px;
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
            margin: 0;
            box-shadow: none !important;
        }
    }
</style>
</head>

<body class="py-8">

    <!-- ══ Tombol Aksi (tidak ikut cetak) ══ -->
    <div class="no-print flex justify-center items-center gap-3 mb-6">

        <!-- Tombol Kembali
        <form action="add_perjanjian_ortu.php" method="post" style="margin:0">
            <input type="hidden" name="nis" value="<?= htmlspecialchars($nis) ?>">
            <button type="submit"
                class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded shadow-sm
                       text-sm font-sans hover:bg-gray-100 transition">
                <svg height="14" width="14" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                    <path d="M874.69 495.52c0 11.3-9.17 20.47-20.47 20.47H249.45l188.08 188.08c8 8 8 20.95 0 28.94-4 3.99-9.24 6-14.47 6s-10.48-2-14.48-6L185.52 510c-3.84-3.84-6-9.05-6-14.47 0-5.43 2.16-10.63 6-14.47L408.54 258.06c8-8 20.96-8 28.95 0 8 8 8 20.96 0 28.95L249.42 475.06H854.2c11.3 0 20.47 9.17 20.47 20.47z" />
                </svg>
                Kembali
            </button>
        </form> -->

        <button onclick="window.location.href='/poin_pelanggaran_siswa/pages/laporan/perjanjian_ortu/daftar_siswa/list.php'"
            class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded shadow-sm
           text-sm font-sans hover:bg-gray-100 transition">

            <svg height="14" width="14" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                <path d="M874.69 495.52c0 11.3-9.17 20.47-20.47 20.47H249.45l188.08 188.08c8 8 8 20.95 0 28.94-4 3.99-9.24 6-14.47 6s-10.48-2-14.48-6L185.52 510c-3.84-3.84-6-9.05-6-14.47 0-5.43 2.16-10.63 6-14.47L408.54 258.06c8-8 20.96-8 28.95 0 8 8 8 20.96 0 28.95L249.42 475.06H854.2c11.3 0 20.47 9.17 20.47 20.47z" />
            </svg>

            Kembali
        </button>

        <!-- Tombol Cetak -->
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
        <div class="text-center font-bold mb-6.25 mt-6.25"
            style="font-size:14pt; letter-spacing:.4px;">
            SURAT PERNYATAAN ORANG TUA
        </div>

        <!-- ── ISI SURAT ── -->
        <div style="font-size:12pt; line-height:1.7; text-align:justify;">

            <p class="mb-4">
                Yang bertandatangan di bawah ini orang tua/wali siswa SMK TI Bali Global Denpasar :
            </p>

            <!-- Data Orang Tua -->
            <div class="pl-8 mb-6">
                <div class="form-row">
                    <span>Nama</span>
                    <span>:</span>
                    <span class="field-value"><?= htmlspecialchars($data['nama_ortu'] ?? '') ?></span>
                </div>
                <div class="form-row">
                    <span>Tempat/ tanggal Lahir</span>
                    <span>:</span>
                    <span class="field-value">
                        <?= htmlspecialchars($data['tempat_lahir_ayah'] ?? '') ?>
                        <?= htmlspecialchars($data['tanggal_lahir_ayah'] ?? '') ?>
                    </span>
                </div>
                <div class="form-row">
                    <span>Pekerjaan</span>
                    <span>:</span>
                    <span class="field-value"><?= htmlspecialchars($data['pekerjaan_ortu'] ?? '') ?></span>
                </div>
                <div class="form-row">
                    <span>Alamat Rumah</span>
                    <span>:</span>
                    <span class="field-value"><?= htmlspecialchars($data['alamat_ortu'] ?? '') ?></span>
                </div>
                <div class="form-row">
                    <span>No. Hp./Telp.</span>
                    <span>:</span>
                    <span class="field-value"><?= htmlspecialchars($data['no_telp_ortu'] ?? '') ?></span>
                </div>
            </div>

            <!-- Paragraf Pernyataan -->
            <p class="mb-4" style="text-indent:2.5em;">
                Menyatakan memang benar sanggup membina anak kami yang bernama
                <strong><?= htmlspecialchars($data['nama_siswa'] ?? '') ?></strong>,
                Kelas :
                <strong><?= htmlspecialchars(
                            ($data['tingkat'] ?? '') . ' ' .
                                ($data['program_keahlian'] ?? '') . ' ' .
                                ($data['rombel'] ?? '')
                        ) ?></strong>
                untuk lebih disiplin mengikuti proses pembelajaran dan mengikuti Tata Tertib Sekolah.
            </p>

            <p class="mb-6">
                Demikian pernyataan kami dan jika tidak sesuai dengan pernyataan diatas, anak kami dapat
                dikeluarkan dari sekolah ini dengan rekomendasi pindah ke SMK lain yang serumpun.
            </p>

            <!-- ── Tanda Tangan ── -->
            <div class="mb-8" style="display:grid; grid-template-columns: 3fr 2fr;">
                <!-- kolom kiri kosong -->
                <div></div>

                <!-- kolom kanan -->
                <div style="font-size:12pt; line-height:1.8;">
                    <div>
                        Denpasar,
                        <?= date("d", strtotime($data['tanggal'])) ?>
                        <?= $bulan[date("F", strtotime($data['tanggal']))] ?>
                        <?= date("Y", strtotime($data['tanggal'])) ?>
                    </div>
                    <div>Yang membuat pernyataan</div>
                    <div>Orang Tua/Wali siswa</div>

                    <!-- ruang tanda tangan -->
                    <div class="ttd-name">
                        <?= htmlspecialchars($data['nama_ortu'] ?? '') ?>
                    </div>
                </div>
            </div>

            <!-- ── NB ── -->
            <div class="pl-0" style="font-size:12pt;">
                <u>
                    NB :<br>
                    Jika siswa tidak bisa mengikuti proses pembelajaran sampai bulan
                    <strong><?= $bulan[date("F", $tiga_bulan)] . " " . date("Y", $tiga_bulan) ?></strong> maka Siswa dinyatakan mengundurkan diri.
                </u>
            </div>

        </div><!-- /isi surat -->
    </div><!-- /page -->

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
<?php include ROOTPATH . "/includes/footer.php"; ?>
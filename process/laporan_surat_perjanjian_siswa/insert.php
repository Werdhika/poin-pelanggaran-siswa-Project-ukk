<?php

define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

// print_r($_POST);
// exit;

//untuk mengambil data tingkat
$nis = $_POST['nis'];
$data_siswa = mysqli_query($conn, "SELECT 
                                a.nis,
                                b.rombel,
                                c.tingkat,
                                d.program_keahlian
                        FROM siswa a
                        LEFT JOIN kelas b ON a.id_kelas = b.id_kelas
                        LEFT JOIN tingkat c ON b.id_tingkat = c.id_tingkat
                        LEFT JOIN program_keahlian d ON b.id_program_keahlian = d.id_program_keahlian
                        WHERE a.nis = '$nis';
                        ");
$data = mysqli_fetch_assoc($data_siswa);

// validasi for not to duplicated
$resultNis = mysqli_query($conn, "SELECT COUNT(*) as data FROM perjanjian_siswa WHERE nis='$nis'");
$count_nis = mysqli_fetch_assoc($resultNis);

if ($count_nis['data'] > 0) {
    echo "<script>window.alert('Maaf, Surat Perjanjian Siswa Sudah dibuat')
    window.location='poin_pelanggaran_siswa/pages/laporan/perjanjian_siswa/daftar_siswa/init.php'</script>";
}

//check data guru wali
$query = mysqli_query($conn, "
    SELECT
        s.nis,
        s.nama_siswa,
        t.tingkat,
        pk.program_keahlian,
        k.rombel,
        g.kode_guru,
        g.nama AS wali_kelas,
        g.jabatan,
        g.status
    FROM siswa s
    LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
    LEFT JOIN tingkat t ON k.id_tingkat = t.id_tingkat
    LEFT JOIN program_keahlian pk ON k.id_program_keahlian = pk.id_program_keahlian
    LEFT JOIN guru g ON k.kode_guru = g.kode_guru
    WHERE s.nis = '$nis'
");
$wali = mysqli_fetch_assoc($query);
$data_wali = $wali['wali_kelas'];
$tingkat = $wali['tingkat'];

// check data guru bk
if ($tingkat == 'XII') {
    $query_bk = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Guru BK XII' AND status = 1");
} else if ($tingkat == 'XI') {
    $query_bk = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Guru BK XI' AND status = 1");
} else {
    $query_bk = mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Guru BK X' AND status = 1");
}
$data_bk = mysqli_fetch_assoc($query_bk)['nama'];

// mengambil data wakasek kesiswaan dari database
$data_kesiswaan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM guru WHERE jabatan = 'Waka Kesiswaan' AND status = 1"))['nama'];


if (!empty(@$_POST['ayah'])) {
    //opsi simpan data perjanjian ayah

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $status = 'Masih Proses';
    $nama_ortu = $_POST['ayah'];
    $pekerjaan_ortu = $_POST['pekerjaan_ayah'];
    $alamat_ortu = $_POST['alamat_ayah'];
    $no_telp_ortu = $_POST['no_telp_ayah'];
    $wali_kelas = $data_wali;
    $guru_bk = $data_bk;
    $wakasek_kesiswaan = $data_kesiswaan;

    //query untuk select table kelas 
    //kemudian join ke table guru untuk mendapatkan wali kelas



    // print_r($tanggal);
    // exit;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO perjanjian_siswa (nis, tanggal, status, nama_ortu, pekerjaan_ortu, alamat_ortu, no_telp_ortu, wali_kelas, guru_bk, wakasek_kesiswaan)
    VALUES ('$nis', '$tanggal', '$status', '$nama_ortu', '$pekerjaan_ortu', '$alamat_ortu', '$no_telp_ortu','$wali_kelas','$guru_bk','$wakasek_kesiswaan' )");
}

if (!empty(@$_POST['ibu'])) {
    //opsi simpan data perjanjian ibu

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $status = 'Masih Proses';
    $nama_ortu = $_POST['ibu'];
    $pekerjaan_ortu = $_POST['pekerjaan_ibu'];
    $alamat_ortu = $_POST['alamat_ibu'];
    $no_telp_ortu = $_POST['no_telp_ibu'];
    $wali_kelas = $data_wali;
    $guru_bk = $data_bk;
    $wakasek_kesiswaan = $data_kesiswaan;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO perjanjian_siswa (nis, tanggal, status, nama_ortu, pekerjaan_ortu, alamat_ortu, no_telp_ortu, wali_kelas, guru_bk, wakasek_kesiswaan)
    VALUES ('$nis', '$tanggal', '$status', '$nama_ortu', '$pekerjaan_ortu', '$alamat_ortu', '$no_telp_ortu','$wali_kelas','$guru_bk','$wakasek_kesiswaan' )");
}


if (!empty(@$_POST['wali'])) {
    //opsi simpan data perjanjian wali

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $status = 'Masih Proses';
    $nama_ortu = $_POST['wali'];
    $pekerjaan_ortu = $_POST['pekerjaan_wali'];
    $alamat_ortu = $_POST['alamat_wali'];
    $no_telp_ortu = $_POST['no_telp_wali'];
    $wali_kelas = $data_wali;
    $guru_bk = $data_bk;
    $wakasek_kesiswaan = $data_kesiswaan;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO perjanjian_siswa (nis, tanggal, status, nama_ortu, pekerjaan_ortu, alamat_ortu, no_telp_ortu, wali_kelas, guru_bk, wakasek_kesiswaan)
    VALUES ('$nis', '$tanggal', '$status', '$nama_ortu', '$pekerjaan_ortu', '$alamat_ortu', '$no_telp_ortu','$wali_kelas','$guru_bk','$wakasek_kesiswaan' )");
}

// print_r($query);
// exit;

if ($query) {
    // jika berhasil langsung ke halaman cetak
    header("Location: /poin_pelanggaran_siswa/pages/cetak/surat_perjanjian_siswa.php?nis=$nis");
    exit;
} else {

    echo "Data gagal disimpan";
}

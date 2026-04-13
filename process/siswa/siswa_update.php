<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_POST['nis'];
$nama = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status = $_POST['status'];

$ayah = $_POST['ayah'];
$ibu = $_POST['ibu'];
$wali = $_POST['wali'];
$tempat_lahir_ayah = $_POST['tempat_lahir_ayah'];
$tempat_lahir_ibu = $_POST['tempat_lahir_ibu'];
$tempat_lahir_wali = $_POST['tempat_lahir_wali'];
$tanggal_lahir_ayah = !empty($_POST['tanggal_lahir_ayah']) ? $_POST['tanggal_lahir_ayah'] : NULL;
$tanggal_lahir_ibu = !empty($_POST['tanggal_lahir_ibu']) ? $_POST['tanggal_lahir_ibu'] : NULL;
$tanggal_lahir_wali = !empty($_POST['tanggal_lahir_wali']) ? $_POST['tanggal_lahir_wali'] : NULL;
$pekerjaan_ayah = $_POST['pekerjaan_ayah'];
$pekerjaan_ibu = $_POST['pekerjaan_ibu'];
$pekerjaan_wali = $_POST['pekerjaan_wali'];
$no_telp_ayah = $_POST['no_telp_ayah'];
$no_telp_ibu = $_POST['no_telp_ibu'];
$no_telp_wali = $_POST['no_telp_wali'];
$alamat_ayah = $_POST['alamat_ayah'];
$alamat_ibu = $_POST['alamat_ibu'];
$alamat_wali = $_POST['alamat_wali'];

//! Update tabel siswa
if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query_siswa = mysqli_query($conn, "UPDATE siswa SET
        nama_siswa = '$nama',
        id_kelas = '$id_kelas',
        alamat = '$alamat',
        jenis_kelamin = '$jenis_kelamin',
        password = '$password',
        status = '$status'
        WHERE nis = '$nis'");
} else {
    $query_siswa = mysqli_query($conn, "UPDATE siswa SET
        nama_siswa = '$nama',
        id_kelas = '$id_kelas',
        alamat = '$alamat',
        jenis_kelamin = '$jenis_kelamin',
        status = '$status'
        WHERE nis = '$nis'");
}

//! Update tabel ortu_wali
$query_ortu_wali = mysqli_query($conn, "UPDATE ortu_wali SET 
    ayah = '$ayah',
    ibu = '$ibu',
    wali = '$wali',
    tempat_lahir_ayah = '$tempat_lahir_ayah',
    tempat_lahir_ibu = '$tempat_lahir_ibu',
    tempat_lahir_wali = '$tempat_lahir_wali',
    tanggal_lahir_ayah = " . ($tanggal_lahir_ayah ? "'$tanggal_lahir_ayah'" : "NULL") . ",
    tanggal_lahir_ibu = " . ($tanggal_lahir_ibu ? "'$tanggal_lahir_ibu'" : "NULL") . ",
    tanggal_lahir_wali = " . ($tanggal_lahir_wali ? "'$tanggal_lahir_wali'" : "NULL") . ",
    pekerjaan_ayah = '$pekerjaan_ayah',
    pekerjaan_ibu = '$pekerjaan_ibu',
    pekerjaan_wali = '$pekerjaan_wali',
    no_telp_ayah = '$no_telp_ayah',
    no_telp_ibu = '$no_telp_ibu',
    no_telp_wali = '$no_telp_wali',
    alamat_ayah = '$alamat_ayah',
    alamat_ibu = '$alamat_ibu',
    alamat_wali = '$alamat_wali'
    WHERE nis = '$nis'");

// print_r($query_ortu_wali);
// exit;

if ($query_siswa && $query_ortu_wali) {
    header("Location: /poin_pelanggaran_siswa/pages/siswa/list.php");
    exit;
} else {
    echo "Gagal update data";
}

<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status_siswa = $_POST['status_siswa'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

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

//! Menambahkan data siswa
$query_siswa = mysqli_query($conn, "INSERT INTO siswa (nama_siswa, nis, alamat, id_kelas, jenis_kelamin, status, password) 
VALUES ('$nama_siswa', '$nis', '$alamat', '$id_kelas', '$jenis_kelamin', '$status_siswa', '$password')");

//! Menambahkan data ortu_wali
$query_ortu_wali = mysqli_query($conn, "INSERT INTO ortu_wali (nis, ayah, ibu, wali, tempat_lahir_ayah, tempat_lahir_ibu, tempat_lahir_wali, tanggal_lahir_ayah, tanggal_lahir_ibu, tanggal_lahir_wali , pekerjaan_ayah, pekerjaan_ibu, pekerjaan_wali, no_telp_ayah, no_telp_ibu, no_telp_wali, alamat_ayah, alamat_ibu, alamat_wali) 
VALUES ('$nis', '$ayah', '$ibu', '$wali', '$tempat_lahir_ayah', '$tempat_lahir_ibu', '$tempat_lahir_wali',
" . ($tanggal_lahir_ayah ? "'$tanggal_lahir_ayah'" : "NULL") . ",
" . ($tanggal_lahir_ibu ? "'$tanggal_lahir_ibu'" : "NULL") . ",
" . ($tanggal_lahir_wali ? "'$tanggal_lahir_wali'" : "NULL") . ",
'$pekerjaan_ayah', '$pekerjaan_ibu', '$pekerjaan_wali',
'$no_telp_ayah', '$no_telp_ibu', '$no_telp_wali',
'$alamat_ayah', '$alamat_ibu', '$alamat_wali')");


if ($query_siswa && $query_ortu_wali) {
    header("location: /poin_pelanggaran_siswa/pages/siswa/list.php");
} else {
    echo "Gagal Manambahkan Data";
}

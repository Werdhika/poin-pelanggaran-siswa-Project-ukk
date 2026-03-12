<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nama_siswa = $_POST['nama_siswa'];
$nis = $_POST['nis'];
$alamat = $_POST['alamat'];
$id_kelas = $_POST['id_kelas'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status = $_POST['status'];

$data = "INSERT INTO siswa (nama_siswa, nis, alamat, id_kelas, jenis_kelamin, status) VALUES ('$nama_siswa', '$nis', '$alamat', '$id_kelas', '$jenis_kelamin', '$status')";

// echo "<pre>";
// var_dump($_POST);
// die();

$query = mysqli_query($conn, $data);

if ($query) {
    header("location: /poin_pelanggaran_siswa/pages/siswa/list.php");
} else {
    echo "Gagal Manambahkan Data";
}

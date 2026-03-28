<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status_siswa = $_POST['status_siswa'];

$data = "INSERT INTO siswa (nama_siswa, nis, alamat, id_kelas, jenis_kelamin, status_siswa) 
VALUES ('$nama_siswa', '$nis', '$alamat', '$id_kelas', '$jenis_kelamin', '$status_siswa')";

$query = mysqli_query($conn, $data);

if ($query) {
    header("location: /poin_pelanggaran_siswa/pages/siswa/list.php");
} else {
    echo "Gagal Manambahkan Data";
}
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$kode_guru = $_POST['kode_guru'];
$nama = $_POST['nama'];
$role = $_POST['role'];
$status = $_POST['status'];
$jabatan = $_POST['jabatan'];
$telp = $_POST['telp'];

$data = "INSERT INTO guru (kode_guru, nama, role, status, jabatan, telp) 
VALUES ('$kode_guru', '$nama', '$role', '$status', '$jabatan', '$telp')";

$query = mysqli_query($conn, $data);

if ($query) {
    header("location: /poin_pelanggaran_siswa/pages/guru/list.php");
} else {
    echo "Gagal Manambahkan Data";
}
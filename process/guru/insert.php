<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$kode_guru = $_POST['kode_guru'];
$username = $_POST['username'];
$nama = $_POST['nama'];
$role = $_POST['role'];
$status = $_POST['status'];
$jabatan = $_POST['jabatan'];
$telp = $_POST['telp'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$data = "INSERT INTO guru (kode_guru, nama, username, role, status, jabatan, telp, password) 
    VALUES ('$kode_guru', '$nama', '$username', '$role', '$status', '$jabatan', '$telp', '$password')";

$query = mysqli_query($conn, $data);

if ($query) {
    header("location: /poin_pelanggaran_siswa/pages/guru/list.php");
} else {
    echo "Gagal Menambahkan Data";
}

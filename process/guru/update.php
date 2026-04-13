<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$kode_guru = $_POST['kode_guru'];
$username = $_POST['username'];
$nama = $_POST['nama'];
$role = $_POST['role'];
$jabatan = $_POST['jabatan'];
$telp = $_POST['telp'];
$status = $_POST['status'];

if ($_POST['password'] != null) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = mysqli_query($conn, "UPDATE guru SET
nama='$nama',
username='$username',
password='$password',
role='$role',
jabatan='$jabatan',
telp='$telp',
status ='$status'
WHERE kode_guru='$kode_guru'");
} else {
    $password = '';
    $query = mysqli_query($conn, "UPDATE guru SET
nama='$nama',
username='$username',
role='$role',
jabatan='$jabatan',
telp='$telp',
status ='$status'
WHERE kode_guru='$kode_guru'");
}


if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/guru/list.php");
} else {
    echo "Gagal update data";
}

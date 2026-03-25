<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$kode_guru = $_POST['kode_guru'];
$nama = $_POST['nama'];
$role = $_POST['role'];
$jabatan = $_POST['jabatan'];
$telp = $_POST['telp'];
$status_guru = $_POST['status_guru'];

$query = mysqli_query($conn, "UPDATE guru SET
nama='$nama',
role='$role',
jabatan='$jabatan',
telp='$telp',
status_guru ='$status_guru'
WHERE kode_guru='$kode_guru'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/guru/list.php");
} else {
    echo "Gagal update data";
}

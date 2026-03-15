<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_POST['nis'];
$nama = $_POST['nama_siswa'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status_siswa = $_POST['status_siswa'];

$query = mysqli_query($conn, "UPDATE siswa SET
nama_siswa='$nama',
id_kelas='$id_kelas',
alamat='$alamat',
jenis_kelamin='$jenis_kelamin',
status_siswa ='$status_siswa'
WHERE nis='$nis'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/siswa/list.php");
} else {
    echo "Gagal update data";
}

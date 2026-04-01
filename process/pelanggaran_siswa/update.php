<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

date_default_timezone_set('Asia/Makassar');

$id = $_POST['id_pelanggaran_siswa'];
$nis = $_POST['nis'];
$id_jenis_pelanggaran = $_POST['id_jenis_pelanggaran'];
$keterangan = $_POST['keterangan'];
$tanggal = date("Y-m-d H:i:s");

$query = mysqli_query($conn, "UPDATE pelanggaran_siswa SET
nis ='$nis',
id_jenis_pelanggaran='$id_jenis_pelanggaran',
keterangan='$keterangan',
tanggal='$tanggal'
WHERE id_pelanggaran_siswa='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/laporan/pelanggaran_siswa/list.php");
} else {
    echo "Gagal memperbarui data Pelanggaran Siswa";
}

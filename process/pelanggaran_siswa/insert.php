<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

date_default_timezone_set('Asia/Makassar');

$nis = $_POST['nis'];
$id_jenis_pelanggaran = $_POST['id_jenis_pelanggaran'];
$keterangan = $_POST['keterangan'];
$tanggal = date("Y-m-d H:i:s");

$query = "INSERT INTO pelanggaran_siswa (nis, id_jenis_pelanggaran, keterangan, tanggal) 
    VALUES ('$nis','$id_jenis_pelanggaran','$keterangan','$tanggal')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/laporan/pelanggaran_siswa/list.php");
    exit;
} else {
    echo "Gagal Manambahkan Data" . mysqli_error($conn);
}

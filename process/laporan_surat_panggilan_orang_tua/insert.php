<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

date_default_timezone_set('Asia/Makassar');

$nis = $_POST['nis'];
$no_surat = $_POST['no_surat'];
$tanggal_pembuatan_surat = date("Y-m-d");
$tanggal_pemanggilan = $_POST['tanggal_pemanggilan'];
$jam = $_POST['jam'];
$keperluan = $_POST['keperluan'];

$hasil = date('Y-m-d h:i:s', strtotime("$tanggal_pemanggilan $jam"));

$query = "INSERT INTO surat_keluar (nis, no_surat, tanggal_pembuatan_surat, tanggal_pemanggilan, keperluan) 
    VALUES ('$nis','$no_surat', '$tanggal_pembuatan_surat' ,'$hasil', '$keperluan')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/cetak/surat_panggilan_ortu.php?nis=$nis");
    exit;
} else {
    echo "Gagal Manambahkan Data Surat Keluar" . mysqli_error($conn);
}

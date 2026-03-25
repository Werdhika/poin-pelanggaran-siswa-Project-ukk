<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$jenis = $_POST['jenis'];
$poin = $_POST['poin'];

$query = "INSERT INTO jenis_pelanggaran (jenis, poin) 
VALUES ('$jenis', '$poin')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/jenis_pelanggaran/list.php");
} else {
    echo "Gagal Manambahkan Data";
}
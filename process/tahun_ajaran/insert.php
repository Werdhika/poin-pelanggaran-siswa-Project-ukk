<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$tahun = $_POST['tahun'];
$status = $_POST['status'];

$query =  "INSERT INTO tahun_ajaran (tahun, status)
VALUES ('$tahun', '$status')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/tahun_ajaran/list.php");
    exit;
} else {
    echo "Gagal Manambahkan Data Tahun Ajaran" . mysqli_error($conn);
}

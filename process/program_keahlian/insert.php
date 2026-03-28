<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$deskripsi = $_POST['deskripsi'];
$program_keahlian = $_POST['program_keahlian'];

$query = "INSERT INTO program_keahlian (deskripsi, program_keahlian) 
VALUES ('$deskripsi', '$program_keahlian')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/program_keahlian/list.php");
} else {
    echo "Gagal Manambahkan Data";
}
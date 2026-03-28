<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$tingkat = $_POST['tingkat'];

$query = "INSERT INTO tingkat (tingkat)
VALUES ('$tingkat')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/tingkat/list.php");
} else {
    echo "Gagal Manambahkan Data";
}

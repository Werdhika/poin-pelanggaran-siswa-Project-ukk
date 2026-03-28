<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id_tingkat = $_POST['id_tingkat'];
$id_program_keahlian = $_POST['id_program_keahlian'];
$rombel = $_POST['rombel'];
$kode_guru = $_POST['kode_guru'];

$query = "INSERT INTO kelas (id_tingkat, id_program_keahlian, rombel, kode_guru) 
VALUES ('$id_tingkat','$id_program_keahlian','$rombel', '$kode_guru')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/kelas/list.php");
} else {
    echo "Gagal Menambahkan Data";
}
<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_kelas'];
$id_tingkat = $_POST['id_tingkat'];
$id_program_keahlian = $_POST['id_program_keahlian'];
$rombel = $_POST['rombel'];
$kode_guru = $_POST['kode_guru'];

$query = "UPDATE kelas SET
id_tingkat = '$id_tingkat',
id_program_keahlian = '$id_program_keahlian',
rombel = '$rombel',
kode_guru = '$kode_guru'
WHERE id_kelas = '$id'";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location:/poin_pelanggaran_siswa/pages/kelas/list.php");
} else {
    echo "Gagal update data";
}
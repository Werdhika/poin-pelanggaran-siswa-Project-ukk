<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_program_keahlian'];
$deskripsi = $_POST['deskripsi'];
$program_keahlian = $_POST['program_keahlian'];

$query = mysqli_query($conn, "UPDATE program_keahlian SET
deskripsi='$deskripsi',
program_keahlian='$program_keahlian'
WHERE id_program_keahlian ='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/program_keahlian/list.php");
} else {
    echo "Gagal update data";
}

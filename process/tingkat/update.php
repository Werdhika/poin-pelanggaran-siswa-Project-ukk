<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_tingkat'];
$tingkat = $_POST['tingkat'];

$query = mysqli_query($conn, "UPDATE tingkat SET
tingkat='$tingkat'
WHERE id_tingkat='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/tingkat/list.php");
} else {
    echo "Gagal update data";
}

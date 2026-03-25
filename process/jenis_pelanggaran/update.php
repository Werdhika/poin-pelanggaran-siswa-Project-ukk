<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_jenis_pelanggaran'];
$jenis = $_POST['jenis'];
$poin = $_POST['poin'];

$query = mysqli_query($conn, "UPDATE jenis_pelanggaran SET
jenis='$jenis',
poin='$poin'
WHERE id_jenis_pelanggaran ='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/jenis_pelanggaran/list.php");
} else {
    echo "Gagal update data";
}

<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_tahun_ajaran'];
$tahun = $_POST['tahun'];
$status = $_POST['status'];

$query = mysqli_query($conn, "UPDATE tahun_ajaran SET
tahun ='$tahun',
status='$status'
WHERE id_tahun_ajaran='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/tahun_ajaran/list.php");
} else {
    echo "Gagal memperbarui data tahun ajaran";
}

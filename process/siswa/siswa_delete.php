<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$nis'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/siswa/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Siswa";
    }
} else {
    echo "Nis Siswa Tidak ditemukan";
}

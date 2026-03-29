<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_tingkat'])) {
    $id = $_GET['id_tingkat'];
    $query = mysqli_query($conn, "DELETE FROM tingkat WHERE id_tingkat='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/tingkat/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Tingkat";
    }
} else {
    echo "Id Tingkat Tidak ditemukan";
}

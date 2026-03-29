<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_jenis_pelanggaran'])) {
    $id = $_GET['id_jenis_pelanggaran'];
    $query = mysqli_query($conn, "DELETE FROM jenis_pelanggaran WHERE id_jenis_pelanggaran='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/jenis_pelanggaran/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Jenis Pelanggaran";
    }
} else {
    echo "Id Jenis Pelanggaran Tidak ditemukan";
}

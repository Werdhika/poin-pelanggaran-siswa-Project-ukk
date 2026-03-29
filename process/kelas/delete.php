<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_kelas'])) {
    $id = $_GET['id_kelas'];
    $query = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/kelas/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Kelas";
    }
} else {
    echo "Id Kelas Tidak ditemukan";
}

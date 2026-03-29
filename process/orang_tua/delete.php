<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_ortu_wali'])) {
    $id = $_GET['id_ortu_wali'];
    $query = mysqli_query($conn, "DELETE FROM ortu_wali WHERE id_ortu_wali='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/orang_tua/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Orang Tua";
    }
    } else {
    echo "Id Orang Tua Tidak ditemukan";
}

<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_profil_sekolah'])) {
    $id = $_GET['id_profil_sekolah'];
    $query = mysqli_query($conn, "DELETE FROM profil_sekolah WHERE id_profil_sekolah='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/profil_sekolah/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Profil Sekolah";
    }
} else {
    echo "Id profil sekolah tidak ditemukan";
}

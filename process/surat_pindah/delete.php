<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_surat_pindah'])) {
    $id = $_GET['id_surat_pindah'];
    $query = mysqli_query($conn, "DELETE FROM surat_pindah WHERE id_surat_pindah='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/surat_pindah/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Surat Pindah";
    }
} else {
    echo "Id surat pindah tidak ditemukan";
}

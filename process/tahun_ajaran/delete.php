<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if (isset($_GET['id_tahun_ajaran'])) {
    $id = $_GET['id_tahun_ajaran'];
    $query = mysqli_query($conn, "DELETE FROM tahun_ajaran WHERE id_tahun_ajaran='$id'");

    if ($query) {
        header("location: /poin_pelanggaran_siswa/pages/tahun_ajaran/list.php");
        exit;
    } else {
        echo "Gagal Hapus Data Tahun Ajaran";
    }
} else {
    echo "Id tahun ajaran tidak ditemukan";
}

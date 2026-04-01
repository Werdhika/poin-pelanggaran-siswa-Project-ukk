<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_surat_pindah'];
$sekolah_tujuan = $_POST['sekolah_tujuan'];
$alasan_pindah = $_POST['alasan_pindah'];

$query = mysqli_query($conn, "UPDATE surat_pindah SET
sekolah_tujuan ='$sekolah_tujuan',
alasan_pindah='$alasan_pindah'
WHERE id_surat_pindah='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/surat_pindah/list.php");
} else {
    echo "Gagal memperbarui data Surat Pindah";
}

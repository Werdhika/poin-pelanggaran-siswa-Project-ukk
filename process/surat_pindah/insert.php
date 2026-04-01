<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$sekolah_tujuan = $_POST['sekolah_tujuan'];
$alasan_pindah = $_POST['alasan_pindah'];

$query =  "INSERT INTO surat_pindah (sekolah_tujuan, alasan_pindah)
VALUES ('$sekolah_tujuan', '$alasan_pindah')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/surat_pindah/list.php");
    exit;
} else {
    echo "Gagal Manambahkan Data Surat Pindah" . mysqli_error($conn);
}

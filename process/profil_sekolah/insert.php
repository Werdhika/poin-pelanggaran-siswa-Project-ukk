<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nama_sekolah = $_POST['nama_sekolah'];
$kota = $_POST['kota'];
$alamat_sekolah = $_POST['alamat_sekolah'];

$query =  "INSERT INTO profil_sekolah (nama_sekolah, kota, alamat_sekolah)
VALUES ('$nama_sekolah', '$kota', '$alamat_sekolah')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/profil_sekolah/list.php");
    exit;
} else {
    echo "Gagal Manambahkan Data Profil Sekolah" . mysqli_error($conn);
}

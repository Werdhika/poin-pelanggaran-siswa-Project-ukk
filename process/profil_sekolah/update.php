<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_profil_sekolah'];
$nama_sekolah = $_POST['nama_sekolah'];
$kota = $_POST['kota'];
$alamat_sekolah = $_POST['alamat_sekolah'];

$query = mysqli_query($conn, "UPDATE profil_sekolah SET
nama_sekolah ='$nama_sekolah',
kota='$kota',
alamat_sekolah='$alamat_sekolah'
WHERE id_profil_sekolah='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/profil_sekolah/list.php");
} else {
    echo "Gagal memperbarui data Profil Sekolah";
}

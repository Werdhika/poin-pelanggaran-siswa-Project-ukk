<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$id = $_POST['id_ortu_wali'];
$ayah = $_POST['ayah'];
$ibu = $_POST['ibu'];
$wali = $_POST['wali'];
$no_telp_ayah = $_POST['no_telp_ayah'];
$no_telp_ibu = $_POST['no_telp_ibu'];
$no_telp_wali = $_POST['no_telp_wali'];
$alamat_ayah = $_POST['alamat_ayah'];
$alamat_ibu = $_POST['alamat_ibu'];
$alamat_wali = $_POST['alamat_wali'];

$query = mysqli_query($conn, "UPDATE ortu_wali SET
ayah='$ayah',
ibu='$ibu',
wali='$wali',
no_telp_ayah='$no_telp_ayah',
no_telp_ibu='$no_telp_ibu',
no_telp_wali='$no_telp_wali',
alamat_ayah='$alamat_ayah',
alamat_ibu='$alamat_ibu',
alamat_wali='$alamat_wali'
WHERE id_ortu_wali ='$id'");

if ($query) {
    header("location:/poin_pelanggaran_siswa/pages/orang_tua/list.php");
} else {
    echo "Gagal update data";
}

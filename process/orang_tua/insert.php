<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$ayah = $_POST['ayah'];
$ibu = $_POST['ibu'];
$wali = $_POST['wali'];
$no_telp_ayah = $_POST['no_telp_ayah'];
$no_telp_ibu = $_POST['no_telp_ibu'];
$no_telp_wali = $_POST['no_telp_wali'];
$alamat_ayah = $_POST['alamat_ayah'];
$alamat_ibu = $_POST['alamat_ibu'];
$alamat_wali = $_POST['alamat_wali'];

if (empty($ayah) && empty($ibu) && empty($wali)) {
    echo "<script>
        alert('Minimal isi salah satu data Orang Tua atau Wali');
        history.back();
    </script>";
    exit;
}

$query = "INSERT INTO ortu_wali (ayah, ibu, wali, no_telp_ayah, no_telp_ibu, no_telp_wali, alamat_ayah, alamat_ibu, alamat_wali) 
VALUES ('$ayah', '$ibu', '$wali', '$no_telp_ayah', '$no_telp_ibu', '$no_telp_wali', '$alamat_ayah', '$alamat_ibu', '$alamat_wali')";

$stmt = mysqli_query($conn, $query);

if ($stmt) {
    header("location: /poin_pelanggaran_siswa/pages/orang_tua/list.php");
    exit;
} else {
    echo "Gagal Manambahkan Data" . mysqli_error($conn);
}

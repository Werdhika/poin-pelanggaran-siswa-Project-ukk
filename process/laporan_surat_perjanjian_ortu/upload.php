<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

$nis = $_POST['nis'];
$foto_dokumen = $_FILES["foto_dokumen"]["name"];

$targetDir = ROOTPATH . "/uploads/perjanjian_ortu/";
$fileName = basename($_FILES["foto_dokumen"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

if (!empty($_FILES["foto_dokumen"]["name"])) {
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["foto_dokumen"]["tmp_name"], $targetFilePath)) {
            $query = mysqli_query($conn, "UPDATE perjanjian_orang_tua SET 
                foto_dokumen = '$fileName',
                status = 'Selesai'
                WHERE nis = '$nis'");

            if ($query) {
                header("Location: /poin_pelanggaran_siswa/pages/laporan/perjanjian_ortu/daftar_siswa/list.php");
                exit;
            } else {
                echo "Upload berhasil, tapi gagal update database: " . mysqli_error($conn);
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah.";
        }
    } else {
        echo "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diperbolehkan.";
    }
} else {
    echo "Pilih file untuk diunggah.";
}

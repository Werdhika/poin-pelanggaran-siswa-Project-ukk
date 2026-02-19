<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";
include ROOTPATH . "/includes/header.php";
$result = mysqli_query($conn, "SELECT * FROM siswa");
?>

<h2>Dashboard</h2>

<?php 
include ROOTPATH . "/includes/footer.php";
?>
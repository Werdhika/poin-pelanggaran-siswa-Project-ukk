<?php 

$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$nis = $_POST['id_kelas'];

mysqli_query($conn, "UPDATE siswa SET 
nama_siswa='$nama', id_kelas='$id_kelas' WHERE nis='$nis'
")
?>
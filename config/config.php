<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_poin_pelanggaran_siswa";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection Failed :" . mysqli_connect_error());
}

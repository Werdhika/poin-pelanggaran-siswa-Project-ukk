<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function check_login()
{
    if (
        !isset($_SESSION['user']) ||
        !is_array($_SESSION['user']) ||
        !isset($_SESSION['user']['login']) ||
        $_SESSION['user']['login'] !== true
    ) {
        header("Location: /poin_pelanggaran_siswa/login.php");
        exit;
    }
}
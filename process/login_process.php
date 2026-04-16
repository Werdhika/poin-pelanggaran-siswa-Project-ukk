<?php
session_start();
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /poin_pelanggaran_siswa/login.php");
    exit;
}

$role     = mysqli_real_escape_string($conn, $_POST['role'] ?? '');
$username = mysqli_real_escape_string($conn, trim($_POST['username'] ?? ''));
$password = $_POST['password'] ?? '';

if (empty($role) || empty($username) || empty($password)) {
    $_SESSION['error'] = "Semua field wajib diisi.";

    if ($role === 'siswa') {
        header("Location: /poin_pelanggaran_siswa/login_siswa.php");
    } else {
        header("Location: /poin_pelanggaran_siswa/login.php");
    }
    exit;
}

if ($role === 'guru') {
    $query = "SELECT * FROM guru WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        if (password_verify($password, $data['password'])) {
            session_regenerate_id(true);

            $_SESSION['user'] = [
                'login'     => true,
                'role'      => $data['role'],
                'id'        => $data['kode_guru'],
                'kode_guru' => $data['kode_guru'],
                'nama'      => $data['nama'],
                'username'  => $data['username'],
                'jabatan'   => $data['jabatan'],
                'status'    => $data['status']
            ];

            header("Location: /poin_pelanggaran_siswa/pages/guru/dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Password guru salah.";
            header("Location: /poin_pelanggaran_siswa/login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Username guru tidak ditemukan.";
        header("Location: /poin_pelanggaran_siswa/login.php");
        exit;
    }
} elseif ($role === 'siswa') {
    $query = "SELECT * FROM siswa WHERE nis = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $passwordValid = false;

        if (password_verify($password, $data['password'])) {
            $passwordValid = true;
        } elseif ($password === $data['password'] || md5($password) === $data['password']) {
            $passwordValid = true;
        }

        if ($passwordValid) {
            session_regenerate_id(true);

            $_SESSION['user'] = [
                'login'         => true,
                'role'          => 'siswa',
                'id'            => $data['nis'],
                'nis'           => $data['nis'],
                'nama'          => $data['nama_siswa'],
                'status'        => $data['status'],
                'id_ortu_wali'  => $data['id_ortu_wali'] ?? null
            ];

            header("Location: /poin_pelanggaran_siswa/pages/siswa/dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Password siswa salah.";
            header("Location: /poin_pelanggaran_siswa/login_siswa.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "NIS siswa tidak ditemukan.";
        header("Location: /poin_pelanggaran_siswa/login_siswa.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Role login tidak valid.";
    header("Location: /poin_pelanggaran_siswa/login.php");
    exit;
}

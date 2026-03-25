    <?php
    define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
    include ROOTPATH . "/config/config.php";

    if (isset($_GET['kode_guru'])) {
        $kode_guru = $_GET['kode_guru'];
        $query = mysqli_query($conn, "DELETE FROM guru WHERE kode_guru='$kode_guru'");

        if ($query) {
            header("location: /poin_pelanggaran_siswa/pages/guru/list.php");
            exit;
        } else {
            echo "Gagal Tambah";
        }
    } else {
        echo "Kode Guru Tidak ditemukan";
    }

    <?php
    define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
    include ROOTPATH . "/config/config.php";

    if (isset($_GET['id_program_keahlian'])) {
        $id = $_GET['id_program_keahlian'];
        $query = mysqli_query($conn, "DELETE FROM program_keahlian WHERE id_program_keahlian='$id'");

        if ($query) {
            header("location: /poin_pelanggaran_siswa/pages/program_keahlian/list.php");
            exit;
        } else {
            echo "Gagal Tambah";
        }
    } else {
        echo "Kode Guru Tidak ditemukan";
    }

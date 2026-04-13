<?php

define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

// print_r($_POST);
// exit;

//untuk mengambil data tingkat
$nis = $_POST['nis'];
$data_siswa = mysqli_query($conn, "SELECT 
                                a.nis,
                                b.rombel,
                                c.tingkat,
                                d.program_keahlian
                        FROM siswa a
                        LEFT JOIN kelas b ON a.id_kelas = b.id_kelas
                        LEFT JOIN tingkat c ON b.id_tingkat = c.id_tingkat
                        LEFT JOIN program_keahlian d ON b.id_program_keahlian = d.id_program_keahlian
                        WHERE a.nis = '$nis';
                        ");
$data = mysqli_fetch_assoc($data_siswa);

// validasi for not to duplicated
$resultNis = mysqli_query($conn, "SELECT COUNT(*) as data FROM perjanjian_orang_tua WHERE nis='$nis'");
$count_nis = mysqli_fetch_assoc($resultNis);

if ($count_nis['data'] > 0) {
    echo "<script>window.alert('Maaf, Surat Perjanjian Orang Tua Sudah dibuat')
    window.location='poin_pelanggaran_siswa/pages/laporan/perjanjian_ortu/daftar_siswa/init.php'</script>";
}


if (!empty(@$_POST['ayah'])) {
    //opsi simpan data perjanjian ayah

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $status = 'Masih Proses';
    $nama_ortu = $_POST['ayah'];
    $pekerjaan_ortu = $_POST['pekerjaan_ayah'];
    $alamat_ortu = $_POST['alamat_ayah'];
    $no_telp_ortu = $_POST['no_telp_ayah'];

    // print_r($tanggal);
    // exit;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO perjanjian_orang_tua (nis, tanggal, status, nama_ortu, pekerjaan_ortu, alamat_ortu, no_telp_ortu)
    VALUES ('$nis', '$tanggal', '$status', '$nama_ortu', '$pekerjaan_ortu', '$alamat_ortu', '$no_telp_ortu' )");
}

if (!empty(@$_POST['ibu'])) {
    //opsi simpan data perjanjian ibu

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $status = 'Masih Proses';
    $nama_ortu = $_POST['ibu'];
    $pekerjaan_ortu = $_POST['pekerjaan_ibu'];
    $alamat_ortu = $_POST['alamat_ibu'];
    $no_telp_ortu = $_POST['no_telp_ibu'];

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO perjanjian_orang_tua (nis, tanggal, status, nama_ortu, pekerjaan_ortu, alamat_ortu, no_telp_ortu)
    VALUES ('$nis','$tanggal', '$status', '$nama_ortu', '$pekerjaan_ortu', '$alamat_ortu', '$no_telp_ortu' )");
}


if (!empty(@$_POST['wali'])) {
    //opsi simpan data perjanjian wali

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $status = 'Masih Proses';
    $nama_ortu = $_POST['wali'];
    $pekerjaan_ortu = $_POST['pekerjaan_wali'];
    $alamat_ortu = $_POST['alamat_wali'];
    $no_telp_ortu = $_POST['no_telp_wali'];

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO perjanjian_orang_tua (nis, tanggal, status, nama_ortu, pekerjaan_ortu, alamat_ortu, no_telp_ortu)
    VALUES ('$nis', '$tanggal', '$status', '$nama_ortu', '$pekerjaan_ortu', '$alamat_ortu', '$no_telp_ortu' )");
}

// print_r($query);
// exit;

if ($query) {
    // jika berhasil langsung ke halaman cetak
    header("Location: /poin_pelanggaran_siswa/pages/cetak/surat_perjanjian_ortu.php?nis=$nis");
    exit;
} else {

    echo "Data gagal disimpan";
}

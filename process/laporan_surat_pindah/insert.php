<?php
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');
include ROOTPATH . "/config/config.php";

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
$resultNis = mysqli_query($conn, "SELECT COUNT(*) as data FROM surat_keluar WHERE nis='$nis'");
$count_nis = mysqli_fetch_assoc($resultNis);

if ($count_nis['data'] > 0) {
    echo "<script>window.alert('Maaf, Surat Pindah Sudah dibuat')
    window.location='poin_pelanggaran_siswa/pages/laporan/surat_pindah/list.php'</script>";
}


if (!empty(@$_POST['ayah'])) {
    //opsi simpan data perjanjian ayah

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    // $status = 'Masih Proses';
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    $nama_ortu = $_POST['ayah'];
    $alamat_ortu = $_POST['alamat_ayah'];
    $sekolah_tujuan = $_POST['sekolah_tujuan'];
    $alasan_pindah = $_POST['alasan_pindah'];
    $no_surat = $_POST['no_surat'];

    // print_r($tanggal);
    // exit;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO surat_pindah (nis, tanggal_pembuatan_surat, nama_ortu, alamat_ortu, sekolah_tujuan, alasan_pindah, no_surat)
    VALUES ('$nis', '$tanggal', '$nama_ortu', '$alamat_ortu', '$sekolah_tujuan','$alasan_pindah','$no_surat')");
}

if (!empty(@$_POST['ibu'])) {
    //opsi simpan data perjanjian ayah

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    // $status = 'Masih Proses';
    $nama_ortu = $_POST['ibu'];
    $alamat_ortu = $_POST['alamat_ibu'];
    $sekolah_tujuan = $_POST['sekolah_tujuan'];
    $alasan_pindah = $_POST['alasan_pindah'];
    $no_surat = $_POST['no_surat'];

    // print_r($tanggal);
    // exit;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO surat_pindah (nis, tanggal_pembuatan_surat, nama_ortu, alamat_ortu, sekolah_tujuan, alasan_pindah, no_surat)
    VALUES ('$nis', '$tanggal', '$nama_ortu', '$alamat_ortu', '$sekolah_tujuan','$alasan_pindah','$no_surat')");
}


if (!empty(@$_POST['wali'])) {
    //opsi simpan data perjanjian wali

    //opsi simpan data perjanjian ayah

    //ini field yang saya tidak ketahui di input dari mana
    // $id_pelanggaran_siswa = $_POST['id_pelanggaran_siswa'];
    // $foto_dokumen = $_POST['foto_dokumen'];
    // $tingkat = $data['tingkat'];
    date_default_timezone_set('Asia/Makassar');
    $tanggal = date('Y-m-d h:i:s');
    // $status = 'Masih Proses';
    $nama_ortu = $_POST['wali'];
    $alamat_ortu = $_POST['alamat_wali'];
    $sekolah_tujuan = $_POST['sekolah_tujuan'];
    $alasan_pindah = $_POST['alasan_pindah'];
    $no_surat = $_POST['no_surat'];

    // print_r($tanggal);
    // exit;

    // simpan data surat
    $query = mysqli_query($conn, "INSERT INTO surat_pindah (nis, tanggal_pembuatan_surat, nama_ortu, alamat_ortu, sekolah_tujuan, alasan_pindah, no_surat)
    VALUES ('$nis', '$tanggal', '$nama_ortu', '$alamat_ortu', '$sekolah_tujuan','$alasan_pindah','$no_surat')");
}

// print_r($query);
// exit;

if ($query) {
    // jika berhasil langsung ke halaman cetak
    header("Location: /poin_pelanggaran_siswa/pages/cetak/surat_pindah_sekolah.php?nis=$nis");
    exit;
} else {

    echo "Data gagal disimpan";
}

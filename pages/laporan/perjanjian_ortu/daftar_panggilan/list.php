<?php
// Menentukan lokasi root folder proyek di server
define('ROOTPATH', $_SERVER['DOCUMENT_ROOT'] . '/poin_pelanggaran_siswa');

// Menghubungkan ke file konfigurasi (koneksi database)
include ROOTPATH . "/config/config.php";

// Menyertakan tampilan header (bagian atas halaman)
include ROOTPATH . "/includes/header.php";

// jika ada(isset) tombol ditekan dengan method GET berisi value cari maka jalankan perintah dalam if
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];

    // Menggunakan subquery untuk mengambil satu tanggal yang paling terakhir jika ada data tanggal yang lebih dari satu (karena penggunaan GROUP BY nis), kita bisa menggunakan fungsi agregasi SQL yaitu MAX(). Mengganti kolom tanggal menjadi MAX(tanggal) as tanggal. Fungsi ini akan memeriksa seluruh data tanggal dari setiap nis yang sama, dan mengembalikan satu tanggal dengan nilai paling besar (yang berarti tanggal yang paling terakhir atau terbaru) sambil mencari hasil inputan user dicocokkan dengan nama siswa atau nis.
    $result = mysqli_query($conn, "SELECT ps.id_pelanggaran_siswa, s.nama_siswa, ps.tanggal, jp.jenis, ps.nis FROM pelanggaran_siswa ps JOIN siswa s USING(nis) JOIN jenis_pelanggaran jp USING(id_jenis_pelanggaran) WHERE ps.tanggal = (SELECT MAX(tanggal) FROM pelanggaran_siswa WHERE nis = ps.nis) AND (nama_siswa like '%" . $cari . "%' OR nis like '%" . $cari . "%') ORDER BY ps.tanggal DESC");

    // else akan berjalan atau tampil ketika tombol cari belum ditekan 
} else {
    // Menggunakan subquery untuk mengambil satu tanggal yang paling terakhir jika ada data tanggal yang lebih dari satu (karena penggunaan GROUP BY nis), kita bisa menggunakan fungsi agregasi SQL yaitu MAX(). Mengganti kolom tanggal menjadi MAX(tanggal) as tanggal. Fungsi ini akan memeriksa seluruh data tanggal dari setiap nis yang sama, dan mengembalikan satu tanggal dengan nilai paling besar (yang berarti tanggal yang paling terakhir atau terbaru).
    $result = mysqli_query($conn, "SELECT ps.id_pelanggaran_siswa, s.nama_siswa, ps.tanggal, jp.jenis, ps.nis FROM pelanggaran_siswa ps JOIN siswa s USING(nis) JOIN jenis_pelanggaran jp USING(id_jenis_pelanggaran) WHERE ps.tanggal = (SELECT MAX(tanggal) FROM pelanggaran_siswa WHERE nis = ps.nis) ORDER BY ps.tanggal DESC");
}
?>

<div class="px-6 py-4">

    <!-- ═════════════════════════════════════════════════════════
         TABEL DAFTAR PELANGGARAN PER SISWA
         ═════════════════════════════════════════════════════════ -->
    <div class="mx-auto w-[70%] border border-gray-300 rounded-xl shadow-md bg-white overflow-hidden">
        <div class="px-5 py-3 bg-gray-100 border-b border-gray-300 font-semibold text-gray-600 text-sm uppercase tracking-wide">
            Daftar Pelanggaran Per Siswa
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50">
                        <th colspan="7" class="px-4 py-3 border border-gray-200">
                            <div class="flex items-center justify-between flex-wrap gap-3">
                                <h3 class="text-base font-bold text-gray-800 m-0">
                                    Daftar Pelanggaran Per Siswa
                                </h3>

                                <form action="list_pelanggaran.php" method="get" class="flex items-center gap-2">
                                    <!-- menampilkan data nis dan nama siswa -->
                                    <datalist id="nama_siswa">
                                        <?php
                                        $result_siswa = mysqli_query($conn, "SELECT nama_siswa, nis FROM pelanggaran_siswa JOIN siswa USING(nis) JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) GROUP BY nis");
                                        while ($row_siswa = mysqli_fetch_assoc($result_siswa)) {
                                            echo "<option value='" . $row_siswa['nis'] . "'>";
                                            echo "<option value='" . $row_siswa['nama_siswa'] . "'>";
                                        }
                                        ?>
                                    </datalist>

                                    <input type="text"
                                        value="<?php if (isset($_GET['cari'])) { echo $_GET['cari']; } else { echo ""; } ?>"
                                        name="cari"
                                        placeholder="Masukkan NIS / Nama Siswa"
                                        list="nama_siswa"
                                        class="px-3 py-2 w-52 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                        autocomplete="off">
                                    <input type="submit"
                                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-sm rounded-lg cursor-pointer transition-colors duration-200"
                                        value="Cari">
                                    <a href="list_pelanggaran.php"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-bold text-sm rounded-lg no-underline transition-colors duration-200">
                                        Reset
                                    </a>
                                </form>
                            </div>
                        </th>
                    </tr>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">No</th>
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">Tanggal</th>
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">NIS</th>
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">Nama Siswa</th>
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">Jenis Pelanggaran</th>
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">Point</th>
                        <th class="px-4 py-3 border border-blue-500 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan='7' class='px-4 py-6 text-center text-gray-500 italic'>Data Tidak Ditemukan</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150 even:bg-gray-50/50">
                                <td class="px-4 py-3 border border-gray-200 text-center"><?= $no++ ?></td>
                                <td class="px-4 py-3 border border-gray-200 text-center">
                                    <?php
                                    // ubah format tanggal dari YYYY-MM-DD H:i:s menjadi DD-MM-YYYY H:i:s
                                    $datetime = date("d-m-Y H:i:s", strtotime($row['tanggal']));
                                    // memecah tanggal dan jam
                                    $tanggal = explode(" ", $datetime);
                                    // memecah jam
                                    $jam = $tanggal[1];
                                    // memecah tanggal
                                    $tanggal = explode("-", $tanggal[0]);
                                    // array bulan dalam bahasa indonesia
                                    $bulan = array(
                                        "01" => "Januari",
                                        "02" => "Pebruari",
                                        "03" => "Maret",
                                        "04" => "April",
                                        "05" => "Mei",
                                        "06" => "Juni",
                                        "07" => "Juli",
                                        "08" => "Agustus",
                                        "09" => "September",
                                        "10" => "Oktober",
                                        "11" => "November",
                                        "12" => "Desember"
                                    );
                                    // menggabungkan tanggal dan bulan dalam bahasa indonesia
                                    $tanggal = $tanggal[0] . " " . $bulan[$tanggal[1]] . " " . $tanggal[2];
                                    // tampilkan tanggal yang sudah dimodifikasi menjadi bahasa indonesia agar mudah dibaca
                                    echo $tanggal;
                                    echo "<br>";
                                    echo $jam;
                                    ?>
                                </td>
                                <td class="px-4 py-3 border border-gray-200 text-center font-mono text-xs"><?= htmlspecialchars($row['nis']) ?></td>
                                <td class="px-4 py-3 border border-gray-200 font-medium"><?= htmlspecialchars($row['nama_siswa']) ?></td>
                                <td class="px-4 py-3 border border-gray-200 text-center text-gray-700">
                                    <?php
                                    // 1. Ambil data jenis pelanggaran siswa dari database (gunakan DISTINCT agar jenis yang sama hanya tampil 1x)
                                    $query_pelanggaran = mysqli_query($conn, "SELECT DISTINCT jenis FROM pelanggaran_siswa JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$row[nis]'");

                                    // 2. Siapkan tempat penampungan (array) kosong untuk menyimpan daftar nama pelanggaran
                                    $daftar_pelanggaran = [];

                                    // 3. Ambil data satu per satu dan masukkan ke tempat penampungan
                                    while ($data_pelanggaran = mysqli_fetch_assoc($query_pelanggaran)) {
                                        // htmlspecialchars digunakan untuk keamanan agar teks aman saat ditampilkan
                                        $daftar_pelanggaran[] = htmlspecialchars($data_pelanggaran['jenis']);
                                    }

                                    // 4. Jika daftar pelanggaran ada (tidak kosong), maka tampilkan ke layar
                                    if (!empty($daftar_pelanggaran)) {
                                        // Gabungkan semua pelanggaran dengan koma dan spasi, lalu akhiri dengan tanda titik
                                        echo implode(', ', $daftar_pelanggaran) . '.';
                                    }
                                    ?>
                                </td>
                                <?php
                                // menghitung total poin dari kolom poin menggunakan fungsi SUM() pada mysql
                                $poin_persiswa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(poin) FROM pelanggaran_siswa JOIN siswa USING(nis) JOIN jenis_pelanggaran USING(id_jenis_pelanggaran) WHERE nis = '$row[nis]'"))['SUM(poin)'];
                                ?>
                                <td class="px-4 py-3 border border-gray-200 text-center">
                                    <span class="inline-block px-2.5 py-1 bg-orange-100 text-orange-700 font-bold rounded-full text-xs">
                                        <?= htmlspecialchars($poin_persiswa) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 border border-gray-200 text-center">
                                    <!-- tombol untuk menampilkan detail pelanggaran dengan mengirim nis terpilih melalui method GET -->
                                    <a href="/poin_pelanggaran_siswa/pages/laporan/detail_pelanggaran.php?nis=<?= $row['nis'] ?>"
                                        class="inline-block px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-md no-underline transition-colors duration-200">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php
include ROOTPATH . "/includes/footer.php";
?>

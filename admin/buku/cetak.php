<?php
include "inc/koneksi.php";

// Inisialisasi variabel
$start_date = '';
$end_date = '';
$show_report = false;

// Proses jika formulir disubmit
if (isset($_POST['filter'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $show_report = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Laporan Karya Tulis</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Laporan Data Karya Tulis</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="start_date">Dari Tanggal:</label>
                <input type="date" name="start_date" class="form-control" value="<?php echo htmlspecialchars($start_date); ?>" required>
            </div>
            <div class="form-group">
                <label for="end_date">Sampai Tanggal:</label>
                <input type="date" name="end_date" class="form-control" value="<?php echo htmlspecialchars($end_date); ?>" required>
            </div>
            <button type="submit" name="filter" class="btn btn-primary">Tampilkan Laporan</button>
        </form>

        <?php if ($show_report): ?>
            <h2 class="text-center mt-5"></h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>N0</th>
                        <th>ID</th>
                        <th>Nama Penulis</th>
                        <th>Judul Karya Tulis</th>
                        <th>Program Studi</th>
                        <th>Jenis Karya Tulis</th>
                        <th>Tahun Terbit</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Query untuk mengambil data berdasarkan rentang tanggal input
                $query = "SELECT * FROM tb_buku WHERE tgl BETWEEN '$start_date' AND '$end_date' ORDER BY tgl ASC";
                $sql = $koneksi->query($query);

                // Cek apakah query berhasil
                if ($sql && $sql->num_rows > 0) {
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($data['id_buku']) . "</td>";
                        echo "<td>" . strtoupper(htmlspecialchars($data['penerbit'])) . "</td>";
                        echo "<td>" . strtoupper(htmlspecialchars($data['judul_buku'])) . "</td>";
                        echo "<td>" . htmlspecialchars($data['prodi']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['jenis']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['tahun']) . "</td>";
                        echo "<td>" . date('d-m-Y', strtotime($data['tgl'])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Menampilkan pesan jika query gagal atau tidak ada data
                    echo "<tr><td colspan='9' class='text-center'>Tidak ada data untuk rentang waktu ini</td></tr>";
                }
                ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

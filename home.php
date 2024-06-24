<?php
include "inc/koneksi.php";

// Inisialisasi variabel pencarian
$search = '';
$result_found = false;
$sql = null;

// Ambil nilai halaman dari parameter GET jika ada
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 'home.php';

// Cek apakah form pencarian disubmit
if (isset($_GET["cari"])) {
    $search = $_GET["search"];
    $sql = $koneksi->query("SELECT * FROM tb_buku WHERE judul_buku LIKE '%$search%' OR penerbit LIKE '%$search%'");
    $result_found = true;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ruang Baca FKep Unhas</title>
    <link rel="icon" href="dist/img/baca.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('dist/img/latarku.png') fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="background">
    <div class="container">
        <div class="search-container" id="search-container">
            <div class="search-box">
                <form action="home.php" method="get" id="search-form">
                    <input type="text" name="search" placeholder="Masukkan Keyword Pencarian..." id="search" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" name="cari"><i class="fa fa-search"></i></button>
                    <?php if (isset($_GET['halaman'])): ?>
                    <input type="hidden" name="halaman" value="<?php echo htmlspecialchars($_GET['halaman']); ?>">
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <?php if ($result_found && $sql->num_rows > 0) { ?>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Id Skripsi</th>
                        <th style="width: 40%;">Judul Skripsi</th>
                        <th style="width: 25%;">Penerbit</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['id_buku']; ?></td>
                        <td><?php echo $data['judul_buku']; ?></td>
                        <td><?php echo $data['penerbit']; ?></td>
                        <td>
                            <a href="pdf_viewer.php?kode=<?php echo $data['id_buku']; ?>&halaman=<?php echo urlencode($halaman); ?>" title="Buka PDF" class="btn btn-danger">
                                <i class="fa fa-file"></i> Pdf
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } elseif ($result_found && $sql->num_rows == 0) { ?>
            <div class="alert-info">Data Tidak Ditemukan !</div>
        <?php } ?>
    </div>

    <script src="dist/js/jquery-3.7.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            var table = $('#example1').DataTable({
                paging: true,
                lengthChange: false,
                pageLength: 10,
                searching: false,
                ordering: true,
                info: true,
                autoWidth: false
            });

            <?php if ($result_found) { ?>
            $('#search-container').css('margin-top', '10px');
            <?php } ?>

            // Set focus to search input after results are shown
            $('#search').focus();

            // Move cursor to end of input value
            var input = document.getElementById('search');
            input.setSelectionRange(input.value.length, input.value.length);
        });
    </script>
</body>
<footer class="main-footer">Copyright &copy; <a href="https://www.webmeid.com">webmeid.com</a></strong>
    All rights reserved.
</footer>

</html>

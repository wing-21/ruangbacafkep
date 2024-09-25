<?php
include "inc/koneksi.php";

// Inisialisasi variabel pencarian
$search = '';
$result_found = false;
$sql = null;

// Ambil nilai halaman dari parameter GET jika ada
$current_page = isset($_GET['halaman']) ? $_GET['halaman'] : 'home.php';

// Cek apakah form pencarian disubmit
if (isset($_GET["cari"])) {
    $search = mysqli_real_escape_string($koneksi, $_GET["search"]);
    $sql = $koneksi->query("SELECT * FROM tb_buku WHERE judul_buku LIKE '%$search%' OR penerbit LIKE '%$search%' OR jenis LIKE '%$search%' OR tahun LIKE '%$search%' ORDER BY tahun DESC, id_buku DESC");
    
    if ($sql) {
        $result_found = true;
    } else {
        // Tampilkan pesan kesalahan jika query gagal
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
    }
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

        @media (max-width: 768px) {
            .search-box {
                display: block;
                text-align: center;
                margin-bottom: 15px;
                font-size: 10px;
            }

            .search-box input {
                margin-bottom: 5px;
                font-size: 10px;
            }

            .table-responsive {
                margin-top: 5px;
                font-size: 10px;
                border: none;
            }

            .main-footer {
                font-size: 12px;
            }
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
                        <th style="width: 5%;">NO</th>
                        <th style="width: 25%;">PENULIS</th>
                        <th style="width: 40%;">JUDUL</th>
                        <th style="width: 10%;">JENIS</th>
                        <th style="width: 10%;">TAHUN</th>
                        <th style="width: 10%;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo strtoupper(htmlspecialchars($data['penerbit'])); ?></td>
                        <td><?php echo strtoupper(htmlspecialchars($data['judul_buku'])); ?></td>
                        <td><?php echo htmlspecialchars($data['jenis']); ?></td>
                        <td><?php echo htmlspecialchars($data['tahun']); ?></td>
                        <td>
                            <a href="pdf_viewer.php?kode=<?php echo $data['id_buku']; ?>&halaman=<?php echo urlencode($current_page); ?>&search=<?php echo urlencode($search); ?>" title="Buka PDF" class="btn btn-danger">
                                <i class="fa fa-file"></i> PDF
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } elseif ($result_found && $sql->num_rows == 0) { ?>
            <div class="alert alert-info">Data Tidak Ditemukan!</div>
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

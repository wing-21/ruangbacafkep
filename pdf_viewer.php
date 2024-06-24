<?php
include "inc/koneksi.php";

if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql_cek = "SELECT * FROM tb_buku WHERE id_buku='$kode'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek);

    // Jika data buku ditemukan
    if ($data_cek) {
        $file_buku = 'pdf/' . $data_cek['file_buku'];

        // Periksa apakah file PDF ada
        if (file_exists($file_buku)) {
            // Menyematkan PDF ke dalam halaman web menggunakan <iframe> dengan toolbar disembunyikan
                echo '<html>
                    <head><title> Ruang Baca FKep Unhas</title>
                    <link rel="icon" href="dist/img/baca.png">
                    <style>
                        body { margin: 0; height: 100vh; overflow: hidden; }
                        .pdf-container { position: relative; width: 100%; height: 100vh; }
                        .pdf-iframe { width: 100%; height: 100%; border: none; }
                    </style>
                    <script>
                        document.addEventListener("contextmenu", function(e){
                            e.preventDefault();
                        }, false);
                    </script>
                    </head>
                    <body>
                    <div class="pdf-container">
                        <iframe class="pdf-iframe" src="'.$file_buku.'#toolbar=0"></iframe>
                    </div>
                    </body></html>';
            exit;
        } else {
            // Jika file tidak ditemukan, arahkan kembali ke halaman sebelumnya
            if (isset($_GET['halaman'])) {
                header('Location: ' . $_GET['halaman']);
                exit();
            } else {
                header('Location: home.php');
                exit();
            }
        }
    } else {
        // Jika data buku tidak ditemukan, arahkan kembali ke halaman sebelumnya
        if (isset($_GET['halaman'])) {
            header('Location: ' . $_GET['halaman']);
            exit();
        } else {
            header('Location: home.php');
            exit();
        }
    }
} else {
    // Jika tidak ada parameter kode, arahkan ke halaman default
    header('Location: home.php');
    exit();
}
?>

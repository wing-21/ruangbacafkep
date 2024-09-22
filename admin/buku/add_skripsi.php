<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Mulai sesi hanya jika belum ada sesi yang aktif
}

$tanggal = date("Y-m-d");
// kode

$carikode = mysqli_query($koneksi,"SELECT id_buku FROM tb_buku order by id_buku desc");
$datakode = mysqli_fetch_array($carikode);
$kode = $datakode['id_buku'];
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "B"."00".$tambah;
} else if (strlen($tambah) == 2) {
    $format = "B"."0".$tambah;
} else if (strlen($tambah) == 3) {
    $format = "B".$tambah;
}
?>

<section class="content-header">
    <h1>
        Masukkan Data Karya Tulis
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $format; ?>" readonly/>
                        </div>

                        <div class="form-group">
                            <label>Judul Karya Tulis</label>
                            <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Judul Buku" style="text-transform: uppercase;">
                        </div>

                        <div class="form-group">
                            <label>Nama Penulis</label>
                            <input type="text" name="penerbit" id="penerbiit" class="form-control" placeholder="Penerbit" style="text-transform: uppercase;">
                        </div>

                        <div class="form-group">
                            <label>Program Studi</label>
                            <select name="prodi" id="prodi" class="form-control">
                                <option value="">--- Pilih Program Studi ---</option>
                                <option value="D3 Keperawatan">D3 Keperawatan</option>
                                <option value="S1 Keperawatan">S1 Keperawatan</option>
                                <option value="S1 Fisioterapi">S1 Fisioterapi</option>
                                <option value="Profesi Ners">Profesi Ners</option>
                                <option value="Profesi Fisioterapi">Profesi Fisioterapi</option>
                                <option value="Spesialis KMB">Spesialis KMB</option>
                                <option value="S2 Keperawatan">S2 Keperawatan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jenis Karya Tulis</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="">--- Pilih Jenis Karya Tulis ---</option>
                                <option value="kti">Karya Tulis Ilmiah</option>
                                <option value="skripsi">Skripsi</option>
                                <option value="kia">Karya Ilmiah Akhir</option>
                                <option value="tesis">Tesis</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Tahun">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Upload Karya Tulis</label>
                            <input type="file" name="file_buku" id="file_buku">
                            <p class="help-block">
                                <font color="red">Format file .Pdf</font>
                            </p>
                        </div>

                    </div>

                    <div class="box-footer">
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                        <a href="?page=koleksi_buku" class="btn btn-warning">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
$sumber = @$_FILES['file_buku']['tmp_name'];
$target = 'pdf/';
$nama_file = @$_FILES['file_buku']['name'];
$pindah = move_uploaded_file($sumber, $target.$nama_file);

if (isset($_POST['Simpan'])) {
    if (!isset($_SESSION['data_saved'])) { // Cek apakah data sudah disimpan
        if (!empty($sumber)) {
            $sql_simpan = "INSERT INTO tb_buku (id_buku,judul_buku,penerbit,prodi,jenis,tahun,tgl,file_buku) VALUES (
                '".$_POST['id_buku']."',
                '".$_POST['judul_buku']."',
                '".$_POST['penerbit']."',
                '".$_POST['prodi']."',
                '".$_POST['jenis']."',
                '".$_POST['tahun']."',
                '".$tanggal."',
                '".$nama_file."')";
            $query_simpan = mysqli_query($koneksi, $sql_simpan);
            mysqli_close($koneksi);

            if ($query_simpan) {
                $_SESSION['data_saved'] = true; // Tandai bahwa data telah disimpan
                echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'page.php?page=koleksi_buku';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'page.php?page=add_skripsi';
                    }
                })</script>";
            }
        } else {
            echo "<script>
            Swal.fire({title: 'Gagal, File Buku Kosong',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'page.php?page=add_skripsi';
					
                }
            })</script>";
        }
    } else {
        echo "<script>
        Swal.fire({title: 'Data Sudah Disimpan',text: '',icon: 'info',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'page.php?page=koleksi_buku';
            }
        })</script>";
    }
}
?>

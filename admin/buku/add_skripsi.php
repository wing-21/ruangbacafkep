<?php
$tanggal = date("Y-m-d");
//kode
  
$carikode = mysqli_query($koneksi,"SELECT id_buku FROM tb_buku order by id_buku desc");
$datakode = mysqli_fetch_array($carikode);
$kode = $datakode['id_buku'];
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1){
$format = "B"."00".$tambah;
 	}else if (strlen($tambah) == 2){
 	$format = "B"."0".$tambah;
}else if (strlen($tambah) == 3){
    $format = "B".$tambah;
}


?>

<section class="content-header">
	<h1>
		Master Data
		<small>Data Skripsi</small>
	</h1>
	<ol class="breadcrumb">
		<li>
			<a href="page.php">
				<i class="fa fa-home"></i>
				<b>Ruang Baca FKep Unhas</b>
			</a>
		</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Skripsi</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove">
							<i class="fa fa-remove"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form action="" method="post" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label>ID Skripsi</label>
							<input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $format; ?>"
							 readonly/>
						</div>

						<div class="form-group">
							<label>Judul Skripsi</label>
							<input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Judul Buku">
						</div>

						<div class="form-group">
							<label>Nama Mahasiswa</label>
							<input type="text" name="penerbit" id="penerbiit" class="form-control" placeholder="Penerbit">
						</div>

						<div class="form-group">
							<label for="exampleInputFile">Upload Skripsi</label>
							<input type="file" name="file_buku" id="file_buku">
							<p class="help-block">
								<font color="red">Format file .Pdf"</p>
						</div>

					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
						<a href="?page=MyApp/data_buku" class="btn btn-warning">Batal</a>
					</div>
				</form>
			</div>
			<!-- /.box -->
</section>

<?php
	$sumber = @$_FILES['file_buku']['tmp_name'];
	$target = 'pdf/';
	$nama_file = @$_FILES['file_buku']['name'];
	$pindah = move_uploaded_file($sumber, $target.$nama_file);

    if (isset ($_POST['Simpan'])){
		
		if(!empty($sumber)){
        $sql_simpan = "INSERT INTO tb_buku (id_buku,judul_buku,penerbit,tgl,file_buku) VALUES (
           '".$_POST['id_buku']."',
          '".$_POST['judul_buku']."',
		  '".$_POST['penerbit']."',
		  '".$tanggal."',
          '".$nama_file."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan){

      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'page.php?page=MyApp/data_buku';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {
          if (result.value) {
              window.location = 'page.php?page=MyApp/add_skripsi';
          }
	  })</script>";
		}
		}elseif(empty($sumber)){
		echo "<script>
		Swal.fire({title: 'Gagal, File Buku Kosong',text: '',icon: 'error',confirmButtonText: 'OK'
		}).then((result) => {
			if (result.value) {
				window.location = 'page.php?page=MyApp/add_skripsi';
			}
		})</script>";}}


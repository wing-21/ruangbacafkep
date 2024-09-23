<section class="content-header">
	<h1>
		Data Karya Tulis
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="?page=MyApp/add_buku" title="Tambah Data" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
			<a href="?page=MyApp/cetak" class="btn btn-success">
				<i class="glyphicon glyphicon-print"></i> Cetak Data
			</a>
	
		</div>
		
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NO</th>
							<th>ID</th>
							<th>NAMA PENULIS</th>
							<th>JUDUL KARYA TULIS</th>
							<th>PROGRAM STUDI</th>
							<th>JENIS</th>
							<th>KATA KUNCI</th>
							<th>TAHUN TERBIT</th>
							<th>TGL UPLOAD</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>

						<?php
                  $no = 1;
                  $sql = $koneksi->query("SELECT * FROM tb_buku 
    ORDER BY LEFT(id_buku, 1) ASC, CAST(SUBSTRING(id_buku, 2) AS UNSIGNED) DESC");

                  while ($data= $sql->fetch_assoc()) {
                ?>

						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['id_buku']; ?>
							</td>
							<td>
								<?php echo strtoupper($data['penerbit']); ?>
							</td>
							<td>
								<?php echo strtoupper($data['judul_buku']); ?>
							</td>
							<td>
								<?php echo $data['prodi']; ?>
							</td>
							<td>
								<?php echo $data['jenis']; ?>
							</td>
							<td>
								<?php echo $data['kata_kunci']; ?>
							</td>
							<td>
								<?php echo $data['tahun']; ?>
							</td>
							<td>
							<?php $date = new DateTime($data['tgl']);
								echo $date->format('d-m-Y'); // Mengubah format menjadi dd-mm-yyyy
							?>

							</td>

							<td>
								<a href="?page=reading&kode=<?php echo $data['id_buku']; ?>" title="File PDF"
								 class="btn btn-primary">
									<i class="fa fa-book"></i>
								</a>

								<a href="?page=MyApp/edit_buku&kode=<?php echo $data['id_buku']; ?>" title="Ubah"
								 class="btn btn-success">
									<i class="glyphicon glyphicon-edit"></i>
								</a>
								<a href="?page=MyApp/del_buku&kode=<?php echo $data['id_buku']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger">
									<i class="glyphicon glyphicon-trash"></i>
							</td>
						</tr>
						<?php
                  }
                ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</section>

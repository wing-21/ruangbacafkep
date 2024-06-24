<section class="content-header">
	<h1>
		Koleksi Skripsi
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
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="?page=MyApp/add_skripsi" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data
			</a>

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
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Skripsi</th>
							<th>Judul Skripsi</th>
							<th>Nama Mahasiswa</th>
							<th>Read</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$sql = $koneksi->query("SELECT * FROM tb_buku ORDER BY id_buku DESC LIMIT 5");
							while ($data = $sql->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['id_buku']; ?></td>
							<td><?php echo $data['judul_buku']; ?></td>
							<td><?php echo $data['penerbit']; ?></td>
							<td>
								<a href="?page=reading&kode=<?php echo $data['id_buku']; ?>" title="File PDF" class="btn btn-danger">
									<i class="fa fa-file"></i> Pdf
								</a>
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

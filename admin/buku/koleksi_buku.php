<section class="content-header">
	<h1>
		Karya Tulis Terbaru
	</h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<a href="?page=add_skripsi" class="btn btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Tambah Data
			</a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NO</th>
							<th>PENULIS</th>
							<th>JUDUL</th>
							<th>PROGRAM STUDI</th>
							<th>JENIS</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$sql = $koneksi->query("SELECT * FROM tb_buku ORDER BY LEFT(id_buku, 1) ASC, CAST(SUBSTRING(id_buku, 2) AS UNSIGNED) DESC LIMIT 5");
							while ($data = $sql->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo strtoupper($data['penerbit']); ?></td>
							<td><?php echo strtoupper($data['judul_buku']); ?></td>
							<td><?php echo $data['prodi']; ?></td>
							<td><?php echo $data['jenis']; ?></td>
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

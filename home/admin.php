<?php
	$sql = $koneksi->query("SELECT count(id_buku) as buku from tb_buku");
	while ($data= $sql->fetch_assoc()) {
	
		$buku=$data['buku'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_anggota) as agt from tb_anggota");
	while ($data= $sql->fetch_assoc()) {
	
		$agt=$data['agt'];
	}
?>


<?php
	$sql = $koneksi->query("SELECT count(id_anggota) as mhs from tb_anggota where jenis_anggota='Mahasiswa'");
	while ($data= $sql->fetch_assoc()) {
	
		$mhs=$data['mhs'];
	}
?>



<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Administrator</small>
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-primary">
				<div class="inner">
					<h2>
						<b>
							<?= $buku; ?>
						</b>
					</h2>

					<p>Skripsi</p>
				</div>
				<div class="icon">
					<i class="ion-ios-book"></i>
				</div>
				<a href="?page=MyApp/data_buku" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h2>
						<b>
							<?= $agt; ?>
						</b>
					</h2>

					<p>Anggota</p>
				</div>
				<div class="icon">
					<i class="ion-person-stalker"></i>
				</div>
				<a href="?page=MyApp/data_agt" class="small-box-footer">More info
					<i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>

		<!--  -->

		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h2>
						<b>
							<?= $mhs; ?>
						</b>
					</h2>

					<p>Mahasiswa</p>
				</div>
				<div class="icon">
					<i class="ion ion-university"></i>
				</div>
				<a href="#" class="small-box-footer">Info

				</a>
			</div>
		</div>


		

		
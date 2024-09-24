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

<?php
// Query untuk mendapatkan jumlah karya tulis per tahun
$sql = "SELECT tahun, COUNT(*) as jumlah FROM tb_buku GROUP BY tahun ORDER BY tahun ASC";
$result = $koneksi->query($sql);

$years = [];
$counts = [];

while ($data = $result->fetch_assoc()) {
    $years[] = $data['tahun'];
    $counts[] = $data['jumlah'];
}

$years_json = json_encode($years);
$counts_json = json_encode($counts);
?>

<?php
// Query untuk mendapatkan jumlah karya tulis per jenis
$sql = "SELECT jenis, COUNT(*) as jumlah FROM tb_buku GROUP BY jenis ORDER BY jenis ASC";
$result = $koneksi->query($sql);

$jenis_karya = [];
$jumlah_jenis = [];

while ($data = $result->fetch_assoc()) {
    $jenis_karya[] = $data['jenis'];
    $jumlah_jenis[] = $data['jumlah'];
}

$jenis_karya_json = json_encode($jenis_karya);
$jumlah_jenis_json = json_encode($jumlah_jenis);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
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
                    <h2><b><?= $buku; ?></b></h2>
                    <p>Judul</p>
                </div>
                <div class="icon">
                    <i class="ion-ios-book"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h2><b><?= $agt; ?></b></h2>
                    <p>Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h2><b><?= $mhs; ?></b></h2>
                    <p>Admin</p>
                </div>
                <div class="icon">
                    <i class="ion ion-university"></i>
                </div>
                <a href="#" class="small-box-footer">More Info</a>
            </div>
        </div>
    </div>

    <!-- Grafik Karya Tulis -->
    <div class="row">
        <!-- Grafik Tahun Terbit Karya Tulis -->
        <div class="col-lg-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Jumlah Judul per Tahun</h3>
                </div>
                <div class="box-body">
                    <canvas id="chartTahunTerbit" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Grafik Jenis Karya Tulis -->
        <div class="col-lg-6 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Jumlah Judul Berdasarkan Jenis</h3>
                </div>
                <div class="box-body">
                    <canvas id="chartJenisKarya" style="height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	// Data dari PHP (tahun dan jumlah karya tulis)
	var years = <?php echo $years_json; ?>;
	var counts = <?php echo $counts_json; ?>;

	// Membuat grafik dengan Chart.js
	var ctx = document.getElementById('chartTahunTerbit').getContext('2d');
	var chartTahunTerbit = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: years,
			datasets: [{
				label: 'Jumlah Judul',
				data: counts,
				backgroundColor: 'rgba(54, 162, 235, 0.6)',
				borderColor: 'rgba(54, 162, 235, 1)',
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			},
			responsive: true,
			maintainAspectRatio: false
		}
	});

	// Data dari PHP (jenis dan jumlah karya tulis)
	var jenis_karya = <?php echo $jenis_karya_json; ?>;
	var jumlah_jenis = <?php echo $jumlah_jenis_json; ?>;

	// Membuat grafik dengan Chart.js
	var ctxJenis = document.getElementById('chartJenisKarya').getContext('2d');
	var chartJenisKarya = new Chart(ctxJenis, {
		type: 'pie',
		data: {
			labels: jenis_karya,
			datasets: [{
				label: 'Jumlah Karya Tulis',
				data: jumlah_jenis,
				backgroundColor: [
					'rgba(255, 99, 132, 0.6)',
					'rgba(54, 162, 235, 0.6)',
					'rgba(255, 206, 86, 0.6)',
					'rgba(75, 192, 192, 0.6)',
					'rgba(153, 102, 255, 0.6)',
					'rgba(255, 159, 64, 0.6)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					position: 'top'
				}
			}
		}
	});
</script>

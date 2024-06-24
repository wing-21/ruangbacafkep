<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_buku WHERE id_buku='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);

    }
?>

<section class="content-header">
	<h1>
		Koleksi Skripsi
	</h1>
	<ol class="breadcrumb">
		
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">
						
						<?php echo $data_cek['judul_buku'];?>
					</h3>
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

				<div class="box-body">

					<object type="application/pdf" data="pdf/<?php echo $data_cek['file_buku'];?>#toolbar=0&navpanes=0&scrollbar=0"
					width="100%" height="500px">
					</object>

				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<b>Ruang Baca FKep Unhas</b>
				</div>
			</div>
			<!-- /.box -->
</section>
<?php 
include_once '../templates/header.php';
if($u['kode'] <> 'Office'){
	exit;
}
?>
<!--  DATA LAPORAN --------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-4">Laporan</h1>
		<div class="row">
			<div class="col-12 col-lg-8">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Stok Masuk - Pembelian</h5>
					</div>
					<div class="card-body">
						<div class="row d-flex justify-content-between">
							<form action="" method="get">
								<div class="row">
									<div class="col-6">
										<label class="form-label">Tgl Awal</label>
										<input type="text" name="masukTglAwal" id="masukTglAwal" class="form-control" autocomplete="off" value="<?= (isset($_GET['masukTglAwal']) ? $_GET['masukTglAwal'] : '') ?>">
									</div>
									<div class="col-6">
										<label class="form-label">Tgl Ahir</label>
										<div class="input-group">
											<input type="text" name="masukTglAhir" id="masukTglAhir" class="form-control" autocomplete="off" value="<?= (isset($_GET['masukTglAhir']) ? $_GET['masukTglAhir'] : '') ?>" onchange="this.form.submit()">
											<a href="../report/lap_masuk.php?tglawl=<?= $_GET['masukTglAwal'] ?>&tglahr=<?= $_GET['masukTglAhir'] ?>" target="_blank" class="btn btn-primary"><span data-feather="printer"></span></a>
											<!-- <a class="btn btn-primary"><span data-feather="download"></span></a> -->
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Stok Terpakai</h5>
					</div>
					<div class="card-body">
						<div class="row d-flex">
							<form action="" method="get">
								<div class="row">
									<div class="col">
										<label class="form-label">Tanggal</label>
										<div class="input-group">
											<input type="text" name="tglTerpakai" id="tglTerpakai" class="form-control" autocomplete="off" value="<?= (isset($_GET['tglTerpakai']) ? $_GET['tglTerpakai'] : '') ?>" onchange="this.form.submit()">
											<a href="../report/lap_pakai.php?tgl=<?= $_GET['tglTerpakai'] ?>" target="_blank" class="btn btn-primary"><span data-feather="printer"></span></a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12 col-lg-8">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Stok Keluar - Pengiriman</h5>
					</div>
					<div class="card-body">
						<div class="row d-flex">
							<form action="" method="get">
								<div class="row">
									<div class="col-6">
										<label class="form-label">Tgl Awal</label>
										<input type="text" name="keluarTglAwal" id="keluarTglAwal" class="form-control" autocomplete="off" value="<?= (isset($_GET['keluarTglAwal']) ? $_GET['keluarTglAwal'] : '') ?>">
									</div>
									<div class="col-6">
										<label class="form-label">Tgl Ahir</label>
										<div class="input-group">
											<input type="text" name="keluarTglAhir" id="keluarTglAhir" class="form-control" autocomplete="off" value="<?= (isset($_GET['keluarTglAhir']) ? $_GET['keluarTglAhir'] : '') ?>" onchange="this.form.submit()">
											<a href="../report/lap_kirim.php?tglawl=<?= $_GET['keluarTglAwal'] ?>&tglahr=<?= $_GET['keluarTglAhir'] ?>" target="_blank" class="btn btn-primary"><span data-feather="printer"></span></a>
											<!-- <a class="btn btn-primary"><span data-feather="download"></span></a> -->
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Stok Terbuang</h5>
					</div>
					<div class="card-body">
						<div class="row d-flex">
							<form action="" method="get">
								<div class="row">
									<div class="col">
										<label class="form-label">Tanggal</label>
										<div class="input-group">
											<input type="text" name="tglTerbuang" id="tglTerbuang" class="form-control" autocomplete="off" value="<?= (isset($_GET['tglTerbuang']) ? $_GET['tglTerbuang'] : '') ?>" onchange="this.form.submit()">
											<a href="../report/lap_buang.php?tgl=<?= $_GET['tglTerbuang'] ?>" target="_blank" class="btn btn-primary"><span data-feather="printer"></span></a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../extends/ext-laporan.js"></script>

<?php 
include_once '../templates/footer.php';
?>
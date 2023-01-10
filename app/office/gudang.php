<?php 
include_once '../templates/header.php';
if($u['kode'] <> 'Office'){
	exit;
}
?>
<!--  DATA GUDANG --------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-3">
			<h1 class="h3 d-inline align-middle"><strong>Stok</strong> Gudang</h1>
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-3">
				<!-- OVERVIEW DATA MASUK -->
				<div class="card">
					<!-- <div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Index</h5>
					</div> -->
					<div class="card-body">
						<div class="chart chart-sm">
							<canvas id="stokGudang" class="chartjs-render-monitor d-block"></canvas>
						</div>
					</div>
					<hr class="my-0">
					<div class="card-body text-center mt-2">
						<h5><?= date('D, d M Y'); ?></h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-9">	
				<!-- DATABASE STOK GUDANG -->
				<div class="card">
					<div class="card-header d-md-flex justify-content-between">
						<h5 class="card-title">Data Stok Gudang</h5>
						<div class="btn-group">
							<a data-bs-toggle="modal" data-bs-target="#formGudang" class="btn btn-success inputGudang"><span data-feather="plus-circle"></span> Tambah</a>
							<a onclick="if(confirm('Import Semua Data Barang ??')){ location.href='../models/fun-gudang.php?import' }" class="btn btn-success"><span data-feather="download"></span> Import</a>
						</div>
					</div>
					<div class="card-body">
						<!-- FORM filter Pencarian -->
						<form action="" method="post">
							<div class="input-group col-12 col-lg-4 mb-3">
								<span class="input-group-text"><span data-feather="search"></span></span>
								<input type="text" class="form-control" name="cari" id="cari" placeholder="Pencarian" autocomplete="off" onchange>
							</div>
						</form>
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>Kode</th>
								<th>Barang</th>
								<th class="d-none d-md-table-cell">Jenis</th>
								<th>Stok</th>
								<th>Opsi</th>
							</tr>
							<?php 
							if(isset($_POST['cari'])){
								$cari=$_POST['cari'];
								$queryGudang = "SELECT * FROM gudang WHERE barang LIKE '%$cari%' OR jenis LIKE '%$cari%' ORDER BY barang";
							}else{
								$queryGudang = "SELECT gudang.*, jenis.id FROM gudang LEFT JOIN jenis ON gudang.jenis=jenis.jenis ORDER BY jenis.id, gudang.barang";
							}
							$dataGudang = myquery($queryGudang);
							foreach($dataGudang as $g) : 
							?>
							<tr>
								<td class="text-center"><?= $g['kode'] ?></td>
								<td><?= $g['barang'] ?></td>
								<td class="d-none d-md-table-cell"><?= $g['jenis'] ?></td>
								<td class="text-center"><?= $g['stok'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formGudang" class="btn btn-<?= $g['minim']==0 ? 'success' : 'warning' ?> btn-sm editGudang" data-id="<?= $g['kode'] ?>"><span data-feather="edit"></span></a>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>

<!-- Modal Input Data Gudang -->
<div class="modal fade" id="formGudang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formGudangLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formGudangLabel">Input Data <b>Gudang</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputGudangKode">Kode Barang</label>
						<select type="text" class="form-select" name="inputGudangKode" id="inputGudangKode">
						</select>
						<input type="text" class="form-control" name="inputKode" id="inputKode" readonly>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangNama">Nama Barang</label>
							<input type="text" class="form-control" name="inputGudangNama" id="inputGudangNama" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangJenis">Jenis</label>
							<input type="text" class="form-control" name="inputGudangJenis" id="inputGudangJenis" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangSatuan">Satuan</label>
							<select type="text" class="form-select" name="inputGudangSatuan" id="inputGudangSatuan">
							</select>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangConv">Qty - Conversi</label>
							<input type="text" class="form-control" name="inputGudangConv" id="inputGudangConv" required>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangStok">Stok</label>
							<input type="text" class="form-control" name="inputGudangStok" id="inputGudangStok" value="0" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangMinim">Stok Minimum</label>
							<input type="text" class="form-control" name="inputGudangMinim" id="inputGudangMinim" required>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangHarga">Harga Beli</label>
							<input type="text" class="form-control" name="inputGudangHarga" id="inputGudangHarga" required>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputGudangJual">Harga Jual</label>
							<input type="text" class="form-control" name="inputGudangJual" id="inputGudangJual" required>
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputGudangSuplier">Supplier</label>
						<select type="text" class="form-select" name="inputGudangSuplier" id="inputGudangSuplier">
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputGudangNote">Catatan</label>
						<input type="text" class="form-control" name="inputGudangNote" id="inputGudangNote">
					</div>
					<br>
					<div class="modal-footer">  
						<button type="submit" class="btn btn-success" name="save">Simpan</button>
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> 

<script src="../../assets/js/jquery.min.js"></script>
<script src="../extends/ext-gudang.js"></script>

<?php 
$gudang = myquery('SELECT DISTINCT jenis, SUM(stok) FROM gudang GROUP BY jenis');
?>

<script>
	// GRAFIK STOK GUDANG
$(document).ready(function(){
	// Pie chart
	new Chart(document.getElementById("stokGudang"), {
		type: "pie",
		data: {
			labels: [
				<?php foreach($gudang as $g) : ?>
				"<?= $g['jenis'] ?>", 
				<?php endforeach; ?>
			],
			datasets: [{
				data: [
					<?php foreach($gudang as $g) : ?>
					<?= $g['SUM(stok)'] ?>, 
					<?php endforeach; ?>
				],
				backgroundColor: [
					window.theme.primary,
					window.theme.warning,
					window.theme.danger,
					"#dee2e6"
				],
				borderColor: "transparent"
			}]
		},
		options: {
			maintainAspectRatio: false,
			legend: {
				display: false
			}
		}
	});
});
// selector satuan barang
$(function() {
	$.ajax({
		url: '../models/fun-satuan.php?getListSatuan',
		method: 'post',
		dataType: 'json',
		success: function(data){
			$.each(data, function(index, item){
				$('#inputGudangSatuan').append('<option>' + item.satuan + '</option>');
			});			
		}
	});
});
</script>

<?php 
include_once '../templates/footer.php';
?>
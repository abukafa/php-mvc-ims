<?php 
require_once '../templates/header.php';
if($u['kode'] == 'Office'){
	exit;
}
?>

<!--  DATA OUTLET --------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-3">
			<h1 class="h3 d-inline align-middle"><strong>Stok</strong> <?= $u['cabang'] ?></h1>
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
							<canvas id="stokOutlet" class="chartjs-render-monitor d-block"></canvas>
						</div>
					</div>
					<hr class="my-0">
					<div class="card-body text-center">
						<h5>Senin, 21 Maret 2022</h5>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-9">	
				<!-- DATABASE STOK OUTLET -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Stok Outlet</h5>
						<div class="btn-group">
							<a data-bs-toggle="modal" data-bs-target="#formDapur" class="btn btn-success inputDapur"><span data-feather="plus-circle"></span> Tambah</a>
							<a onclick="if(confirm('Import Semua Data Barang ??')){ location.href='../models/fun-dapur.php?import' }" class="btn btn-success"><span data-feather="download"></span> Import</a>
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
								<th class="d-none d-md-table-cell">Kode</th>
								<th>Barang</th>
								<th class="d-none d-md-table-cell">Jenis</th>
								<th>Stok</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$outlet = $u['kode'];
							if(isset($_POST['cari'])){
								$cari=$_POST['cari'];
								$queryDapur = "SELECT * FROM dapur WHERE outlet='$outlet' AND barang LIKE '%$cari%' ORDER BY jenis, kode";
							}else{
								$queryDapur = "SELECT dapur.*, jenis.id as idj FROM dapur LEFT JOIN jenis ON dapur.jenis=jenis.jenis WHERE outlet='$outlet' ORDER BY jenis.id, dapur.barang";
							}
							$dataDapur = myquery($queryDapur);
							foreach($dataDapur as $d) : 
							?>
							<tr>
								<td class="d-none d-md-table-cell text-center"><?= $d['kode'] ?></td>
								<td><?= $d['barang'] ?></td>
								<td class="d-none d-md-table-cell"><?= $d['jenis'] ?></td>
								<td class="text-center"><?= $d['stok'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formDapur" class="btn btn-<?= $d['minim']==0 ? 'success' : 'warning' ?> btn-sm editDapur" data-id="<?= $d['id'] ?>"><span data-feather="edit"></span></a>
								</td>
							<?php endforeach; ?>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<!-- Modal Input Data Outlet -->
<div class="modal fade" id="formDapur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formDapurLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formDapurLabel">Input Data <b>Barang Outlet</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputDapurKode">Kode Barang</label>
						<select type="text" class="form-select" name="inputDapurKode" id="inputDapurKode">
						</select>
						<input type="hidden" class="form-control" name="inputId" id="inputId" readonly>
						<input type="hidden" class="form-control" name="inputOutlet" id="inputOutlet" value="<?= $u['kode'] ?>" readonly>
						<input type="hidden" class="form-control" name="inputKode" id="inputKode" readonly>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputDapurNama">Nama Barang</label>
							<input type="text" class="form-control" name="inputDapurNama" id="inputDapurNama" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputDapurJenis">Jenis</label>
							<input type="text" class="form-control" name="inputDapurJenis" id="inputDapurJenis" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputDapurStok">Stok</label>
							<input type="text" class="form-control" name="inputDapurStok" id="inputDapurStok" value="0" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputDapurMinim">Stok Minimum</label>
							<input type="text" class="form-control" name="inputDapurMinim" id="inputDapurMinim" required>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-4">
							<label class="form-label" for="inputSatuan">S. Gudang</label>
							<input type="text" class="form-control" name="inputSatuan" id="inputSatuan" readonly>
						</div>
						<div class="mb-2 col-4">
							<label class="form-label" for="inputDapurConv">Conversi</label>
							<input type="text" class="form-control" name="inputDapurConv" id="inputDapurConv" required>
						</div>
						<div class="mb-2 col-4">
							<label class="form-label" for="inputDapurSatuan">S. Terkecil</label>
							<select type="text" class="form-select" name="inputDapurSatuan" id="inputDapurSatuan">
							</select>
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputDapurHarga">Harga Beli</label>
						<input type="text" class="form-control" name="inputDapurHarga" id="inputDapurHarga" required>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputDapurSuplier">Supplier</label>
						<select type="text" class="form-select" name="inputDapurSuplier" id="inputDapurSuplier">
							<option>PT. JUPRI - Distribution Center</option>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputDapurNote">Catatan</label>
						<input type="text" class="form-control" name="inputDapurNote" id="inputDapurNote">
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

<?php 
$dataOutlet = myquery("SELECT DISTINCT jenis, SUM(stok) FROM dapur WHERE outlet='$outlet' GROUP BY jenis");
?>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		// Pie chart
		new Chart(document.getElementById("stokOutlet"), {
			type: "pie",
			data: {
				labels: [
					<?php foreach($dataOutlet as $do) : ?>
					"<?= $do['jenis'] ?>", 
					<?php endforeach; ?>
				],
				datasets: [{
					data: [
						<?php foreach($dataOutlet as $do) : ?>
						<?= $do['SUM(stok)'] ?>, 
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

	// selector barang
	$(function() {
		$.ajax({
			url: '../models/fun-dapur.php?getListBarang',
			method: 'post',	
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputDapurKode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + '</option>');
				});			
			}
		});
	});
	$(document).ready(function(){
		$("#inputDapurKode").change(function(){
			var kode = $(this).val();
			$.ajax({
				url: '../models/fun-barang.php?getBarang=' + kode,
				type: 'post',
				data: {kode:kode},
				dataType: 'json',
				success:function(response){
					// console.log(response);
					$("#inputKode").val(response[0].kode);
					$("#inputDapurNama").val(response[0].barang);
					$("#inputDapurJenis").val(response[0].jenis);
					$("#inputSatuan").val(response[0].satuan);
					$("#inputDapurSatuan").val('Pcs');
					$("#inputDapurConv").val(response[0].conv);
				}
			});
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
					$('#inputDapurSatuan').append('<option>' + item.satuan + '</option>');
				});			
			}
		});
	});

	// selector supplier
	$(function() {
		$.ajax({
			url: '../models/fun-suplier.php?getListSuplier',
			// method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputDapurSuplier').append('<option>' + item.suplier + '</option>');
				});			
			}
		});
	});

	// FORM Dapur
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputDapur').on('click', function(){
			$('#formDapurLabel').html('Input Data <b>Dapur</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-dapur.php?tambah');
			$('#inputKode').attr('type', 'hidden');
			$('#inputDapurKode').attr('class', 'form-select');
			$('#inputDapurKode').val('');
			$('#inputDapurNama').val('');
			$('#inputDapurJenis').val('');
			$('#inputDapurSatuan').val('');
			$('#inputDapurConv').val('');
			$('#inputDapurStok').val('0');
			$('#inputDapurHarga').val('');
			$('#inputDapurJual').val('');
			$('#inputDapurMinim').val('');
			$('#inputDapurSuplier').val('PT. JUPRI - Distribution Center');
			$('#inputDapurNote').val('-');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editDapur').on('click', function(){
			$('#formDapurLabel').html('Edit Data <b>Dapur</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-dapur.php?ubah');
			const id = $(this).data('id');
			$.ajax({
				url: '../models/fun-dapur.php?getDapurById=' + id,
				dataType: 'json',
				success:function(response){
					// console.log(response);
					$('#inputDapurKode').attr('class', 'form-select d-none');
					$('#inputKode').attr('type', 'text');
					$('#inputKode').val(response[0].kode);
					$('#inputOutlet').val(response[0].outlet);
					$('#inputId').val(response[0].id);
					$('#inputDapurNama').val(response[0].barang);
					$('#inputDapurJenis').val(response[0].jenis);
					$('#inputDapurSatuan').val(response[0].satuan);
					$('#inputDapurConv').val(response[0].conv);
					$('#inputDapurStok').val(response[0].stok);
					$('#inputDapurMinim').val(response[0].minim);
					$('#inputDapurHarga').val(response[0].harga);
					$('#inputDapurJual').val(response[0].jual);
					$('#inputDapurSuplier').val(response[0].suplier);
					$('#inputDapurNote').val(response[0].note);
				}
			});
		});
	});	
</script>

<?php 
require_once '../templates/footer.php'
?>
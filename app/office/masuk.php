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
			<h1 class="h3 d-inline align-middle"><strong>Stok Masuk</strong> Gudang</h1>
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">	
				<!-- DATABASE STOK GUDANG -->
				<div class="card">
					<div class="card-header d-md-flex justify-content-between">
						<h5 class="card-title">
							<?php 
							if(isset($_GET['filter'])){
								$data=$_GET['data'];
								$now=date('Y-m-d');
								if($_GET['filter']=='Tanggal'){
									echo $_GET['data'] .' s.d. '. $now;
								}elseif($_GET['filter']=='Hari'){
									echo 'Tanggal '. $_GET['data'];
								}else{
									echo ucwords($_GET['data']);
								}
							}else{
								echo 'Data Pembelian Barang';
							}
							?>
						</h5>
						<form action="" method="get">
							<div class="input-group">
								<div class="input-group-text p-0">
									<select class="form-select bg-light border-0" name="filter" id="filter" onchange="filterFocus()">
										<option value="">.. Filter ..</option>
										<option>Tanggal</option>
										<option>Hari</option>
										<option>Barang</option>
									</select>
								</div>
          						<input type="text" name="data" id="data" class="form-control" placeholder="Filter Data..">
								<a data-bs-toggle="modal" data-bs-target="#formMasuk" class="btn btn-success inputMasuk"><span data-feather="plus-circle"></span><div class="d-none d-md-inline"> Entri Baru</div></a>
							</div>
						</form>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th class="d-none d-md-table-cell">Tanggal</th>
								<th>Invoice</th>
								<th class="d-none d-md-table-cell">Barang</th>
								<th class="d-none d-md-table-cell">Jenis</th>
								<th class="d-none d-md-table-cell">Qty</th>
								<th>Tagihan</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$queryMasuk = "SELECT * FROM pembelian";
							if(isset($_GET['filter'])){
								if($_GET['filter']=='Tanggal'){
									$queryMasuk .= " WHERE tanggal BETWEEN '$data' AND '$now' ORDER BY tanggal DESC";
								}elseif($_GET['filter']=='Hari'){
									$queryMasuk .= " WHERE tanggal = '$data' ORDER BY tanggal DESC";
								}else{
									$queryMasuk .= " WHERE kode LIKE '%$data%' OR barang LIKE '%$data%' ORDER BY tanggal DESC";
								}
							}else{
							$pagi = pagination(25, $queryMasuk);
							$queryMasuk .= " ORDER BY tanggal DESC limit $pagi[4], $pagi[0]";
							}
							$dataMasuk = myquery($queryMasuk);
							foreach($dataMasuk as $m) : ?>
							<tr>
								<td class="d-none d-md-table-cell text-center"><?= $m['tanggal'] ?></td>
								<td class="text-center"><?= $m['inv'] ?></td>
								<td class="d-none d-md-table-cell"><?= $m['kode'] .' - '. $m['barang'] ?></td>
								<td class="d-none d-md-table-cell"><?= $m['jenis'] ?></td>
								<td class="d-none d-md-table-cell text-center"><?= $m['qty'] . ' ' . $m['satuan'] ?></td>
								<td class="text-end"><?= number_format(($m['jumlah']-$m['bayar']),0,".",",") ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formMasuk" class="btn btn-warning btn-sm editMasuk" data-id="<?= $m['inv'] ?>"><span data-feather="edit"></span></a>
									<!-- <a class="btn btn-success btn-sm"><span data-feather="printer"></span></a> -->
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-masuk.php?hapus=<?= $m['inv'] ?>&kode=<?= $m['kode'] ?>&qty=<?= $m['qty'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Pagination -->
		<?php if(!isset($_GET['filter'])){ ?>
		<ul class="pagination justify-content-center">
			<li class="page-item<?php if($pagi[3]==1){ echo " disabled"; } ?>">
				<a class="page-link" href="?page=<?= $pagi[3] - 1; ?>" aria-label="Previous">
				<span aria-hidden="true">«</span>
				</a>
			</li>
			<li class="page-item">
				<b class="page-link">
				<?= $pagi[3]; ?> : <?= $pagi[2]; ?>
				</b>
			</li>
			<li class="page-item<?php if($pagi[3]==$pagi[2]){ echo " disabled"; } ?>">
				<a class="page-link" href="?page=<?= $pagi[3] + 1; ?>" aria-label="Next">
				<span aria-hidden="true">»</span>
				</a>
			</li>
		</ul>
		<?php } ?>
	</div>
</main>

<!-- Modal Input Data Masuk -->
<div class="modal fade" id="formMasuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formMasukLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formMasukLabel">Input Data <b>Masuk Barang</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<?php
						function createRandomPassword() {
							$chars = "003232303232023232023456789";
							srand((double)microtime()*1000000);
							$i = 0;
							$pass = '' ;
							while ($i <= 7) {
								$num = rand() % 33;
								$tmp = substr($chars, $num, 1);
								$pass = $pass . $tmp;
								$i++;
							}
							return $pass;
						}
						$invo = 'GM-'.createRandomPassword();
					?>
					<div class="mb-2">
						<label class="form-label" for="inputMasukInv">Invoice</label>
						<input type="text" class="form-control" name="inputMasukInv" id="inputMasukInv" value="<?= $invo ?>" readonly>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukTanggal">Tanggal</label>
							<input type="text" class="form-control" name="inputMasukTanggal" id="inputMasukTanggal" autocomplete="off" required>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukTempo">Jatuh Tempo</label>
							<input type="text" class="form-control" name="inputMasukTempo" id="inputMasukTempo" autocomplete="off" required>
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputMasukKode">Kode Barang</label>
						<select type="text" class="form-select" name="inputMasukKode" id="inputMasukKode" required>
						</select>
						<input type="text" class="form-control" name="inputKode" id="inputKode" readonly>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukBarang">Nama Barang</label>
							<input type="text" class="form-control" name="inputMasukBarang" id="inputMasukBarang" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukJenis">Jenis</label>
							<input type="text" class="form-control" name="inputMasukJenis" id="inputMasukJenis" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukHarga">Harga Beli</label>
							<input type="text" class="form-control" name="inputMasukHarga" id="inputMasukHarga">
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukSatuan">Satuan</label>
							<input type="text" class="form-control" name="inputMasukSatuan" id="inputMasukSatuan" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukQty">Qty</label>
							<input type="text" class="form-control" name="inputMasukQty" id="inputMasukQty" required>
							<input type="hidden" class="form-control" name="inputMasukQtyEx" id="inputMasukQtyEx" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukJumlah">Jumlah</label>
							<input type="text" class="form-control" name="inputMasukJumlah" id="inputMasukJumlah" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukBayar">Bayar</label>
							<input type="text" class="form-control" name="inputMasukBayar" id="inputMasukBayar" required>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputMasukSisa">Sisa</label>
							<input type="text" class="form-control" name="inputMasukSisa" id="inputMasukSisa" readonly>
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputMasukSuplier">Supplier</label>
						<select type="text" class="form-select" name="inputMasukSuplier" id="inputMasukSuplier" required>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputMasukNote">Catatan</label>
						<input type="text" class="form-control" name="inputMasukNote" id="inputMasukNote" value="-">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputMasukUser">User</label>
						<input type="text" class="form-control" name="inputMasukUser" id="inputMasukUser" value="<?= $u['nama'] ?>" readonly>
						<!-- user untuk edit -->
						<input type="hidden" class="form-control" name="inputMasukUser2" id="inputMasukUser2" value="<?= $u['nama'] ?>" readonly>
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
<script src="../../assets/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="../extends/masuk.js"></script> -->
<script>
	//   Selektor Tanggal
	function filterFocus(){
		document.getElementById('data').focus();
	}
	$(function() {
		$('#inputMasukTanggal').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});
	$(function() {
		$('#inputMasukTempo').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});

	$('#inputMasukQty').keyup(function(){
		$('#inputMasukJumlah').val($(this).val() * $('#inputMasukHarga').val());
		$('#inputMasukSisa').val($('#inputMasukJumlah').val() - $('#inputMasukBayar').val());
	});

	$('#inputMasukHarga').keyup(function(){
		$('#inputMasukJumlah').val($(this).val() * $('#inputMasukQty').val());
		$('#inputMasukSisa').val($('#inputMasukJumlah').val() - $('#inputMasukBayar').val());
	});

	$('#inputMasukBayar').keyup(function(){
		$('#inputMasukSisa').val($('#inputMasukJumlah').val() - $(this).val());
		$('#inputMasukJumlah').val($('#inputMasukHarga').val() * $('#inputMasukQty').val());
	});

	// selector barang
	$(function() {
		$.ajax({
			url: '../models/fun-gudang.php?getListGudang',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputMasukKode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + ' - ' + item.stok + '</option>');
				});			
			}
		});
	});
	$(document).ready(function(){
		$("#inputMasukKode").change(function(){
			var kode = $(this).val();
			$.ajax({
				url: '../models/fun-gudang.php?getGudang=' + kode,
				type: 'post',
				data: {kode:kode},
				dataType: 'json',
				success:function(response){
					$("#inputMasukKode").val(response[0].kode);
					$("#inputMasukBarang").val(response[0].barang);
					$("#inputMasukJenis").val(response[0].jenis);
					$("#inputMasukHarga").val(response[0].harga);
					$("#inputMasukSatuan").val(response[0].satuan);
					$("#inputMasukSuplier").val(response[0].suplier);
				}
			});
		});
	});

	// selector supplier
	$(function() {
		$.ajax({
			url: '../models/fun-suplier.php?getListSuplier',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputMasukSuplier').append('<option>' + item.suplier + '</option>');
				});			
			}
		});
	});

	// FORM Masuk
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputMasuk').on('click', function(){
			$('#formMasukLabel').html('Input Data <b>Masuk</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-masuk.php?tambah');
			$('#inputMasukInv').val('<?= $invo ?>');
			$('#inputMasukTanggal').val('');
			$('#inputMasukTempo').val('');
			$('#inputMasukKode').attr('class', 'form-select');
			$('#inputMasukKode').val('');
			$('#inputKode').attr('type', 'hidden');
			$('#inputMasukBarang').val('');
			$('#inputMasukJenis').val('');
			$('#inputMasukHarga').val('');
			$('#inputMasukSatuan').val('');
			$('#inputMasukQty').val('');
			$('#inputMasukJumlah').val('');
			$('#inputMasukBayar').val('');
			$('#inputMasukSuplier').val('');
			$('#inputMasukNote').val('-');
			$('#inputMasukUser').val('<?= $u['nama'] ?>');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editMasuk').on('click', function(){
			$('#formMasukLabel').html('Edit Data <b>Masuk</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-masuk.php?ubah');
			const inv = $(this).data('id');
			$.ajax({
				url: '../models/fun-masuk.php?getMasuk=' + inv,
				data: {inv : inv}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					// console.log(data);
					$('#inputMasukInv').val(data[0].inv);
					$('#inputMasukTanggal').val(data[0].tanggal);
					$('#inputMasukTempo').val(data[0].tempo);
					$('#inputMasukKode').attr('class', 'form-select d-none');
					$('#inputKode').attr('type', 'text');
					$('#inputKode').val(data[0].kode);
					$('#inputMasukBarang').val(data[0].barang);
					$('#inputMasukJenis').val(data[0].jenis);
					$('#inputMasukHarga').val(data[0].harga);
					$('#inputMasukSatuan').val(data[0].satuan);
					$('#inputMasukQty').val(data[0].qty);
					$('#inputMasukQtyEx').val(data[0].qty);
					$('#inputMasukJumlah').val(data[0].jumlah);
					$('#inputMasukBayar').val(data[0].bayar);
					$('#inputMasukSisa').val(data[0].jumlah - data[0].bayar);
					$('#inputMasukSuplier').val(data[0].suplier);
					$('#inputMasukNote').val(data[0].note);
					$('#inputMasukUser').val(data[0].user);
				}
			});
		});
	});
</script>

<?php 
include_once '../templates/footer.php';
?>
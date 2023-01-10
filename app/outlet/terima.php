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
			<h1 class="h3 d-inline align-middle"><strong>Stok Masuk</strong> Outlet</h1>
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">	
				<!-- DATABASE STOK Outlet -->
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
								echo $u['cabang'];
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
								<a data-bs-toggle="modal" data-bs-target="#formTerima" class="btn btn-success inputTerima"><span data-feather="plus-circle"></span><div class="d-none d-md-inline"> Entri Baru</div></a>
							</div>
						</form>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th class="d-none d-md-table-cell">No. Ship</th>
								<th class="d-none d-md-table-cell">Invoice</th>
								<th class="d-none d-md-table-cell">Tanggal</th>
								<th>Barang</th>
								<th class="d-none d-md-table-cell">Pkg</th>
								<th>Qty</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$outlet = $u['kode'];
							$queryDapur = "SELECT * FROM penerimaan WHERE outlet='$outlet'";
							if(isset($_GET['filter'])){
								if($_GET['filter']=='Tanggal'){
									$queryDapur .= " AND tanggal BETWEEN '$data' AND '$now' ORDER BY tanggal DESC";
								}elseif($_GET['filter']=='Hari'){
									$queryDapur .= " AND tanggal = '$data' ORDER BY tanggal DESC";
								}else{
									$queryDapur .= " AND kode LIKE '%$data%' OR barang LIKE '%$data%' ORDER BY tanggal DESC";
								}
							}else{
							$pagi = pagination(25, $queryDapur);
							$queryDapur .= " ORDER BY tanggal DESC limit $pagi[4], $pagi[0]";
							}
							$terima = myquery($queryDapur);
							foreach($terima as $t) : 
							$id = str_pad($t['id'], 7, '00', STR_PAD_LEFT);	
							$myQty = $t['terima'] * $t['conv'];
							?>
							<tr>
								<td class="d-none d-md-table-cell text-center"><?= $id ?></td>
								<td class="text-center d-none d-md-table-cell"><?= $t['inv'] ?></td>
								<td class="d-none d-md-table-cell text-center"><?= $t['tanggal'] ?></td>
								<td><?= $t['barang'] ?></td>
								<td class="text-center d-none d-md-table-cell"><?= $t['terima'] .' '. $t['satuan'] ?></td>
								<td class="text-center"><?= $myQty ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formTerima" class="btn btn-warning btn-sm editTerima" data-id="<?= $t['id'] ?>"><span data-feather="edit"></span></a>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-terima.php?hapus=<?= $t['id'] ?>&kode=<?= $t['kode'] ?>&qty=<?= $myQty ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
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
<div class="modal fade" id="formTerima" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formTerimaLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formTerimaLabel">Input Data <b>Masuk Barang</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="terimaTanggal">Tanggal Diterima</label>
						<input type="text" class="form-control" name="terimaTanggal" id="terimaTanggal" autocomplete="off" required>
					</div>
					<div class="mb-2">
						<label class="form-label" for="terimaId">Shipment Number</label>
						<select type="text" class="form-select" name="terimaId" id="terimaId" required>
							<option>.. pilih ..</option>
						</select>
						<input type="text" class="form-control" name="id" id="id" readonly>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaInv">Invoice</label>
							<input type="text" class="form-control" name="terimaInv" id="terimaInv" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaPengirim">Pengirim</label>
							<input type="text" class="form-control" name="terimaPengirim" id="terimaPengirim" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaKode">Kode</label>
							<input type="text" class="form-control" name="terimaKode" id="terimaKode" readonly>
							<select  class="d-none form-select" name="terimaSelect" id="terimaSelect">
								<option>.. pilih ..</option>
							</select>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaNama">Barang</label>
							<input type="text" class="form-control" name="terimaNama" id="terimaNama" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaJenis">Jenis</label>
							<input type="text" class="form-control" name="terimaJenis" id="terimaJenis" readonly>
						</div>
						<div class="mb-2 col-3">
							<label class="form-label" for="terimaQty">Qty</label>
							<input type="text" class="form-control" name="terimaQty" id="terimaQty" readonly>
						</div>
						<div class="mb-2 col-3">
							<label class="form-label" for="terimaSatuan">Satuan</label>
							<input type="text" class="form-control" name="terimaSatuan" id="terimaSatuan" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaHarga">Harga</label>
							<input type="text" class="form-control" name="terimaHarga" id="terimaHarga" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="terimaJumlah">Jumlah</label>
							<input type="text" class="form-control" name="terimaJumlah" id="terimaJumlah" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-4">
							<label class="form-label" for="terimaTerima">Qty Diterima</label>
							<input type="text" class="form-control" name="terimaTerima" id="terimaTerima">
						</div>
						<div class="mb-2 col-4">
							<label class="form-label" for="terimaConv">Konversi</label>
							<input type="text" class="form-control" name="terimaConv" id="terimaConv">
						</div>
						<div class="mb-2 col-4">
							<label class="form-label" for="terimaBanyak">Qty Banyak</label>
							<input type="text" class="form-control" name="terimaBanyak" id="terimaBanyak" readonly>
							<input type="hidden" class="form-control" name="terimaBanyakEx" id="terimaBanyakEx" readonly>
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="terimaSuplier">Supplier</label>
						<select type="text" class="form-select" name="terimaSuplier" id="terimaSuplier">
							<option>.. pilih ..</option>
							<option>PT. JUPRI - Distribution Center</option>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="terimaNote">Catatan</label>
						<input type="text" class="form-control" name="terimaNote" id="terimaNote" value="-">
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

<script>
	//   Selektor Tanggal
	function filterFocus(){
		document.getElementById('data').focus();
	}
	$(function() {
		$('#terimaTanggal').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
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
					$('#terimaSuplier').append('<option>' + item.suplier + '</option>');
				});			
			}
		});
	});

	// selector barang
	$(function() {
		const outlet = <?= $u['kode'] ?>;
		$.ajax({
			url: '../models/fun-dapur.php?getListDapur=' + outlet,
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#terimaSelect').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + '</option>');
				});			
			}
		});
	});
	$(document).ready(function(){
		$("#terimaSelect").change(function(){
			const kode = $(this).val();
			$.ajax({
				url: '../models/fun-dapur.php?getDapur=' + kode,
				type: 'post',
				data: {kode:kode},
				dataType: 'json',
				success:function(response){
					// console.log(response);
					$("#terimaKode").val(response[0].kode);
					$("#terimaNama").val(response[0].barang);
					$("#terimaJenis").val(response[0].jenis);
					$("#terimaSatuan").val(response[0].satuan);
					$("#terimaHarga").val(response[0].harga);
					$("#terimaConv").val(response[0].conv);
					$("#terimaTerima").val('');
					$("#terimaTerima").focus();
				}
			});
		});
	});

	const bl = <?= generate_num() ?>;

	// selector Barang Dapur
	$(function() {
		$.ajax({
			url: '../models/fun-terima.php?getListItem',
			method: 'post',	
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#terimaId').append('<option value="' + item.id + '">' + item.id + ' - ' + item.barang + '</option>');
				});	
				$('#terimaId').append('<option value="'+ bl +'">BL-'+ bl +'</option>');		
			}
		});
	});
	$(document).ready(function(){
		$("#terimaId").change(function(){
			var id = $(this).val();
			if(id == bl){
				$("#terimaInv").val('BL-'+ bl);
				$("#terimaPengirim").val('-');
				$("#terimaSelect").attr('class', 'form-select');
				$("#terimaSelect").focus();
				$("#terimaKode").attr('type', 'hidden');
				$("#terimaKode").val('');
				$("#terimaNama").val('');
				$("#terimaJenis").val('');
				$("#terimaSatuan").val('');
				$("#terimaHarga").val('');
				$("#terimaHarga").removeAttr('readonly');
				$("#terimaJumlah").val('');
				$("#terimaConv").val('');
				$("#terimaQty").val('-');
				$("#terimaTerima").val('');
				$("#terimaNote").val('Pembelanjaan ');
			}else{
				$.ajax({
					url: '../models/fun-terima.php?getItem=' + id,
					type: 'post',
					data: {id:id},
					dataType: 'json',
					success:function(response){
						// console.log(response);
						$("#terimaId").val(response[0].id);
						$("#terimaInv").val(response[0].inv);
						$("#terimaPengirim").val(response[0].pengirim);
						$("#terimaSelect").attr('class', 'form-select d-none');
						$("#terimaKode").attr('type', 'text');
						$("#terimaKode").val(response[0].kode);
						$("#terimaNama").val(response[0].barang);
						$("#terimaJenis").val(response[0].jenis);
						$("#terimaSatuan").val(response[0].satuan);
						$("#terimaHarga").val(response[0].harga);
						$("#terimaHarga").attr('readonly', 'yes');
						$("#terimaJumlah").val(response[0].jumlah);
						$("#terimaConv").val(response[0].conv);
						$("#terimaQty").val(response[0].qty);
						$("#terimaTerima").val('');
						$("#terimaNote").val('-');
						$("#terimaTerima").focus();
					}
				});
			}
		});
	});
	
	$('#terimaHarga').keyup(function(){
		$('#terimaJumlah').val($(this).val() * $('#terimaTerima').val());
	});
	
	$('#terimaConv').keyup(function(){
		$('#terimaBanyak').val($(this).val() * $('#terimaTerima').val());
	});

	$("#terimaTerima").keyup(function(){
		const kode = $("#terimaKode").val();
		const tqty = $("#terimaQty").val();
		const qty = $(this).val();
		const outlet = <?= $u['kode'] ?>;
		$.ajax({
			url: '../models/fun-terima.php?getConv=' + kode + '&outlet=' + outlet,
			type: 'post',
			data: {kode:kode},
			dataType: 'json',
			success:function(response){
				$("#terimaConv").val(response[0].conv);
				$('#terimaBanyak').val(qty * response[0].conv);
				$('#terimaJumlah').val(qty * $('#terimaHarga').val());
			}
		});
		if(qty == tqty){
			$('#terimaTerima').attr('class', 'form-control is-valid');
		}else{
			$('#terimaTerima').attr('class', 'form-control is-invalid');
		}
	});
	
	// FORM Masuk
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputTerima').on('click', function(){
			$('#formTerimaLabel').html('Input Data <b>Masuk</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-terima.php?tambah');
			$('#terimaId').attr('class', 'form-select');
			$('#id').attr('type', 'hidden');
			$('#terimaTanggal').val('');
			$('#terimaInv').val('');
			$('#terimaPengirim').val('');
			$('#terimaKode').val('');
			$('#terimaNama').val('');
			$('#terimaJenis').val('');
			$('#terimaQty').val('');
			$('#terimaSatuan').val('');
			$('#terimaHarga').val('');
			$('#terimaJumlah').val('');
			$('#terimaTerima').val('');
			$('#terimaConv').val('');
			$('#terimaBanyak').val('');
			$('#terimaNote').val('-');
			$('#terimaSuplier').val('PT. JUPRI - Distribution Center');
		});
		
		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editTerima').on('click', function(){
			$('#formTerimaLabel').html('Edit Data <b>Masuk</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-terima.php?ubah');
			const id = $(this).data('id');
			// console.log(id);
			$.ajax({
				url: '../models/fun-terima.php?getTerima=' + id,
				data: {id : id}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					// console.log(data);
					$('#terimaId').attr('class', 'form-select d-none');
					$('#id').attr('type', 'text');
					$('#id').val(data[0].id);
					$('#terimaTanggal').val(data[0].tanggal);
					$('#terimaInv').val(data[0].inv);
					$('#terimaPengirim').val(data[0].pengirim);
					$('#terimaKode').val(data[0].kode);
					$('#terimaNama').val(data[0].barang);
					$('#terimaJenis').val(data[0].jenis);
					$('#terimaQty').val(data[0].qty);
					$('#terimaSatuan').val(data[0].satuan);
					$('#terimaHarga').val(data[0].harga);
					$('#terimaJumlah').val(data[0].jumlah);
					$('#terimaTerima').val(data[0].terima);
					$('#terimaConv').val(data[0].conv);
					$('#terimaBanyak').val(data[0].terima * data[0].conv);
					$('#terimaBanyakEx').val(data[0].terima * data[0].conv);
					$('#terimaNote').val(data[0].note);
					$('#terimaSuplier').val(data[0].suplier);
				}
			});
		});
	});
</script>

<?php 
require_once '../templates/footer.php'
?>
<?php 
include_once '../templates/header.php';
if($u['kode'] <> 'Office'){
	exit;
}
?>
<!--  data pengiriman baru --------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-2">
			<div class="d-flex justify-content-between">
				<h1 class="h3 d-inline align-middle"><strong>Entri</strong> Pengiriman</h1>
				<a href="kirim" class="btn"><span data-feather="arrow-left"></span> Kembali</a>
			</div>	
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">	
				<!-- POS PENGIRIMAN -->
				<div class="card">
					<div class="card-header mb-1">
						<h5 class="card-title">Entri Item</h5>
					</div>
					<div class="card-body">
						<form action="../models/fun-kirim.php?tambah" method="post">
							<div class="row">
								<div class="col-md-3 mb-3">
									<label class="form-label">Invoice</label>
									<input type="text" class="form-control" name="invoice" id="invoice" value="<?= $_GET['inv'] ?>" readonly>
								</div>
								<div class="col-6 col-md-3 mb-3">
									<label class="form-label">Tanggal</label>
									<input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" required>
								</div>
								<div class="col-6 col-md-3 mb-3">
									<label class="form-label">Jatuh Tempo</label>
									<input type="text" class="form-control" name="tempo" id="tempo" autocomplete="off" required>
								</div>
								<div class="col-6 col-md-3 mb-3">
									<label class="form-label">Nama Pengirim</label>
									<input type="text" class="form-control" name="pengirim" id="pengirim" required>
								</div>
								<div class="col-6 col-md-3 mb-3">
									<label class="form-label">Tujuan</label>
									<input type="hidden" class="form-control" name="tujuan" id="tujuan" readonly>
									<select type="text" class="form-select" name="tujuanS" id="tujuanS">
									</select>
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Outlet</label>
									<input type="text" class="form-control" name="outlet" id="outlet" readonly>
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Alamat</label>
									<input type="text" class="form-control" name="alamat" id="alamat" readonly>
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Kode Barang</label>
									<select type="text" class="form-select" name="kode" id="kode" required>
									</select>
								</div>
								<div class="col-6 col-md-3 mb-3">
									<label class="form-label">Nama Barang</label>
									<input type="text" class="form-control" name="barang" id="barang" readonly>
								</div>
								<div class="col-6 col-md-3 mb-3">
									<label class="form-label">Jenis</label>
									<input type="text" class="form-control" name="jenis" id="jenis" readonly>
								</div>
								<div class="col-6 col-md-1 mb-3">
									<label class="form-label">Stok</label>
									<input type="text" class="form-control" name="stok" id="stok" readonly>
								</div>
								<div class="col-6 col-md-2 mb-3">
									<label class="form-label">Satuan</label>
									<input type="text" class="form-control" name="satuan" id="satuan" readonly>
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Ket. Pembayaran</label>
									<select type="text" class="form-select" name="bayar" id="bayar" required>
										<option>Lunas</option>
										<option>Tempo</option>
										<option>Angsuran</option>
									</select>
								</div>
								<div class="col-4 col-md-3 mb-3">
									<label class="form-label">Qty</label>
									<input type="text" class="form-control" name="qty" id="qty" required>
								</div>
								<div class="col-4 col-md-3 mb-3">
									<label class="form-label">Harga</label>
									<input type="text" class="form-control" name="harga" id="harga">
								</div>
								<div class="col-4 col-md-3 mb-3">
									<label class="form-label">Jumlah</label>
									<input type="text" class="form-control" name="jumlah" id="jumlah" readonly>
								</div>
								<div class="col-md-9 mb-3">
									<label class="form-label">Catatan</label>
									<input type="text" class="form-control" name="note" id="note" value="-">
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">User</label>
									<input type="text" class="form-control" name="user" id="user" value="<?= $u['nama'] ?>" readonly>
								</div>
							</div>
							<div class="col-md-3 align-items-center pt-3">
								<input type="submit" class="btn btn-success" value="Simpan" name="save"></button>
								<a href="kirim" type="reset" class="btn btn-secondary">Selesai</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- DATA PENGIRIMAN -->
		<div class="card">
			<div class="card-body mt-3">
				<table class="table table-hover table-sm table-bordered">
					<tr class="table-active text-center">
						<th class="d-none d-md-table-cell">No. Ship</th>
						<th class="d-none d-md-table-cell">Kode</th>
						<th>Barang</th>
						<th class="d-none d-md-table-cell">Jenis</th>
						<th>Qty</th>
						<th class="d-none d-md-table-cell">Harga</th>
						<th>Jumlah</th>
						<th class="d-none d-md-table-cell">Pembayaran</th>
						<th>Opsi</th>
					</tr>
					<?php 
					$inv = $_GET['inv'];
					$queryKirim = "SELECT * FROM pengiriman WHERE inv='$inv'";
					$dataKirim = myquery($queryKirim);
					foreach($dataKirim as $k) : 
					$id = str_pad($k['id'], 7, '00', STR_PAD_LEFT);	
					?>
					<tr>
						<td class="d-none d-md-table-cell text-center"><?= $id ?></td>
						<td class="d-none d-md-table-cell text-center"><?= $k['kode'] ?></td>
						<td class=""><?= $k['barang'] ?></td>
						<td class="d-none d-md-table-cell"><?= $k['jenis'] ?></td>
						<td class="text-center"><?= $k['qty'] . ' ' . $k['satuan'] ?></td>
						<td class="d-none d-md-table-cell text-end"><?= number_format($k['harga'],0,".",",") ?></td>
						<td class="text-end"><?= number_format($k['jumlah'],0,".",",") ?></td>
						<td class="d-none d-md-table-cell text-center"><?= $k['ket'] ?></td>
						<td class="text-center">
							<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-kirim.php?hapus=<?= $k['id'] ?>&kode=<?= $k['kode'] ?>&qty=<?= $k['qty'] ?>&inv=<?= $k['inv'] ?>' }" class="btn btn-sm <?= $k['note']=='DITERIMA' ? 'disabled' : 'btn-danger' ?>"><span data-feather="<?= $k['note']=='DITERIMA' ? 'check' : 'trash-2' ?>"></span></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</main>


<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="../extends/ext-kirim_baru.js"></script> -->

<script>
	// edit invoice
	$(document).ready(function(){
		const inv = $('#invoice').val();
		$.ajax({
			url: '../models/fun-kirim.php?getFromKirim=' + inv,
			method: 'post',
			dataType: 'json',
			success: function(data){
				// console.log(data);
				if ( data == '' ) {
					//   Selektor Tanggal
					$(function() {
						$('#tanggal').datepicker({ 
						autoclose: true,
						todayHighlight: true,
						format : 'yyyy-mm-dd' 
						});
					});
					$(function() {
						$('#tempo').datepicker({ 
						autoclose: true,
						todayHighlight: true,
						format : 'yyyy-mm-dd' 
						});
					});
				} else {
					$('#tanggal').val(data[0].tanggal);
					$('#tanggal').attr('readonly', '');
					$("#tempo").val(data[0].tempo);
					$('#tempo').attr('readonly', '');
					$("#pengirim").val(data[0].pengirim);
					$('#pengirim').attr('readonly', '');
					$("#tujuan").val(data[0].toko);
					$("#tujuan").attr('type', 'text');
					$("#tujuanS").attr('class', 'form-select d-none');
					$("#outlet").val(data[0].nama);
					$("#alamat").val(data[0].alamat);		
					$("#user").val(data[0].user);		
				}
			}
		});
	});
	// selector outlet
	$(function() {
		$.ajax({
			url: '../models/fun-outlet.php?getListOutlet',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#tujuanS').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.outlet + '</option>');
				});			
				$('#tujuanS').append('<option>-</option>');
				$('#tujuanS').val('');
			}
		});
	});
	$(document).ready(function(){
		$("#tujuanS").change(function(){
			var kode = $(this).val();
			if(kode == '-'){
				$("#tujuan").val('-');
				$("#outlet").val('-');
				$("#alamat").val('-');
			}else{
				$.ajax({
					url: '../models/fun-outlet.php?getOutlet=' + kode,
					type: 'post',
					data: {kode:kode},
					dataType: 'json',
					success:function(response){
						// console.log()
						$("#tujuan").val(response[0].kode);
						$("#outlet").val(response[0].outlet);
						$("#alamat").val(response[0].alamat);
					}
				});
			}
		});
	});
	
	// selector barang
	$(function() {
		$.ajax({
			url: '../models/fun-gudang.php?getListGudang',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#kode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + '</option>');
					$('#kode').val('');
				});			
			}
		});
	});

	$(document).ready(function(){
		$("#kode").change(function(){
			var kode = $(this).val();
			$.ajax({
				url: '../models/fun-gudang.php?getGudang=' + kode,
				type: 'post',
				data: {kode:kode},
				dataType: 'json',
				success:function(response){
					$("#barang").val(response[0].barang);
					$("#jenis").val(response[0].jenis);
					$("#stok").val(response[0].stok);
					$("#satuan").val(response[0].satuan);
					$("#harga").val(response[0].jual);
				}
			});
		});
	});

	$('#qty').keyup(function(){
		$('#jumlah').val($(this).val() * $('#harga').val());
	});
	$('#harga').keyup(function(){
		$('#jumlah').val($(this).val() * $('#qty').val());
	});
</script>


<?php 
include_once '../templates/footer.php';
?>
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
			<h1 class="h3 d-inline align-middle"><strong>Stok Keluar</strong> Outlet</h1>
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">	
				<!-- DATABASE STOK OUTLET -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
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
								<a data-bs-toggle="modal" data-bs-target="#formKeluar" class="btn btn-success inputKeluar"><span data-feather="plus-circle"></span><div class="d-none d-md-inline"> Entri Baru</div></a>
							</div>
						</form>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th class="d-none d-md-table-cell">Kode</th>
								<th>Tanggal</th>
								<th class="d-none d-md-table-cell">Keluar</th>
								<th>Ket</th>
								<th class="d-none d-md-table-cell">Barang</th>
								<th>Qty</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$outlet = $u['kode'];
							if(isset($_GET['filter'])){
								if($_GET['filter']=='Tanggal'){
									$queryDapur = "(SELECT * FROM terpakai WHERE outlet='$outlet' AND tanggal BETWEEN '$data' AND '$now') UNION (SELECT * FROM terbuang WHERE outlet='$outlet' AND tanggal BETWEEN '$data' AND '$now')";
								}elseif($_GET['filter']=='Hari'){
									$queryDapur = "(SELECT * FROM terpakai WHERE outlet='$outlet' AND tanggal = '$data') UNION (SELECT * FROM terbuang WHERE outlet='$outlet' AND tanggal = '$data')";
								}else{
									$queryDapur = "(SELECT * FROM terpakai WHERE outlet='$outlet' AND kode LIKE '%$data%' OR barang LIKE '%$data%') UNION (SELECT * FROM terbuang WHERE outlet='$outlet' AND kode LIKE '%$data%' OR barang LIKE '%$data%')";
								}
								$queryDapur .= " ORDER BY jenis, barang";
							}else{
							$queryDapur = "(SELECT * FROM terpakai WHERE outlet='$outlet') UNION (SELECT * FROM terbuang WHERE outlet='$outlet')";
							$pagi = pagination(25, $queryDapur);
							$queryDapur .= " ORDER BY jenis, barang limit $pagi[4], $pagi[0]";
							}
							$keluar = myquery($queryDapur);
							foreach($keluar as $k) : 
								if($k['keluar'] == 'Terpakai'){
									$id = str_pad($k['id'], 7, 'P00000', STR_PAD_LEFT);
								}else{
									$id = str_pad($k['id'], 7, 'B00000', STR_PAD_LEFT);
								}	
							?>
							<tr>
								<td class="text-center d-none d-md-table-cell"><?= $id ?></td>
								<td class="text-center"><?= $k['tanggal'] ?></td>
								<td class="d-none d-md-table-cell"><?= $k['keluar'] ?></td>
								<td><?= $k['ket'] ?></td>
								<td class="d-none d-md-table-cell"><?= $k['barang'] ?></td>
								<td class="text-center"><?= $k['qty'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formKeluar" class="btn btn-warning btn-sm editKeluar" data-id="<?= $k['id'] ?>" data-kel="<?= $k['keluar'] ?>"><span data-feather="edit"></span></a>
									<!-- <a class="btn btn-success btn-sm"><span data-feather="printer"></span></a> -->
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-keluar.php?hapus=<?= $k['id'] ?>&kode=<?= $k['kode'] ?>&qty=<?= $k['qty'] ?>&kel=<?= $k['keluar'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
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

<!-- Modal Input Data Keluar -->
<div class="modal fade" id="formKeluar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formKeluarLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formKeluarLabel">Input Data <b>Keluar Barang</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputKeluarTanggal">Tanggal</label>
						<input type="text" class="form-control" name="inputKeluarTanggal" id="inputKeluarTanggal" autocomplete="off" required>
						<input type="hidden" class="form-control" name="inputKeluarId" id="inputKeluarId">
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputKeluarKeluar">Jenis Pengeluaran</label>
							<select type="text" class="form-select" name="inputKeluarKeluar" id="inputKeluarKeluar" required>
								<option>.. pilih ..</option>
								<option>Terpakai</option>
								<option>Terbuang</option>
							</select>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputKeluarKet">Keterangan</label>
							<select type="text" class="form-select" name="inputKeluarKet" id="inputKeluarKet" required>
								<option>.. pilih ..</option>
							</select>
						</div>
					</div>
					<script>
						var jkl = document.getElementById('inputKeluarKeluar');
						var ket = document.getElementById('inputKeluarKet');
						var items;
						jkl.addEventListener('change', function(){
							if ( jkl.value == 'Terpakai' ){
								items = ['Terpakai', 'Terjual', 'Voucher Tamu', 'Voucher Karyawan', 'Sisa Masak'];
							}else if ( jkl.value == 'Terbuang' ){
								items = ['Reject', 'Beton', 'Hilang', 'Rusak'];
							}else{
								items = [];
							}
							var str = '';
							for (var item of items){
								str += '<option>' + item + '</option>'
							}
							ket.innerHTML = str;
						})
					</script>
					<div class="mb-2">
						<label class="form-label" for="inputKeluarKode">Kode Barang</label>
						<select type="text" class="form-select" name="inputKeluarKode" id="inputKeluarKode" required>
							<option>.. pilih ..</option>
						</select>
						<input type="text" class="form-control" name="inputKode" id="inputKode" readonly>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputKeluarBarang">Barang</label>
							<input type="text" class="form-control" name="inputKeluarBarang" id="inputKeluarBarang" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputKeluarJenis">Jenis</label>
							<input type="text" class="form-control" name="inputKeluarJenis" id="inputKeluarJenis" readonly>
						</div>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputKeluarStok">Stok</label>
							<input type="text" class="form-control" name="inputKeluarStok" id="inputKeluarStok" readonly>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputKeluarQty">Qty</label>
							<input type="text" class="form-control" name="inputKeluarQty" id="inputKeluarQty" required>
							<input type="hidden" class="form-control" name="inputKeluarQtyEx" id="inputKeluarQtyEx">
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputKeluarNote">Catatan</label>
						<input type="text" class="form-control" name="inputKeluarNote" id="inputKeluarNote" value="-">
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
		$('#inputKeluarTanggal').datepicker({ 
		autoclose: true,
		todayHighlight: true,
		format : 'yyyy-mm-dd' 
		});
	});

	// selector barang
	$(function() {
		const outlet = <?= $u['kode'] ?>;
		$.ajax({
			url: '../models/fun-dapur.php?getListDapur=' + outlet,
			method: 'post',	
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputKeluarKode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + '</option>');
				});			
			}
		});
	});
	$(document).ready(function(){
		$("#inputKeluarKode").change(function(){
			const kode = $(this).val();
			$.ajax({
				url: '../models/fun-dapur.php?getDapur=' + kode,
				type: 'post',
				data: {kode:kode},
				dataType: 'json',
				success:function(response){
					// console.log(response);
					$("#inputKode").val(response[0].kode);
					$("#inputKeluarBarang").val(response[0].barang);
					$("#inputKeluarJenis").val(response[0].jenis);
					$("#inputKeluarStok").val(response[0].stok);
				}
			});
		});
	});

	// FORM Keluar
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputKeluar').on('click', function(){
			$('#formKeluarLabel').html('Input Data <b>Keluar</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-keluar.php?tambah');
			$('#inputKeluarTanggal').val('');
			$('#inputKeluarKeluar').val('');
			$('#inputKeluarKet').val('');
			$('#inputKode').attr('type', 'hidden');
			$('#inputKeluarKode').attr('class', 'form-select');
			$('#inputKeluarKode').val('');
			$('#inputKeluarBarang').val('');
			$('#inputKeluarJenis').val('');
			$('#inputKeluarStok').val('');
			$('#inputKeluarQty').val('');
			$('#inputKeluarNote').val('-');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editKeluar').on('click', function(){
			$('#formKeluarLabel').html('Edit Data <b>Keluar</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-keluar.php?ubah');
			const id = $(this).data('id');
			const kel = $(this).data('kel');
			// console.log(kel);
			$.ajax({
				url: '../models/fun-keluar.php?getKeluar=' + id + '&kel=' + kel,
				dataType: 'json',
				success:function(response){
					console.log(response);
					$('#inputKeluarId').val(response[0].id);
					$('#inputKeluarTanggal').val(response[0].tanggal);
					$('#inputKeluarKeluar').val('');
					$('#inputKeluarKet').val('');
					$('#inputKode').attr('type', 'text');
					$('#inputKode').val(response[0].kode);
					$('#inputKeluarKode').attr('class', 'form-select d-none');
					$('#inputKeluarBarang').val(response[0].barang);
					$('#inputKeluarJenis').val(response[0].jenis);
					$('#inputKeluarStok').val('-');
					$('#inputKeluarQty').val(response[0].qty);
					$('#inputKeluarQtyEx').val(response[0].qty);
					$('#inputKeluarNote').val(response[0].note);
				}
			});
		});
	});	
</script>

<?php 
require_once '../templates/footer.php';
?>
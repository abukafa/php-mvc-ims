<?php 
include_once '../templates/header.php';
if($u['kode'] == 'Office'){
	exit;
}
?>
<!--  DATA SO --------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-3">
			<h1 class="h3 d-inline align-middle"><strong>Stok </strong>Opname</h1>
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title mb-0">Cek Persediaan Outlet</h5>
						<a href="../models/fun-dapur.php?resetOpname" class="btn btn-success btn-sm"><span data-feather="refresh-cw"></span> Reset</a>
					</div>
					<div class="card-body">
						<!-- FORM filter Pencarian -->
						<form action="" method="post">
							<div class="input-group col-12 col-lg-4 mb-3">
								<span class="input-group-text"><span data-feather="search"></span></span>
								<input type="text" class="form-control" name="cari" id="cari" placeholder="Pencarian" autocomplete="off" onchange>
							</div>
						</form>
						<table id="data_table" class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th class="col-1">Id</th>
								<th class="d-none d-md-table-cell col-1">Kode</th>
								<th>Barang</th>
								<th class="">SO</th>
								<th class="col-1">Stok</th>
								<th class="col-1">Selisih</th>
							</tr>
							<?php 
							$outlet = $u['kode'];
							if(isset($_POST['cari'])){
								$cari=$_POST['cari'];
								$query = "SELECT * FROM dapur WHERE outlet='$outlet' AND barang LIKE '%$cari%' ORDER BY barang";
							}else{
								$query = "SELECT dapur.*, jenis.id as jid FROM dapur LEFT JOIN jenis ON dapur.jenis=jenis.jenis WHERE dapur.outlet='$outlet' ORDER BY jenis.id, dapur.barang";
							}
								$data = myquery($query);
								foreach ($data as $g) : ?>
							<tr>
								<td class="text-center"><?= $g['id'] ?></td>
								<td class="d-none d-md-table-cell text-center"><?= $g['kode'] ?></td>
								<td><?= $g['barang'] ?></td>
								<td class="text-center"><?= $g['so'] ?></td>
								<td class="text-center"><?= $g['stok'] ?></td>
								<td class="text-center" <?= ($g['so'] - $g['stok']) <> 0 ? "style='color:red'" : "" ?>><?= $g['so'] - $g['stok'] ?></td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.tabledit.js"></script>
<script>
	// BASEURL
	const geturl = 'http://localhost/agj/public';

	$(document).ready(function(){
		$('#data_table').Tabledit({
			deleteButton: false,
			editButton: false,   		
			columns: {
			identifier: [0, 'id'],                    
			editable: [[3, 'so']]
			},
			hideIdentifier: true,
			url: '../models/fun-dapur.php?stokOpname',
		});
	});

	// $('#cari').keyup(function(){
	// 	var xhr = new XMLHttpRequest();
	// 	xhr.onreadystatechange = function(){
	// 		console.log('ok');
	// 		if( xhr.readyState == 4 && xhr.status == 200 ){
	// 			$('#data_table').innerHTML = xhr.responseText;
	// 		}
	// 	}
	// 	xhr.open('GET', '../models/fun-gudang.php?cariOpname=' + $('#cari').val(), true);
	// 	xhr.send();
	// });
</script>

<?php 
include_once '../templates/footer.php';
?>
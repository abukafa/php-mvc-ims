<?php 
include_once '../templates/header.php';
if($u['kode'] <> 'Office'){
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
					<div class="card-header d-md-block d-lg-flex justify-content-between">
						<?php 
						if(isset($_GET['view'])){
							$kou = $_GET['view'];
							$out = myquery("SELECT * FROM outlet WHERE kode=" . $kou);
							$label = $out[0]['outlet'];
							$query = "SELECT dapur.*, jenis.id FROM dapur LEFT JOIN jenis ON dapur.jenis=jenis.jenis WHERE outlet='$kou'";
							$bin = ' AND';
							$print = '../report/lap_so?cab='. $kou;
							$export = '../models/fun-export?so='. $kou;
						}else{
							$label = 'PT. JUPRI - Distribution Center';
							$query = "SELECT gudang.*, jenis.id FROM gudang LEFT JOIN jenis ON gudang.jenis=jenis.jenis";
							$bin = ' WHERE';
							$print = '../report/lap_so?cab=office';
							$export = '../models/fun-export?so=office';
						}
						?>
						<h5 class="card-title mb-2 CardLabel"><?= $label ?></h5>
						<form action="" method="get">
							<div class="input-group">
								<div class="input-group-text p-0">
									<select class="form-select bg-light border-0" name="view" id="view" onchange="this.form.submit()">
										<option value="">.. pilih Outlet ..</option>	
									</select>
								</div>
								<!-- <input type="text" name="data" id="data" class="form-control" placeholder="Filter Data.."> -->
								<a href="../models/fun-gudang?resetOpname" class="d-none d-md-inline btn btn-primary <?= isset($_GET['view']) ? 'd-none' : '' ?>"><span data-feather="refresh-cw"></span></a>
								<a href="<?= $print ?>" target="_blank" class="d-none d-md-inline btn btn-primary"><span data-feather="printer"></span></a>
								<a href="<?= $export ?>" class="d-none d-md-inline btn btn-primary"><span data-feather="download"></span></a>
							</div>
						</form>
					</div>
					<div class="card-body">
						<!-- FORM filter Pencarian -->
						<form action="" method="post">
							<div class="input-group col-12 col-lg-4 mb-3">
								<span class="input-group-text"><a href="so"><span data-feather="search"></span></a></span>
								<input type="text" class="form-control" name="cari" id="cari" placeholder="Pencarian" autocomplete="off" onchange>
							</div>
						</form>
						<table id="data_table" class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th class="d-none d-md-table-cell col-1">Kode</th>
								<th>Barang</th>
								<th class="">SO</th>
								<th class="col-1">Stok</th>
								<th class="col-1">Selisih</th>
							</tr>
							<?php 
							if(isset($_POST['cari'])){
								$cari=$_POST['cari'];
								$query .= $bin ." barang LIKE '%$cari%'";
							}
							$query .= " ORDER BY jenis.id, barang";
							$data = myquery($query);
							foreach ($data as $g) : ?>
							<tr>
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
	$(document).ready(function(){
		if(window.location.href.indexOf('?') < 0){
			$('#data_table').Tabledit({
				deleteButton: false,
				editButton: false,   		
				columns: {
				identifier: [0, 'id'],                    
				editable: [[2, 'so']]
				},
				hideIdentifier: false,
				url: '../models/fun-gudang.php?stokOpname',
			});
		}
	});

	// selector outlet
	$(document).ready(function() {
		$.ajax({
			url: '../models/fun-outlet.php?getListOutlet',
			method: 'post',
			dataType: 'json',
			success: function(data){
				// console.log(data);
				$.each(data, function(index, item){
					$('#view').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.outlet + '</option>');
					// $('#outlet').val('');
				});			
			}
		});
	});
	// $(document).ready(function(){
	// 	$("#view").change(function(){
	// 		var kode = $(this).val();
	// 		$.ajax({
	// 			url: '../models/fun-outlet.php?getOutlet=' + kode,
	// 			type: 'post',
	// 			data: {kode:kode},
	// 			dataType: 'json',
	// 			success:function(response){
	// 				// console.log()
	// 				$(".CardLabel").html(response[0].outlet);
	// 			}
	// 		});
	// 	});
	// });
</script>

<?php 
include_once '../templates/footer.php';
?>
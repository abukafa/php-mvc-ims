<?php 
include_once '../templates/header.php';
if($u['kode'] <> 'Office'){
	exit;
}
?>
<main class="content">
	<div class="container-fluid p-0">
		<?php 
		if(!isset($_GET['pass'])){ ?>
		<article class="pb-2 mb-3 <?= $u['jabatan'] == "Programmer" ? "d-block" : "d-none" ?>">
			<!-- Menu mysql -->
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
			<h1 class="h3 mb-3">Edit <strong>Database</strong></h1>
			</div>
			<div>
			<div class="accordion" id="accordionExample">
				<div class="accordion-item">
				<h4 class="accordion-header" id="headingOne">
					<button class="accordion-button <?= isset($_GET['userSQL']) ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					<b>User SQL Query</b>
					</button>
				</h4>
				<div id="collapseOne" class="accordion-collapse collapse <?= isset($_GET['userSQL']) ? 'show' : '' ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body">
					<form action="../models/fun-user.php?userSQL=edit" method="post">
						<div class="row">
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Aksi</label>
								<select type="text" class="form-select" id="opsi" onchange="generateQuery()">
									<option>Update</option>
									<option>Delete</option>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Tabel</label>
								<select name="tabel" id="tabel" class="form-select">
								<option>.. pilih ..</option>
								<?php
								$tables = myquery("SHOW TABLES");
								foreach($tables as $table) :
									echo "<option>". $table['Tables_in_jupri'] ."</option>";
								endforeach
								?>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Kolom</label>
								<select id="kolom" class="form-select" onchange="generateQuery()">
									<option>.. pilih ..</option>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Data Baru</label>
								<input id="newValue" type="text" class="form-control" onkeyup="generateQuery()">
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Konsidi</label>
								<select id="kondisi" class="form-select" onchange="generateQuery()">
									<option>.. pilih ..</option>
								</select>
							</div>
							<div class="col-6 col-md-2 mb-2">
								<label class="form-label">Data Lama</label>
								<input id="oldValue" type="text" class="form-control" onkeyup="generateQuery()">
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12">
								<div class="input-group">
									<input type="text" class="form-control" name="query" id="query"  autocomplete="off">
									<button type="submit" id="io_submit" class="btn btn-primary float-md-end">
									<span data-feather="save" class="feather-15"></span>
									</button>
									<button type="reset" id="refresh" class="btn btn-primary float-md-end" data-bs-dismiss="modal">
									<span data-feather="refresh-cw" class="feather-15"></span>
									</button>
								</div>
							</div>
						</div>
					</form>
					<br>
					<?php flash(); ?>
					</div>
				</div>
				</div>
				<div class="accordion-item">
				<h4 class="accordion-header" id="headingOne">
					<button class="accordion-button <?= isset($_GET['userSQL']) ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<b>Overview</b>
					</button>
				</h4>
				<div id="collapseTwo" class="accordion-collapse collapse <?= isset($_GET['userSQL']) ? 'show' : '' ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body overflow-auto">
					<table class="table table-striped table-bordered">
						<tr class="text-center">
						<?php
						$tables = myquery("SHOW TABLES");
						$jum = myNumRow("SHOW TABLES");
						foreach($tables as $table) :
						echo "<td class='align-content-center'>". $table['Tables_in_jupri'] ."</td>";
						endforeach;
						// var_dump($tables);
						echo "</tr><tr class='text-center'>";
						for($i=0; $i<$jum; $i++){
						$tab = $tables[$i]['Tables_in_jupri'];
						$tabRows = myNumRow("SELECT * FROM ". $tab);
						echo "<td>" . $tabRows . "</td>";
						}
						?>
						</tr>
					</table>
					</div>
				</div>
				</div>
			</div>
		</article>
		<?php } ?>

		<?php 
		if(isset($_GET['pass'])){ ?> 
			<h1 class="h3 mb-3">Ganti <strong>Password</strong></h1>
			<div class="row">
				<div class="col-12 col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<?php flash(); ?>
								</div>
							</div>
							<form action="../models/fun-user.php?pass" method="post">
								<div class="mt-1 mb-2">
									<label class="form-label" for="uname">Username</label>
									<input type="text" class="form-control" name="uname" id="uname" value="<?= $u['uname'] ?>" readonly>
								</div>
								<div class="mb-2">
									<label class="form-label" for="lama">Password Lama</label>
									<input type="password" class="form-control" name="lama" id="lama" required>
								</div>
								<div class="mb-2">
									<label class="form-label" for="baru">Password Baru</label>
									<input type="password" class="form-control" name="baru" id="baru" required>
								</div>
								<div class="mb-4">
									<label class="form-label" for="lagi">Password Baru</label>
									<input type="password" class="form-control" name="lagi" id="lagi" onkeyup="sameCheck()" required>
								</div>
								<script>    
									function sameCheck(){  
										let pas = document.getElementById('baru');
										let rpas = document.getElementById('lagi');
										if (rpas.value !== pas.value){
											rpas.className = "form-control is-invalid";
										}else if (rpas.value == pas.value){
											rpas.className = "form-control is-valid";
										}
									};  
								</script>  
								<div>
									<button type="submit" name="pass" class="btn btn-success float-end">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		<?php }else{ ?>
			<h1 class="h3 mb-3">Data <strong>Pengguna</strong></h1>
			<div class="row">
		<?php } ?>

		<div class="col-12 <?php if(isset($_GET['pass']) == 'pass'){ echo 'col-lg-9'; } ?>">
			<div class="card">
				<div class="card-header d-flex justify-content-between"></div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
						</div>
					</div>
					<table class="table table-hover table-sm table-bordered">
						<tr class="table-active text-center">
							<th>ID</th>
							<th>Username</th>
							<th class="d-none d-md-table-cell">Nama</th>
							<th class="d-none d-md-table-cell">Cabang</th>
							<th>Jabatan</th>
							<th>Akses</th>
							<th class="d-none d-md-table-cell">Ket</th>
						</tr>
						<?php 
						$query = "SELECT * FROM user ORDER BY id";
						$data = myquery($query);
						foreach( $data as $u ) : 
						$id = str_pad($u['id'], 3, 'U0', STR_PAD_LEFT);	
						?>
						<tr class="text-center">
							<td><?= $id ?></td>
							<td><?= $u['uname'] ?></td>
							<td class="d-none d-md-table-cell"><?= $u['nama'] ?></td>
							<td class="d-none d-md-table-cell"><?= $u['cabang'] ?></td>
							<td><?= $u['jabatan'] ?></td>
							<td><?= $u['akses'] ?></td>
							<td class="d-none d-md-table-cell"><?= $u['note'] ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>

<script src="../../assets/js/jquery.min.js"></script>
<script>
    // AJAX KOLOM USER-SQL EDIT
	$('#tabel').change(function(){
		var tab = $(this).val();
		$.ajax({
			url: '../models/fun-user.php?getListColumn=' + tab,
			dataType: 'json',
			success: function(data){
				// console.log(data);
				$.each(data, function(index, item){
					$('#kolom').append('<option>' + item.Field + '</option>');
					$('#kondisi').append('<option>' + item.Field + '</option>');
				});			
			}
		});
	});
	$('#refresh').click(function(){
		// console.log('ok');
		$('#kolom').removeAttr('disabled');
        $('#newValue').removeAttr('disabled');
	});
    function generateQuery(){
      var opsi = $('#opsi').val();
      if(opsi=="Update"){
        $('#query').val("UPDATE " + $('#tabel').val() + " SET " + $('#kolom').val() + "='" + $('#newValue').val() + "' WHERE " + $('#kondisi').val() + "='" + $('#oldValue').val() + "'");
        $('#kolom').removeAttr('disabled');
        $('#newValue').removeAttr('disabled');
      }else if(opsi=="Delete"){
        $('#query').val("DELETE FROM " + $('#tabel').val() + " WHERE " + $('#kondisi').val() + "='" + $('#oldValue').val() + "'");
        $('#kolom').attr('disabled', '');
        $('#newValue').attr('disabled', '');
      }
    }
</script>

<?php 
include_once '../templates/footer.php';
?>
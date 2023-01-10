<?php 
include_once '../templates/header.php';
if($u['kode'] == 'Office'){
	exit;
}
?>
<main class="content">
	<div class="container-fluid p-0">

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
	</div>
</main>


<?php 
include_once '../templates/footer.php';
?>
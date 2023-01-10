<?php 
include_once '../templates/header.php';
if($u['kode'] <> 'Office'){
	exit;
}
?>
<!--  DATA MASTER ---------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Database</h1>
			<div class="row">
				<div class="col-lg-12 mt-2">
					<?php flash(); ?>
					<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Berhasil </strong>Ini adalah pesan contoh..<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               		</div> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6">
				<!-- DATABASE OUTLET -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Outlet</h5>
						<a data-bs-toggle="modal" data-bs-target="#formOutlet" class="btn btn-success btn-sm inputOutlet"><span data-feather="plus-circle"></span> Outlet Baru</a>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>Kode</th>
								<th>Nama</th>
								<th class="d-none d-md-table-cell">Alamat</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$queryOutlet = "SELECT * FROM outlet ORDER BY kode";
							$dataOutlet = myquery($queryOutlet);
							foreach( $dataOutlet as $o ) : ?>
							<tr>
								<td class="text-center"><?= $o['kode'] ?></td>
								<td><?= $o['outlet'] ?></td>
								<td class="d-none d-md-table-cell"><?= $o['alamat'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formOutlet" class="btn btn-warning btn-sm editOutlet" data-id="<?= $o['kode'] ?>"><span data-feather="edit"></span></a>
									<?php if($u['akses'] == 'Superuser') { ?>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-outlet.php?hapus=<?= $o['kode'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>

				<?php if($u['akses'] == 'Superuser') { ?>
				<!-- DATABASE USER -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Pengguna</h5>
						<a data-bs-toggle="modal" data-bs-target="#formUser" class="btn btn-success btn-sm inputUser"><span data-feather="plus-circle"></span> User Baru</a>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>ID</th>
								<th>Username</th>
								<th class="d-none d-md-table-cell">Cabang</th>
								<th class="d-none d-md-table-cell">Akses</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$queryUser = "SELECT * FROM user WHERE jabatan <> 'Programmer' ORDER BY id";
							$dataUser = myquery($queryUser);
							foreach( $dataUser as $us ) : 
							$uid = str_pad($us['id'], 3, 'U0', STR_PAD_LEFT);	
							?>
							<tr>
								<td class="text-center"><?= $uid ?></td>
								<td><?= $us['uname'] ?></td>
								<td class="d-none d-md-table-cell"><?= $us['cabang'] ?></td>
								<td class="d-none d-md-table-cell"><?= $us['akses'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formUser" class="btn btn-warning btn-sm editUser" data-id="<?= $us['id'] ?>"><span data-feather="edit"></span></a>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-user.php?hapus=<?= $us['id'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
				<?php } ?>
									
				<!-- DATABASE JENIS BARANG -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Jenis Barang</h5>
						<a data-bs-toggle="modal" data-bs-target="#formJenis" class="btn btn-success btn-sm inputJenis"><span data-feather="plus-circle"></span> Jenis Baru</a>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>ID</th>
								<th>Jenis Barang</th>
								<th class="d-none d-md-table-cell">Keterangan</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$queryJenis = "SELECT * FROM jenis ORDER BY id";
							$dataJenis = myquery($queryJenis);
							foreach( $dataJenis as $j ) : 
							$jid = str_pad($j['id'], 3, 'J0', STR_PAD_LEFT);	
							?>
							<tr>
								<td class="text-center"><?= $jid ?></td>
								<td><?= $j['jenis'] ?></td>
								<td class="d-none d-md-table-cell"><?= $j['note'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formJenis" class="btn btn-warning btn-sm editJenis" data-id="<?= $j['id'] ?>"><span data-feather="edit"></span></a>
									<?php if($u['akses'] == 'Superuser') { ?>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-jenis.php?hapus=<?= $j['id'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
												
				<!-- DATABASE SATUAN BARANG -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Satuan Barang</h5>
						<a data-bs-toggle="modal" data-bs-target="#formSatuan" class="btn btn-success btn-sm inputSatuan"><span data-feather="plus-circle"></span> Satuan Baru</a>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>ID</th>
								<th>Satuan</th>
								<th>Keterangan</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$querySatuan = "SELECT * FROM satuan ORDER BY id";
							$dataSatuan = myquery($querySatuan);
							foreach( $dataSatuan as $i ) : 
							$iid = str_pad($i['id'], 3, 'I0', STR_PAD_LEFT);	
							?>
							<tr>
								<td class="text-center"><?= $iid ?></td>
								<td class="text-center"><?= $i['satuan'] ?></td>
								<td><?= $i['note'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formSatuan" class="btn btn-warning btn-sm editSatuan" data-id="<?= $i['id'] ?>"><span data-feather="edit"></span></a>
									<?php if($u['akses'] == 'Superuser') { ?>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-satuan.php?hapus=<?= $i['id'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>

				<!-- DATABASE SUPPLIER -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Supplier</h5>
						<a data-bs-toggle="modal" data-bs-target="#formSuplier" class="btn btn-success btn-sm inputSuplier"><span data-feather="plus-circle"></span> Supplier Baru</a>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>ID</th>
								<th>Supplier</th>
								<th class="d-none d-md-table-cell">Jenis</th>
								<th>Opsi</th>
							</tr>
							<?php 
							$querySuplier = "SELECT * FROM suplier ORDER BY id";
							$dataSuplier = myquery($querySuplier);
							foreach( $dataSuplier as $s ) : 
							$sid = str_pad($s['id'], 3, 'S0', STR_PAD_LEFT);	
							?>
							<tr>
								<td class="text-center"><?= $sid ?></td>
								<td><?= $s['suplier'] ?></td>
								<td class="d-none d-md-table-cell"><?= $s['jenis'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formSuplier" class="btn btn-warning btn-sm editSuplier" data-id="<?= $s['id'] ?>"><span data-feather="edit"></span></a>
									<?php if($u['akses'] == 'Superuser') { ?>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-suplier.php?hapus=<?= $s['id'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>

			<div class="col-12 col-lg-6">	
				<!-- DATABASE BARANG -->
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h5 class="card-title">Data Barang</h5>
						<a data-bs-toggle="modal" data-bs-target="#formBarang" class="btn btn-success btn-sm inputBarang"><span data-feather="plus-circle"></span> Barang Baru</a>
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
								<th>Opsi</th>
							</tr>
							<?php 
							if(isset($_POST['cari'])){
								$cari=$_POST['cari'];
								$queryBarang = "SELECT * FROM barang WHERE barang LIKE '%$cari%' OR jenis LIKE '%$cari%' ORDER BY barang";
							}else{
								$queryBarang = "SELECT barang.*, jenis.id, jenis.jenis FROM barang LEFT JOIN jenis ON barang.jenis=jenis.jenis ORDER BY jenis.id, barang.barang";
							}
								$dataBarang = myquery($queryBarang);
							foreach( $dataBarang as $b ) : ?>
							<tr>
								<td class="text-center d-none d-md-table-cell"><?= $b['kode'] ?></td>
								<td><?= $b['barang'] ?></td>
								<td class="d-none d-md-table-cell"><?= $b['jenis'] ?></td>
								<td class="text-center">
									<a data-bs-toggle="modal" data-bs-target="#formBarang" class="btn btn-warning btn-sm editBarang" data-id="<?= $b['kode'] ?>"><span data-feather="edit"></span></a>
									<?php if($u['akses'] == 'Superuser') { ?>
									<a onclick="if(confirm('Anda yakin akan menghapus Data ini ??')){ location.href='../models/fun-barang.php?hapus=<?= $b['kode'] ?>' }" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></a>
									<?php } ?>
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

<!-- Modal Input Data Outlet -->
<div class="modal fade" id="formOutlet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formOutletLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formOutletLabel">Input Data <b>Outlet</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputOutletKode">Kode Outlet</label>
						<input type="text" class="form-control form-control" name="inputOutletKode" id="inputOutletKode" onkeyup="cekKodeOutlet(this.value)" required>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletNama">Nama Outlet</label>
						<input type="text" class="form-control form-control" name="inputOutletNama" id="inputOutletNama" required>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletJenis">Jenis Outlet</label>
						<input type="text" class="form-control form-control" name="inputOutletJenis" id="inputOutletJenis">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletAlamat">Alamat</label>
						<input type="text" class="form-control form-control" name="inputOutletAlamat" id="inputOutletAlamat">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletKordinat">Lokasi (Kordinat)</label>
						<input type="text" class="form-control form-control" name="inputOutletKordinat" id="inputOutletKordinat">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletKepala">Kepala Outlet</label>
						<input type="text" class="form-control form-control" name="inputOutletKepala" id="inputOutletKepala">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletStatus">Status Outlet</label>
						<select type="text" class="form-select form-select" name="inputOutletStatus" id="inputOutletStatus">
							<option>Aktif</option>
							<option>Non Aktif</option>
							<option>Tutup</option>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputOutletNote">Catatan</label>
						<input type="text" class="form-control form-control" name="inputOutletNote" id="inputOutletNote" value="-">
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

<!-- Modal Input Data User -->
<div class="modal fade" id="formUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formUserLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formUserLabel">Input Data <b>Pengguna</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="<?= BASEURL ?>/login/tambah" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputUserUname">Username</label>
						<input type="text" class="form-control form-control" name="inputUserUname" id="inputUserUname" onkeyup="cekUname(this.value)" required>
						<input type="hidden" class="form-control form-control" name="inputUserId" id="inputUserId">
					</div>
					<div class="mb-2" id="inputUserPass">
						<label class="form-label" for="inputUserPass">Default Password</label>
						<input type="text" class="form-control form-control" name="inputUserPass" value="juara" readonly>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputUserNama">Nama Lengkap</label>
						<input type="text" class="form-control form-control" name="inputUserNama" id="inputUserNama" required>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputUserKode">Kode</label>
							<select type="text" class="form-control form-select" name="inputUserKode" id="inputUserKode" required>
								<option></option>
								<option>Office</option>
							</select>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputUserCabang">Cabang</label>
							<input type="text" class="form-control form-control" name="inputUserCabang" id="inputUserCabang" readonly>
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputUserJabatan">Jabatan</label>
						<select type="text" class="form-control form-select" name="inputUserJabatan" id="inputUserJabatan" required>
							<option>Owner</option>
							<option>Manager</option>
							<option>Supervisor</option>
							<option>Admin</option>
							<option>Staff</option>
							<option>Leader</option>
							<option>Kasir</option>
							<option>Kru</option>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputUserAkses">Akses</label>
						<select type="text" class="form-control form-select" name="inputUserAkses" id="inputUserAkses" required>
							<option>User</option>
							<option>Superuser</option>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputUserNote">Catatan</label>
						<input type="text" class="form-control form-control" name="inputUserNote" id="inputUserNote" value="-">
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

<!-- Modal Input Data Jenis -->
<div class="modal fade" id="formJenis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formJenisLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formJenisLabel">Input Data <b>Jenis</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputJenisNama">Jenis Barang</label>
						<input type="text" class="form-control" name="inputJenisNama" id="inputJenisNama" required>
						<input type="hidden" class="form-control" name="inputJenisId" id="inputJenisId">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputJenisNote">Catatan</label>
						<input type="text" class="form-control" name="inputJenisNote" id="inputJenisNote">
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

<!-- Modal Input Data Satuan -->
<div class="modal fade" id="formSatuan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formSatuanLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formSatuanLabel">Input Data <b>Satuan</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputSatuanNama">Satuan Barang</label>
						<input type="text" class="form-control" name="inputSatuanNama" id="inputSatuanNama" required>
						<input type="hidden" class="form-control" name="inputSatuanId" id="inputSatuanId">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputSatuanNote">Catatan</label>
						<input type="text" class="form-control" name="inputSatuanNote" id="inputSatuanNote">
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

<!-- Modal Input Data Supplier -->
<div class="modal fade" id="formSuplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formSuplierLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formSuplierLabel">Input Data <b>Supplier</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputSuplierNama">Nama Supplier</label>
						<input type="text" class="form-control" name="inputSuplierNama" id="inputSuplierNama" onkeyup="cekNamaSuplier(this.value)" required>
						<input type="hidden" class="form-control" name="inputSuplierId" id="inputSuplierId">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputSuplierAlamat">Alamat</label>
						<input type="text" class="form-control" name="inputSuplierAlamat" id="inputSuplierAlamat">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputSuplierTelepon">Telephone</label>
						<input type="text" class="form-control" name="inputSuplierTelepon" id="inputSuplierTelepon">
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputSuplierJenis">Jenis Supplier</label>
						<select type="text" class="form-select" name="inputSuplierJenis" id="inputSuplierJenis" required>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputSuplierNote">Catatan</label>
						<input type="text" class="form-control" name="inputSuplierNote" id="inputSuplierNote" value="-">
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

<!-- Modal Input Data Barang -->
<div class="modal fade" id="formBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formBarangLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formBarangLabel">Input Data <b>Barang</b></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form role="form" action="" method="post">
					<div class="mb-2">
						<label class="form-label" for="inputBarangKode">Kode Barang</label>
						<input type="text" class="form-control form-control" name="inputBarangKode" id="inputBarangKode" readonly="false" onkeyup="cekKodeBarang(this.value)" required>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputBarangNama">Nama Barang</label>
						<input type="text" class="form-control form-control" name="inputBarangNama" id="inputBarangNama" required>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputBarangJenis">Jenis Barang</label>
						<select type="text" class="form-control form-select" name="inputBarangJenis" id="inputBarangJenis" required>
						</select>
					</div>
					<div class="row">
						<div class="mb-2 col-6">
							<label class="form-label" for="inputBarangSatuan">Satuan</label>
							<select type="text" class="form-control form-select" name="inputBarangSatuan" id="inputBarangSatuan" required>
							</select>
						</div>
						<div class="mb-2 col-6">
							<label class="form-label" for="inputBarangConv">Qty (Konversi) Satuan Terkecil</label>
							<input type="text" class="form-control" name="inputBarangConv" id="inputBarangConv">
						</div>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputBarangSupplier">Supplier</label>
						<select type="text" class="form-control form-select" name="inputBarangSuplier" id="inputBarangSuplier" required>
						</select>
					</div>
					<div class="mb-2">
						<label class="form-label" for="inputBarangNote">Catatan</label>
						<input type="text" class="form-control" name="inputBarangNote" id="inputBarangNote" value="-">
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
<script src="../extends/ext-master.js"></script>
<script>
	// cek nama supplier
	function cekNamaSuplier(word){
		$.ajax({
			url: '../models/fun-suplier.php?cekNamaSuplier=' + word,
			method: 'post',
			success: function(data){
				if(data > 0) {
					$('#inputSuplierNama').attr('class', 'form-control is-invalid');
				}else{
					$('#inputSuplierNama').attr('class', 'form-control is-valid');
				}
			}
		});
	}

	console.log('ok');
	// selector outlet
	$(function() {
		$.ajax({
			url: '../models/fun-outlet.php?getListOutlet',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					console.log()
					$('#inputUserKode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.outlet + '</option>');
				});			
			}
		});
	});
	$(document).ready(function(){
		$("#inputUserKode").change(function(){
			var kode = $(this).val();
			if(kode=='Office'){
					$("#inputUserCabang").val('Juara Priangan');
			}else{
				$.ajax({
					url: '../models/fun-outlet.php?getOutlet=' + kode,
					type: 'post',
					data: {kode:kode},
					dataType: 'json',
					success:function(response){
						console.log()
						$("#inputUserCabang").val(response[0].outlet);
					}
				});
			}
		});
	});
</script>

<?php 
include_once '../templates/footer.php';
?>
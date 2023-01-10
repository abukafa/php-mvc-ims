<!DOCTYPE html>
<html lang="en">
<?php
require_once '../models/function.php';
session_start();
if(!isset($_SESSION['uname'])){
    header("location:../../");
    exit;
}else{
	$uname=$_SESSION['uname'];
	$user = myquery("select * from user where uname='$uname'");
	$u = $user[0];
}
?>
<style>
	.dropdown-menu {
		overflow-y: auto;
		max-height: 600px;
	}
</style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link href="../../assets/css/app.css" rel="stylesheet">
    <!-- <link href="../../assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="../../assets/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../assets/img/pin.png">

	<title><?= $u['kode'] . ' | ' . $u['cabang'] ?></title>
</head>

<body>
	<div class="wrapper">

        <!--  SIDEBAR MENU  ---------------------------------------------------------------------------------------------------------->
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index">
				<span class="align-middle"><?= $u['cabang'] ?></span>
			</a>
			<?php 
			// menghilangkan slash (/) di ahir
			$url = rtrim($_SERVER['REQUEST_URI'], '/');
			// memecah URL menjadi array
			$url = explode('/', $url);
			$url = substr($url[3],0,4);
			?> 

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						<?= ($u['kode'] == 'Office') ? 'Office' : 'Outlet' ?>
					</li>
					<li class="sidebar-item <?php if($url == 'inde'){ echo 'active'; } ?>">
						<a class="sidebar-link" href="index">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
					<?php if($u['kode'] == 'Office') { ?>
						<li class="sidebar-item <?php if($url == 'mast'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="master">
								<i class="align-middle" data-feather="book"></i> <span class="align-middle">Master Data</span>
							</a>
						</li>
						<li class="sidebar-item <?php if($url == 'guda'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="gudang">
								<i class="align-middle" data-feather="package"></i> <span class="align-middle">Gudang</span>
							</a>
						</li>
						<li class="sidebar-item <?php if($url == 'masu'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="masuk">
								<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Barang Masuk</span>
							</a>
						</li>
						<li class="sidebar-item <?php if($url == 'kiri'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="kirim">
								<i class="align-middle" data-feather="truck"></i> <span class="align-middle">Pengiriman</span>
							</a>
						</li>
					<?php }else{ ?>
						<li class="sidebar-item <?php if($url == 'dapu'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="dapur">
								<i class="align-middle" data-feather="home"></i> <span class="align-middle">Outlet</span>
							</a>
						</li>
						<li class="sidebar-item <?php if($url == 'teri'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="terima">
								<i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Barang Masuk</span>
							</a>
						</li>
						<li class="sidebar-item <?php if($url == 'kelu'){ echo 'active'; } ?>">
							<a class="sidebar-link" href="keluar">
								<i class="align-middle" data-feather="inbox"></i> <span class="align-middle">Barang Keluar</span>
							</a>
						</li>
					<?php } ?>
					<li class="sidebar-item <?php if($url == 'lapo'){ echo 'active'; } ?>">
						<a class="sidebar-link" href="laporan">
							<i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Laporan</span>
						</a>
					</li>
					<li class="sidebar-item <?php if($url == 'so'){ echo 'active'; } ?>">
						<a class="sidebar-link" href="so">
							<i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Stok Opname</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="../models/fun-user?logout">
							<i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
        
		<div class="main">

      <!--  SIDEBAR TOGGLE  ---------------------------------------------------------------------------------------------------->
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
				<i class="hamburger align-self-center"></i>
				</a>

        <!--  NAVBAR MENU  --------------------------------------------------------------------------------------------------->
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						<!-- MENU POPUP NOTOFIKASI -->
						<?php 
						// notifikasi stok
						if($u['kode'] == 'Office') {
							$kode = 'Gudang';
							$queryNotiStok = "SELECT 'Gudang' as outlet, kode, barang, satuan, stok FROM gudang WHERE stok < minim UNION SELECT outlet.outlet, dapur.kode, dapur.barang, dapur.satuan, dapur.stok FROM dapur LEFT JOIN outlet ON dapur.outlet=outlet.kode WHERE stok < minim ORDER BY outlet DESC";
							$queryNotiStokMinim = "SELECT * FROM gudang WHERE minim=0";
							$queryNotiKirim = "SELECT pengiriman.* FROM pengiriman LEFT JOIN penerimaan ON pengiriman.id=penerimaan.id WHERE penerimaan.id IS NULL";
						}else{
							$kode = $u['kode'];
							$queryNotiStok = "SELECT * FROM dapur WHERE outlet='$kode' AND stok < minim";
							$queryNotiStokMinim = "SELECT * FROM dapur WHERE outlet='$kode' AND minim=0";
							$queryNotiKirim = "SELECT pengiriman.* FROM pengiriman LEFT JOIN penerimaan ON pengiriman.id=penerimaan.id WHERE pengiriman.outlet='$kode' AND penerimaan.id IS NULL";
						}
						$notiStok = myNumRow($queryNotiStok);
						$stokMinim = myNumRow($queryNotiStokMinim);
						$notiStokMinim = $stokMinim > 0 ? 1 : 0;
						$notiKirim = myNumRow($queryNotiKirim);
						// notifikasi so
						if(date('d') == 10 || date('d') == 20 || date('d') >= 28){
							$period = (date('d') <= 10 ? '1' : date('d') <= 20) ? '2' : '3';
							$notiSO = 1;
						}else{
							$notiSO = 0;
						}
						// notifikasi data

						// sum notifikasi
						$sumNoti = $notiStok + $notiSO + $notiStokMinim + $notiKirim;
						?>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<?php if($sumNoti > 0){ ?>
									<span class="indicator"><?= $sumNoti ?></span>
									<?php } ?>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									<?= $sumNoti ?> New Notifications
								</div>
								<div class="list-group">
									<?php if($notiStokMinim !== 0){ ?>
									<a href="<?= ($u['kode'] == 'Office') ? 'gudang' : 'dapur' ?>" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark"><?= $stokMinim ?> Data Barang Belum diisi</div>
												<div class="text-muted small mt-1">Isi Stok Minimum & Konversi</div>
											</div>
										</div>
									</a>
									<?php 
									}
									if($notiKirim !== 0){
										$rowNotiKirim = myquery($queryNotiKirim);
										foreach($rowNotiKirim as $kirim) :
									?>
									<a href="<?= ($u['kode'] == 'Office') ? 'kirim' : 'terima' ?>" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark"><?= $kirim['inv'] ?> Belum diterima</div>
												<div class="text-muted small mt-1"><?= $kirim['outlet'] .' : '. $kirim['barang'] .' '. $kirim['qty'] .' '. $kirim['satuan'] ?></div>
											</div>
										</div>
									</a>
									<?php 
									endforeach;
									}
									if($notiStok !== 0){
										$rowNotiStok = myquery($queryNotiStok);
										foreach($rowNotiStok as $stok) :
									?>
									<a href="<?= ($u['kode'] == 'Office') ? 'gudang' : 'dapur' ?>" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-<?= ($stok['outlet']=='Gudang') ? 'circle' : 'triangle' ?>"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Stock Control - <?= $stok['kode'] ?></div>
												<div class="text-muted small mt-1"><?= $stok['outlet'] .' : '. $stok['barang'] .' = '. $stok['stok'] . ' ' . $stok['satuan'] ?></div>
											</div>
										</div>
									</a>
									<?php 
									endforeach;
									}
									if($notiSO == 1){
									?>
									<a href="so" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="alert-triangle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Stok Opname P<?= $period ?></div>
												<div class="text-muted small mt-1">Hari ini tanggal <?= date('d') ?> Periode-<?= $period ?></div>
												<div class="text-muted small mt-1">Segera lakukan Stok Opname</div>
											</div>
										</div>
									</a>
									<?php 
									}
									?>
								</div>
								<div class="dropdown-menu-footer">
									<small class="text-muted">User Notifications</small>
								</div>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
							<i class="align-middle" data-feather="settings"></i>
						</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							<img src="../../assets/img/pin.png" class="avatar img-fluid rounded-circle me-2"> <b><?= $u['nama'] ?></b>
						</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="user"><i class="align-middle me-1" data-feather="user"></i> Pengguna</a>
								<a class="dropdown-item" href="user?pass"><i class="align-middle me-1" data-feather="settings"></i> Password</a>
								<a class="dropdown-item" href="manual"><i class="align-middle me-1" data-feather="help-circle"></i> Manual</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="../models/fun-user?logout"><i class="align-middle me-1" data-feather="log-out"></i> Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
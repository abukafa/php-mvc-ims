<!DOCTYPE html>
<html lang="en">
<?php 
if(!session_id()) session_start();
require_once 'app/models/config.php';
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

  	<link rel="stylesheet" href="assets/css/app.css">
	<link rel="shortcut icon" href="assets/img/pin.png">
	<style>
		.stroke {
			-webkit-text-stroke:1px black;
			-webkit-text-fill-color:transparent;
		}
	</style>

	<title>Login | Juara Priangan</title>
</head>

<body>
	<div
	class="bg-image d-flex justify-content-center align-items-center"
	style="
	  background-image: url('../index/watermark.png');
	  background-repeat: repeat;
	  height: 100vh;
	">
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-md-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<div class="text-center mt-4">
							<h2><strong>Inventory Management</strong></h2>
							<h2 class="mb-4"><strong>System</strong></h2>
							<!-- <p class="lead text-warning shadow"><strong>
								Juara Priangan
							</strong></p> -->
						</div>
						<div class="card" style="border-radius:20px; background-color: #f58d91;">
							<div class="card-body">
								<div>
									<div class="text-center">
										<img src="assets/img/jupri.png" class="img-fluid mb-4" width="300" />
									</div>
									<div class="row">
										<div class="col-lg-12">
										<?php if(isset($_SESSION['flash'])){ ?>
										<div class="alert alert-<?= $_SESSION['flash']['tipe'] ?> alert-dismissible fade show" role="alert">
											<strong><?= $_SESSION['flash']['pesan'] ?></strong> <?= $_SESSION['flash']['ket'] ?>
										</div>
										<?php
										unset($_SESSION['flash']);
										} ?>
										</div>
									</div>
									<form action="app/models/fun-user.php?login"  method="post">
										<label class="form-label lead">Silahkan Login..</label>
										<div class="form-floating mb-3">
											<input type="text" class="form-control" name="uname" id="uname" placeholder="Username" autocomplete="off">
											<label for="uname">Username</label>
										</div>
										<div class="form-floating mb-3">
											<input type="password" class="form-control" name="pass" id="pass" placeholder="Password" autocomplete="off">
											<label for="pass">Password</label>
										</div>
										<div class="text-center mt-2 mb-1">
											<button type="submit" name="login" class="btn btn-lg btn-success">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>
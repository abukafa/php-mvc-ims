<?php 
require_once '../templates/header.php';
if($u['kode'] == 'Office'){
	exit;
}
?>

<!--  DASHBOARD ---------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">
		
		<h1 class="h3 mb-4"><strong>Inventory</strong> Management System</h1>
		<?php 
		$outlet = $u['kode'];
		$queryMasuk = "SELECT SUM(terima*conv) as qty FROM penerimaan WHERE outlet='$outlet'";
		$queryPakai = "SELECT SUM(qty) as total FROM terpakai WHERE outlet='$outlet'";
		$queryBuang = "SELECT SUM(qty) as total FROM terbuang WHERE outlet='$outlet'";
		$masuk = myquery($queryMasuk);
		$pakai = myquery($queryPakai);
		$buang = myquery($queryBuang);
		$stokIn = $masuk[0]['qty'];
		$stokOk = $pakai[0]['total'];
		$stokNo = $buang[0]['total'];
		$sisa = $stokIn - ($stokOk + $stokNo);
		?>
		<div class="row">
			<div class="col-xl-6 col-xxl-5 d-flex">
				<div class="w-100">
					<div class="row">
						<div class="col-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<!-- <h5 class="card-title">Barang Masuk</h5> -->
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="truck"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?= $stokIn ?></h1>
									<div class="mb-0">
										<!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -0% </span> -->
										<!-- <span class="text-muted"><?= $u['cabang'] ?></span> -->
										<h5 class="card-title">Barang Masuk</h5>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<!-- <h5 class="card-title">Barang Sisa</h5> -->
										</div>
										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="briefcase"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?= $sisa ?></h1>
									<div class="mb-0">
										<!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -0% </span> -->
										<!-- <span class="text-muted"><?= $u['cabang'] ?></span> -->
										<h5 class="card-title">Barang Sisa</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<!-- <h5 class="card-title">Barang Terpakai</h5> -->
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="inbox"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?= $stokOk ?></h1>
									<div class="mb-0">
										<!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -0% </span> -->
										<!-- <span class="text-muted"><?= $u['cabang'] ?></span> -->
										<h5 class="card-title">Terpakai</h5>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<!-- <h5 class="card-title">Barang Terbuang</h5> -->
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="trash-2"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?= $stokNo ?></h1>
									<div class="mb-0">
										<!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -0% </span> -->
										<!-- <span class="text-muted"><?= $u['cabang'] ?></span> -->
										<h5 class="card-title">Terbuang</h5>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-xxl-7">
				<div class="card flex-fill w-100">
					<div class="card-header">

						<h5 class="card-title mb-0">Grafik - <?= $u['cabang'] ?></h5>
					</div>
					<div class="card-body py-3">
						<div class="chart chart-sm">
							<canvas id="gaphMonth"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
				<div class="card flex-fill w-100">
					<div class="card-header">

						<h5 class="card-title mb-0">Stok Terbuang - <?= $u['cabang'] ?></h5>
					</div>
					<div class="card-body d-flex">
						<div class="align-self-center w-100">
							<div class="py-3">
								<div class="chart chart-xs">
									<canvas id="stokTerbuang"></canvas>
								</div>
							</div>
							<table class="table mb-0">
								<tbody>
								<?php 
								$terbuang = myquery("SELECT DISTINCT ket, SUM(qty) as sum FROM terbuang WHERE outlet='$outlet' GROUP BY ket");
								foreach($terbuang as $bu) :
								?>
									<tr>
										<td><?= $bu['ket'] ?></td>
										<td class="text-end"><?= $bu['sum'] ?></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
				<div class="card flex-fill w-100">
					<div class="card-header">

						<h5 class="card-title mb-0">Outlet AGJ Priangan Timur</h5>
					</div>
					<div class="card-body px-4">
						<div id="petaPriangan" style="height:350px;"></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
				<div class="card flex-fill">
					<div class="card-header">

						<h5 class="card-title mb-0">Kalender</h5>
					</div>
					<div class="card-body d-flex">
						<div class="align-self-center w-100">
							<div class="chart">
								<div id="kalender-besar"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-lg-7 col-xxl-9 d-flex">
				<div class="card flex-fill">
					<div class="card-header">

						<h5 class="card-title mb-0">Laporan Outlet</h5>
					</div>
					<table class="table table-hover my-0">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Outlet</th>
								<th>Status</th>
								<th class="d-none d-md-table-cell">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$outlet = myquery("SELECT outlet.*, COUNT(terpakai.outlet) as con FROM outlet LEFT JOIN terpakai ON outlet.kode=terpakai.outlet GROUP BY kode");
							foreach($outlet as $o) :
								$con = $o['con'];
							?>
							<tr>
								<td><?= $o['kode'] ?></td>
								<td><?= $o['outlet'] ?></td>
								<?php if($con > 0){ ?>
									<td><span class="badge bg-success">Done</span></td>
								<?php }else{ ?>
									<td><span class="badge bg-danger">Waiting..</span></td>
								<?php } ?>
								<td class="d-none d-md-table-cell"><?= $con ?> Data</td>
							</tr>
							<?php 
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-12 col-lg-5 col-xxl-3 d-flex">
				<div class="card flex-fill w-100">
					<div class="card-header">

						<h5 class="card-title mb-0">Stok Terpakai</h5>
					</div>
					<div class="card-body d-flex">
						<div class="align-self-center chart chart-lg h-100">
							<canvas id="stokTerpakai"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>

<script src="../../assets/js/jquery.min.js"></script>

<?php 

?>

<script>
// GRAFIK KORDINAT ALL OUTLET
$(document).ready(function(){
    // document.addEventListener("DOMContentLoaded", function() {
    var markers = [
		<?php foreach($outlet as $o) : ?>
		{
            coords: [ <?= $o['kordinat']; ?> ],
            name: "<?= $o['kode'] .' - '. $o['outlet'] ?>"
        },
		<?php endforeach; ?>
    ];
    var map = new jsVectorMap({
        map: "world",
        selector: "#petaPriangan",
        zoomButtons: true,
        markers: markers,
        markerStyle: {
            initial: {
                r: 9,
                strokeWidth: 7,
                stokeOpacity: .4,
                fill: window.theme.primary
            },
            hover: {
                fill: window.theme.primary,
                stroke: window.theme.primary
            }
        },
        zoomOnScroll: false
    });
    window.addEventListener("resize", () => {
        map.updateSize();
    });
});

// GRAFIK STOK TERPAKAI ALL OUTLET
$(document).ready(function(){
    // document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
    new Chart(document.getElementById("stokTerpakai"), {
        type: "horizontalBar",
        data: {
            labels: [
						<?php 
							$terpakai = myquery('SELECT outlet.kode, outlet.outlet, COUNT(terpakai.outlet) as pakai, SUM(terpakai.qty) as sum FROM outlet LEFT JOIN terpakai ON outlet.kode=terpakai.outlet GROUP BY outlet.kode');
							foreach($terpakai as $pakai) : ?>
						"<?= $pakai['kode'] ?>", 
						<?php endforeach; ?>
						],
            datasets: [{
                label: "This year",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: [
									<?php foreach($terpakai as $pakai) : ?>
									<?= $pakai['sum'] ?>, 
									<?php endforeach; ?>
								],
                barPercentage: .75,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
					display: false
            },
            scales: {
					xAxes: [{
						stacked: false,
						gridLines: {
							color: "transparent"
						},
						ticks: {
							display: false,
							beginAtZero: true
						}
               }]
            }
        }
    });
});

// KALENDER
$(document).ready(function(){
    // document.addEventListener("DOMContentLoaded", function() {
    var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
    var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
    document.getElementById("kalender-besar").flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: defaultDate
    });
});

// GRAFIK STOK TERBUANG
$(document).ready(function(){
    // document.addEventListener("DOMContentLoaded", function() {
    // Pie chart
    new Chart(document.getElementById("stokTerbuang"), {
        type: "pie",
        data: {
            labels: [
							<?php
							$outlet = $u['kode'];
							$terbuang = myquery("SELECT DISTINCT ket, SUM(qty) as sum FROM terbuang WHERE outlet='$outlet' GROUP BY ket");
							foreach($terbuang as $bu) :
							?>
							"<?= $bu['ket'] ?>", 
							<?php endforeach; ?>
						],
            datasets: [{
                data: [
									<?php foreach($terbuang as $bu) : ?>
									<?= $bu['sum'] ?>, 
									<?php endforeach; ?>
								],
                backgroundColor: [
                    window.theme.primary,
                    window.theme.warning,
                    window.theme.danger
                ],
                borderWidth: 5
            }]
        },
        options: {
            responsive: !window.MSInputMethodContext,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            cutoutPercentage: 75
        }
    });
});

// GRAFIK STOK TERJUAL PER MONTH
$(document).ready(function(){
    // document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("gaphMonth").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
    // Line chart
    new Chart(document.getElementById("gaphMonth"), {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales ($)",
                fill: true,
                backgroundColor: gradient,
                borderColor: window.theme.primary,
                data: [
									<?php
									$outlet = $u['kode'];
									$terjual = myquery("SELECT MONTH(tanggal) as mon, SUM(qty) as qty FROM terpakai WHERE outlet='$outlet' GROUP BY MONTH(tanggal)");
									foreach($terjual as $jual) :
										echo $jual['qty'] . ', ';
									endforeach;
									?>
                ]
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 1000
                    },
                    display: true,
                    borderDash: [3, 3],
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }]
            }
        }
    });
});
</script>

<?php 
require_once '../templates/footer.php'
?>
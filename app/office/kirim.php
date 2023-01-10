<?php
include_once '../templates/header.php';
if ($u['kode'] <> 'Office') {
	exit;
}
?>
<!--  DATA GUDANG --------------------------------------------------------------------------------------------------------->
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-4">
			<h1 class="h3 d-inline align-middle"><strong>Stok Keluar</strong> Gudang</h1>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- generate invoice -->
				<?php
				function createRandomPassword()
				{
					$chars = "003232303232023232023456789";
					srand((float)microtime() * 1000000);
					$i = 0;
					$pass = '';
					while ($i <= 7) {
						$num = rand() % 33;
						$tmp = substr($chars, $num, 1);
						$pass = $pass . $tmp;
						$i++;
					}
					return $pass;
				}
				$invo = 'IN-' . createRandomPassword();
				?>
				<div class="card">
					<div class="card-header d-md-flex justify-content-between">
						<h5 class="card-title">
							<?php
							if (isset($_GET['filter'])) {
								$data = $_GET['data'];
								$now = date('Y-m-d');
								if ($_GET['filter'] == 'Tanggal') {
									echo $_GET['data'] . ' s.d. ' . $now;
								} elseif ($_GET['filter'] == 'Hari') {
									echo 'Tanggal ' . $_GET['data'];
								} else {
									echo 'Outlet Tujuan ' . $_GET['data'];
								}
							} else {
								echo 'Data Pengiriman Barang';
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
										<option>Tujuan</option>
									</select>
								</div>
								<input type="text" name="data" id="data" class="form-control" placeholder="Filter Data..">
								<a href="kirim_baru?inv=<?= $invo ?>" class="btn btn-success"><span data-feather="plus-circle"></span>
									<div class="d-none d-md-inline"> Entri Baru</div>
								</a>
							</div>
						</form>
					</div>
					<div class="card-body">
						<table class="table table-hover table-sm table-bordered">
							<tr class="table-active text-center">
								<th>Tanggal</th>
								<th class="d-none d-md-table-cell">Jatuh Tempo</th>
								<th class="d-none d-md-table-cell">Invoice</th>
								<th>Outlet</th>
								<th class="d-none d-md-table-cell">Tujuan</th>
								<th class="d-none d-md-table-cell">Pengirim</th>
								<th>Opsi</th>
							</tr>
							<?php
							$queryKirim = "SELECT DISTINCT pengiriman.inv, pengiriman.tanggal, pengiriman.tempo, pengiriman.outlet, pengiriman.pengirim, outlet.kode, outlet.outlet as nama, outlet.alamat FROM pengiriman INNER JOIN outlet ON pengiriman.outlet = outlet.kode";
							if (isset($_GET['filter'])) {
								if ($_GET['filter'] == 'Tanggal') {
									$queryKirim .= " WHERE tanggal BETWEEN '$data' AND '$now' ORDER BY tanggal DESC";
								} elseif ($_GET['filter'] == 'Hari') {
									$queryKirim .= " WHERE tanggal = '$data' ORDER BY tanggal DESC";
								} else {
									$queryKirim .= " WHERE outlet.kode = " . $data . " ORDER BY tanggal DESC";
								}
							} else {
								$pagi = pagination(25, $queryKirim);
								$queryKirim .= " ORDER BY tanggal DESC limit $pagi[4], $pagi[0]";
							}
							$dataKirim = myquery($queryKirim);
							foreach ($dataKirim as $k) : ?>
								<tr>
									<td class="text-center"><?= $k['tanggal'] ?></td>
									<td class="text-center d-none d-md-table-cell"><?= $k['tempo'] ?></td>
									<td class="text-center d-none d-md-table-cell"><?= $k['inv'] ?></td>
									<td class="text-center"><?= $k['outlet'] ?></td>
									<td class="d-none d-md-table-cell"><?= $k['nama'] ?></td>
									<td class="text-center d-none d-md-table-cell"><?= $k['pengirim'] ?></td>
									<td class="text-center">
										<a href="kirim_baru?inv=<?= $k['inv'] ?>" class="btn btn-warning btn-sm"><span data-feather="eye"></span></a>
										<a href="../report/lap_spj.php?inv=<?= $k['inv'] ?>" target="blank" class="btn btn-success btn-sm"><span data-feather="printer"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Pagination -->
		<?php if (!isset($_GET['filter'])) { ?>
			<ul class="pagination justify-content-center">
				<li class="page-item<?php if ($pagi[3] == 1) {
										echo " disabled";
									} ?>">
					<a class="page-link" href="?page=<?= $pagi[3] - 1; ?>" aria-label="Previous">
						<span aria-hidden="true">«</span>
					</a>
				</li>
				<li class="page-item">
					<b class="page-link">
						<?= $pagi[3]; ?> : <?= $pagi[2]; ?>
					</b>
				</li>
				<li class="page-item<?php if ($pagi[3] == $pagi[2]) {
										echo " disabled";
									} ?>">
					<a class="page-link" href="?page=<?= $pagi[3] + 1; ?>" aria-label="Next">
						<span aria-hidden="true">»</span>
					</a>
				</li>
			</ul>
		<?php } ?>
	</div>
</main>

<script>
	function filterFocus() {
		document.getElementById('data').focus();
	}
</script>
<?php
include_once '../templates/footer.php';
?>
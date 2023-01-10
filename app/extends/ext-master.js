
	// selector jenis barang
	$(function() {
		$.ajax({
			url: '../models/fun-jenis.php?getListJenis',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputSuplierJenis').append('<option>' + item.jenis + '</option>');
					$('#inputBarangJenis').append('<option>' + item.jenis + '</option>');
				});			
			}
		});
	});
	// selector satuan barang
	$(function() {
		$.ajax({
			url: '../models/fun-satuan.php?getListSatuan',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputBarangSatuan').append('<option>' + item.satuan + '</option>');
				});			
			}
		});
	});
	// selector supplier
	$(function() {
		$.ajax({
			url: '../models/fun-suplier.php?getListSuplier',
			method: 'post',
			dataType: 'json',
			success: function(data){
				$.each(data, function(index, item){
					$('#inputBarangSuplier').append('<option>' + item.suplier + '</option>');
				});			
			}
		});
	});

	// cek kode outlet eksis
	function cekKodeOutlet(word){
		$.ajax({
			url: '../models/fun-outlet.php?cekKodeOutlet=' + word,
			method: 'post',
			success: function(data){
				if(data > 0) {
					$('#inputOutletKode').attr('class', 'form-control is-invalid');
				}else{
					$('#inputOutletKode').attr('class', 'form-control is-valid');
				}
			}
		});
	}

	// cek kode barang eksis
	function cekKodeBarang(word){
		$.ajax({
			url: '../models/fun-barang.php?cekKodeBarang=' + word,
			method: 'post',
			success: function(data){
				if(data > 0) {
					$('#inputBarangKode').attr('class', 'form-control is-invalid');
				}else{
					$('#inputBarangKode').attr('class', 'form-control is-valid');
				}
			}
		});
	}

	// $(function(){
	// 	$('#inputSuplierNama').attr('class', 'form-control is-invalid');

	// 	// cek nama supplier
	// 	// $('#inputSuplierNama').on('keyup', function(){
	// 	// 	const word = $('#inputSuplierNama').val();
	// 	// 	$.ajax({
	// 	// 		url: '../models/fun-suplier.php?cekNamaSuplier=' + word,
	// 	// 		method: 'post',
	// 	// 		success: function(data){
	// 	// 			if(data > 0) {
	// 	// 				$('#inputSuplierNama').attr('class', 'form-control is-invalid');
	// 	// 			}else{
	// 	// 				$('#inputSuplierNama').attr('class', 'form-control is-valid');
	// 	// 			}
	// 	// 		}
	// 	// 	});
	// 	// });
	// });

	// cek username eksis
	function cekUname(word){
		$.ajax({
			url: '../models/fun-user.php?cekUname=' + word,
			method: 'post',
			success: function(data){
				if(data > 0) {
					$('#inputUserUname').attr('class', 'form-control is-invalid');
				}else{
					$('#inputUserUname').attr('class', 'form-control is-valid');
				}
			}
		});
	}

	// FORM OUTLET
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputOutlet').on('click', function(){
			$('#formOutletLabel').html('Input Data <b>Outlet</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-outlet.php?tambah');
			$('#inputOutletKode').val('');
			$('#inputOutletNama').val('');
			$('#inputOutletJenis').val('');
			$('#inputOutletAlamat').val('');
			$('#inputOutletKordinat').val('');
			$('#inputOutletKepala').val('');
			$('#inputOutletStatus').val('');
			$('#inputOutletNote').val('-');
			$('#inputOutletKode').removeAttr('readonly');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editOutlet').on('click', function(){
			$('#formOutletLabel').html('Edit Data <b>Outlet</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-outlet.php?ubah');
			const kode = $(this).data('id');
			$.ajax({
				url: '../models/fun-outlet.php?getOutlet=' + kode,
				data: {kode : kode}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					$('#inputOutletKode').val(data[0].kode);
					$('#inputOutletNama').val(data[0].outlet);
					$('#inputOutletJenis').val(data[0].jenis);
					$('#inputOutletAlamat').val(data[0].alamat);
					$('#inputOutletKordinat').val(data[0].kordinat);
					$('#inputOutletKepala').val(data[0].kepala);
					$('#inputOutletStatus').val(data[0].status);
					$('#inputOutletNote').val(data[0].note);
					$('#inputOutletKode').attr('readonly', '');
				}
			});
		});
	});

	// FORM USER
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputUser').on('click', function(){
			$('#formUserLabel').html('Input Data <b>Pengguna</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-user.php?tambah');
			$('#inputUserUname').val('');
			$('#inputUserNama').val('');
			$('#inputUserPass').attr('class', 'd-block mb-2');
			$('#inputUserCabang').val('');
			$('#inputUserJabatan').val('');
			$('#inputUserAkses').val('');
			$('#inputUserNote').val('-');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editUser').on('click', function(){
			$('#formUserLabel').html('Edit Data <b>Pengguna</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-user.php?ubah');
			const id = $(this).data('id');
			$.ajax({
				url: '../models/fun-user.php?getUser=' + id,
				data: {id : id}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					$('#inputUserUname').val(data[0].uname);
					$('#inputUserId').val(data[0].id);
					$('#inputUserNama').val(data[0].nama);
					$('#inputUserPass').attr('class', 'd-none');
					$('#inputUserCabang').val(data[0].cabang);
					$('#inputUserJabatan').val(data[0].jabatan);
					$('#inputUserAkses').val(data[0].akses);
					$('#inputUserNote').val(data[0].note);
				}
			});
		});
	});

	// FORM JENIS
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputJenis').on('click', function(){
			$('#formJenisLabel').html('Input Data <b>Jenis</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-jenis.php?tambah');
			$('#inputJenisNama').val('');
			$('#inputJenisNote').val('-');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editJenis').on('click', function(){
			$('#formJenisLabel').html('Edit Data <b>Jenis</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-jenis.php?ubah');
			const id = $(this).data('id');
			$.ajax({
				url: '../models/fun-jenis.php?getJenis=' + id,
				data: {id : id}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					$('#inputJenisNama').val(data[0].jenis);
					$('#inputJenisNote').val(data[0].note);
					$('#inputJenisId').val(data[0].id);
				}
			});
		});
	});

	// FORM SATUAN
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputSatuan').on('click', function(){
			$('#formSatuanLabel').html('Input Data <b>Satuan</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-satuan.php?tambah');
			$('#inputSatuanNama').val('');
			$('#inputSatuanNote').val('-');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editSatuan').on('click', function(){
			$('#formSatuanLabel').html('Edit Data <b>Satuan</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-satuan.php?ubah');
			const id = $(this).data('id');
			$.ajax({
				url: '../models/fun-satuan.php?getSatuan=' + id,
				data: {id : id}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					$('#inputSatuanNama').val(data[0].satuan);
					$('#inputSatuanNote').val(data[0].note);
					$('#inputSatuanId').val(data[0].id);
				}
			});
		});
	});

	// FORM SUPLIER
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputSuplier').on('click', function(){
			$('#formSuplierLabel').html('Input Data <b>Suplier</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-suplier.php?tambah');
			$('#inputSuplierNama').val('');
			$('#inputSuplierAlamat').val('');
			$('#inputSuplierTelepon').val('');
			$('#inputSuplierJenis').val('');
			$('#inputSuplierNote').val('-');
		});

		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editSuplier').on('click', function(){
			$('#formSuplierLabel').html('Edit Data <b>Suplier</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-suplier.php?ubah');
			const id = $(this).data('id');
			$.ajax({
				url: '../models/fun-suplier.php?getSuplier=' + id,
				data: {id : id}, 
				method: 'post',
				dataType: 'json',
				success: function(data){
					$('#inputSuplierNama').val(data[0].suplier);
					$('#inputSuplierAlamat').val(data[0].alamat);
					$('#inputSuplierTelepon').val(data[0].telepon);
					$('#inputSuplierJenis').val(data[0].jenis);
					$('#inputSuplierNote').val(data[0].note);
					$('#inputSuplierId').val(data[0].id);
				}
			});
		});
	});

	// FORM BARANG
	$(function(){
		// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
		$('.inputBarang').on('click', function(){
			$('#formBarangLabel').html('Input Data <b>Barang</b>');
			$('.modal-footer button[type=submit]').html('Tambah');
			$('.modal-body form').attr('action', '../models/fun-barang.php?tambah');
			$('#inputBarangKode').val('');
			$('#inputBarangNama').val('');
			$('#inputBarangJenis').val('');
			$('#inputBarangSatuan').val('');
			$('#inputBarangConv').val('');
			$('#inputBarangSuplier').val('');
			$('#inputBarangNote').val('-');
			$('#inputBarangKode').removeAttr('readonly');
		});
		
		// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
		$('.editBarang').on('click', function(){
			$('#formBarangLabel').html('Edit Data <b>Barang</b>');
			$('.modal-footer button[type=submit]').html('Ubah');
			$('.modal-body form').attr('action', '../models/fun-barang.php?ubah');
				const kode = $(this).data('id');
				$.ajax({
					url: '../models/fun-barang.php?getBarang=' + kode,
					data: {kode : kode}, 
					method: 'post',
					dataType: 'json',
					success: function(data){
						$('#inputBarangKode').val(data[0].kode);
						$('#inputBarangNama').val(data[0].barang);
						$('#inputBarangJenis').val(data[0].jenis);
						$('#inputBarangSatuan').val(data[0].satuan);
						$('#inputBarangConv').val(data[0].conv);
						$('#inputBarangSuplier').val(data[0].suplier);
						$('#inputBarangNote').val(data[0].note);
						$('#inputBarangKode').attr('readonly', '');
				}
			});
		});
	});
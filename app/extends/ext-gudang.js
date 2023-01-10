

// selector barang
$(function() {
	$.ajax({
		url: '../models/fun-gudang.php?getListBarang',
		dataType: 'json',
		success: function(data){
			$.each(data, function(index, item){
				$('#inputGudangKode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + '</option>');
			});			
		}
	});
});
$(document).ready(function(){
	$("#inputGudangKode").change(function(){
		var kode = $(this).val();
		$.ajax({
			url: '../models/fun-barang.php?getBarang=' + kode,
			dataType: 'json',
			success:function(response){
				$("#inputKode").val(response[0].kode);
				$("#inputGudangNama").val(response[0].barang);
				$("#inputGudangJenis").val(response[0].jenis);
				$("#inputGudangSatuan").val(response[0].satuan);
				$("#inputGudangConv").val(response[0].conv);
				$("#inputGudangSuplier").val(response[0].suplier);
			}
		});
	});
});
// selector supplier
$(function() {
	$.ajax({
		url: '../models/fun-suplier.php?getListSuplier',
		// method: 'post',
		dataType: 'json',
		success: function(data){
			$.each(data, function(index, item){
				$('#inputGudangSuplier').append('<option>' + item.suplier + '</option>');
			});			
		}
	});
});
// FORM Gudang
$(function(){
	// Jika tombol INPUT data ditekan - Modal data kembali menjadi INPUT
	$('.inputGudang').on('click', function(){
		$('#formGudangLabel').html('Input Data <b>Gudang</b>');
		$('.modal-footer button[type=submit]').html('Tambah');
		$('.modal-body form').attr('action', '../models/fun-gudang.php?tambah');
		$('#inputKode').attr('type', 'hidden');
		$('#inputGudangKode').attr('class', 'form-select');
		$('#inputGudangKode').val('');
		$('#inputGudangNama').val('');
		$('#inputGudangJenis').val('');
		$('#inputGudangSatuan').val('');
		$('#inputGudangConv').val('');
		$('#inputGudangStok').val('0');
		$('#inputGudangHarga').val('');
		$('#inputGudangJual').val('');
		$('#inputGudangMinim').val('');
		$('#inputGudangSuplier').val('');
		$('#inputGudangNote').val('-');
	});

	// Jika tombol EDIT data ditekan - Modal data berubah menjadi EDIT
	$('.editGudang').on('click', function(){
		$('#formGudangLabel').html('Edit Data <b>Gudang</b>');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-body form').attr('action', '../models/fun-gudang.php?ubah');
		const kode = $(this).data('id');
		$.ajax({
			url: '../models/fun-gudang.php?getGudang=' + kode,
			dataType: 'json',
			success:function(response){
				$('#inputGudangKode').attr('class', 'form-select d-none');
				$('#inputKode').attr('type', 'text');
				$('#inputKode').val(response[0].kode);
				$('#inputGudangNama').val(response[0].barang);
				$('#inputGudangJenis').val(response[0].jenis);
				$('#inputGudangSatuan').val(response[0].satuan);
				$('#inputGudangConv').val(response[0].conv);
				$('#inputGudangStok').val(response[0].stok);
				$('#inputGudangMinim').val(response[0].minim);
				$('#inputGudangHarga').val(response[0].harga);
				$('#inputGudangJual').val(response[0].jual);
				$('#inputGudangSuplier').val(response[0].suplier);
				$('#inputGudangNote').val(response[0].note);
			}
		});
	});
});
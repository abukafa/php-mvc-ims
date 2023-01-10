// edit invoice
$(document).ready(function(){
    const inv = $('#invoice').val();
    $.ajax({
        url: '../models/fun-kirim.php?getFromKirim=' + inv,
        method: 'post',
        dataType: 'json',
        success: function(data){
            // console.log(data);
            if ( data == '' ) {
                //   Selektor Tanggal
                $(function() {
                    $('#tanggal').datepicker({ 
                    autoclose: true,
                    todayHighlight: true,
                    format : 'yyyy-mm-dd' 
                    });
                });
                $(function() {
                    $('#tempo').datepicker({ 
                    autoclose: true,
                    todayHighlight: true,
                    format : 'yyyy-mm-dd' 
                    });
                });
            } else {
                $('#tanggal').val(data[0].tanggal);
                $('#tanggal').attr('readonly', '');
                $("#tempo").val(data[0].tempo);
                $('#tempo').attr('readonly', '');
                $("#pengirim").val(data[0].pengirim);
                $('#pengirim').attr('readonly', '');
                $("#tujuan").val(data[0].toko);
                $("#tujuan").attr('type', 'text');
                $("#tujuanS").attr('class', 'form-select d-none');
                $("#outlet").val(data[0].nama);
                $("#alamat").val(data[0].alamat);		
                $("#user").val(data[0].user);		
            }
        }
    });
});
// selector outlet
$(function() {
    $.ajax({
        url: '../models/fun-outlet.php?getListOutlet',
        method: 'post',
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, item){
                $('#tujuanS').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.outlet + '</option>');
                $('#tujuanS').val('');
            });			
        }
    });
});
$(document).ready(function(){
    $("#tujuanS").change(function(){
        var kode = $(this).val();
        $.ajax({
            url: '../models/fun-outlet.php?getOutlet=' + kode,
            type: 'post',
            data: {kode:kode},
            dataType: 'json',
            success:function(response){
                // console.log()
                $("#tujuan").val(response[0].kode);
                $("#outlet").val(response[0].outlet);
                $("#alamat").val(response[0].alamat);
            }
        });
    });
});

// selector barang
$(function() {
    $.ajax({
        url: '../models/fun-gudang.php?getListGudang',
        method: 'post',
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, item){
                $('#kode').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.barang + '</option>');
                $('#kode').val('');
            });			
        }
    });
});

$(document).ready(function(){
    $("#kode").change(function(){
        var kode = $(this).val();
        $.ajax({
            url: '../models/fun-gudang.php?getGudang=' + kode,
            type: 'post',
            data: {kode:kode},
            dataType: 'json',
            success:function(response){
                $("#barang").val(response[0].barang);
                $("#jenis").val(response[0].jenis);
                $("#stok").val(response[0].stok + ' ' + response[0].satuan);
                $("#harga").val(response[0].jual);
            }
        });
    });
});

$('#qty').keyup(function(){
    $('#jumlah').val($(this).val() * $('#harga').val());
});
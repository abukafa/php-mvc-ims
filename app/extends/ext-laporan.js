$(function() {
    $.ajax({
        url: '../models/fun-outlet.php?getListOutlet',
        method: 'post',
        dataType: 'json',
        success: function(data){
            // console.log(data);
            $.each(data, function(index, item){
                $('#outlet').append('<option value="' + item.kode + '">' + item.kode + ' - ' + item.outlet + '</option>');
                $('#outlet').val('');
            });			
        }
    });
});
// Selektor Tanggal
$(function() {
    $('#masukTglAwal').datepicker({ 
    autoclose: true,
    todayHighlight: true,
    format : 'yyyy-mm-dd' 
    });
});
$(function() {
    $('#masukTglAhir').datepicker({ 
    autoclose: true,
    todayHighlight: true,
    format : 'yyyy-mm-dd' 
    });
});
$(function() {
    $('#keluarTglAwal').datepicker({ 
    autoclose: true,
    todayHighlight: true,
    format : 'yyyy-mm-dd' 
    });
});
$(function() {
    $('#keluarTglAhir').datepicker({ 
    autoclose: true,
    todayHighlight: true,
    format : 'yyyy-mm-dd' 
    });
});
$(function() {
    $('#tglTerpakai').datepicker({ 
    autoclose: true,
    todayHighlight: true,
    format : 'yyyy-mm-dd' 
    });
});
$(function() {
    $('#tglTerbuang').datepicker({ 
    autoclose: true,
    todayHighlight: true,
    format : 'yyyy-mm-dd' 
    });
});
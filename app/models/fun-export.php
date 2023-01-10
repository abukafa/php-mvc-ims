<?php 

require_once 'function.php';
session_start();
if(!isset($_SESSION['uname'])){
    header("location:../../index");
    exit;
}else{
	$uname=$_SESSION['uname'];
	$user = myquery("select * from user where uname='$uname'");
	$u = $user[0];
}

// FUNGSI EXPORT PASIEN ---------------------------------------------------------------------------------------------------
if(isset($_GET['so'])){
    if($_GET['so']=="office"){
        $query = "SELECT gudang.*, jenis.id FROM gudang LEFT JOIN jenis ON gudang.jenis=jenis.jenis ORDER BY jenis.id, barang";
        $label = 'Distribution Center';
    }else{
        $cab = $_GET['so'];
        $out = myquery("SELECT * FROM outlet WHERE kode='$cab'");
        $label = $out[0]['outlet'];
        $query = "SELECT dapur.*, jenis.id FROM dapur LEFT JOIN jenis ON dapur.jenis=jenis.jenis WHERE outlet='$cab' ORDER BY jenis.id, barang";
    }

    $output = '
    <b>REKAP STOK OPNAME</b><br>
    <b>'. $label .'</b><br>
    <b>'. date("d-m-Y") .'</b><br>
    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
    ';
    $no=1;
    $jum=0;
    $data = myquery($query);
    foreach($data as $da):
    $stk=$da['kode'];
    $gh=myquery("SELECT harga, jual FROM gudang WHERE kode='$stk'");
    $harga = $gh[0]['jual'] / $da['conv'];
    $total = $da['stok'] * $harga;
    $output .= '
        <tr>
            <td>'. $no .'</td>
            <td>'. $da['kode'] .'</td>
            <td>'. $da['barang'] .'</td>
            <td>'. $da['jenis'] .'</td>
            <td>'. $da['stok'] .'</td>
            <td>'. number_format($harga,0,'','') .'</td>
            <td>'. number_format($total,0,'','') .'</td>
        </tr>
    ';
    $no++;
    $jum = $jum + $total;
    endforeach;
    $output .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'. number_format($jum,0,'','') .'</td>
        </tr>
    </table>';
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=StokOpname.xls");
    echo $output;

}
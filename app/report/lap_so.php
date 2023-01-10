<?php
require('../../assets/pdf/fpdf.php');
require('../models/function.php');
session_start();
if(!isset($_SESSION['uname'])){
    header("location:../../index.php");
    exit;
}else{
	$uname=$_SESSION['uname'];
	$user = myquery("select * from user where uname='$uname'");
	$u = $user[0];
}

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->SetAutoPageBreak(true);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../../assets/img/kop2.png',1,0.6,19,1.6);  

$cab = $_GET['cab'];
if($cab == 'office'){
    $label = 'Distribution Center';
    $query = "SELECT gudang.*, jenis.id FROM gudang LEFT JOIN jenis ON gudang.jenis=jenis.jenis ORDER BY jenis.id, barang";
}else{
    $out = myquery("SELECT * FROM outlet WHERE kode='$cab'");
    $label = $out[0]['outlet'];
    $query = "SELECT dapur.*, jenis.id FROM dapur LEFT JOIN jenis ON dapur.jenis=jenis.jenis WHERE outlet='$cab' ORDER BY jenis.id, barang";
}
$pdf->ln(1.5);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'REKAP STOK OPNAME',0,1,'C');
$pdf->Cell(0,0.6, $label ,0,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,0.6, indo_date(date('y-m-d')) ,0,1,'C');

$pdf->ln(0.5);
$pdf->SetFillColor(193,229,252);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Kode', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
// $pdf->Cell(1.75, 0.8, 'Satuan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Stok', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Total', 1, 1, 'C');

$no=1;
$jum=0;
$pdf->SetFont('Arial','',8);
$stock = myquery($query);
foreach($stock as $st) :
$pdf->Cell(1, 0.8, $no, 1, 0, 'C');
$pdf->Cell(2, 0.8, $st['kode'], 1, 0, 'C');
$pdf->Cell(5, 0.8, $st['barang'], 1, 0, 'L');
$pdf->Cell(3, 0.8, $st['jenis'], 1, 0, 'L');
// $pdf->Cell(1.75, 0.8, $st['satuan'], 1, 0, 'C');
$pdf->Cell(2, 0.8, $st['stok'], 1, 0, 'C');
$stk=$st['kode'];
$gh=myquery("SELECT harga, jual FROM gudang WHERE kode='$stk'");
$harga = $gh[0]['jual'] / $st['conv'];
$total = $st['stok'] * $harga;
$pdf->Cell(3, 0.8, number_format($harga,0,'.',','), 1, 0, 'R');
$pdf->Cell(3, 0.8, number_format($total,0,'.',','), 1, 1, 'R');
$no++;
$jum = $jum + $total;
endforeach;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(16, 0.8, 'Total', 1, 0, 'C');
$pdf->Cell(3, 0.8, number_format($jum,0,'.',','), 1, 1, 'R');

$pdf->Output("Rekap-Stok-Opname.pdf","I");
?>
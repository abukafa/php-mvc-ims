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

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->SetAutoPageBreak(true);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../../assets/img/kop2.png',1,0.6,25,2); 

$tglawl = $_GET['tglawl'];
$tglahr = $_GET['tglahr'];
$pdf->ln(2);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'REKAP PENGIRIMAN & PENJUALAN',0,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,0.6, $tglawl.' s.d. '.$tglahr ,0,1,'C');

$pdf->ln(0.5);
$pdf->SetFillColor(193,229,252);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Ship', 1, 0, 'C');
$pdf->Cell(2.25, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Outlet', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Kode', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(1, 0.8, 'Qty', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Bayar', 1, 0, 'C');
$pdf->Cell(5.25, 0.8, 'Catatan', 1, 1, 'C');

$no=1;
$pdf->SetFont('Arial','',8);
$keluar = myquery("SELECT * FROM pengiriman WHERE tanggal BETWEEN '$tglawl' AND '$tglahr'");
foreach($keluar as $ke) :
$id = str_pad($ke['id'], 7, '00', STR_PAD_LEFT);	
$pdf->Cell(1, 0.7, $no, 1, 0, 'C');
$pdf->Cell(2.5, 0.7, $id, 1, 0, 'C');
$pdf->Cell(2.25, 0.7, $ke['tanggal'], 1, 0, 'C');
$pdf->Cell(1.75, 0.7, $ke['outlet'], 1, 0, 'C');
$pdf->Cell(1.75, 0.7, $ke['kode'], 1, 0, 'C');
$pdf->Cell(5, 0.7, ' '. $ke['barang'], 1, 0, 'L');
$pdf->Cell(3, 0.7, ' '. $ke['jenis'], 1, 0, 'L');
$pdf->Cell(1, 0.7, $ke['qty'], 1, 0, 'C');
$pdf->Cell(2, 0.7, number_format($ke['jumlah'],0,'.',',') , 1, 0, 'R');
$pdf->Cell(2, 0.7, $ke['ket'], 1, 0, 'C');
$pdf->Cell(5.25, 0.7, $ke['note'], 1, 1, 'C');
$no++;
endforeach;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(18.25, 0.8, 'Total', 1, 0, 'C');
$total = myquery("SELECT SUM(jumlah) as total FROM pengiriman WHERE tanggal BETWEEN '$tglawl' AND '$tglahr'");
$pdf->Cell(2, 0.8, number_format($total[0]['total'],0,'.',','), 1, 0, 'R');
$pdf->Cell(2, 0.8, '-', 1, 0, 'C');
$pdf->Cell(5.25, 0.8, '-', 1, 1, 'C');

$pdf->Output("Rekap-Barang-Keluar.pdf","I");
?>
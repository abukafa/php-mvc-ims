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

$tgl = $_GET['tgl'];
$pdf->ln(1.5);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'REKAP BARANG TERBUANG',0,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,0.6, indo_date($tgl) ,0,1,'C');

$pdf->ln(0.5);
$pdf->SetFillColor(193,229,252);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Outlet', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Kode', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(1, 0.8, 'Qty', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Ket', 1, 0, 'C');
$pdf->Cell(2.75, 0.8, 'Catatan', 1, 1, 'C');

$no=1;
$pdf->SetFont('Arial','',8);
$keluar = myquery("SELECT terbuang.*, outlet.outlet as nama FROM terbuang LEFT JOIN outlet ON terbuang.outlet=outlet.kode WHERE tanggal='$tgl'");
foreach($keluar as $ke) :
$pdf->Cell(1, 0.7, $no, 1, 0, 'C');
$pdf->Cell(3.5, 0.7, $ke['outlet'] .' - '. $ke['nama'], 1, 0, 'L');
$pdf->Cell(1.75, 0.7, $ke['kode'], 1, 0, 'C');
$pdf->Cell(4, 0.7, ' '. $ke['barang'], 1, 0, 'L');
$pdf->Cell(3, 0.7, ' '. $ke['jenis'], 1, 0, 'L');
$pdf->Cell(1, 0.7, $ke['qty'], 1, 0, 'C');
$pdf->Cell(2, 0.7, ' '. $ke['ket'], 1, 0, 'L');
$pdf->Cell(2.75, 0.7, $ke['note'], 1, 1, 'C');
$no++;
endforeach;

$pdf->Output("Rekap-Barang-Keluar.pdf","I");
?>
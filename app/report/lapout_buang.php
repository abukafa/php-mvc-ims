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

$tgl = $_GET['tgl'];
$outlet = $u['kode'];
$out = myquery("SELECT * FROM outlet WHERE kode='$outlet'");

$pdf = new FPDF("L","cm","A5");
$pdf->SetMargins(1,1,1);
$pdf->SetAutoPageBreak(true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('../../assets/img/kop2.png',1,0.6,19,1.6); 

$pdf->ln(1.5);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'BERITA ACARA',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.6,'Kerusakan & Kehilangan Barang',0,1,'C');

$pdf->ln(0.5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(2.5,0.6,'Nama Outlet',0,0,'L');
$pdf->Cell(0,0.6,':  '. $out[0]['kode'] .' - '. $out[0]['outlet'],0,1,'L');
$pdf->Cell(2.5,0.6,'Hari & Tanggal',0,0,'L');
$pdf->Cell(0,0.6,':  '. indo_date($tgl),0,1,'L');

$pdf->ln(0.5);
$pdf->SetFillColor(193,229,252);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kode', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Barang', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Item', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Qty', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Catatan', 1, 1, 'C');

$no=1;
$pdf->SetFont('Arial','',8);
$buang = myquery("SELECT * FROM terbuang WHERE outlet='$outlet' AND tanggal='$tgl'");
foreach($buang as $bu) :
$id = str_pad($bu['id'], 7, 'P00000', STR_PAD_LEFT);	
$pdf->Cell(1, 0.7, $no, 1, 0, 'C');
$pdf->Cell(2.5, 0.7, $id, 1, 0, 'C');
$pdf->Cell(1.75, 0.7, $bu['kode'], 1, 0, 'C');
$pdf->Cell(5, 0.7, ' '. $bu['barang'], 1, 0, 'L');
$pdf->Cell(1.75, 0.7, $bu['qty'], 1, 0, 'C');
$pdf->Cell(3, 0.7, ' '. $bu['ket'], 1, 0, 'L');
$pdf->Cell(4, 0.7, ' '. $bu['note'], 1, 1, 'L');
$no++;
endforeach;

$pdf->ln(0.5);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 0.7, 'Demikian berita acara ini dibuat dengan sebenar-benarnya, agar dapat dipergunakan sebagaimana mestinya', 0, 'L');

$pdf->ln(0.5);
$pdf->Cell(13, 0.5, '', 0, 0, 'L');
$pdf->Cell(4, 0.5, 'Tasikmalaya, '. indo_date($tgl, 'j F Y'), '', 1, 'C');
$pdf->Cell(2, 0.5, '', 0, 0, 'L');
$pdf->Cell(4, 0.5, 'Tim CK Tasikmalaya', '', 0, 'C');
$pdf->Cell(7, 0.5, '', 0, 0, 'L');
$pdf->Cell(4, 0.5, 'Supervisor', '', 1, 'C');
$pdf->ln(1.25);
$pdf->Cell(2, 0.7, '', 0, 0, 'L');
$pdf->Cell(4, 0.7, '', 'B', 0, 'L');
$pdf->Cell(7, 0.7, '', 0, 0, 'L');
$pdf->Cell(4, 0.7, '', 'B', 1, 'L');

$pdf->Output("BA-Barang-Hilang.pdf","I");
?>
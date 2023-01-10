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

$pdf = new FPDF("L","cm","A5");

$pdf->SetMargins(1,1,1);
$pdf->SetAutoPageBreak(true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('../../assets/img/kop2.png',1,0.6,19,1.6); 

$inv = $_GET['inv'];
$data = myquery("SELECT pengiriman.*, outlet.kode as toko, outlet.outlet as nama, outlet.alamat FROM pengiriman INNER JOIN outlet WHERE pengiriman.outlet = outlet.kode AND pengiriman.inv='$inv'");
$pdf->ln(1.5);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.8,'SURAT PERINTAH JALAN',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(2,0.6,'No. Invoice',0,0,'L');
$pdf->Cell(12,0.6,': '. $inv ,0,0,'L');
$pdf->Cell(2.25,0.6,'Tanggal',0,0,'L');
$pdf->Cell(0.25,0.6,': ',0,0,'L');
$pdf->Cell(2.5,0.6, $data[0]['tanggal'] ,0,1,'R');

$pdf->Cell(2,0.6,'Tujuan',0,0,'L');
$pdf->Cell(12,0.6,': '. $data[0]['nama'] ,0,0,'L');
$pdf->Cell(2.25,0.6,'Tempo',0,0,'L');
$pdf->Cell(0.25,0.6,': ',0,0,'L');
$pdf->Cell(2.5,0.6, $data[0]['tempo'] ,0,1,'R');

$pdf->Cell(14,0.6,'',0,0,'L');
$pdf->Cell(2.25,0.6,'Pengirim',0,0,'L');
$pdf->Cell(0.25,0.6,': ',0,0,'L');
$pdf->Cell(2.5,0.6, $data[0]['pengirim'] ,0,1,'R');

$pdf->ln(-0.6);
$pdf->Cell(2,0.6,'Alamat',0,0,'L');
$pdf->Cell(0.2,0.6,': ' ,0,0,'L');
$pdf->MultiCell(11,0.6, $data[0]['alamat'] ,0,'L');

$pdf->ln(0.5);
$pdf->SetFillColor(193,229,252);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Ship', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Barang', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Item', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Qty', 1, 0, 'C');
$pdf->Cell(4.75, 0.8, 'Ket', 1, 1, 'C');

$pdf->SetFont('Arial','',8);
$kirim = myquery("SELECT * FROM pengiriman WHERE inv='$inv'");
$no=1;
foreach($kirim as $k) :
$id = str_pad($k['id'], 7, '00', STR_PAD_LEFT);	
$pdf->Cell(1, 0.7, $no , 1, 0, 'C');
$pdf->Cell(2.5, 0.7, $id , 1, 0, 'C');
$pdf->Cell(1.75, 0.7, $k['kode'] , 1, 0, 'C');
$pdf->Cell(4, 0.7, $k['barang'] , 1, 0, 'L');
$pdf->Cell(3, 0.7, $k['jenis'] , 1, 0, 'L');
$pdf->Cell(2, 0.7, $k['qty'] .' '. $k['satuan'] , 1, 0, 'C');
$pdf->Cell(4.75, 0.7, $k['note'] , 1, 1, 'C');
$no++;
endforeach;

$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(2.5, 0.7, 'Tidak menerima Retur setelah pengirim meninggalkan Tempat', 0, 1, 'L');
$pdf->ln(2.5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(11.5, 0.5, '', 0, 0, 'L');
$pdf->Cell(3.5, 0.5, 'Pengirim', 'T', 0, 'R');
$pdf->Cell(0.5, 0.5, '', 0, 0, 'L');
$pdf->Cell(3.5, 0.5, 'Penerima', 'T', 1, 'R');


$pdf->AddPage();
$pdf->Image('../../assets/img/kop2.png',1,0.6,19,1.6); 

$inv = $_GET['inv'];
$data = myquery("SELECT pengiriman.*, outlet.kode as toko, outlet.outlet as nama, outlet.alamat FROM pengiriman INNER JOIN outlet WHERE pengiriman.outlet = outlet.kode AND pengiriman.inv='$inv'");
$pdf->ln(1.5);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.8,'KWITANSI PEMBAYARAN',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(2,0.6,'No. Invoice',0,0,'L');
$pdf->Cell(12,0.6,': '. $inv ,0,0,'L');
$pdf->Cell(2.25,0.6,'Tanggal',0,0,'L');
$pdf->Cell(0.25,0.6,': ',0,0,'L');
$pdf->Cell(2.5,0.6, $data[0]['tanggal'] ,0,1,'R');

$pdf->Cell(2,0.6,'Konsumen',0,0,'L');
$pdf->Cell(12,0.6,': '. $data[0]['nama'] ,0,0,'L');
$pdf->Cell(2.25,0.6,'Tempo',0,0,'L');
$pdf->Cell(0.25,0.6,': ',0,0,'L');
$pdf->Cell(2.5,0.6, $data[0]['tempo'] ,0,1,'R');

$pdf->Cell(14,0.6,'',0,0,'L');
$pdf->Cell(2.25,0.6,'Pengirim',0,0,'L');
$pdf->Cell(0.25,0.6,': ',0,0,'L');
$pdf->Cell(2.5,0.6, $data[0]['pengirim'] ,0,1,'R');

$pdf->ln(-0.6);
$pdf->Cell(2,0.6,'Alamat',0,0,'L');
$pdf->Cell(0.2,0.6,': ' ,0,0,'L');
$pdf->MultiCell(11,0.6, $data[0]['alamat'] ,0,'L');

$pdf->ln(0.5);
$pdf->SetFillColor(193,229,252);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Ship', 1, 0, 'C');
$pdf->Cell(1.75, 0.8, 'Barang', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Item', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Qty', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Jumlah', 1, 1, 'C');

$pdf->SetFont('Arial','',8);
$kirim = myquery("SELECT * FROM pengiriman WHERE inv='$inv'");
$no=1;
foreach($kirim as $k) :
$id = str_pad($k['id'], 7, '00', STR_PAD_LEFT);	
$pdf->Cell(1, 0.7, $no , 1, 0, 'C');
$pdf->Cell(2.5, 0.7, $id , 1, 0, 'C');
$pdf->Cell(1.75, 0.7, $k['kode'] , 1, 0, 'C');
$pdf->Cell(4, 0.7, $k['barang'] , 1, 0, 'L');
$pdf->Cell(3, 0.7, $k['jenis'] , 1, 0, 'L');
$pdf->Cell(1.5, 0.7, $k['qty'] .' '. $k['satuan'] , 1, 0, 'C');
$pdf->Cell(2.5, 0.7, number_format($k['harga'],0,'.',',') , 1, 0, 'R');
$pdf->Cell(2.5, 0.7, number_format($k['jumlah'],0,'.',',') , 1, 1, 'R');
$no++;
endforeach;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(16.25, 0.8, 'Total', 1, 0, 'C');
$total = myquery("SELECT SUM(jumlah) as total FROM pengiriman WHERE inv='$inv'");
$pdf->Cell(2.5, 0.8, number_format($total[0]['total'],0,'.',','), 1, 1, 'R');

$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(2.5, 0.7, 'Tidak menerima Retur setelah pengirim meninggalkan Tempat', 0, 1, 'L');
$pdf->ln(2.5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(11.5, 0.5, '', 0, 0, 'L');
$pdf->Cell(3.5, 0.5, 'Pengirim', 'T', 0, 'R');
$pdf->Cell(0.5, 0.5, '', 0, 0, 'L');
$pdf->Cell(3.5, 0.5, 'Penerima', 'T', 1, 'R');

$pdf->Output("Bukti-Pengiriman.pdf","I");
?>
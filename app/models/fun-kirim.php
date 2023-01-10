<?php 

require_once 'function.php';
session_start();

if(isset($_GET['getFromKirim'])){
    $inv = $_GET['getFromKirim'];
    $query = "SELECT pengiriman.*, outlet.kode as toko, outlet.outlet as nama, outlet.alamat FROM pengiriman INNER JOIN outlet WHERE pengiriman.outlet = outlet.kode AND pengiriman.inv='$inv'";
    echo json_encode(myquery($query));
}

$table = 'pengiriman';

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $invoice = $_POST['invoice'];
        $tanggal = $_POST['tanggal'];
        $tempo = $_POST['tempo'];
        $pengirim = $_POST['pengirim'];
        $outlet = $_POST['tujuan'];
        $kode = $_POST['kode'];
        $barang = $_POST['barang'];
        $jenis = $_POST['jenis'];
        $satuan = $_POST['satuan'];
        $harga = $_POST['harga'];
        $qty = $_POST['qty'];
        $jumlah = $_POST['jumlah'];
        $ket = $_POST['bayar'];
        $note = $_POST['note'];
        $user = $_POST['user'];
        $query = "INSERT INTO " . $table . " VALUES(
            '', 
            '$invoice', 
            '$tanggal', 
            '$tempo', 
            '$pengirim', 
            '$outlet', 
            '$kode', 
            '$barang', 
            '$jenis', 
            '$satuan', 
            '$harga', 
            '$qty', 
            '$jumlah', 
            '$ket', 
            '$note', 
            '$user'  
        )";

        $brg = myquery("SELECT * FROM gudang WHERE kode='$kode'");
        $upStok = $brg[0]['stok'] - $qty;

        mysqli_query($conn, "UPDATE gudang SET stok='$upStok' WHERE kode='$kode'");
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'Stok telah diupdate', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'Stok telah diupdate', 'danger');
        }
        header("Location: ../office/kirim_baru?inv=" . $invoice);
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $kode = $_GET['kode'];
    $qty = $_GET['qty'];
    $inv = $_GET['inv'];
    
    $brg = myquery("SELECT * FROM gudang WHERE kode='$kode'");
    $upStok = $brg[0]['stok'] + $qty;
    
    mysqli_query($conn, "UPDATE gudang SET stok=" . $upStok . " WHERE kode='$kode'");
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Pengiriman', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Pengiriman', 'danger');
    }
    header("Location: ../office/kirim_baru?inv=" .$inv);
}
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

// if(isset($_GET['getListGudang'])){
//     $query = 'SELECT gudang.kode, gudang.barang, jenis.id FROM gudang LEFT JOIN jenis ON gudang.jenis=jenis.jenis ORDER BY jenis.id, gudang.barang';
//     echo json_encode(myquery($query));
//     // echo $query;
// }

// if(isset($_GET['getListBarang'])){
//     $query = 'SELECT barang.kode, barang.barang, jenis.id FROM barang JOIN jenis ON barang.jenis=jenis.jenis LEFT JOIN gudang ON barang.kode=gudang.kode WHERE gudang.kode IS NULL ORDER BY jenis.id, barang.barang';
//     echo json_encode(myquery($query));
// }

$table = 'pembelian';

if(isset($_GET['getMasuk'])){
    $inv = $_GET['getMasuk'];
    $query = "SELECT * FROM " . $table . " WHERE inv='$inv'";
    echo json_encode(myquery($query));
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $inv = $_POST['inputMasukInv'];
        $tanggal = $_POST['inputMasukTanggal'];
        $tempo = $_POST['inputMasukTempo'];
        $kode = $_POST['inputMasukKode'];
        $barang = $_POST['inputMasukBarang'];
        $jenis = $_POST['inputMasukJenis'];
        $satuan = $_POST['inputMasukSatuan'];
        $harga = $_POST['inputMasukHarga'];
        $qty = $_POST['inputMasukQty'];
        $jumlah = $_POST['inputMasukJumlah'];
        $bayar = $_POST['inputMasukBayar'];
        $suplier = $_POST['inputMasukSuplier'];
        $note = $_POST['inputMasukNote'];
        $user = $u['nama'];
        $query = "INSERT INTO " . $table . " VALUES(
            '$inv', 
            '$tanggal', 
            '$tempo', 
            '$kode', 
            '$barang', 
            '$jenis', 
            '$satuan', 
            '$harga', 
            '$qty', 
            '$jumlah', 
            '$bayar', 
            '$suplier', 
            '$note', 
            '$user'
        )";

        $brg = myquery("SELECT * FROM gudang WHERE kode='$kode'");
        $upStok = $brg[0]['stok'] + $qty;

        mysqli_query($conn, "UPDATE gudang SET stok='$upStok' WHERE kode='$kode'");
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'Stok telah diupdate', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'Stok telah diupdate', 'danger');
        }
        header("Location: ../office/masuk");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $inv = $_POST['inputMasukInv'];
        $tanggal = $_POST['inputMasukTanggal'];
        $tempo = $_POST['inputMasukTempo'];
        $kode = $_POST['inputKode'];
        $barang = $_POST['inputMasukBarang'];
        $jenis = $_POST['inputMasukJenis'];
        $satuan = $_POST['inputMasukSatuan'];
        $harga = $_POST['inputMasukHarga'];
        $qty = $_POST['inputMasukQty'];
        $qtyEx = $_POST['inputMasukQtyEx'];
        $jumlah = $_POST['inputMasukJumlah'];
        $bayar = $_POST['inputMasukBayar'];
        $suplier = $_POST['inputMasukSuplier'];
        $note = $_POST['inputMasukNote'];
        $user = $u['nama'];
        $query = "UPDATE " . $table . " SET
            tanggal = '$tanggal', 
            tempo = '$tempo', 
            kode = '$kode', 
            barang = '$barang', 
            jenis = '$jenis', 
            satuan = '$satuan', 
            harga = '$harga', 
            qty = '$qty', 
            jumlah = '$jumlah', 
            bayar = '$bayar', 
            suplier = '$suplier', 
            note = '$note', 
            user = '$user'
        WHERE inv = '$inv'";
    
        $brg = myquery("SELECT * FROM gudang WHERE kode='$kode'");
        $upStok = $qty + $brg[0]['stok'] - $qtyEx;
        
        mysqli_query($conn, "UPDATE gudang SET stok=" . $upStok . " WHERE kode='$kode'");
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Pembelian', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Pembelian', 'danger');
        }
        header("Location: ../office/masuk");
    }
}

if(isset($_GET['hapus'])){
    $inv = $_GET['hapus'];
    $kode = $_GET['kode'];
    $qty = $_GET['qty'];
    
    $brg = myquery("SELECT * FROM gudang WHERE kode='$kode'");
    $upStok = intval($brg[0]['stok']) - intval($qty);
    
    mysqli_query($conn, "UPDATE gudang SET stok=" . $upStok . " WHERE kode='$kode'");
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE inv='$inv'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Pembelian', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Pembelian', 'danger');
    }
    header("Location: ../office/masuk");
}
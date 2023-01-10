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

$table = 'terpakai';

if(isset($_GET['getKeluar'])){
    $id = $_GET['getKeluar'];
    if($_GET['kel'] == 'Terpakai') {
        $tab = 'terpakai';
    }else{
        $tab = 'terbuang';
    }
    $query = "SELECT * FROM " . $tab . " WHERE id='$id'";
    echo json_encode(myquery($query));
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $outlet = $u['kode'];
        $tanggal = $_POST['inputKeluarTanggal'];
        $keluar = $_POST['inputKeluarKeluar'];
        $ket = $_POST['inputKeluarKet'];
        $kode = $_POST['inputKeluarKode'];
        $barang = $_POST['inputKeluarBarang'];
        $jenis = $_POST['inputKeluarJenis'];
        $qty = $_POST['inputKeluarQty'];
        $note = $_POST['inputKeluarNote'];
        $user = $u['nama'];
        if($keluar == 'Terpakai'){
            $tab = 'terpakai';
        }else{
            $tab = 'terbuang';
        }
        $query = "INSERT INTO " . $tab . " VALUES(
            '', 
            '$outlet', 
            '$tanggal', 
            '$keluar', 
            '$ket', 
            '$kode', 
            '$barang', 
            '$jenis', 
            '$qty', 
            '$note', 
            '$user'
        )";

        $brg = myquery("SELECT * FROM dapur WHERE kode='$kode' AND outlet='$outlet'");
        if($brg[0]['stok'] == 0){
            $upStok = $qty;
        }else{
            $upStok = $brg[0]['stok'] - $qty;
        }

        mysqli_query($conn, "UPDATE dapur SET stok='$upStok' WHERE kode='$kode' AND outlet='$outlet'");
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Outlet', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Outlet', 'danger');
        }
        header("Location: ../outlet/keluar");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['inputKeluarId'];
        $outlet = $u['kode'];
        $tanggal = $_POST['inputKeluarTanggal'];
        $keluar = $_POST['inputKeluarKeluar'];
        $ket = $_POST['inputKeluarKet'];
        $kode = $_POST['inputKode'];
        $barang = $_POST['inputKeluarBarang'];
        $jenis = $_POST['inputKeluarJenis'];
        $qty = $_POST['inputKeluarQty'];
        $qtyEx = $_POST['inputKeluarQtyEx'];
        $note = $_POST['inputKeluarNote'];
        $user = $u['nama'];
        if($keluar == 'Terpakai'){
            $tab = 'terpakai';
        }else{
            $tab = 'terbuang';
        }
        $query = "UPDATE " . $tab . " SET
            outlet = '$outlet', 
            tanggal = '$tanggal', 
            keluar = '$keluar', 
            ket = '$ket', 
            kode = '$kode', 
            barang = '$barang', 
            jenis = '$jenis', 
            qty = '$qty', 
            note = '$note', 
            user = '$user'
        WHERE id = '$id'";
    
        $brg = myquery("SELECT * FROM dapur WHERE kode='$kode' AND outlet='$outlet'");
        $upStok = $qtyEx + $brg[0]['stok'] - $qty;
        
        mysqli_query($conn, "UPDATE dapur SET stok=" . $upStok . " WHERE kode='$kode' AND outlet='$outlet'");
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Outlet', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Outlet', 'danger');
        }
        header("Location: ../outlet/keluar");
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $kode = $_GET['kode'];
    $qty = $_GET['qty'];
    $kel = $_GET['kel'];
    $outlet = $u['kode'];

    $brg = myquery("SELECT * FROM dapur WHERE kode='$kode' AND outlet='$outlet'");
    $upStok = $brg[0]['stok'] + $qty;

    mysqli_query($conn, "UPDATE dapur SET stok='$upStok' WHERE kode='$kode' AND outlet='$outlet'");
    if($kel == 'Terpakai'){
        $tab = 'terpakai';
    }else{
        $tab = 'terbuang';
    }
    mysqli_query($conn, "DELETE FROM " . $tab . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Outlet', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Outlet', 'danger');
    }
    header("Location: ../outlet/keluar");
}
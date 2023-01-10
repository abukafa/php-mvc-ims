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

if(isset($_GET['getListItem'])){
    $outlet = $u['kode'];
    $query = "SELECT pengiriman.*, dapur.harga, penerimaan.id as idd FROM pengiriman JOIN dapur ON pengiriman.kode=dapur.kode AND pengiriman.outlet=dapur.outlet LEFT JOIN penerimaan ON pengiriman.id=penerimaan.id WHERE pengiriman.outlet='$outlet' AND penerimaan.id IS NULL ORDER BY pengiriman.id, pengiriman.barang";
    echo json_encode(myquery($query));
    // echo $query;
}

if(isset($_GET['getItem'])){
    $id = $_GET['getItem'];
    $query = "SELECT * FROM pengiriman WHERE id=" . $id;
    echo json_encode(myquery($query));
    // echo $query;
}

if(isset($_GET['getConv'])){
    $kode = $_GET['getConv'];
    $outlet = $_GET['outlet'];
    $query = "SELECT * FROM dapur WHERE outlet='$outlet' AND kode='$kode'";
    echo json_encode(myquery($query));
    // echo $query;
}

if(isset($_GET['getTerima'])){
    $id = $_GET['getTerima'];
    $query = "SELECT * FROM penerimaan WHERE id=" . $id;
    echo json_encode(myquery($query));
    // echo $query;
}

$table = 'penerimaan';

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $id = $_POST['terimaId'];
        $inv = $_POST['terimaInv'];
        $tanggal = $_POST['terimaTanggal'];
        $pengirim = $_POST['terimaPengirim'];
        $outlet = $u['kode'];
        $kode = $_POST['terimaKode'];
        $barang = $_POST['terimaNama'];
        $jenis = $_POST['terimaJenis'];
        $satuan = $_POST['terimaSatuan'];
        $qty = $_POST['terimaQty'];
        $terima = $_POST['terimaTerima'];
        $conv = $_POST['terimaConv'];
        $byk = $_POST['terimaBanyak'];
        $harga = $_POST['terimaHarga'];
        $jumlah = $_POST['terimaJumlah'];
        $suplier = $_POST['terimaSuplier'];
        $note = $_POST['terimaNote'];
        $user = $u['nama'];

        $brg = myquery("SELECT * FROM dapur WHERE kode='$kode' AND outlet='$outlet'");
        // $byk = $terima * $conv;
        if($brg[0]['stok'] == 0){
            $upStok = $byk;
        }else{
            $upStok = $brg[0]['stok'] + $byk;
        }
        $query = "INSERT INTO " . $table . " VALUES(
            '$id', 
            '$inv', 
            '$tanggal', 
            '$pengirim', 
            '$outlet', 
            '$kode', 
            '$barang', 
            '$jenis', 
            '$satuan', 
            '$qty', 
            '$terima', 
            '$conv', 
            '$harga', 
            '$jumlah', 
            '$suplier', 
            '$note', 
            '$user'
        )";

        mysqli_query($conn, "UPDATE dapur SET stok='$upStok' WHERE kode='$kode' AND outlet='$outlet'");
        mysqli_query($conn, "UPDATE pengiriman SET note='DITERIMA' WHERE id='$id'");
        mysqli_query($conn, $query);
        // $cek = mysqli_query($conn, $query . "; UPDATE dapur SET stok='$upStok' WHERE kode='$kode';");
        // var_dump($cek);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Outlet', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Outlet', 'danger');
        }
        header("Location: ../outlet/terima");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['id'];
        $inv = $_POST['terimaInv'];
        $tanggal = $_POST['terimaTanggal'];
        $pengirim = $_POST['terimaPengirim'];
        $outlet = $u['kode'];
        $kode = $_POST['terimaKode'];
        $barang = $_POST['terimaNama'];
        $jenis = $_POST['terimaJenis'];
        $satuan = $_POST['terimaSatuan'];
        $qty = $_POST['terimaQty'];
        $terima = $_POST['terimaTerima'];
        $conv = $_POST['terimaConv'];
        $byk = $_POST['terimaBanyak'];
        $bykEx = $_POST['terimaBanyakEx'];
        $harga = $_POST['terimaHarga'];
        $jumlah = $_POST['terimaJumlah'];
        $suplier = $_POST['terimaSuplier'];
        $note = $_POST['terimaNote'];
        $user = $u['nama'];
        $query = "UPDATE " . $table . " SET
            inv = '$inv', 
            tanggal = '$tanggal', 
            pengirim = '$pengirim', 
            outlet = '$outlet', 
            kode = '$kode', 
            barang = '$barang', 
            jenis = '$jenis', 
            satuan = '$satuan', 
            qty = '$qty', 
            terima = '$terima', 
            conv = '$conv', 
            harga = '$harga', 
            jumlah = '$jumlah', 
            suplier = '$suplier', 
            note = '$note', 
            user = '$user'
        WHERE id = '$id'";
    
        $brg = myquery("SELECT * FROM dapur WHERE kode='$kode' AND outlet='$outlet'");
        $upStok = $byk + $brg[0]['stok'] - $bykEx;
        
        mysqli_query($conn, "UPDATE dapur SET stok=" . $upStok . " WHERE kode='$kode' AND outlet='$outlet'");
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Outlet', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Outlet', 'danger');
        }
        header("Location: ../outlet/terima");
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $kode = $_GET['kode'];
    $qty = $_GET['qty'];
    $outlet = $u['kode'];

    $brg = myquery("SELECT * FROM dapur WHERE kode='$kode' AND outlet='$outlet'");
    $upStok = $brg[0]['stok'] - $qty;

    mysqli_query($conn, "UPDATE dapur SET stok='$upStok' WHERE kode='$kode' AND outlet='$outlet'");
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Outlet', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Outlet', 'danger');
    }
    header("Location: ../outlet/terima");
}

if(isset($_GET['stokOpname'])){
    $input = filter_input_array(INPUT_POST);
    if ($input['action'] == 'edit') {	
        $update_field='';
        if(isset($input['so'])) {
            $update_field.= "so='".$input['so']."'";
        }	
        if($update_field && $input['id']) {
            $id = $input['id'];
            $query = "UPDATE dapur SET $update_field WHERE id ='$id'";	
            mysqli_query($conn, $query);
        }
    }
}

if(isset($_GET['resetOpname'])){
    $outlet = $u['kode'];
    mysqli_query($conn, "UPDATE dapur SET so=0 WHERE outlet='$outlet'");	
        flasher('Data telah direset', 'Silahkan lakukan Stok Opname..', 'success');
        header("Location: ../outlet/so");
}
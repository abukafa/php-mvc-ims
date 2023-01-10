<?php 

require_once 'function.php';
session_start();

// barang yang terdaftar di gudang
if(isset($_GET['getListGudang'])){
    $query = 'SELECT gudang.kode, gudang.barang, gudang.stok, jenis.id FROM gudang LEFT JOIN jenis ON gudang.jenis=jenis.jenis ORDER BY jenis.id, gudang.barang';
    echo json_encode(myquery($query));
    // echo $query;
}

// barang yang belum terdaftar di gudang
if(isset($_GET['getListBarang'])){
    $query = 'SELECT barang.kode, barang.barang, jenis.id FROM barang JOIN jenis ON barang.jenis=jenis.jenis LEFT JOIN gudang ON barang.kode=gudang.kode WHERE gudang.kode IS NULL ORDER BY jenis.id, barang.barang';
    echo json_encode(myquery($query));
}

$table = 'gudang';

if(isset($_GET['getGudang'])){
    $kode = $_GET['getGudang'];
    $query = "SELECT * FROM " . $table . " WHERE kode='$kode'";
    echo json_encode(myquery($query));
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $kode = $_POST['inputGudangKode'];
        $barang = $_POST['inputGudangNama'];
        $jenis = $_POST['inputGudangJenis'];
        $satuan = $_POST['inputGudangSatuan'];
        $harga = $_POST['inputGudangHarga'];
        $jual = $_POST['inputGudangJual'];
        $conv = $_POST['inputGudangConv'];
        $stok = $_POST['inputGudangStok'];
        $minim = $_POST['inputGudangMinim'];
        $so = 0;
        $suplier = $_POST['inputGudangSuplier'];
        $note = $_POST['inputGudangNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '$kode', 
            '$barang', 
            '$jenis', 
            '$satuan', 
            '$harga', 
            '$jual', 
            '$conv', 
            '$stok', 
            '$minim', 
            '$so', 
            '$suplier', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Gudang', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Gudang', 'danger');
        }
        header("Location: ../office/gudang");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $kode = $_POST['inputKode'];
        $barang = $_POST['inputGudangNama'];
        $jenis = $_POST['inputGudangJenis'];
        $satuan = $_POST['inputGudangSatuan'];
        $harga = $_POST['inputGudangHarga'];
        $jual = $_POST['inputGudangJual'];
        $conv = $_POST['inputGudangConv'];
        $stok = $_POST['inputGudangStok'];
        $minim = $_POST['inputGudangMinim'];
        $so = 0;
        $suplier = $_POST['inputGudangSuplier'];
        $note = $_POST['inputGudangNote'];
        $query = "UPDATE " . $table . " SET
            barang = '$barang', 
            jenis = '$jenis', 
            satuan = '$satuan', 
            harga = '$harga', 
            jual = '$jual', 
            conv = '$conv', 
            stok = '$stok', 
            minim = '$minim', 
            so = '$so', 
            suplier = '$suplier', 
            note = '$note'
        WHERE kode = '$kode'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Gudang', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Gudang', 'danger');
        }
        header("Location: ../office/gudang");
    }
}

// IMPORT SEMUA BARANG BLM TERDAFTAR DARI TABEL BARANG
if(isset($_GET['import'])){
    $brg="SELECT barang.* FROM barang LEFT JOIN gudang ON barang.kode=gudang.kode WHERE gudang.kode IS NULL";
    $barang=myquery($brg);
    $query = "INSERT INTO gudang VALUES ('".$barang[0]['kode']."','".$barang[0]['barang']."','".$barang[0]['jenis']."','".$barang[0]['satuan']."','','','".$barang[0]['conv']."','0','0','0','".$barang[0]['suplier']."','-')";
    foreach(array_slice($barang,1) as $b) :
        $query .= ", ('".$b['kode']."','".$b['barang']."','".$b['jenis']."','".$b['satuan']."','','','".$b['conv']."','0','0','0','".$b['suplier']."','-') ";
    endforeach;
    if(myNumRow($brg) > 0){
        mysqli_query($conn, $query);
        if(mysqli_affected_rows($conn) > 0){
            $count=mysqli_affected_rows($conn);
            flasher($count . ' Data Berhasil Ditambah', 'Jangan Lupa Isi Stok Minimum & Conversi', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Gudang', 'danger');
        }
    }else{
        flasher('Data Gagal Ditambah', 'ke Database Gudang', 'danger');
    }
    header("Location: ../office/gudang");
}

if(isset($_GET['hapus'])){
    $kode = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE kode='$kode'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database gudang', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database gudang', 'danger');
    }
    header("Location: ../office/gudang");
}

if(isset($_GET['stokOpname'])){
    $input = filter_input_array(INPUT_POST);
    if ($input['action'] == 'edit') {	
        $update_field='';
        if(isset($input['so'])) {
            $update_field.= "so='".$input['so']."'";
        }	
        if($update_field && $input['id']) {
            $kode = $input['id'];
            $query = "UPDATE gudang SET $update_field WHERE kode ='$kode'";	
            mysqli_query($conn, $query);
        }
    }
}

if(isset($_GET['resetOpname'])){
    mysqli_query($conn, "UPDATE gudang SET so=0");	
        flasher('Data telah direset', 'Silahkan lakukan Stok Opname..', 'success');
        header("Location: ../office/so");
}

if(isset($_GET['cariOpname'])){
    echo 'ok';
}
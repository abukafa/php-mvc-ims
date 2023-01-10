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

// barang yang terdaftar di Dapur
if(isset($_GET['getListDapur'])){
    $outlet = $_GET['getListDapur'];
    $query = "SELECT dapur.kode, dapur.barang, dapur.stok, jenis.id FROM dapur LEFT JOIN jenis ON dapur.jenis=jenis.jenis WHERE dapur.outlet='$outlet' ORDER BY jenis.id, dapur.barang";
    echo json_encode(myquery($query));
    // echo $query;
}

// barang yang belum terdaftar di Dapur
if(isset($_GET['getListBarang'])){
    $outlet = $u['kode'];
    $query = "SELECT barang.kode, barang.barang, jenis.id FROM barang JOIN jenis ON barang.jenis=jenis.jenis LEFT JOIN dapur ON barang.kode=dapur.kode AND dapur.outlet='$outlet' WHERE dapur.kode IS NULL ORDER BY jenis.id, barang.barang";
    echo json_encode(myquery($query));
    // echo 'ok';
}

$table = 'dapur';

if(isset($_GET['getDapur'])){
    $kode = $_GET['getDapur'];
    $query = "SELECT * FROM " . $table . " WHERE kode='$kode' AND outlet=" . $u['kode'];
    echo json_encode(myquery($query));
}

if(isset($_GET['getDapurById'])){
    $id = $_GET['getDapurById'];
    $query = "SELECT * FROM " . $table . " WHERE id=" . $id;
    echo json_encode(myquery($query));
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $outlet = $_POST['inputOutlet'];
        $kode = $_POST['inputDapurKode'];
        $barang = $_POST['inputDapurNama'];
        $jenis = $_POST['inputDapurJenis'];
        $satuan = $_POST['inputDapurSatuan'];
        $conv = $_POST['inputDapurConv'];
        $harga = $_POST['inputDapurHarga'];
        $stok = $_POST['inputDapurStok'];
        $minim = $_POST['inputDapurMinim'];
        $so = 0;
        $suplier = $_POST['inputDapurSuplier'];
        $note = $_POST['inputDapurNote'];
        $user = $u['nama'];
        $query = "INSERT INTO " . $table . " VALUES(
            '', 
            '$outlet', 
            '$kode', 
            '$barang', 
            '$jenis', 
            '$satuan', 
            '$conv', 
            '$harga', 
            '$stok', 
            '$minim', 
            '$so', 
            '$suplier', 
            '$note', 
            '$user' 
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Dapur', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Dapur', 'danger');
        }
        header("Location: ../outlet/dapur");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['inputId'];
        $outlet = $_POST['inputOutlet'];
        $kode = $_POST['inputKode'];
        $barang = $_POST['inputDapurNama'];
        $jenis = $_POST['inputDapurJenis'];
        $satuan = $_POST['inputDapurSatuan'];
        $conv = $_POST['inputDapurConv'];
        $harga = $_POST['inputDapurHarga'];
        $stok = $_POST['inputDapurStok'];
        $minim = $_POST['inputDapurMinim'];
        $so = 0;
        $suplier = $_POST['inputDapurSuplier'];
        $note = $_POST['inputDapurNote'];
        $user = $u['nama'];
        $query = "UPDATE " . $table . " SET
            outlet = '$outlet', 
            kode = '$kode', 
            barang = '$barang', 
            jenis = '$jenis', 
            satuan = '$satuan', 
            conv = '$conv', 
            harga = '$harga', 
            stok = '$stok', 
            minim = '$minim', 
            so = '$so', 
            suplier = '$suplier', 
            note = '$note', 
            user = '$user'
        WHERE id = '$id'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Dapur', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Dapur', 'danger');
        }
        header("Location: ../outlet/dapur");
    }
}

// IMPORT SEMUA BARANG BLM TERDAFTAR DARI TABEL BARANG
if(isset($_GET['import'])){
    $user = $u['nama'];
    $outlet = $u['kode'];
    $brg="SELECT barang.* FROM barang LEFT JOIN dapur ON barang.kode=dapur.kode AND dapur.outlet='$outlet' WHERE dapur.kode IS NULL";
    $barang=myquery($brg);
    $query = "INSERT INTO dapur VALUES ('','".$outlet."','".$barang[0]['kode']."','".$barang[0]['barang']."','".$barang[0]['jenis']."','".$barang[0]['satuan']."','".$barang[0]['conv']."','0','0','0','0','".$barang[0]['suplier']."','-','".$user."')";
    foreach(array_slice($barang,1) as $b) :
        $query .= ", ('','".$outlet."','".$b['kode']."','".$b['barang']."','".$b['jenis']."','".$b['satuan']."','".$b['conv']."','0','0','0','0','".$b['suplier']."','-','".$user."') ";
    endforeach;
    if(myNumRow($brg) > 0){
        mysqli_query($conn, $query);
        if(mysqli_affected_rows($conn) > 0){
            $count=mysqli_affected_rows($conn);
            flasher($count . ' Data Berhasil Ditambah', 'Jangan Lupa Isi Stok Minimum & Conversi', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Outlet', 'danger');
        }
    }else{
        flasher('Data Gagal Ditambah', 'ke Database Outlet', 'danger');
    }
    header("Location: ../outlet/dapur");
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Dapur', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Dapur', 'danger');
    }
    header("Location: ../outlet/dapur");
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

if(isset($_GET['cariOpname'])){
    echo 'ok';
}
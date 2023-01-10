<?php 

require_once 'function.php';
session_start();

$table = 'barang';

if(isset($_GET['getListBarang'])){
    $query = 'SELECT barang.*, jenis.id, jenis.jenis FROM barang LEFT JOIN jenis ON barang.jenis=jenis.jenis ORDER BY jenis.id, barang.barang';
    echo json_encode(myquery($query));
}

if(isset($_GET['getBarang'])){
    $kode = $_GET['getBarang'];
    $query = "SELECT * FROM " . $table . " WHERE kode='$kode'";
    echo json_encode(myquery($query));
}

if(isset($_GET['cekKodeBarang'])){
    $kode = $_GET['cekKodeBarang'];
    $query = "SELECT * FROM " . $table . " WHERE kode='$kode'";
    echo myNumRow($query);
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $kode = $_POST['inputBarangKode'];
        $barang = $_POST['inputBarangNama'];
        $jenis = $_POST['inputBarangJenis'];
        $satuan = $_POST['inputBarangSatuan'];
        $conv = $_POST['inputBarangConv'];
        $suplier = $_POST['inputBarangSuplier'];
        $note = $_POST['inputBarangNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '$kode', 
            '$barang', 
            '$jenis', 
            '$satuan', 
            '$conv', 
            '$suplier', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Barang', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Barang', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $kode = $_POST['inputBarangKode'];
        $barang = $_POST['inputBarangNama'];
        $jenis = $_POST['inputBarangJenis'];
        $satuan = $_POST['inputBarangSatuan'];
        $conv = $_POST['inputBarangConv'];
        $suplier = $_POST['inputBarangSuplier'];
        $note = $_POST['inputBarangNote'];
        $query = "UPDATE " . $table . " SET
            barang = '$barang', 
            jenis = '$jenis', 
            satuan = '$satuan', 
            conv = '$conv', 
            suplier = '$suplier', 
            note = '$note'
        WHERE kode = '$kode'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Barang', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Barang', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['hapus'])){
    $kode = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE kode='$kode'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Barang', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Barang', 'danger');
    }
    header("Location: ../office/master");
}
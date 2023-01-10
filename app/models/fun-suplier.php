<?php 

require_once 'function.php';
session_start();

$table = 'suplier';

if(isset($_GET['getListSuplier'])){
    $query = 'SELECT * FROM suplier ORDER BY suplier';
    echo json_encode(myquery($query));
}

if(isset($_GET['getSuplier'])){
    $id = $_GET['getSuplier'];
    $query = "SELECT * FROM " . $table . " WHERE id=" . $id;
    echo json_encode(myquery($query));
}

if(isset($_GET['cekNamaSuplier'])){
    $suplier = $_GET['cekNamaSuplier'];
    $query = "SELECT * FROM " . $table . " WHERE suplier='$suplier'";
    echo myNumRow($query);
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $suplier = $_POST['inputSuplierNama'];
        $alamat = $_POST['inputSuplierAlamat'];
        $telepon = $_POST['inputSuplierTelepon'];
        $jenis = $_POST['inputSuplierJenis'];
        $note = $_POST['inputSuplierNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '', 
            '$suplier', 
            '$alamat', 
            '$telepon', 
            '$jenis', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Suplier', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Suplier', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['inputSuplierId'];
        $suplier = $_POST['inputSuplierNama'];
        $alamat = $_POST['inputSuplierAlamat'];
        $telepon = $_POST['inputSuplierTelepon'];
        $jenis = $_POST['inputSuplierJenis'];
        $note = $_POST['inputSuplierNote'];
        $query = "UPDATE " . $table . " SET
            suplier = '$suplier', 
            alamat = '$alamat', 
            telepon = '$telepon', 
            jenis = '$jenis', 
            note = '$note'
        WHERE id = '$id'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Supplier', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Supplier', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Supplier', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Supplier', 'danger');
    }
    header("Location: ../office/master");
}
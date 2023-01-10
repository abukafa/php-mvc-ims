<?php 

require_once 'function.php';
session_start();

$table = 'satuan';

if(isset($_GET['getListSatuan'])){
    $query = 'SELECT * FROM satuan ORDER BY satuan';
    echo json_encode(myquery($query));
}

if(isset($_GET['getSatuan'])){
    $id = $_GET['getSatuan'];
    $query = 'SELECT * FROM ' . $table . ' WHERE id=' . $id;
    echo json_encode(myquery($query));
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $nama = $_POST['inputSatuanNama'];
        $note = $_POST['inputSatuanNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '', 
            '$nama', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Satuan', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Satuan', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['inputSatuanId'];
        $nama = $_POST['inputSatuanNama'];
        $note = $_POST['inputSatuanNote'];
        $query = "UPDATE " . $table . " SET
            satuan = '$nama', 
            note = '$note'
        WHERE id = '$id'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Satuan', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Satuan', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Satuan', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Satuan', 'danger');
    }
    header("Location: ../office/master");
}
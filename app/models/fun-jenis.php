<?php 

require_once 'function.php';
session_start();

$table = 'jenis';

if(isset($_GET['getListJenis'])){
    $query = 'SELECT * FROM ' . $table . ' ORDER BY id';
    echo json_encode(myquery($query));
}

if(isset($_GET['getJenis'])){
    $id = $_GET['getJenis'];
    $query = 'SELECT * FROM ' . $table . ' WHERE id=' . $id;
    echo json_encode(myquery($query));
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $nama = $_POST['inputJenisNama'];
        $note = $_POST['inputJenisNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '', 
            '$nama', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Jenis', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Jenis', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['inputJenisId'];
        $nama = $_POST['inputJenisNama'];
        $note = $_POST['inputJenisNote'];
        $query = "UPDATE " . $table . " SET
            jenis = '$nama', 
            note = '$note'
        WHERE id = '$id'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Jenis', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Jenis', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Jenis', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Jenis', 'danger');
    }
    header("Location: ../office/master");
}
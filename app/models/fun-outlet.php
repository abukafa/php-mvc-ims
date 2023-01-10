<?php 

require_once 'function.php';
session_start();

$table = 'outlet';

if(isset($_GET['getListOutlet'])){
    $query = "SELECT * FROM " . $table . " ORDER BY kode";
    echo json_encode(myquery($query));
}

if(isset($_GET['getOutlet'])){
    $kode = $_GET['getOutlet'];
    $query = "SELECT * FROM " . $table . " WHERE kode='$kode'";
    echo json_encode(myquery($query));
}

if(isset($_GET['cekKodeOutlet'])){
    $kode = $_GET['cekKodeOutlet'];
    $query = "SELECT * FROM " . $table . " WHERE kode='$kode'";
    echo myNumRow($query);
    // echo $kode;
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $kode = $_POST['inputOutletKode'];
        $outlet = $_POST['inputOutletNama'];
        $jenis = $_POST['inputOutletJenis'];
        $alamat = $_POST['inputOutletAlamat'];
        $kordinat = $_POST['inputOutletKordinat'];
        $kepala = $_POST['inputOutletKepala'];
        $status = $_POST['inputOutletStatus'];
        $note = $_POST['inputOutletNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '$kode', 
            '$outlet', 
            '$jenis', 
            '$alamat', 
            '$kordinat', 
            '$kepala', 
            '$status', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Outlet', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Outlet', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $kode = $_POST['inputOutletKode'];
        $outlet = $_POST['inputOutletNama'];
        $jenis = $_POST['inputOutletJenis'];
        $alamat = $_POST['inputOutletAlamat'];
        $kordinat = $_POST['inputOutletKordinat'];
        $kepala = $_POST['inputOutletKepala'];
        $status = $_POST['inputOutletStatus'];
        $note = $_POST['inputOutletNote'];
        $query = "UPDATE " . $table . " SET
            outlet = '$outlet', 
            jenis = '$jenis', 
            alamat = '$alamat', 
            kordinat = '$kordinat', 
            kepala = '$kepala',
            status = '$status', 
            note = '$note'
        WHERE kode = '$kode'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Outlet', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Outlet', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['hapus'])){
    $kode = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE kode='$kode'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Outlet', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Outlet', 'danger');
    }
    header("Location: ../office/master");
}
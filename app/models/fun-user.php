<?php 

require_once 'function.php';
session_start();

$table = 'user';

if(isset($_GET['getUser'])){
    $id = $_GET['getUser'];
    $query = "SELECT * FROM " . $table . " WHERE id='$id'";
    echo json_encode(myquery($query));
}

if(isset($_GET['login'])){
    if(isset($_POST['login'])){
        $uname=$_POST['uname'];
        $pass=$_POST['pass'];
        $result = mysqli_query($conn, "select * from ". $table ." where uname='$uname'");
        if( mysqli_num_rows($result) === 1 ){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row["pass"])){
                $_SESSION['uname']=$uname;
                    if($row['kode'] == 'Office'){
                        header('Location:../office/index');
                    }else{
                        header('Location:../outlet/index');
                    }
            }else{
                flasher('Password', 'nya diperiksa Lagi ya..!', 'warning');
                header('Location:../../');
            }
        }else{
            flasher('Username', 'nya Belum Terdaftar tuh..!', 'danger');
            header('Location:../../');
        }  
    }
}

if(isset($_GET['logout'])) {
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("location:../../");
    exit;
}

if(isset($_GET['pass'])) {
    if(isset($_GET['pass'])) {
        $user=$_POST['uname'];
        $lama=$_POST['lama'];
        $baru=$_POST['baru'];
        $lagi=$_POST['lagi'];
        $result = mysqli_query($conn, "select * from " . $table . " where uname='$user'");
        if( mysqli_num_rows($result) === 1 ){
            $row = mysqli_fetch_assoc($result);
            if($baru==$lagi && $lama!==$baru){
                if(password_verify($lama, $row["pass"])){
                    $baru = password_hash($baru, PASSWORD_DEFAULT);
                    mysqli_query($conn, "update ". $table ." set pass='$baru' where uname='$user'");
                    flasher('Berhasil', 'diubah', 'success');
                }else{
                    flasher('Gagal', 'diubah', 'danger');
                }
            }else{
                flasher('Gagal', 'diubah', 'warning');
            }
            header('Location:../office/user?pass');
        }
    }
}

if(isset($_GET['cekUname'])){
    $word = $_GET['cekUname'];
    $query = "SELECT * FROM ". $table ." WHERE uname='$word'";
    echo myNumRow($query);
}

if(isset($_GET['tambah'])){
    if(isset($_POST['save'])){
        $nama = $_POST['inputUserNama'];
        $uname = $_POST['inputUserUname'];
        $pass = password_hash($_POST['inputUserPass'], PASSWORD_DEFAULT);
        $kode = $_POST['inputUserKode'];
        $cabang = $_POST['inputUserCabang'];
        $jabatan = $_POST['inputUserJabatan'];
        $akses = $_POST['inputUserAkses'];
        $note = $_POST['inputUserNote'];
        $query = "INSERT INTO " . $table . " VALUES(
            '', 
            '$uname', 
            '$pass', 
            '$nama', 
            '$kode', 
            '$cabang', 
            '$jabatan', 
            '$akses', 
            '$note'
        )";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Ditambah', 'ke Database Pengguna', 'success');
        }else{
            flasher('Data Gagal Ditambah', 'ke Database Pengguna', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['ubah'])){
    if(isset($_POST['save'])){
        $id = $_POST['inputUserId'];
        $nama = $_POST['inputUserNama'];
        $uname = $_POST['inputUserUname'];
        $kode = $_POST['inputUserKode'];
        $cabang = $_POST['inputUserCabang'];
        $jabatan = $_POST['inputUserJabatan'];
        $akses = $_POST['inputUserAkses'];
        $note = $_POST['inputUserNote'];
        $query = "UPDATE " . $table . " SET
            uname = '$uname', 
            nama = '$nama', 
            kode = '$kode', 
            cabang = '$cabang', 
            jabatan = '$jabatan', 
            akses = '$akses', 
            note = '$note'
        WHERE id = '$id'";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            flasher('Data Berhasil Diubah', 'di Database Pengguna', 'success');
        }else{
            flasher('Data Gagal Diubah', 'di Database Pengguna', 'danger');
        }
        header("Location: ../office/master");
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM " . $table . " WHERE id='$id'");

    if(mysqli_affected_rows($conn) > 0){
        flasher('Data Berhasil Dihapus', 'dari Database Pengguna', 'success');
    }else{
        flasher('Data Gagal Dihapus', 'dari Database Pengguna', 'danger');
    }
    header("Location: ../office/master");
}

// FUNGSI USER SQL -------------------------------------------------------------------------------------
if(isset($_GET['userSQL'])){
    if($_GET['userSQL']=="edit"){
        global $conn;
        $userQuery = $_POST['query'];
        $q = mysqli_query($conn, $userQuery);
        if($q){
            header("Location: ../office/user?userSQL");
            flasher('Your SQL query has been ', 'executed successfully', 'success');
        }else{
            header("Location: ../office/user?userSQL");
            flasher('Your SQL query not executed ', 'check it back dude!', 'danger');
        }
    }
}

if(isset($_GET['getListColumn'])){
    $tab = $_GET['getListColumn'];
    $query = "SHOW COLUMNS FROM " . $tab;
    echo json_encode(myquery($query));
    // echo $query;
}
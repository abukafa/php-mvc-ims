<?php
require_once 'config.php';

// FUNGSI DATA QUERY ROWS ------------------------------------------------------------------------------
function myquery($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// FUNGSI QUERY NUM ROWS -------------------------------------------------------------------------------
function myNumRow($query){
    global $conn;
    $myQue = mysqli_query($conn, $query);
    $numRow = mysqli_num_rows($myQue);
    return $numRow;
}

// FUNGSI HITUNG UMUR ----------------------------------------------------------------------------------
function umur($tanggal, $th, $bl, $hr){
    $lahir = new DateTime($tanggal);
    $today = new DateTime("today");
    if ($lahir >= $today){
        exit("0");
    }
    $y = $today->diff($lahir)->y;
    $m = $today->diff($lahir)->m;
    $d = $today->diff($lahir)->d;
    return $y . $th . $m . $bl . $d . $hr;
}

// FUNGSI FORMAT TANGGAL INDONESIA ------- | H:i --------------------------------------------------------------
function indo_date($timestamp = '', $date_format = 'l, j F Y', $suffix = '') { 
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Aha',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Ahad',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}

// SESI USER -------------------------------------------------------------------------------------------
// function user(){
//     $uname=$_SESSION['uname'];
//     $user = myquery("select * from user where uname='$uname'");
//     return $user;
// }

// FUNGSI GENERATE AUTO NUMBER -------------------------------------------------------------------------
function autoCode($table, $field, $init){
    $qry = myquery("SELECT max(". $field .") as myFil FROM ". $table);
    $row = $qry[0];
    $length = strlen($row['myFil']);
    if($row['myFil'] == ""){
        $angka = 100000;
    }else{
        $angka = substr($row['myFil'], strlen($init));
    } 
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for($i=1; $i<=($length-strlen($init)-strlen($angka)); $i++){
        $tmp=$tmp."0";
    }
    return $init.$tmp.$angka;
}

// FUNGSI CARI DATABASE --------------------------------------------------------------------------------
function cari($query, $cari){
    return myquery($query);
}

// FUNGSI PAGINATION -----------------------------------------------------------------------------------
function pagination($data, $query){
    global $conn;
    $jumlahData = count(myquery($query));
    $jumlahHal = ceil($jumlahData / $data);
    $halAktif = ( isset($_GET['page']) ) ? $_GET['page'] : 1 ;
    $awalData = ( $data * $halAktif ) - $data;
    $pagi = [ $data, $jumlahHal, $jumlahHal, $halAktif, $awalData, $jumlahData ] ;
    return $pagi;
}

// FUNGSI SERIAL NUMBER -----------------------------------------------------------------------------------
function generate_num() {
    $chars = "003232303232023232023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

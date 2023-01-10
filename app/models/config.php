<?php 

// Konesi Database
$conn = mysqli_connect("localhost","root","","jupri");

// FUNGSI POPUP MESSAGE -------------------------------------------------------------------------------
function flasher($pesan, $ket, $tipe){
    $_SESSION['flash'] = [
        'pesan' => $pesan,
        'ket' => $ket,
        'tipe' => $tipe     
    ];
}
function flash(){
    if(isset($_SESSION['flash'])){
        echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
            <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['ket'] .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

        // echo
        // '<script>
        //     swal("' . $_SESSION['flash']['pesan'] . '", "' . $_SESSION['flash']['ket'] . '", "' . $_SESSION['flash']['tipe'] . '")
        // </script>';

        // hilangkan ketika reload
        unset($_SESSION['flash']);
    }
}
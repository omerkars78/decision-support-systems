<?php
//baglanti.php
$con = mysqli_connect("localhost","root","","karar_destek_sistemleri_proje");

    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $con->set_charset("utf8");
?>

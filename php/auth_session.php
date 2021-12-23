<?php
    session_start();
    if(!isset($_SESSION["email"])) {
        header("Location: ../html/signin_1.php");
        exit();
    }
?>
<?php
    SESSION_START();
    include "../assets/connect.php";

    $id = $_GET["id"];

    if(($_SESSION['keranjang'][$id])>49)
    {
        $_SESSION['keranjang'][$id]-=1;
    }
    if(($_SESSION['keranjang'][$id])==49)
    {
        unset($_SESSION['keranjang'][$id]);
    }
    echo "<script>location='../marketplace/keranjang.php';</script>";
?>
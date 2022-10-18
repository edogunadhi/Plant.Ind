<?php
    SESSION_START();
    include '../assets/connect.php';

    $id = $_GET['id'];
    $seller = $_SESSION['admin']['adminId'];

    $conn->query("UPDATE `detailservices` SET `sellerid` = '$seller' WHERE `detailservices`.`transactionid` = $id");
    $conn->query("UPDATE `headerservices` SET `adminId` = '$seller' WHERE `headerservices`.`id` = $id");
    
    echo"<script>alert('Transaksi telah ditambahkan ke daftar penjualan anda')</script>";
    echo"<script>location='index.php?halaman=pembelian'</script>";
?>
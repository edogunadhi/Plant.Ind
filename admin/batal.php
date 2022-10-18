<?php
    include '../assets/connect.php';
    $id = $_GET['id'];

    $conn->query("UPDATE `detailservices` SET `sellerid` = '0' WHERE `detailservices`.`transactionid` = $id");

    echo"<script>alert('Transaksi anda telah dibatalkan!')</script>";
    echo"<script>location='index.php?halaman=daftar'</script>";
?>
<?php
    SESSION_START();
    include "../assets/connect.php";
    $id_pelanggan = $_GET['id'];
    $ambil = $conn->query("SELECT * FROM detailservices WHERE transactionid = '$id_pelanggan'");
    $pecah = $ambil->fetch_assoc();
    
    if(isset($_POST['kirim']))
    {
        $direktori = "../pembayaran/";
        $file_name = $_FILES['bukti']['name'];
        move_uploaded_file($_FILES['bukti']['tmp_name'],$direktori.$file_name);
        $pelanggan = $id_pelanggan;

        $conn->query("UPDATE headerservices SET buktipembayaran='$file_name' WHERE id = '$pelanggan'");

        $conn->query("UPDATE headerservices SET Status='PENDING' WHERE id = '$pelanggan'");

        echo"<script> location = 'pesanan.php'</script>";
    }
?>
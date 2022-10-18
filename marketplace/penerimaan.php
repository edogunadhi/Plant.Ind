<?php
    SESSION_START();
    include "../assets/connect.php";
    $id_pelanggan = $_GET['id'];
    $ambil = $conn->query("SELECT * FROM detailservices WHERE transactionid = '$id_pelanggan'");
    $pecah = $ambil->fetch_assoc();
    
    if(isset($_POST['kirim']))
    {
        $direktori = "../buktipenerimaan/";
        $file_name = $_FILES['pesanan']['name'];
        move_uploaded_file($_FILES['pesanan']['tmp_name'],$direktori.$file_name);
        $pelanggan = $id_pelanggan;

        $conn->query("UPDATE headerservices SET buktipenerimaan='$file_name' WHERE id = '$pelanggan'");

        echo"<script> location = 'riwayat.php'</script>";
    }
?>
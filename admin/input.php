<?php
    include '../assets/connect.php';
    $id = $_GET['id'];
    $resi = $_POST['resi'];

    $conn->query("UPDATE `headerservices` SET `resi` = '$resi' WHERE `headerservices`.`id` = $id");
    $conn->query("UPDATE `headerservices` SET `status` = 'TELAH DIKIRIM' WHERE `headerservices`.`id` = $id");

    echo"<script>alert('Resi berhasil diinput')</script>";
    echo"<script>location='index.php?halaman=pelanggan'</script>";
?>

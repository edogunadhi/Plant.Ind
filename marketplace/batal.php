<?php
    include '../assets/connect.php';

    $id = $_GET['id'];

    $conn->query("DELETE FROM `headerservices` WHERE `headerservices`.`id` = $id");
    
    echo "<script> alert('Pesanan telah dibatalkan') </script>";
    echo "<script>location='pesanan.php'</script>"
?>
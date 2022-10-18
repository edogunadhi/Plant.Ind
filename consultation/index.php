<?php
    SESSION_START();
    include "../assets/connect.php";
    if(isset($_SESSION['user']) || isset($_SESSION['admin']))
    {
        echo "<script>alert('WELCOME!!!')</script>";
    }
    else
    {
        echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
        echo "<script>location='../login/login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/konsultasi.css">
    <title>Consultation</title>
</head>
<body>
    <?php
        include('../assets/navbar.php');
    ?>
    <div class="background">
        <p class="judul">Plant Monitoring</p>
        <div class="container">
            <?php
                $sql = "SELECT * FROM buah";
                $query = mysqli_query ($conn, $sql);
                while($hasil = mysqli_fetch_object ($query)):
            ?>
            <div class="buah">
                <img src="../assets/shop/<?= $hasil->Gambar ?>">
                <p><?= $hasil->NamaBuah ?></p>
                <?= $hasil->gejala ?> Gejala
                <a href="../consultation/penyakit.php?id=<?= $hasil->BuahID ?>">Cek</a>
            </div>
            <?php
                endwhile;
            ?>
        </div>
    </div>
    <?php
        include('../assets/footer.php')
    ?>
</body>
</html>
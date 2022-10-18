<?php
  SESSION_START();
  include "../assets/connect.php";
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/home.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>Plant.Ind</title>
    </head>

    <body>
        <?php
            include '../assets/navbar.php';
        ?>

        <!-- Container Home -->
        <div class="home">
            <div class="left">
                <div class=container-left>
                    <p class="header">
                        Tempat yang Cocok <br> Untuk Buahmu
                    </p>
                    <p class="deskripsi">
                        Plant.Ind adalah sebuah platform untuk kamu dalam membeli buah, dan mengecek kesehatan tanaman buahmu
                    </p> 
                </div>
            </div>
            <div class="right">
                <img src="../assets/illustration.png" alt="illustrasi" height=100%>
            </div>
        </div>

        <div class="batas"></div>

        <!-- Container Toko -->
        <div class="toko">
            <div class="left">
                <a href="#">
                    <img src="../assets/market.png" alt="toko" height=100%>
                </a>
            </div>
            <div class="right">
                <div class="toko-right">
                    <p class="judul">
                        Belanja Hemat Langsung di Agent
                    </p>
                    <p class="penjelasan">
                        Belanja buah langsung di produsen/petani dengan harga yang lebih murah dan segar langsung dari kebun.
                    </p>
                    <div class="d-grid gap-2 d-md-block">
                        <?php
                            if(isset($_SESSION['user'])){
                        ?>
                            <a class="btn btn-outline-primary" href="../marketplace/shop.php" role="button">Toko</a>
                        <?php
                            }
                            elseif(isset($_SESSION['admin'])){
                        ?>
                            <a class="btn btn-outline-primary" href="../admin/index.php" role="button">Toko</a>
                        <?php
                            }
                            else
                            {
                        ?>
                            <a class="btn btn-outline-primary" href="../marketplace/shop.php" role="button">Toko</a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container Konsultasi -->
        <div class="konsultasi">
            <div class="left">
                <div class="konsultasi-left">
                    <p class="judul">
                        Periksa Kesehatan Tanamanmu
                    </p>
                    <p class="penjelasan">
                        Jaga tanamanmu agar tetap sehat dan terhindar dari berbagai penyakit. Segera periksa tanamanmu apabila ada sebuah kesalahan pada tanamanmu
                    </p>
                    <div class="d-grid gap-2 d-md-block">
                        <a class="btn btn-outline-primary" href="../consultation/index.php" role="button">Periksa</a>
                    </div>
                </div>
            </div>
            <div class="right">
                <a href="#">
                    <img src="../assets/maintenance.png" alt="maintenance" width=80%>
                </a>
            </div>
        </div>
    </body>
    <footer>
        <?php
            include '../assets/footer.php';
        ?>
    </footer>
</html>
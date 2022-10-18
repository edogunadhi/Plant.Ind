<?php
    SESSION_START();
    include "../assets/connect.php";
    if(!isset($_SESSION['user']))
    {
        echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
        echo "<script>location='../login/login.php';</script>";
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Tanaman</title>

    <link rel="stylesheet" href="../assets/css/shop.css">
    <link rel="stylesheet" href="../assets/jquery/jquery.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="../assets/jquery/jquery.js"></script>
    <script>
        $(function(){
            $('input[type="number"]').niceNumber();
        });
    </script>
    
</head>

<body>
    <!-- Navigation-->
    <?php
        include '../assets/navbar.php';
    ?>

    <!-- Header-->
    <header class="bg">
        <div class="judul" >
            <div class="text-center">
                <h1 class="font fw-bolder">Toko Plant.Ind</h1>
                <p class="text-muted">Tempat untuk belanja hasil tanaman</p>
            </div>
        </div>
    </header>
    <hr>

    <!-- Section-->
    <?php
        $sql = "SELECT * FROM buah";
        $query = mysqli_query ($conn, $sql);
    ?>
    <section>
        <div class="grid">
            <?php
                while($hasil = mysqli_fetch_object ($query)):
            ?>
            <div class="col">
                <div class="card">
                    <!-- Product image-->
                    <img class="card-img-top" src=../assets/shop/<?= $hasil->Gambar ?> alt="..." />
                    <!-- Product details-->
                    <div class="card-body">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?= $hasil->NamaBuah ?></h5>
                            <!-- Product price-->
                            <p class=harga>Rp. <?= number_format($hasil->Harga)?> / Kg
                        </div>
                    </div>
                    <!-- Product actions-->
                    <form action="tambah.php?id=<?= $hasil->BuahID ?>" method="POST">
                        <div class="box">
                            <input type="number" name="satuan" value="50" min="50">
                        </div>
                        <div class="beli border-top-0 bg-transparent">
                            <div class="text-center">
                                <button class="btn btn-outline-dark mt-auto">Beli</button>
                            </div>
                        </div>
                    </form>                
                </div>
            </div>
            <?php endwhile ?>
        </div>
    </section>

    <!-- Footer-->
    <?php
        include "../assets/footer.php";
    ?>
    
    <!--JS-->
    <script src="../assets/js/shop.js"></script>
</body>
</html>
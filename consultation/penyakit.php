<?php
    SESSION_START();
    include "../assets/connect.php";
    $iduser = $_SESSION['user']['userId'];
    $idbuah = $_GET['id'];
    if(!isset($_SESSION['user']))
    {
        echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
        echo "<script>location='../login/login.php';</script>";
    }
    $ambil = $conn->query("SELECT * FROM buah WHERE BuahId = '$idbuah'");
    $pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/penyakit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Penyakit</title>
</head>
<body>
    <?php
        include ('../assets/navbar.php');
    ?>
    <div class="judul">
        <img src="../assets/shop/<?= $pecah['Gambar'] ?>">
        <p><?= $pecah['NamaBuah'] ?></p>
    </div>
    <div class="kontainer">
        <?php
            $sql = "SELECT * FROM penyakit WHERE BuahId = '$idbuah'";
            $query = mysqli_query ($conn, $sql);
            while($hasil = mysqli_fetch_object ($query)):
        ?>
        <div class="penyakit">
            <img src="../assets/penyakit/<?= $hasil->gambar ?>">
            <p class="nama"><?= $hasil->penyakit ?></p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $hasil->id ?>">
            Cek
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop<?= $hasil->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><?= $hasil->penyakit ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="../assets/penyakit/<?= $hasil->gambar ?>" alt="">
                    <p>Gejala</p>
                    <div class="deskripsi">
                        <?= $hasil->gejala ?>
                    </div>
                    <p>Penyebab</p>
                    <div class="deskripsi">
                        <?= $hasil->penyebab ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Selesai</button>
                </div>
                </div>
            </div>
            </div>
        </div>
        <?php
            endwhile;
        ?>
    </div>
    <?php
        include ('../assets/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
<?php
    session_start();
    include '../assets/connect.php';

    $pelanggan = $_SESSION['user']['userId'];
    $ambil = $conn->query("SELECT * FROM user WHERE userId = '$pelanggan'");
    $pecah = $ambil->fetch_assoc();
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/profil.css">
    <title>Profil</title>
<body>
    <?php
        include "../assets/navbar.php"
    ?>

    <div class="home">
        <div class="profil">
            <img src="../assets/user.png">
            <p class='name'> <?= $pecah['username'] ?> </p>
            <p class="email"> <?= $pecah['email'] ?> </p>
            <a href="../marketplace/pesanan.php" class='riwayat'> Pesanan Berlangsung </a>
            <a href="riwayat.php" class='riwayat'> Riwayat Belanja </a>
        </div>
        <div class="data">
            <p class="judul">Profil</p>
            <form method="POST">
                <div class="form">
                    <div class="column1">
                        <div class="field">
                            Username
                            <input type="text" readonly value="<?= $pecah['username'] ?>" class="user">
                        </div>
                        <div class="field">
                            Nomor Telepon
                            <input type="text" name="telepon" value="<?= $pecah['telpon'] ?>">
                        </div>
                    </div>
                    <div class="column2">
                        <div class="field">
                            Email
                            <input type="text" name="email" value="<?= $pecah['email'] ?>">
                        </div>
                        <div class="field">
                            Alamat
                            <input type="text" name="alamat" value="<?= $pecah['alamat'] ?>">
                        </div>
                        <div class="field">
                            Kota
                            <select name="kota">
                                <option value="0">
                                    <?= $pecah['kota'] ?>
                                </option>
                            <?php
                                $ongkir = mysqli_query($conn, "SELECT ongkir.id,ongkir.kota,ongkir,kurir FROM ongkir");
                                while($pecah = $ongkir->fetch_assoc()):
                            ?>

                                <option value="<?= $pecah['id']?>">
                                    <?= $pecah['kota']?>
                                </option>

                                <?php endwhile ?>

                            </select>
                        </div>
                    </div>
                </div>
                <button name="perbarui" class="button"> Perbarui </button>
            </form>
            <?php
                if(isset($_POST['perbarui']))
                {
                    if($_POST['kota']==0)
                    {
                        $telponbaru = $_POST['telepon'];
                        $emailbaru = $_POST['email'];
                        $alamatbaru = $_POST['alamat'];
    
                        mysqli_query(
                                $conn, "UPDATE user SET 
                                        email = '$emailbaru',
                                        telpon = '$telponbaru',
                                        alamat = '$alamatbaru'
                                        WHERE userId = '$pelanggan';"  
                            );
                        echo "<script>alert('Data berhasil diupdate')</script>";
                        echo "<script>location='../login/profil.php;</script>";
                    }
                    else
                    {
                        $telponbaru = $_POST['telepon'];
                        $emailbaru = $_POST['email'];
                        $alamatbaru = $_POST['alamat'];
                        $kotabaru = $_POST['kota'];
                        
                        $ambillagi = mysqli_query($conn, "SELECT * FROM ongkir WHERE id = '$kotabaru'");
                        $arraykota = mysqli_fetch_assoc($ambillagi);
                        $namakota = $arraykota['kota'];
    
                        mysqli_query(
                                $conn, "UPDATE user SET 
                                        email = '$emailbaru',
                                        telpon = '$telponbaru',
                                        alamat = '$alamatbaru',
                                        kota = '$namakota'
                                        WHERE userId = '$pelanggan';"  
                            );
                        echo "<script>alert('Data berhasil diupdate')</script>";
                        echo "<script>location='../login/profil.php;</script>";
                    }
                }
            ?>
        </div>
    </div>
    </body>
</html>
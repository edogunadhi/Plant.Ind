<?php
    SESSION_START();
    include "../assets/connect.php";
    $iduser = $_SESSION['user']['userId'];
    if(!isset($_SESSION['user']))
    {
        echo "<script>location='../home/index.php';</script>";
    }

    $result = mysqli_query($conn, "SELECT * FROM user WHERE userId = '$iduser'");
    $hasil = mysqli_fetch_row($result);

    if(empty($_SESSION['keranjang']))
    {
        echo"<script>alert('Keranjang kosong! Silahkan kembali berbelanja');</script>";
        echo"<script>location='../marketplace/shop.php';</script>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>

<?php
    include '../assets/navbar.php';
?>

    <div class="kontainer">
        <p>Checkout</p>

        <table class="daftar">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tanaman</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
                
            <?php 
                $nomor = 1;
                $total=0;
                foreach ($_SESSION["keranjang"] as $id => $jumlah) :

                $ambil = $conn->query("SELECT * FROM buah WHERE BuahId = '$id'");
                $pecah = $ambil->fetch_assoc();
                $subtotal = $pecah["Harga"]*$jumlah;
            ?>
                
            <tbody>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $pecah["NamaBuah"]; ?></td>
                    <td>Rp. <?= number_format($pecah["Harga"]); ?></td>
                    <td><?= $jumlah; ?></td>
                    <td>Rp. <?= number_format($subtotal); ?></td>
                </tr>
            </tbody>

            <?php 
                $total+=$subtotal;
                endforeach 
            ?>

            <tr>
                <td colspan=4>Total Belanja</td>
                <td>Rp. <?= number_format($total); ?></td>
            </tr>

        </table>

        <form method="POST">
            <div class="datauser">

                <div class="data">
                    <input type="text" readonly value="<?= $hasil[1];?>">                    
                </div>

                <div class="data">
                    <input type="text" readonly value="<?= $hasil[3];?>">
                </div>

                <div class="data">
                    <?php
                        if($hasil[4]==NULL)
                        {
                    ?>
                        <input type="text" readonly value="no data">
                    <?php
                        }
                        else
                        {
                    ?>
                        <input type="text" readonly value="<?= $hasil[4];?>">
                    <?php
                        }
                    ?>
                </div>

                <div class="data">
                    <select name="ongkir">
                        <option value="0">
                            Kota Tujuan
                        </option>
                            
                            <?php
                                $ongkir = mysqli_query($conn, "SELECT ongkir.id,ongkir.kota,ongkir,kurir FROM ongkir
                                                                JOIN user ON ongkir.kota = user.kota
                                                                WHERE userId = '$iduser'");
                                while($pecah = $ongkir->fetch_assoc()):
                            ?>

                        <option value="<?= $pecah['id']?>">
                            <?= $pecah['kota']?> - Rp. <?= number_format($pecah['ongkir'])?>
                        </option>

                        <?php endwhile ?>

                        <option value="1">
                            <?php
                                if($pecah==NULL)
                                {
                                    echo "Tambah Alamat";
                                }
                                else
                                {
                                    echo "Ubah Alamat";
                                }
                            ?>
                        </option>
                    </select>
                </div>
            </div>

            <div class="alamat">
                <textarea name="alamatbaru" cols="100%" rows="1" placeholder="Masukkan alamat tujuan pengiriman baru"></textarea>
                
                <select name="newcity">
                    <option value="0">
                        Nama Kota
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

            <div class="button">
                <a href="../marketplace/keranjang.php">Kembali</a>
                <button class="checkout" name="checkout">Checkout</button>
            </div>
        </form>
            
        <?php
            if(isset($_POST["checkout"]))
            {
                if($_POST["ongkir"]==0)
                {
        ?>
                    <script>alert('Silahkan memilih ongkir terlebih dahulu!!')</script>
                    <script>location='../marketplace/checkout.php'</script>
        <?php
                    exit();
                }

                elseif($_POST["ongkir"]==1)
                {
                    if($_POST["alamatbaru"]==NULL)
                    {
        ?>
                        <script>alert('Alamat tidak sah!!')
                        location='../marketplace/checkout.php'</script>
        <?php
                        exit();
                    }
                    elseif($_POST["newcity"]==0)
                    {
        ?>
                        <script>alert('Alamat tidak sah!!')
                        location='../marketplace/checkout.php'</script>
        <?php
                        exit();
                    }
                    else
                    {
                        $alamatbaru = $_POST["alamatbaru"];
                        $kotabaru = $_POST["newcity"];

                        $ambillagi = mysqli_query($conn, "SELECT * FROM ongkir WHERE id = '$kotabaru'");
                        $arraykota = mysqli_fetch_assoc($ambillagi);
                        $namakota = $arraykota['kota'];

                        mysqli_query(
                            $conn, "UPDATE user SET alamat = '$alamatbaru',
                                    kota = '$namakota'
                                    WHERE userId = '$iduser';" 
                        );
                    }
                }
                
                else 
                {
                    if($_POST['alamatbaru']==0 && $_POST['newcity']==0)
                    {
                        $alamat = $hasil['4'];
                        $userid = $hasil['0'];
                        $transactiondate = date("Y-m-d");
                        $ongkirid = $_POST["ongkir"];

                        $ambildata = mysqli_query($conn, "SELECT * FROM ongkir WHERE id = '$ongkirid'");
                        $arrayongkir = mysqli_fetch_assoc($ambildata);
                        $tarif = $arrayongkir['ongkir'];
                        $kurir = $arrayongkir['kurir'];

                        $TotalPembelian = $total+$tarif;

                        mysqli_query($conn, "INSERT INTO headerservices (
                                        userid, ongkirid, transactiondate, address, totalpembelian,kurir)
                                        VALUES
                                        ('$userid','$ongkirid','$transactiondate','$alamat','$TotalPembelian','$kurir')"
                                    );
                        
                        $transaction = mysqli_insert_id($conn);

                        foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
                                {
                                    $conn->query("INSERT INTO detailservices (
                                            transactionid, buahid, jumlahproduk)
                                            VALUES
                                            ('$transaction','$id_produk','$jumlah')"
                                            );
                                }
        
        
                        echo "<script>alert('Pembelian Berhasil')</scriplocation=>";
                        echo "<script>location='../marketplace/nota.php?id=$transaction';</script>";
                        
                        unset($_SESSION['keranjang']);
                    }
                    else
                    {
                    ?>
                        <script>alert('Alamat tidak sah!!')</script>
                        <script>location='../marketplace/checkout.php'</script>
                    <?php
                    }
                }  
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
<?php
    SESSION_START();
    include "../assets/connect.php";

    if(($_SESSION["keranjang"])==NULL)
    {
        echo"<script>alert('Keranjang kosong! Silahkan kembali berbelanja');</script>";
        echo"<script>location='shop.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/keranjang.css">
    <title>Keranjang</title>
</head>

<body>    
<?php
    include '../assets/navbar.php';
?>
    <div class="kontainer">
        <p>Keranjang</p>

        <center>
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
                
                <?php $nomor = 1;
                    foreach ($_SESSION['keranjang'] as $id => $jumlah) :
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
                        <td class="beda">
                            <a href="hapus.php?id=<?=$id?>"> <i class="fa-solid fa-trash-can delete"></i></a>
                            <a href="lebih.php?id=<?=$id?>"><i class="fa-solid fa-plus add"></i></a></td>
                    </tr>
                </tbody>

                <?php
                    endforeach 
                ?>
            </table>
        </center>

        <div class="action">
            <a href=../marketplace/shop.php class="lanjut" style="pointer:cursor;">Lanjut Belanja </a>
            <a href=../marketplace/checkout.php class="checkout" style="pointer:cursor;">Checkout</a>
            <form method="POST">
                <button name="satuan" class="hapus">Hapus</button>
            </form>

            <?php
                if(isset($_POST["satuan"]))
                {
                    unset($_SESSION['keranjang']);
                    echo "<script>location='keranjang.php';</script>";
                }
            ?>
        </div>    
    </div>       
</body>
<script src="https://kit.fontawesome.com/27bd1f331f.js" crossorigin="anonymous"></script>
</html>
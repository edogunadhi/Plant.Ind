<?php
    include "../assets/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Pembelian</title>
        <link href="../assets/css/nota.css" rel="stylesheet" />
</head>
<body>
    <?php
        include '../assets/navbar.php';
    ?>

    <div class="konten">
        <p>Detail Belanja</p>
        <hr>
        
        <div class="detail">

            <?php
                $nomor = 1;
                $total=0;
                
                $ambil = $conn->query("SELECT * FROM detailservices JOIN headerservices ON detailservices.transactionid=headerservices.id
                                        JOIN buah ON detailservices.buahid=buah.BuahId
                                        JOIN user ON headerservices.userid=user.userId
                                        JOIN ongkir ON headerservices.ongkirid=ongkir.id
                                        WHERE detailservices.transactionid=$_GET[id]");
                $pecah = $ambil->fetch_assoc();
            ?>
            
            <div>
                <h3>Pembelian</h3>
                <?= $pecah['transactiondate']; ?><br>
                Total Pembelian : Rp<?= number_format($pecah['totalpembelian']); ?>
            </div>

            <div>
                <h3>Pelanggan</h3>
                <strong><?= $pecah['username']?></strong><br>
                <?= $pecah['telpon']; ?> <br>
            </div>
                
            <div>
                <h3>Pengiriman</h3>
                <strong><?= $pecah['kota']; ?></strong><br>
                Ongkos Kirim : Rp<?= number_format($pecah['ongkir']); ?> <br>
                <?= $pecah['alamat']; ?>
            </div>
        </div>
            
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
                $ambil = $conn->query("SELECT * FROM detailservices JOIN headerservices ON detailservices.transactionid=headerservices.id
                JOIN buah ON detailservices.buahid=buah.BuahID
                WHERE detailservices.transactionid=$_GET[id]");

                while($pecah = $ambil->fetch_assoc()):
                    $Subtotal = $pecah["Harga"]*$pecah['jumlahproduk'];
            ?>

            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $pecah["NamaBuah"]; ?></td>
                <td>Rp. <?= number_format($pecah["Harga"]); ?></td>
                <td><?= $pecah["jumlahproduk"]; ?></td>
                <td>Rp. <?= number_format($Subtotal); ?></td>
            </tr>

            <?php
                $total+=$Subtotal;
                endwhile;
            ?>

            <tr>
                <td colspan=4>Total Belanja</td>
                <td>Rp. <?= number_format($total); ?></td>
            </tr>
        </table>
                
        <div class="bayar">
            <div class="pembayaran">
                
                <?php
                    $ambil = $conn->query("SELECT * FROM headerservices WHERE id=$_GET[id]");
                    $pecah = $ambil->fetch_assoc();
                ?>

                    Silahkan melakukan pembayaran Rp<?= number_format($pecah["totalpembelian"]) ?> ke <br>
                    <strong>BANK MANDIRI XXX-XXXXXX-XXXX a/n Alken Richard Ho </strong>
            </div>

            <a href="pesanan.php">
                <div class="selesai">
                    Selesai 
                </div>
            </a>
        </div>
    </div>
</body>
</html>
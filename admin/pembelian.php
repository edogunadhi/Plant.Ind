<?php
    include '../assets/connect.php';

    $id = $_SESSION['admin']['adminId'];

    $ambil = $conn->query("SELECT DISTINCT detailservices.transactionid FROM `detailservices` 
                            JOIN headerservices ON detailservices.transactionid = headerservices.id
                            JOIN buah ON detailservices.buahid = buah.BuahID
                            JOIN ongkir ON headerservices.ongkirid = ongkir.id
                            WHERE NOT headerservices.userid = $id AND detailservices.sellerid = 0 AND headerservices.status = 'TELAH MEMBAYAR';");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian</title>
    <style>
        .content{
            background:white;
            border-radius:10px;
            height: 100%;
            padding: 10px;
        }
        .content table
        {
            margin-top: 30px;
        }
        .action{
            text-decoration: none;
            color: black;
            background: lightgreen;
            padding: 10px 15px 10px 15px;
            border-radius: 5px;
        }
    </style>
        
</head>
<body>
    <div class=content>
        <center>
            <h1>Daftar Pembelian</h1>
        </center>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama Tanaman
                    </th>
                    <th>
                        Jumlah Produk
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php
                $nomor = 1;
                while($pecah = $ambil->fetch_assoc()){
                    $transaction = $pecah['transactionid']; 
            ?>
                <tr>
                    <td>
                        <?= $nomor++;?>
                    </td>
                    <td>
                        <?php
                            $plant = $conn->query("SELECT * FROM detailservices
                                                        JOIN buah ON detailservices.buahid = buah.BuahID
                                                        WHERE detailservices.transactionid = $transaction");
                        while($pecahplant = $plant->fetch_assoc()):
                            echo $pecahplant['NamaBuah']; echo " - Rp"; echo number_format($pecahplant['Harga']);
                            echo "<br> <br>";
                        endwhile;
                        ?>
                    </th>
                    <td>
                        <?php 
                            $jumlah = $conn->query("SELECT * FROM detailservices
                                                    WHERE detailservices.transactionid = $transaction");
                            while($pecahjumlah = $jumlah->fetch_assoc()):
                                echo $pecahjumlah['jumlahproduk']; echo" Kg";
                                echo "<br> <br>";
                            endwhile;
                        ?>
                    </td>
                    <td>
                        <a href="terima.php?id=<?= $pecah['transactionid'];?>" style="pointer:cursor;" class="action"><strong>Terima Pesanan</strong></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    include '../assets/connect.php';

    $id = $_SESSION['admin']['adminId'];

    $ambil = $conn->query("SELECT DISTINCT detailservices.transactionid FROM `detailservices` 
                            JOIN headerservices ON detailservices.transactionid = headerservices.id
                            JOIN admin ON headerservices.adminId = admin.adminId
                            JOIN buah ON detailservices.buahid = buah.BuahID
                            WHERE sellerid = $id;");
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
            <h1>Daftar Pelanggan</h1>
        </center>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Pembelian
                    </th>
                    <th>
                        Username
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Alamat
                    </th>
                    <th>
                        Nomor Telepon
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
                        <?= $nomor++; ?>
                    </td>
                    <td>
                        <?php
                            $name = $conn->query("SELECT * FROM detailservices
                                                    JOIN buah ON detailservices.buahid = buah.BuahID
                                                    WHERE detailservices.transactionid = $transaction");
                            while($pecahname = $name->fetch_assoc()):
                                echo $pecahname['NamaBuah'];
                                echo"<br><br>"; 
                            endwhile;
                        ?>
                    </th>
                    <td>
                        <?php
                            $username = $conn->query("SELECT * FROM headerservices
                                                        JOIN user ON headerservices.userid = user.userId
                                                        WHERE headerservices.id = $transaction");
                            $pecahname = $username->fetch_assoc();

                        echo $pecahname['username'] 
                        ?>
                    </td>
                    <td>
                        <?php
                            $username = $conn->query("SELECT * FROM headerservices
                                                                JOIN user ON headerservices.userid = user.userId
                                                                WHERE headerservices.id = $transaction");
                            $pecahname = $username->fetch_assoc();
                            echo $pecahname['email'] 
                        ?>
                    </td>
                    <td>
                        <?php
                            $username = $conn->query("SELECT * FROM headerservices
                                                                JOIN user ON headerservices.userid = user.userId
                                                                WHERE headerservices.id = $transaction");
                            $pecahname = $username->fetch_assoc();
                            echo $pecahname['alamat']
                        ?>
                    </td>
                    <td>
                        <?php
                            $username = $conn->query("SELECT * FROM headerservices
                                                                JOIN user ON headerservices.userId = user.userId
                                                                WHERE headerservices.id = $transaction");
                            $pecahname = $username->fetch_assoc();
                            echo $pecahname['telpon'] 
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
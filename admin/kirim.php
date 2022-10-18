<?php
    include '../assets/connect.php';

    $id = $_GET['id'];

    $ambil = $conn->query("SELECT * FROM `detailservices` 
                            JOIN headerservices ON detailservices.transactionid = headerservices.id
                            JOIN buah ON detailservices.buahid = buah.BuahID
                            JOIN ongkir ON headerservices.ongkirid = ongkir.id
                            JOIN admin ON headerservices.userid = admin.adminId
                            WHERE detailservices.transactionid = $id;");
    $pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <center>
    <h1>Masukkan Resi</h1>
  </center>
  <table class="table table-light table-hover">
    <tr>
      <td>Nama Tanaman</td>
      <td>
        <?php
          $name = $conn->query("SELECT * FROM detailservices
                                  JOIN buah ON detailservices.buahid = buah.BuahID
                                  JOIN headerservices ON detailservices.transactionid = headerservices.id
                                  JOIN user ON headerservices.userid = user.userId
                                  WHERE detailservices.transactionid = $id");
          while($pecahname = $name->fetch_assoc()):
            echo $pecahname['NamaBuah'];
            echo "<br><br>";
        ?>
      </td>
    </tr>
    <tr>
      <td>Jumlah Produk</td>
      <td>
        <?= $pecahname['jumlahproduk'] ?>
      </td>
    </tr>
    <tr>
      <td>Alamat Tujuan</td>
      <td>
        <?= $pecahname['alamat'] ?>
      </td>
    </tr>
    <tr>
      <td>Kota Tujuan</td>
      <td>
        <?= $pecahname['kota'] ?>
      </td>
    </tr>
    <tr>
      <td>Total Pembayaran</td>
      <td>
        Rp<?= number_format($pecahname['totalpembelian']) ?>
      </td>
    </tr>
    <tr>
      <td>Nomor Telepon</td>
      <td>
        <?= $pecahname['telpon'] ?>
      </td>
    </tr>
  </table>
  <form action="input.php?id=<?=$pecahname['transactionid']?>" method="POST">
    <label for="recipient-name" class="col-form-label">Resi Pengiriman</label><br>
    <input type="text" name="resi" class="form-control">
    <label for="recipient-name" class="col-form-label"></label>
    <button type="submit" class="form-control" style="background:grey; color:white; width:40%">Kirim</button>
  </form>  
  <?php
    endwhile
  ?>
</body>
</html>
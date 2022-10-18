<?php
  SESSION_START();
  include"../assets/connect.php";
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="../assets/css/daftar.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
  <title>Daftar</title>
</head>

<body>
    <div class="overlay"></div>
    <form method="post" class="box">
      <div class="header">
        <h3>Daftar</h3>
      </div>
      <div class="login-area">
        <input type="text" name="username" class="username" placeholder="Username" required>
        <input type="email" name="email" class="username" placeholder="Email" required>
        <input type="tel" name="telpon" class="password" placeholder="08xxxxx" required>
        <input type="password" name="password1" class="password" placeholder="Password" required>
        <input type="password" name="password2" class="password" placeholder="Ulangi Password" required>
        <button type="submit" class="submit" name="daftar">Daftar</button>
        <a href="login.php">Sudah punya akun? Masuk</a>
      </div>
    </form>
    <?php
      if(isset($_POST["daftar"]))
      {
        $username=$_POST["username"];
        $email=$_POST["email"];
        $telepon=$_POST["telpon"];
        $pass1=$_POST["password1"];
        $pass2=$_POST["password2"];

        $ambil = $conn->query("SELECT * FROM user WHERE email = '$email' OR username = '$username'");
        $cocok = $ambil->num_rows;
        if($cocok==1)
        {
          echo"<script> alert('Email atau Username telah digunakan') </script>";
          echo"<script> location='../login/daftar.php'; </script>";
        }
        else
        {
          if($pass1 != $pass2)
          {
            echo"<script> alert('Password tidak sama') </script>";
            echo"<script> location='../login/daftar.php'; </script>";
          }
          else
          {
            $conn->query("INSERT INTO user (username,email,telpon,alamat,password) VALUES ('$username','$email','$telepon','$alamat',md5('$pass1'))");

            echo"<script> alert('Pendaftaran Sukses! Silahkan login') </script>";
            echo"<script> location='../login/login.php'; </script>";
          }
        }
      }
    ?>
</body>
</html>
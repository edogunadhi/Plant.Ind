<?php
  SESSION_START();
  include "../assets/connect.php";
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
  <title>Masuk</title>
</head>

<body>
    <div class="overlay"></div>
    <form method="post" class="box">
      <?php
        if ( function_exists('wp_nonce_field') ) 
          wp_nonce_field('plugin-name-action_' . $your_object); 
      ?>
      <div class="header">
        <h3>Masuk</h3>
      </div>
      <div class="login-area">
        <input type="text" name="username" class="username" placeholder="Username/Email">
        <input type="password" name="password" class="password" placeholder="Password">
        <button type="submit" class="submit" name="login">Masuk</button>
        <a href="daftar.php">Belum punya akun? Daftar</a>
      </div>
    </form>
    <?php
      if(isset($_POST['login']))
      {
        $ambil_user = $conn->query("SELECT * FROM user WHERE username='$_POST[username]' OR email='$_POST[username]' AND password='$_POST[password]'");
        $ambil_admin = $conn->query("SELECT * FROM admin WHERE username='$_POST[username]' AND password='$_POST[password]'");
        $cocok_admin = $ambil_admin->num_rows;
        $cocok_user = $ambil_user->num_rows;

        if ($cocok_user==1)
        {
          $_SESSION['user'] = $ambil_user->fetch_assoc();
          echo"<script> alert('Selamat datang!'); </script>";
          echo"<script> location='../home/index.php'; </script>";
        }
        elseif ($cocok_admin==1)
        {
          $_SESSION['admin'] = $ambil_admin->fetch_assoc();
          echo"<script> alert('Selamat datang Seller!'); </script>";
          echo"<script> location='../home/index.php'; </script>";
        }
        else
        {
          echo"<script> alert('Username atau kata sandi salah'); </script>";
          echo"<script> location='../login/login.php'; </script>";
        }
      }
    ?>
    
</body>
</html>
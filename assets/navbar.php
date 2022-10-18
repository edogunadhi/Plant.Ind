<?php
  include 'connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        
        <a class="navbar-brand" href="../home/index.php">
          <img src="../assets/logo.png" alt="logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          <ul class="navbar-nav me-auto mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../home/index.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../marketplace/shop.php">Toko</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../consultation/index.php">Konsultasi</a>
            </li>
          </ul>
          
          <!-- Default dropstart button -->
          <div class="btn-group">
            <button type="button" class="tombol" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
              <img src="../assets/user.png" alt="user" width=5vw>
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <?php
                if(isset($_SESSION['user']))
                {
              ?>
              <li>
                <?php
                  $banyak=0; 
                  if(!isset($_SESSION["keranjang"]))
                  {
                    $banyak=0;
                  }
                  else
                  {
                    foreach ($_SESSION["keranjang"] as $jumlah) :
                      $banyak+=$jumlah;
                    endforeach;
                  }
                ?>
                
                <a class="dropdown-item" href="../marketplace/keranjang.php">
                  Keranjang
                  <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $banyak; ?></span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="../login/profil.php">
                  Profil
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="../login/logout.php">
                  Keluar
                </a>
              </li>
                        
              <?php    
                }
                elseif(isset($_SESSION['admin']))
                {
              ?>
              <li>
                <a class="dropdown-item" href="../login/logout.php">
                  Keluar
                </a>
              </li>
              <?php
                }
                else
                {
              ?>
                   
              <li>    
                <a class="dropdown-item" href="../login/login.php">                
                  Masuk 
                </a>
              </li>
              <li>    
                <a class="dropdown-item" href="../login/daftar.php">                
                  Daftar 
                </a>
              </li>

              <?php 
                } 
              ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>
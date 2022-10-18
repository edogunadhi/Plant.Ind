<?php
  SESSION_START();
  include "../assets/connect.php";
  $id = $_GET["id"];
  $jumlah = $_POST["satuan"];

  if(isset($_SESSION['keranjang'][$id]))
  {
      $_SESSION['keranjang'][$id]+=$jumlah;
  }
  else
  {
      $_SESSION['keranjang'][$id]=$jumlah;
  }
  
  echo"<script>location='shop.php';</script>";
?>
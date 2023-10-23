<?php
session_start();
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <title>dashboard | zapato </title>
</head>

<body class="das">
  <header>
    <div class="container">
      <h1><a href="">Zapato</a></h1>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="data-kategori.php">Data Merek</a></li>
        <li><a href="data-produk.php">Data Produk</a></li>
        <li><a href="keluar.php">Log Out</a></li>
      </ul>
    </div>
  </header>
  <div class="section">
    <div class="container">
      <h1>Dashboard</h1>
      <div class="box-1">
        <h4>Selamat Datang
          <?php echo $_SESSION['a_global']->admin_name ?>
        </h4>
      </div>
      <div class="kol-2">
        <div class="bar">
            <a href="data-produk.php"><img src="gambar/kategori.png">
            <p>Produk</p></a> 
        <div>
        <div class="bar">
            <a href="data-kategori.php"><img src="gambar/kategori.png">
            <p>Merek</p></a>    
        <div>
      </div>
    </div>
  </div>
  <div>
  <div>
</body>

</html>
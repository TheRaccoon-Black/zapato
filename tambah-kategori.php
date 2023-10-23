<?php
    session_start();
    include "db.php";
    if($_SESSION['status_login'] != true){
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
    <title>Tambah | Zapato </title>
</head>
<body>
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
        <h1>Tambah merek</h1>
        <div class="box">
           <form action='' method="POST">
            <input type="text" name="nama" placeholder="Nama Merek" class="input-control" required>
            <input type="submit" name="submit" value="Submit" class="btn">
        </form>
       <?php
        if(isset($_POST['submit'])){
            $nama = ucwords($_POST['nama']);
            $insert = mysqli_query($conn, "insert into tb_kategori values (null,'".$nama."')");

            if($insert){
              echo "<script>alert('kategori ".$nama." berhasil ditambahkan')</script>";
              header("Location: data-kategori.php");
            }else{
              echo "gagal".mysqli_error($conn);
            }
        }
       ?>
        </div>
        
    </div>
  </div>
  <footer>
    <div class="container">
        <small>Copyright &copy; 2023 - Zapato</small>
    </div>
  </footer>
</body>
</html>
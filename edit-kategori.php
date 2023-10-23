<?php
session_start();
include "db.php";
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="login.php"</script>';
}
$kategori = mysqli_query($conn, "SELECT * FROM tb_kategori where kategori_id = '" . $_GET['id'] . "'");
if (mysqli_num_rows($kategori) == 0) {
  header('location: data-kategori.php');
}
$k = mysqli_fetch_object($kategori);
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
  <title>Edit | Zapato </title>
</head>

<body>
  <header>
    <div class="container">
      <h1><a href="">Zapato</a></h1>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="data-kategori.php">Data Kategori</a></li>
        <li><a href="data-produk.php">Data Produk</a></li>
        <li><a href="keluar.php">Log Out</a></li>
      </ul>
    </div>
  </header>
  <div class="section">
    <div class="container">
      <h1>Edit kategori</h1>
      <div class="box">
        <form action='' method="POST">
          <input type="text" name="nama" placeholder="nama kategori" class="input-control"
            value="<?php echo $k->kategori_nama ?>" required>
          <input type="submit" name="submit" value="Submit" class="btn">
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $nama = ucwords($_POST['nama']);
          $update = mysqli_query($conn, "update tb_kategori set kategori_nama = '" . $nama . "' where kategori_id = '" . $k->kategori_id . "'");

          if ($update) {
            echo "<script>alert('Edit kategori " . $nama . " berhasil ditambahkan')</script>";
            header("Location: data-kategori.php");
          } else {
            echo "gagal" . mysqli_error($conn);
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
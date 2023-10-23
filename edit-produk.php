<?php
session_start();
include "db.php";
if ($_SESSION['status_login'] != true) {
  echo '<script>window.location="login.php"</script>';
}
$produk = mysqli_query($conn, "select * from tb_produk where produk_id = '" . $_GET['id'] . "'");
if (mysqli_num_rows($produk) == 0) {
  header("location: data-produk.php");
}
$p = mysqli_fetch_object($produk);
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
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <title>Edit produk | Zapato </title>
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
      <h1>Edit produk</h1>
      <div class="box">
        <form action="" method="POST" enctype="multipart/form-data">
          <select class="input-control" name="kategori" required>
            <option value="">---Pilih---</option>
            <?php
            $kategori = mysqli_query($conn, "select * from tb_kategori order by kategori_id desc");
            while ($r = mysqli_fetch_array($kategori)) {
              ?>
              <option value="<?php echo $r['kategori_id'] ?>" <?php echo ($r['kategori_id'] == $p->kategori_id) ? 'selected' : ''; ?>><?php echo $r['kategori_nama'] ?></option>
            <?php } ?>
          </select>
          <input type="text" name="nama" placeholder="nama produk" class="input-control"
            value="<?php echo $p->produk_nama ?>" required>
          <input type="text" name="harga" placeholder="Harga" class="input-control"
            value="<?php echo $p->produk_harga ?> " required>
          <img src="produk/<?php echo $p->produk_gambar ?>" width="100px">
          <input type="hidden" name="foto" value="<?php echo $p->produk_gambar ?>">
          <input type="file" name="gambar" class="input-control">
          <textarea name="deskripsi" placeholder="Deskripsi"
            class="input-control"><?php echo $p->produk_desk ?></textarea>
          <select class="input-control" name="status">
            <option value="">---Pilih---</option>
            <option value="1" <?php echo ($p->produk_status == 1) ? 'selected' : ''; ?>>Aktif</option>
            <option value="0" <?php echo ($p->produk_status == 2) ? 'selected' : ''; ?>>Tidak Aktif</option>
          </select>

          <input type="submit" name="submit" value="Submit" class="btn">
        </form>
        <?php
        if (isset($_POST['submit'])) {
          $kategori = $_POST["kategori"];
          $nama = $_POST["nama"];
          $harga = $_POST["harga"];
          $deskripsi = $_POST["deskripsi"];
          $status = $_POST["status"];
          $foto = $_POST["foto"];

          $filename = $_FILES['gambar']['name'];
          $tmp_name = $_FILES['gambar']['tmp_name'];


          if ($filename != '') {
            $type1 = explode('.', $filename);
            $type2 = $type1[1];

            $newname = 'produk' . time() . '.' . $type2;
            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

            if (!in_array($type2, $tipe_diizinkan)) {
              echo "<script>alert('format file tidak diizinkan')</script>";
            } else {
              unlink('./produk/' . $foto);
              move_uploaded_file($tmp_name, './produk/' . $newname);
              $namagambar = $newname;
            }
          } else {
            $namagambar = $foto;
          }
          $update = mysqli_query($conn, "update tb_produk set
                kategori_id ='" . $kategori . "',
                produk_nama = '" . $nama . "',
                produk_harga = '" . $harga . "',
                produk_desk = '" . $deskripsi . "',
                produk_gambar = '" . $namagambar . "',
                produk_status = '" . $status . "'
                where produk_id = '" . $p->produk_id . "';");
          if ($update) {
            echo "<script>alert('Edit data berhasil dilakukan')</script>";
            header("Location: data-produk.php");
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
  <script>
    CKEDITOR.replace('deskripsi')
  </script>
</body>

</html>
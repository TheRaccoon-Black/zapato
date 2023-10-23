
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
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <title>Tambah | Zapato </title>
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
        <h1>Tambah produk</h1>
        <div class="box">
           <form action="" method="POST" enctype="multipart/form-data">
            <select class="input-control" name="kategori" required>
                <option value="">---Pilih---</option>
                <?php 
                    $kategori = mysqli_query($conn,"select * from tb_kategori order by kategori_id desc");
                    while($r = mysqli_fetch_array($kategori)){
                    ?>
                    <option value="<?php echo $r['kategori_id']?>"><?php echo $r['kategori_nama']?></option>
                  <?php } ?>
            </select>
            <input type="text" name="nama" placeholder="nama produk" class="input-control" required>
            <input type="text" name="harga" placeholder="Harga" class="input-control" required>
            <input type="file" name="gambar" class="input-control" required>
            <textarea name="deskripsi" placeholder="Deskripsi" class="input-control"></textarea>
            <select class="input-control" name="status">
              <option value="">---Pilih---</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
            
            <input type="submit" name="submit" value="Submit" class="btn">
        </form>
        <?php
        if(isset($_POST['submit'])){
          //print_r($_FILES['gambar']);
            $kategori = $_POST["kategori"];
            $nama = $_POST["nama"];
            $harga = $_POST["harga"];
            $deskripsi = $_POST["deskripsi"];
            $status = $_POST["status"];

            $filename = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];

            $type1 = explode('.', $filename);
            $type2 = $type1[1];

            echo $type2;
            $newname = 'produk'.time().'.'.$type2;

            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

            if(!in_array($type2, $tipe_diizinkan)){
                echo "<script>alert('format file tidak diizinkan')</script>";
            } else {
                move_uploaded_file($tmp_name, './produk/'.$newname);
                $insert = mysqli_query($conn, "insert into tb_produk values(
                          null,'".$kategori."','".$nama."','".$harga."','".$deskripsi."','".$newname."','".$status."',CURRENT_DATE())");
              if($insert){
                echo "<script>alert('Tambah data berhasil dilakukan')</script>";
                header("Location: data-produk.php");
              }else{
                echo "gagal".mysqli_error($conn);
              }
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
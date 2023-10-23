<?php
    session_start();
    include "db.php";
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "select * from tb_admin where admin_id = '".$_SESSION['id']."'");
    $d = mysqli_fetch_object($query);
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
    <title>Profil | Zapato </title>
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
        <h1>Profil</h1>
        <div class="box">
           <form action='' method="POST">
            <input type="text" name="nama" placeholder="Nama lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
            <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
            <input type="text" name="hp" placeholder="No hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
            <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
            <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_alamat ?>" required>
            <input type="submit" name="submit" value="Ubah Profil" class="btn">

        </form>
        <?php 
            if(isset($_POST['submit'])){
                $nama = ucwords($_POST['nama']);
                $user = $_POST['user'];
                $hp = $_POST['hp'];
                $email = $_POST['email'];
                $alamat = ucwords($_POST['alamat']);

                $update = mysqli_query($conn, "update tb_admin set admin_name ='".$nama."',username='".$user."',admin_telp='".$hp."',admin_email='".$email."',admin_alamat='".$alamat."' where admin_id = '".$d->admin_id."'");
                
                if($update){
                    echo "<script>alert('Data berhasil diubah');</script>";
                    header("location: profil.php");
                }else{
                    echo "gagal update" .mysqli_error($conn);
                }
            }
        ?>
        </div>
        <h3>Ubah password</h3>
        <div class="box">
           <form action='' method="POST">
            <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
            <input type="password" name="pass2" placeholder="Konfirmasi password baru" class="input-control"  required>
            <input type="submit" name="ubah_password" value="Ubah Password" class="btn">

        </form>
        <?php 
            if(isset($_POST['ubah_password'])){
         
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
                
                if ($pass2 != $pass1){
                    echo '<script>alert("konfirmasi password baru tidak sesuai")</script>';
                }else{
                    $u_pass = mysqli_query($conn, "update tb_admin set password ='".$pass1."' where admin_id = '".$d->admin_id."'");
                    if($u_pass){
                        echo "<script>alert('password berhasil diubah');</script>";
                        header("location: profil.php");
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
</body>
</html>
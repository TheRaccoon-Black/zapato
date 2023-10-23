<?php
session_start();
include "db.php";
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
    <title>Merek | Zapato </title>
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
            <h1>Data-Merek</h1>
            <button class="btn" style="width:100px;">
                <a href="tambah-kategori.php">Tambah data</a>
            </button>
            <div class="box">
                <table border="1" cellspacing="9" class="table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Merek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $kategori = mysqli_query($conn, "select * from tb_kategori order by kategori_id desc");
                        if (mysqli_num_rows($kategori) > 0) {
                            while ($row = mysqli_fetch_array($kategori)) {
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $no++ ?>
                                    </th>
                                    <th>
                                        <?php echo $row['kategori_nama'] ?>
                                    </th>
                                    <th>
                                        <a href="edit-kategori.php?id=<?php echo $row['kategori_id'] ?>">Edit</a> || <a
                                            href="proses-hapus.php?idk=<?php echo $row['kategori_id'] ?>"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </th>
                                </tr>
                                <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="4">Tidak ada data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
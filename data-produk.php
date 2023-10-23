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
    <title>Produk | Zapato </title>
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
            <h1>Data produk</h1>
            <button class="btn" style="width:100px;">
                <a href="tambah-produk.php">Tambah data</a>
            </button>
            <div class="box">
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Merek</th>
                            <th>Nama produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $produk = mysqli_query($conn, "select * from tb_produk left join tb_kategori using (kategori_id) order by produk_id desc");
                        if (mysqli_num_rows($produk)) {
                            while ($row = mysqli_fetch_array($produk)) {
                                ?>
                                <tr>
                                    <th>
                                        <?php echo $no++ ?>
                                    </th>
                                    <td>
                                        <?php echo $row['kategori_nama'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['produk_nama'] ?>
                                    </td>
                                    <td>Rp.
                                        <?php echo number_format($row['produk_harga']) ?>
                                    </td>
                                    <td>
                                        <?php echo $row['produk_desk'] ?>
                                    </td>
                                    <td><a href="produk/<?php echo $row['produk_gambar'] ?>"><img
                                                src="produk/<?php echo $row['produk_gambar'] ?>" width="150px"
                                                height="150px"></a></td>
                                    <td>
                                        <?php echo ($row['produk_status'] == 0) ? 'Tidak aktif' : 'aktif'; ?>
                                        </th>
                                    <td>
                                        <a href="edit-produk.php?id=<?php echo $row['produk_id'] ?>">Edit</a> || <a
                                            href="proses-hapus.php?idp=<?php echo $row['produk_id'] ?>"
                                            onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="8">tidak ada data yang ditampilkan</td>
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
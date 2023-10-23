<?php
include "db.php";

$kontak = mysqli_query($conn, "select * from tb_admin where admin_id = 1");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "select  * from tb_produk where produk_id = '" . $_GET['id'] . "'");
$p = mysqli_fetch_object($produk);

$kat = mysqli_query($conn, "select  * from tb_produk join tb_kategori on tb_produk.kategori_id = tb_kategori.kategori_id where produk_id = '" . $_GET['id'] . "'");
$k = mysqli_fetch_object($kat);

$search = isset($_GET['search']) ? $_GET['search'] : '';
$kat = isset($_GET['kat']) ? $_GET['kat'] : '';
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
  <title>Detail | Zapato </title>
</head>

<body>
  <header>
    <div class="container">
      <h1><a href="index.php">Zapato</a></h1>
      <ul>
        <li><a href="produk.php">Produk</a></li>
      </ul>
    </div>
  </header>
  <div class="search">
    <div class="container">
      <form action="produk.php">
        <input type="text" class="cari" name="search" placeholder="Cari produk" value="<?php echo $search ?>">
        <input type="hidden" name="kat" value="<?php echo $kat ?>">
        <input type="submit" class="btn" name="cari" value="Cari">
      </form>
    </div>
  </div>
  <div class="section">
    <div class="container">
      <div class="judul"> Detail produk </div>
      <div class="box">
        <div class="col-2" style="text-align:right;">
          <img src="produk/<?php echo $p->produk_gambar ?>" width="100%" height="500px">
        </div>
        <div class="col-2">
          <h3>
            <?php echo $p->produk_nama ?>
          </h3>
          <h4>Rp.
            <?php echo number_format($p->produk_harga) ?>
          </h4>
          <p>Deskripsi :<br>
            <?php echo $p->produk_desk ?>
          </p>
          <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya sangat tertarik dengan produk sepatu <?php echo $p->produk_nama ?> bermerek <?php echo $k->kategori_nama     ?> yang Anda tawarkan. Produk ini terlihat menggiurkan! Dengan harga yang terjangkau sebesar Rp. <?php echo number_format($p->produk_harga) ?> ,saya ingin membuat pesanan.

                        Alamat pengiriman saya berada di [alamat Anda]. Saya ingin memesan [jumlah] item Mochi Matcha ini. Produk ini terlihat lezat dan saya sangat ingin mencoba.

                        Mohon konfirmasi ketersediaan stok dan informasi pembayaran lebih lanjut. Saya siap untuk melakukan pembayaran segera.

                        Terima kasih banyak! Saya sangat menantikan respons dari Anda." target="_blank">Hubungi via
              Whatsapp <img src="gambar/wa.png" width="50px"></a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="container">
      <h4>Alamat</h4>
      <p>
        <?php echo $a->admin_alamat ?>
      </p>
      <h4>Email</h4>
      <p>
        <?php echo $a->admin_email ?>
      </p>
      <h4>Telepon</h4>
      <p>
        <?php echo $a->admin_telp ?>
      </p>
      <small>Copyright &copy; 2023 - Zapato.com</small>
    </div>
  </div>
</body>

</html>?>
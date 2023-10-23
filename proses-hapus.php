<?php
    include "db.php";

    if(isset($_GET['idk'])){
        $delete = mysqli_query($conn,"delete from tb_kategori where kategori_id = '".$_GET['idk']."'");
        header("Location: data-kategori.php");
    }
    if(isset($_GET['idp'])){
        $produk = mysqli_query($conn, "select produk_gambar from tb_produk where produk_id = '".$_GET['idp']."'");
        $p = mysqli_fetch_object($produk);

        unlink('./produk/'.$p->produk_gambar);

        $delete = mysqli_query($conn,"delete from tb_produk where produk_id = '".$_GET['idp']."'");
        header("Location: data-produk.php");


    }
?>
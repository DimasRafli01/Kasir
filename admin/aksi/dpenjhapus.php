<?php 
$koneksi=mysqli_connect('localhost','root','','kasir');

$query = mysqli_query($koneksi,"TRUNCATE TABLE `kasir`.`detailpenjualan`");

header("Location:../keranjang.php");
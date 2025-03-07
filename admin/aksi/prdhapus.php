<?php 
$koneksi=mysqli_connect('localhost','root','','kasir');

$id = $_GET['id'];
$query = mysqli_query($koneksi,"DELETE FROM produk WHERE idproduk='$id'");

header("Location:../produk.php");
 ?>
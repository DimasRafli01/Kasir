<?php 
$koneksi=mysqli_connect('localhost','root','','kasir');

$id = $_POST['id'];
$nm = $_POST['namaprd'];
$hg = $_POST['harga'];
$st = $_POST['stok'];

$query = mysqli_query($koneksi,"UPDATE produk SET idproduk = '$id', namaproduk= '$nm', harga= '$hg', stok= '$st' where idproduk = '$id' ");

header("Location:../produk.php");
 ?>
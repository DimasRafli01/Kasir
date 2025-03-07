<?php 
$koneksi=mysqli_connect('localhost','root','','kasir');

$id = $_POST['id'];
$nama = $_POST['namaprd'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$query = mysqli_query($koneksi,"INSERT INTO produk values('$id','$nama','$harga','$stok')");

header("Location:../produk.php");
 ?>
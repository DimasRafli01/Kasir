<?php 
$conn=mysqli_connect('localhost','root','','kasir');

// $querydp = mysqli_query($conn, "SELECT *from detailpenjualan order by idpenjualan desc");
// $row = mysqli_fetch_assoc($querydp);
$querynmp = mysqli_query($conn, "SELECT produk.namaproduk, produk.harga, iddetail, idpenjualan, jumlah, subtotal FROM detailpenjualan INNER JOIN produk ON Produk.idproduk = detailpenjualan.idproduk order by idpenjualan desc;");
$queryprd = mysqli_fetch_assoc($querynmp);

$idprd = $_GET['id'];

$a = mysqli_query($conn, "SELECT *from produk where idproduk = '$idprd'");
$b = mysqli_fetch_assoc($a);

$harga = 1 * $b['harga'];
$idpnj = $queryprd['idpenjualan'];
$idpnj++;

$query = mysqli_query($conn,"INSERT INTO detailpenjualan values(0,1,'$idprd','1','$harga')");

header("Location:../keranjang.php");
 ?>
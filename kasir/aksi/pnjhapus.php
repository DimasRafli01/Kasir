<?php 
$koneksi=mysqli_connect('localhost','root','','kasir');

$id = $_GET['id'];
$query = mysqli_query($koneksi,"DELETE FROM detailpenjualan WHERE iddetail='$id'");

header("Location:../keranjang.php");
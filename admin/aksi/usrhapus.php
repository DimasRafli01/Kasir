<?php 
$koneksi=mysqli_connect('localhost','root','','kasir');

$id = $_GET['id'];
$query = mysqli_query($koneksi,"DELETE FROM user WHERE id_user='$id'");

header("Location:../user.php");
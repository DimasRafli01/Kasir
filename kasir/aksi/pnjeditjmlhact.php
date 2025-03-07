<?php
	include '../include/config.php';

	$idd = $_POST['idd'];

	$querynmp = mysqli_query($conn, "SELECT harga, stok, detailpenjualan.iddetail
								FROM produk INNER JOIN detailpenjualan 
								ON Produk.idproduk = detailpenjualan.idproduk where iddetail = $idd;");
	$queryprd = mysqli_fetch_assoc($querynmp);
	
	$jumlah = $_POST['jumlah'];
	if ($jumlah <= $queryprd['stok']) {
	$harga = $jumlah * $queryprd['harga'];

$queryupdatejumlah = mysqli_query($conn,"UPDATE detailpenjualan SET jumlah='$jumlah', subtotal='$harga' where iddetail = '$idd'");

header("Location:../keranjang.php");

	} else {
		$jmlhkrng = $queryprd['stok'] - $jumlah;
		?>
		<script>alert("Stok Kurang <?php echo $jmlhkrng; ?>");window.location="../keranjang.php"</script>
		<?php
	}
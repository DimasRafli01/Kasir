<?php

session_start();

if (!isset($_SESSION['nama'])) {
	header("Location: index.php");
}
include 'include/config.php';

if (isset($_POST['cari'])) {
	$cari = $_POST['cari'];
	$cari = date('Y-m-d', strtotime($cari));

	$query = mysqli_query($conn, "SELECT *from penjualan inner join produk on penjualan.idproduk = produk.idproduk 
	where DATE_FORMAT(tglpenjualan, '%Y-%m-%d') = '$cari'");
} else {
	$query = mysqli_query($conn, "SELECT *from penjualan inner join produk on penjualan.idproduk = produk.idproduk");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description"
		content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Produk</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="#">
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="beranda.php">Beranda</a></li>
								<li><a href="produk.php">Produk</a></li>
								<li><a href="keranjang.php">Keranjang</a></li>
								<li class="current-list-item"><a href="#">Laporan</a></li>
								<li><a href="#">
										<?php echo $_SESSION['nama']; ?>
									</a>
									<ul class="sub-menu">
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</li>
							</ul>
						</nav>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>Laporan</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<div class="cart-section mt-100 mb-150">
		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<form class="searchform" action="" method="post" style="margin-bottom:20px;">
						<input type="date" placeholder="Cari..." name="cari" 
						pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php if (isset($cari)) {
							echo $cari;
						} ?>">
						<input type="submit" value="cari">
						<a href="laporan.php" class="formbut">Refresh</a>
						<a href="aksi/printlap.php<?php if (isset($_POST['cari'])) { ?>?cari=
							<?php echo $_POST['cari'];
						} ?>" target="_blank" class="formbut">Print</a>
					</form>
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th>No</th>
									<th>Id</th>
									<th>Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Total</th>
									<th>Kasir</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								<?php if (mysqli_num_rows($query) > 0) { ?>
									<?php
									$i = 1;
									while ($rowp = mysqli_fetch_assoc($query)) {

										?>
										<tr class="table-body-row">
											<td>
												<?php echo $i ?>
											</td>
											<td>
												<?php echo $rowp['idproduk']; ?>
											</td>
											<td>
												<?php echo $rowp['namaproduk']; ?>
											</td>
											<td>
												<?php echo $rowp['jumlah']; ?>
											</td>
											<td>Rp.
												<?php echo number_format($rowp['harga']); ?>,-
											</td>
											<td>Rp.
												<?php echo number_format($rowp['total']); ?>,-
											</td>
											<td>
												<?php echo $rowp['kasir']; ?>
											</td>
											<td>
												<?php echo $rowp['tglpenjualan'] . ", " . $rowp['waktu']; ?>
											</td>
										</tr>
										<?php
										$i++;
									}
								} else {
									echo "<tr><td colspan='8'>Data tidak ditemukan<td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
							doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="services.html">Shop</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights
						Reserved.<br>
						Distributed By - <a href="https://themewagon.com/">Themewagon</a>
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>

</html>
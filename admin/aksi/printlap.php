<?php

session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: index.php");
}
include '../include/config.php';

if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $cari = date('Y-m-d', strtotime($cari));

    $query = mysqli_query($conn, "SELECT *from penjualan inner join produk on penjualan.idproduk = produk.idproduk 
	where DATE_FORMAT(tglpenjualan, '%Y-%m-%d') = '$cari'");
} else {
    $query = mysqli_query($conn, "SELECT *from penjualan inner join produk on penjualan.idproduk = produk.idproduk");
}
?>
<html>

<head>
    <title>print</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <script>window.print();</script>
    <div class="cart-section mt-100 mb-150">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
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
</body>

</html>
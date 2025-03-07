<?php 
 
include 'admin/include/config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['nama'])) {
    header("Location: admin/beranda.php");
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['username'];
    $password = md5($_POST['password']);
 
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$email' AND password='$password'");

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['nama'] = $row['nama'];
        if ($row['admin']==2) {
            header("Location: kasir/beranda.php");
        } if ($row['admin']==1) {
            header("Location: admin/beranda.php");
        }
        
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>
<link rel="stylesheet" href="admin/assets/css/style.css">
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body style="background-color:lightgrey;">
<div id="wrap">
<div class="container">
	<div class="crdlogin">
		<div class="icon">
            <h2 style="color:black;">APLIKASI KASIR </h2>
		</div>
	</div>

	<div class="crdlogin">
        <form action="" method="POST" class="login">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;margin-top:10px;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
        </form>
	</div>
</div>

</body>
</html>
<?php
session_start();
include "../connect.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
	<?php
	$tampil = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM admin"));
	$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
	if ($proses == "login") {
		$username = mysqli_real_escape_string($conn, @$_POST['username']);
		$password = mysqli_real_escape_string($conn, @$_POST['password']);
		$cekakun = mysqli_num_rows(mysqli_query(
			$conn,
			"SELECT * FROM admin WHERE username ='$username' AND 
        	 password ='$password'"
		));
		if ($cekakun != 0) {
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			header("Location: index.php");
			echo "<h3>Sukses!! Login Berhasil</h3>";
		} else {
			echo "<h3>Maaf!!Anda Gagal Login, 
        	silahkan Coba Kembali</h3>";
		}
	}
	?>
	<div class="container2">
		<div class="col-12 body_sign">
			<div class="signup" align="center">
				<h1>Log in Administrator</h1>
				<form method="post" action="?proses=login">
					<div class="col-12">
						<input type="text" name="username" placeholder="Username" class="form_input2" maxlength="15">
					</div>
					<div class="col-12">
						<input type="password" name="password" placeholder="Password" class="form_input2" minlength="8" maxlength="15">
					</div>
					<input type="submit" name="Login" class="form_button2" value="Login">
				</form>
			</div>
		</div>
	</div>

</body>

</html>
<?php
session_start();
include "../connect.php";
$cekuserlogin = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Administrator</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
	<?php
	if (empty($cekuserlogin)) {
		header("Location: login.php");
	} else { ?>

		<div class="header2">
			<div class="container">
				<div class="row">
					<div class="col-2 heading2">
						<h2>Admin</h2>
					</div>
					<div class="col-10">
						<div class="header_menu2">
							<a href="?page" class="menu_atas">Beranda</a>
							<a href="?page=teachers" class="menu_atas">Teacher</a>
							<a href="?page=courses" class="menu_atas">Courses</a>
							<a href="logout.php" class="menu_button">Log out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="">
			<?php
			$page = mysqli_real_escape_string($conn, @$_GET['page']);
			if ($page == "courses") {
				include "page/tambah_courses.php";
			} else if ($page == "teachers") {
				include "page/tambah_teachers.php";
			} else if ($page == "edit_courses") {
				include "page/edit_courses.php";
			} else if ($page == "edit_teachers") {
				include "page/edit_teacher.php";
			} else {
				include("page/home.php");
			}
			?>
		</div>

	<?php } ?>
	<div class="footer2">
		&nsub;
	</div>
	<div class="footer3">
		Copyright &copy; 2022. All Right Reserved
	</div>
</body>

</html>
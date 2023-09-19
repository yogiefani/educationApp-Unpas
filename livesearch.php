<?php

include "connect.php";
if (isset($_POST['input'])) {
	$input = $_POST['input'];

	$query = "SELECT * FROM course WHERE judul LIKE '%" . $input . "%'";

	$result = mysqli_query($conn, $query);
	$course = mysqli_query($conn, "SELECT * FROM course");
	$course1 = mysqli_fetch_array($course);

	if (mysqli_num_rows($result) > 0) { ?>

		<?php
		while ($row = mysqli_fetch_assoc($result)) {
			$idcourse = $row['id_course'];
			$images = $row['images'];
			$harga = $row['harga'];
			$title = $row['title'];
			$judul = $row['judul'];
			$jam = $row['jam'];
			$bulan = $row['bulan'];
			$modules = $row['modules'];
		?>
			<div class="box">
				<img src="<?php echo $images; ?>" alt="">
				<h3 class="price">Rp.<?php echo number_format($harga); ?></h3>
				<div class="content">
					<div class="stars">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half"></i>
					</div>
					<a href="?page=detail_courses&&id_course=<?php echo $idcourse; ?>" class="title"><?php echo $judul; ?></a>
					<p><?php echo $title; ?></p>
					<div class="info">
						<h3> <i class="far fa-clock"></i> <?php echo $jam; ?> hours </h3>
						<h3> <i class="far fa-calendar-alt"></i> <?php echo $bulan; ?> months </h3>
						<h3> <i class="fas fa-book"></i> <?php echo $modules; ?> modules </h3>
					</div>
				</div>
			</div>
<?php
		}
	} else {
		echo "<h3>Data tidak ditemukan</h3>";
	}
}
?>
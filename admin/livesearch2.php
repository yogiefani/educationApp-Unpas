<?php
include '../connect.php';
if (isset($_POST['input'])) {
	$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
	if ($proses == "hapus") {
		$idcourse = mysqli_real_escape_string($conn, @$_GET['id_course']);
		$cekdata = mysqli_fetch_array(mysqli_query(
			$conn,
			"SELECT * FROM course WHERE 
    		id_course='$idcourse'"
		));
		unlink("../$cekdata[images]");
		$hapus = mysqli_query($conn, "DELETE FROM course WHERE 
    		id_course='$idcourse'");
		if ($hapus) {
			echo "<h3>Hapus Data Berhasil</h3>";
		} else {
			echo "<h3>Hapus Data Gagal</h3>";
		}
	}
	$input = $_POST['input'];

	$query = "SELECT * FROM course WHERE judul LIKE '%" . $input . "%'";
	$result = mysqli_query($conn, $query);
	$course = mysqli_query($conn, "SELECT * FROM course");
	$course1 = mysqli_fetch_array($course);

	if (mysqli_num_rows($result) > 0) { ?>
		<table>
			<table border="3" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td>Id</td>
					<td>Judul course</td>
					<td>Harga</td>
					<td>Cover</td>
					<td>Aksi</td>
				</tr>
				<?php
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id_course'];
					$judul = $row['judul'];
					$harga = $row['harga'];
					$images = $row['images'];
				?>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $judul; ?></td>
						<td><?php echo $harga; ?></td>
						<td><img src="../<?php echo $images; ?>" alt="" width="50px"></td>
						<td>
							<a class="text_kecil" href="?page=edit_courses&&id_course=
				<?php echo $id; ?>">
								Edit</a>
							<a class="text_kecil2" href="?page=courses&&id_course=
				<?php echo $id; ?>&&proses=hapus">
								Hapus</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
	<?php }
} ?>
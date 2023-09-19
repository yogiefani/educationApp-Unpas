<?php
include '../connect.php';
if (isset($_POST['input'])) {
	$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
	if ($proses == "edit") {
		$update = mysqli_query($conn, "UPDATE teacher SET teacher='$teacher' WHERE id_teacher='$idteacher'");
		if ($update) {
			echo "Sukses!! Data Berhasil diupdate<br>";
		} else {
			echo "Maaf!! Data Gagal diupdate<br>";
		}
	}
	if ($proses == "hapus") {
		$hapus = mysqli_query($conn, "DELETE FROM teacher WHERE id_teacher='$idteacher'");
		if ($hapus) {
			echo "Sukses!!, Hapus Data Berhasil<br>";
		} else {
			echo "Maaf!!, Hapus Data Gagal<br>";
		}
	}
	$input = $_POST['input'];

	$query = "SELECT * FROM teacher WHERE teacher LIKE '%" . $input . "%'";

	$result = mysqli_query($conn, $query);
	$teacher = mysqli_query($conn, "SELECT * FROM teacher");
	$teacher1 = mysqli_fetch_array($teacher);

	if (mysqli_num_rows($result) > 0) { ?>
		<table>
			<table border="3" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td><b>Id</b></td>
					<td><b>Teachers</b></td>
					<td>Aksi</td>
				</tr>
				<?php
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id_teacher'];
					$teacher = $row['teacher'];
				?>
					<tr>
						<td><?php echo $id; ?></td>
						<td><?php echo $teacher; ?></td>
						<td>
							<a class="text_kecil" href="?page=edit_teachers&&id_teacher=<?php echo $id; ?>" class="">Edit</a>
							<a class="text_kecil2" href="?page=teachers&&id_teacher=<?php echo $id; ?>&&proses=hapus" class="">Hapus</a>
						</td>
					</tr>
				<?php
				}
				?>
			</table>
	<?php }
} ?>
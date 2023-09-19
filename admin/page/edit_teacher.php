<div class="body_konten2">
	<div class="container">
		<h2 class="heading_teacher">EDIT DATA TEACHER</h2>

		<hr>
		<?php
		$idteacher = mysqli_real_escape_string($conn, @$_GET['id_teacher']);
		$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
		if ($proses == "update") {
			$teacher = mysqli_real_escape_string($conn, @$_POST['teacher']);
			$update = mysqli_query($conn, "UPDATE teacher SET teacher='$teacher' WHERE id_teacher='$idteacher'");
			if ($update) {
				echo "Sukses!! Update Data Berhasil";
				header("Location: ?page=teachers");
			} else {
				echo "Maaf!! Proses Update Data Gagal";
			}
		}

		$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM teacher WHERE id_teacher='$idteacher'"));
		?>
		<form method="post" action="?page=edit_teachers&&proses=update
	&&id_teacher=<?php echo $idteacher ?>" enctype="multipart/form-data">
			<label class="col-4">Name Teacher: </label>
			<div class="col-8">
				<input type="text" name="teacher" value="<?php echo @$tampildata['teacher']; ?>" placeholder="Type Name Teacher" class="form_input">
			</div>
			<div class="row">
				<label class="col-4">&nbsp;</label>
				<div class="col-8">
					<button class="form_button2" type="submit">Update Data</button>
				</div>
			</div>
		</form>
	</div>
</div>
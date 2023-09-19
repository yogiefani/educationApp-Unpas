<div class="body_konten2">
	<div class="container">
		<?php
		$idcourse = mysqli_real_escape_string($conn, @$_GET['id_course']);
		$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
		if ($proses == "update") {
			$idteacher = mysqli_real_escape_string($conn, @$_POST['id_teacher']);
			$judul = mysqli_real_escape_string($conn, @$_POST['judul']);
			$harga = mysqli_real_escape_string($conn, @$_POST['harga']);
			$title = mysqli_real_escape_string($conn, @$_POST['title']);
			$jam = mysqli_real_escape_string($conn, @$_POST['jam']);
			$bulan = mysqli_real_escape_string($conn, @$_POST['bulan']);
			$modules = mysqli_real_escape_string($conn, @$_POST['modules']);
			$nama_gambar = mysqli_real_escape_string($conn, @$_FILES['images']['name']);
			$tmp_gambar = mysqli_real_escape_string($conn, @$_FILES['images']['tmp_name']);
			if (!empty($nama_gambar)) {
				$cekgambar = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM course WHERE id_course='$idcourse'"));
				if (!empty($cekgambar['images'])) { //gambar akan dihapus jika didatabase sebelumnya sudah ada gambar
					unlink("../$cekgambar[images]");
				}
				//baris ini adalah baris untuk upload gambar baru
				copy($tmp_gambar, "../images/$nama_gambar");
				$update_gambar = mysqli_query($conn, "UPDATE course SET images='images/$nama_gambar' WHERE id_course='$idcourse'");
			}
			$update = mysqli_query($conn, "UPDATE course SET id_teacher='$idteacher',judul='$judul',harga='$harga',title='$title',jam='$jam',bulan='$bulan',modules='$modules' WHERE id_course='$idcourse'");
			if ($update) {
				echo "Sukses!! Update Data Berhasil";
				header("Location: ?page=courses");
			} else {
				echo "Maaf!! Proses Update Data Gagal";
			}
		}

		$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM course WHERE id_course='$idcourse'"));
		?>
		<h2 class="heading_teacher">Edit Data Course <?php echo $tampildata['judul'] ?></h2>
		<form method="post" action="?page=edit_courses&&proses=update
	&&id_course=<?php echo $idcourse ?>" enctype="multipart/form-data">
			<label class="col-4">Nama guru pengajar</label>
			<div class="col-8">
				<select class="form_input" name="id_teacher">
					<?php
					$teacher = mysqli_query(
						$conn,
						"SELECT * FROM teacher"
					);
					while ($teacher1 = mysqli_fetch_array($teacher)) {
					?>
						<option value="
					<?php echo $teacher1['id_teacher']; ?>" <?php if ($tampildata['id_teacher'] == $teacher1['id_teacher']) { ?>selected <?php } ?>>
							<?php echo $teacher1['teacher']; ?></option>
					<?php } ?>
				</select>
			</div>
			<label class="col-4">Judul Course</label>
			<div class="col-8">
				<input class="form_input" type="text" name="judul" value="<?php echo $tampildata['judul']; ?>" maxlength="50" placeholder="Masukan Judul Courses">
			</div>
			<label class="col-4">Harga</label>
			<div class="col-8">
				<input class="form_input" type="text" name="harga" value="<?php echo $tampildata['harga']; ?>" placeholder="Masukan Harga">
			</div>
			<label class="col-4">Title</label>
			<div class="col-8">
				<textarea class="form_input" name="title" rows="10" style="width:100%;"><?php echo $tampildata['title']; ?></textarea>
			</div>
			<label class="col-4">Jam</label>
			<div class="col-8">
				<input class="form_input" type="number" name="jam" value="<?php echo $tampildata['jam']; ?>" placeholder="Masukan berapa jam setiap pertemuan courses">
			</div>
			<label class="col-4">Bulan</label>
			<div class="col-8">
				<input class="form_input" type="number" name="bulan" value="<?php echo $tampildata['bulan']; ?>" placeholder="Masukan berapa bulan courses berjalan">
			</div>
			<label class="col-4">Modules</label>
			<div class="col-8">
				<input class="form_input" type="number" name="modules" value="<?php echo $tampildata['modules']; ?>" placeholder="Masukan berapa modules satu courses">
			</div>
			<label class="col-4">Ganti Gambar Courses</label>
			<div class="col-8">
				<input class="form_input" type="file" name="images">
			</div>

			<div class="col-12">
				<img src="../<?php echo $tampildata['images']; ?>" alt="" width="50px">
			</div>
			<div class="row">
				<div class="col-12">
					<button class="form_button2" type="submit">Update Data</button>
				</div>
			</div>
		</form>
		<br>
	</div>
</div>
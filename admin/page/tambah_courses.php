<?php
$cekuserlogin = $_SESSION['username'];
?>
<?php
if (empty($cekuserlogin)) {
	header("Location: login.php");
} else { ?>
	<!DOCTYPE html>
	<html>

	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href=".../style.css">
	</head>

	<body>
		<div class="body_konten2">
			<div class="container">
				<h2 class="heading_teacher">COURSES</h2>
				<hr>
				<b>Tambah/Edit Data</b>
				<?php
				//proses simpan data
				$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
				if ($proses == "simpan") {
					$idteacher = @$_POST['id_teacher'];
					$judul = @$_POST['judul'];
					$harga = @$_POST['harga'];
					$title = @$_POST['title'];
					$jam = @$_POST['jam'];
					$bulan = @$_POST['bulan'];
					$modules = @$_POST['modules'];
					$nama_gambar = @$_FILES['images']['name'];
					$tmp_gambar = @$_FILES['images']['tmp_name'];
					if (!empty($nama_gambar)) {
						copy($tmp_gambar, "../images/$nama_gambar");
					}
					$simpan = mysqli_query($conn, "
    		INSERT INTO course(id_teacher,judul,harga,title,jam,bulan,modules
    		,images) 
    		VALUES('$idteacher','$judul','$harga',
    		'$title','$jam','$bulan','$modules','images/$nama_gambar')");
					if ($simpan) {
						echo "<h3>Input Data Berhasil</h3>";
					} else {
						echo "<h3>Input Data Gagal</h3>";
					}
				}
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
				?>
				<form method="post" action="?page=courses&&proses=simpan" enctype="multipart/form-data">
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
					<?php echo $teacher1['id_teacher']; ?>"><?php echo $teacher1['teacher']; ?></option>
							<?php } ?>
						</select>
					</div>
					<label class="col-4">Judul Courses</label>
					<div class="col-8">
						<input class="form_input" type="text" name="judul" maxlength="50" placeholder="Masukan Judul Courses">
					</div>
					<label class="col-4">Harga</label>
					<div class="col-8">
						<input class="form_input" type="number" name="harga" placeholder="Masukan Harga">
					</div>
					<label class="col-4">Title</label>
					<div class="col-8">
						<textarea class="form_input" name="title" rows="10" style="width:100%;"></textarea>
					</div>
					<label class="col-4">Jam</label>
					<div class="col-8">
						<input class="form_input" type="number" name="jam" placeholder="Masukan berapa jam setiap pertemuan courses">
					</div>
					<label class="col-4">Bulan</label>
					<div class="col-8">
						<input class="form_input" type="number" name="bulan" placeholder="Masukan berapa bulan courses berjalan">
					</div>
					<label class="col-4">Modules</label>
					<div class="col-8">
						<input class="form_input" type="number" name="modules" placeholder="Masukan berapa modules satu courses">
					</div>
					<label class="col-4">Upload Gambar courses</label>
					<input class="col-8" type="file" accept="image/*" name="images">

					<label class="col-4">&nbsp;</label>
					<div class="col-8">
						<button class="form_button2" type="submit">Simpan Data</button>
					</div>
				</form>
				<div class="container">
					<div class="education_search" align="center">
						<input id="live_search" class="form_search" type="text" autocomplete="off" placeholder="Ketik Nama Courses">
					</div>
				</div>
				<h3>Tampil Data</h3>
				<div id="searchresult">
					<table class="table_admin" border="1" cellpadding="5" cellspacing="0">
						<tr>
							<td>NO</td>
							<td>Judul course</td>
							<td>Harga</td>
							<td>Cover</td>
							<td>Aksi</td>
						</tr>
						<?php
						$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM teacher"));
						$i = 1;
						$tampil = mysqli_query($conn, "SELECT * FROM course");
						if (isset($_POST['cari'])) {
							$tampil = mysqli_query($conn, "SELECT * FROM course WHERE judul LIKE '%" . $_POST['cari'] . "%'");
						}
						while ($cetak = mysqli_fetch_array($tampil)) {
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $cetak['judul']; ?></td>
								<td><?php echo $cetak['harga']; ?></td>
								<td><img src="../<?php echo $cetak['images']; ?>" alt="" width="50px"></td>
								<td>
									<a class="text_kecil" href="?page=edit_courses&&id_course=
				<?php echo $cetak['id_course']; ?>">
										Edit</a>
									<a class="text_kecil2" href="?page=courses&&id_course=
				<?php echo $cetak['id_course']; ?>&&proses=hapus">
										Hapus</a>
								</td>
							</tr>
						<?php $i = $i + 1;
						} ?>
					</table>
				</div>
				<br>
			</div>
		</div>
	</body>

	</html>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#live_search").keyup(function() {
			var input = $(this).val();
			// alert(input);
			if (input != "") {
				$.ajax({
					url: "livesearch2.php",
					type: "POST",
					data: {
						input: input
					},
					success: function(data) {
						$("#searchresult").html(data);
					}
				});
			} else {

			}
		})
	});
</script>
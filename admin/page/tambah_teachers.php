<?php
$cekuserlogin = $_SESSION['username'];
?>
<?php
if (empty($cekuserlogin)) {
	header("Location: login.php");
} else { ?>
	<div class="body_konten2">
		<div class="container">
			<h2 class="heading_teacher">TEACHER</h2>

			<hr>

			<div class="kotak_form">
				<b>Tambah/Edit Data</b>
				<?php
				$idteacher = mysqli_real_escape_string($conn, @$_GET['id_teacher']);
				if (@$_GET['proses'] == "form_edit") {
					$action = "?page=teachers&&proses=edit&&id_teacher=$idteacher";
					$tampildata = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM teacher WHERE id_teacher='$idteacher'"));
				} else {
					$action = "?page=teachers&&proses=tambah";
				}
				?>
				<form method="post" action="<?php echo $action; ?>">
					<label class="col-4">Name Teacher</label>
					<div class="col-8">
						<input class="form_input" type="text" name="teacher" value="<?php echo @$tampildata['kategori']; ?>" placeholder="Name Teacher" class="form_input">
					</div>
					<input type="submit" name="Simpan" value="Simpan" class="form_button2">
				</form>
			</div><br>
			<div class="kotak_form">
				<?php
				$proses = mysqli_real_escape_string($conn, @$_GET['proses']);
				$teacher = mysqli_real_escape_string($conn, @$_POST['teacher']);
				$idteacher = mysqli_real_escape_string($conn, @$_GET['id_teacher']);
				if ($proses == "tambah") {
					$simpan = mysqli_query($conn, "INSERT INTO teacher(teacher) VALUES('$teacher')");
					if ($simpan) {
						echo "Sukses!!, Simpan Data Berhasil<br>";
					} else {
						echo "Maaf!!, Simpan Data Gagal<br>";
					}
				}
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
				?>
				<div class="container">
					<div class="education_search" align="center">
						<input id="live_search" class="form_search" type="text" autocomplete="off" placeholder="Ketik Nama Courses">
					</div>
				</div>
				<b>Tampil Data</b><br><br>
				<div id="searchresult">
					<table border="3" cellpadding="3" cellspacing="1" width="100%">
						<tr>
							<td><b>No</b></td>
							<td><b>Teachers</b></td>
							<td>Aksi</td>
						</tr>
						<?php
						$i = 1;
						$teacher = mysqli_query($conn, "SELECT * FROM teacher");
						if (isset($_POST['cari'])) {
							$teacher = mysqli_query($conn, "SELECT * FROM teacher WHERE teacher LIKE '%" . $_POST['cari'] . "%'");
						}
						while ($teacher1 = mysqli_fetch_array($teacher)) {
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $teacher1['teacher']; ?></td>
								<td>
									<a class="text_kecil" href="?page=edit_teachers&&id_teacher=<?php echo $teacher1['id_teacher'] ?>" class="">Edit</a>
									<a class="text_kecil2" href="?page=teachers&&id_teacher=<?php echo $teacher1['id_teacher'] ?>&&proses=hapus" class="">Hapus</a>
								</td>
							</tr>
						<?php $i = $i + 1;
						} ?>
					</table>
				</div>
				<br>
			</div>
		</div>
	</div>
<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#live_search").keyup(function() {
			var input = $(this).val();
			// alert(input);
			if (input != "") {
				$.ajax({
					url: "livesearch.php",
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
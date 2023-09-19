<!-- 
 Lokasi dan Nama File	: page/kategori_produk1.php
-->
<?php
$id_teacher = mysqli_real_escape_string($conn, @$_GET['id_teacher']);
$teacher = mysqli_query($conn, "SELECT * FROM teacher WHERE id_teacher='$id_teacher' ORDER BY id_teacher DESC");
$teacher1 = mysqli_fetch_array($teacher);
?>
<section class="course" id="course">
    <h1 class="heading">courses teacher <?php echo $teacher1['teacher'] ?></h1>
    <div class="box-container">
        <?php
        $course = mysqli_query($conn, "SELECT * FROM course WHERE id_teacher='$id_teacher' ORDER BY id_course DESC");
        $course1 = mysqli_num_rows($course);
        if ($course1 == 0) {
            echo "<font size='+2' color='#FF0004'>Maaf!! Data Course pada Teacher ini masih Kosong</font>";
        }
        while ($course1 = mysqli_fetch_array($course)) {
        ?>
            <div class="box">
                <img src="<?php echo $course1['images'] ?>" alt="">
                <h3 class="price">Rp.<?php echo number_format($course1['harga']); ?></h3>
                <div class="content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                    <a href="?page=detail_courses&&id_course=<?php echo $course1['id_course'] ?>" class="title"><?php echo $course1['judul'] ?></a>
                    <p><?php echo $course1['title'] ?></p>
                    <div class="info">
                        <h3> <i class="far fa-clock"></i> <?php echo $course1['jam'] ?> hours </h3>
                        <h3> <i class="far fa-calendar-alt"></i> <?php echo $course1['bulan'] ?> months </h3>
                        <h3> <i class="fas fa-book"></i> <?php echo $course1['modules'] ?> modules </h3>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
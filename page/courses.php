<!-- course section starts  -->

<section class="course" id="course">
    <div class="container">
        <div class="education_search" align="center">
            <input id="live_search" class="form_search" type="text" autocomplete="off" placeholder="Ketik Nama Courses">
        </div>
    </div>
    <h1 class="heading">our popular courses</h1>

    <div class="box-container" id="searchresult">
        <?php
        $course = mysqli_query($conn, "SELECT * FROM course ORDER BY id_course");
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
<!-- course section ends -->
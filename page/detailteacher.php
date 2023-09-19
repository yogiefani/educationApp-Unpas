<!-- course section starts  -->

<section class="course" id="course">
    <div class="container">
        <div class="education_search" align="center">
            <input id="live_search" class="form_search" type="text" autocomplete="off" placeholder="Ketik Nama Teacher">
        </div>
    </div>

    <h1 class="heading">Teacher expert teachers</h1>

    <div class="box-container">
        <?php
        $idteacher = @$_GET['id_teacher'];
        $teacher = mysqli_query($conn, "SELECT * FROM teacher ORDER BY id_teacher");
        if (isset($_POST['cari'])) {
            $teacher = mysqli_query($conn, "SELECT * FROM teacher WHERE teacher LIKE '%" . $_POST['cari'] . "%'");
        }
        while ($teacher1 = mysqli_fetch_array($teacher)) {
        ?>
            <div class="box">
                <img src="images/teacher.png" alt="">
                <div class="content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                    <a href="?page=detail_teacher2&&id_teacher=<?php echo @$teacher1['id_teacher']; ?>" class="title"><?php echo $teacher1['teacher'] ?></a>
                    <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Dolorem, Beatae. Modi Quos Excepturi Id Quibusdam? Molestiae Quis Nihil Non Debitis!</p>
                </div>
            </div>
        <?php } ?>

    </div>

</section>

<!-- course section ends -->
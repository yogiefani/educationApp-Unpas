<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Web</title>

    <!-- google fonts cdn link  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- header section starts  -->

    <header>

        <div id="menu" class="fas fa-bars"></div>

        <a href="#" class="logo"><i class="fas fa-user-graduate"></i></a>

        <nav class="navbar">
            <ul>
                <li><a class="active" href="?page">home</a></li>
                <li><a href="?page=about">about</a></li>
                <li><a href="?page=courses">course</a></li>
                <li><a href="?page=teachers">teacher</a></li>
                <li><a href="?page=contact">contact</a></li>
            </ul>
        </nav>

        <div id="login" class="fas fa-user-circle"></div>

    </header>

    <!-- header section ends -->

    <!-- login form  -->

    <div class="login-form">

        <form action="">
            <h3>login</h3>
            <input type="email" placeholder="username" class="box">
            <input type="password" placeholder="password" class="box">
            <p>forget password? <a href="#">click here</a></p>
            <p>don't have an account? <a href="#">register now</a></p>
            <input type="submit" class="btn" value="login">
            <i class="fas fa-times"></i>
        </form>

    </div>
    <!-- page section starts  -->
    <div class="contents">
        <?php
        $page = @$_GET['page'];
        if ($page == "about") {
            include "page/about.php";
        } elseif ($page == "contact") {
            include "page/contact.php";
        } elseif ($page == "courses") {
            include "page/courses.php";
        } elseif ($page == "teachers") {
            include "page/teachers.php";
        } elseif ($page == "detail_teacher") {
            include "page/detailteacher.php";
        } elseif ($page == "detail_teacher2") {
            include "page/detailteacher2.php";
        } elseif ($page == "detail_courses") {
            include "page/detailcourses.php";
        } else {
            include "page/home.php";
        }
        ?>


    </div>
    <!-- page section ends  -->


    <!-- footer section starts  -->

    <div class="footer">

        <h1 class="credit">created by <a href="#">mr. web designer</a> all rights reserved. </h1>

    </div>

    <!-- footer section ends -->





















</body>

</html>
<?php 

session_start();
if (!isset($_SESSION['id'])) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/header.css">
    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
</head>

<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-3 shadow flash-vn" style="background-color: #004AAD;">
        <a href="../index/home.php" class="navbar-brand col-sm-3 col-md-2 mr-0">
            <span class="flash-vn" style="position: relative; display: inline-block; top: -18px;">
                FLASH VN
                <small class="flash-vn" style="background-color: yellow; padding: 5px; border-radius: 5px; color: #004AAD; font-size: 0.8rem; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);">Kỹ năng số cho cộng đồng</small>
            </span>
        </a>
    </nav>





    <div class="container-fluid mb-5" style="margin-top: 60px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 sidebar py-5d-print-none" style="padding-top:40px; margin-left:-20px;">
                <div  class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="uil uil-tachometer-fast-alt"></i>
                                <b>Dashboard</b>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="course.php" class="nav-link">
                                <i class="uil uil-book-alt"></i>
                                <b>Courses</b>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="lesson.php" class="nav-link">
                                <i class="uil uil-book-reader"></i>
                                <b>Lessons</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="lectures.php" class="nav-link">
                            <i class="uil uil-user-plus"></i>
                                <b>Lectures</b>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="students.php" class="nav-link">
                                <i class="uil uil-user"></i>
                                <b>Students</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="exam.php" class="nav-link">
                            <i class="uil uil-plus"></i>
                                <b>Add Quiz Category</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="add-quizz.php" class="nav-link">
                            <i class="uil uil-plus-circle"></i>
                                <b>Add Quiz</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="result.php" class="nav-link">
                            <i class="uil uil-file-landscape-alt"></i>
                                <b>All Result</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="add-certificate.php" class="nav-link">
                            <i class="uil uil-award-alt"></i>
                                <b>Add Certificate</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="blog.php" class="nav-link">
                            <i class="uil uil-blogger-alt"></i>
                                <b>Blogs</b>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="report.php" class="nav-link">
                                <i class="uil uil-analysis"></i>
                                <b>Report</b>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="enrollstatus.php" class="nav-link">
                                <i class="uil uil-invoice"></i>
                                <b>Enrolled Status</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="feedback.php" class="nav-link">
                                <i class="uil uil-feedback"></i>
                                <b>Feedback</b>
                            </a>
                        </li> 


                        <li class="nav-item">
                            <a href="messages.php" class="nav-link">
                            <i class="uil uil-envelope-add"></i>
                                <b>Messages</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="changepass.php" class="nav-link">
                                <i class="uil uil-key-skeleton"></i>
                                <b>Change Password</b>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="uil uil-sign-out-alt"></i>
                                <b>Log Out</b>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

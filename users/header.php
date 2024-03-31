<?php

    session_start();
include_once("../database/db.php");

if (!isset($_SESSION['stu_id'])) {
    header('Location:../index/home.php');
}
$stu_email=$_SESSION['stu_email'];
if (isset($stu_email)) {
    $sql = "SELECT stu_img FROM students WHERE stu_email='$stu_email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stu_img = $row['stu_img'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
</head>
<style>
        body {
            background: #f7f9fa;
            color: rgb(255, 255, 255);
        }

        .nav-link {
            transition: all 400ms ease;
            color: black;
        }

        .navbar-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar-brand small {
            font-size: 1rem;
            display: block;
            color: #004AAD;
            background-color: yellow;
            border-radius: 5px;
            padding: 3px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-3 shadow flash-vn" style="background-color: #004AAD;">
        <a href="../index/home.php" class="navbar-brand col-sm-3 col-md-2 mr-0">
            FLASH VN
            <small>Kỹ năng số cho cộng đồng</small>
        </a>
    </nav>

    <!-- Side Bar -->
    <div class="container-fluid mb-5" style="margin-top: 100px;">
        <div class="row">
            <nav class="col-sm-3 col-md-2 sidebar py-5d-print-none" style="padding-top:40px; margin-left:-20px;">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-3">
                            <img src="<?php echo $stu_img ?>" alt="" class="img-thumbnail rounded-circle" >
                        </li>
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">
                                <i class="uil uil-user-square"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="course.php" class="nav-link">
                                <i class="uil uil-book"></i>
                                Khóa Học Của Tôi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="enrollquiz.php" class="nav-link">
                                <i class="uil uil-clipboard-alt"></i>
                                Trắc Nghiệm
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="feedback.php" class="nav-link">
                            <i class="uil uil-feedback"></i>
                                Feedback
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="get-certificate.php" class="nav-link">
                            <i class="uil uil-award"></i>
                                Lấy Chứng Chỉ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="uil uil-sign-out-alt"></i>
                                Đăng Xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
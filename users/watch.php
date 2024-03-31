<?php
session_start();
include_once("../database/db.php");

if (!isset($_SESSION['stu_id'])) {
    header('Location:..//index/home.php');
}
$link = $_REQUEST['link'];
?>
<link rel="stylesheet" href="css/watchcourse.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<title>Knowledge Nest</title>


<?php
if (isset($_REQUEST['link'])) {
    $sql = "SELECT * FROM lesson WHERE lesson_link='$link'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<div style="height: 80px; background-color: #004AAD;" class="container-fluid bg p-2 d-flex align-items-center justify-content-center">
    <h4 class="text-white mt-4"><?php echo $row['course_name'] ?></h4>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 border-right mt-5">
            <?php
            $txt = '
            <h3 style="width: 800px;" class="ms-5"> Tên Bài Giảng: ' . $row['lesson_name'] . '</h3>
            <iframe id="videoarea" width="1000" height="410" src="https://www.youtube-nocookie.com/embed/'. $link . '?controls=0"  allowfullscreen class="mt-5 ml-5"></iframe>';
            echo $txt;
            ?>
            <a href="listview.php?course_id=<?php echo $row['course_id'] ?>" class="btn btn-primary mt-5 ms-5" style="background-color: #004AAD;">Hoàn Thành</a>
        </div>

        <div class="col-sm-8 mt-5 m-auto">
            <video hidden class="mt-5 ml-5" id="videoarea" src="" controls></video>


            <br>
            <br><br>
        </div>

    </div>
</div>
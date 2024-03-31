<?php
include_once("header.php");
include_once("../database/db.php");
?>
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/coursedetails.css">

<?php

if (isset($_SESSION['stu_id'])) {
    $stu_email = $_SESSION["stu_email"];
    $cid = $_GET['course_id'];
    $_SESSION["course_id"] = $cid;
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM courseorder WHERE stu_email='$stu_email' && course_id='$cid'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>setTimeout(()=>{window.location.href='../users/course.php';},0);</script>";
        } else {
            echo "<script>setTimeout(()=>{window.location.href='../users/enroll.php';},0);</script>";
        }
    }
}
?>

<section id="course-inner">
    <?php
    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];
        $sql = "SELECT * FROM course WHERE course_id='$course_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <div class="overview">
        <img class="course-img" src="<?php echo $row['course_img']; ?>" alt="">
        <div class="course-head">
            <div class="c-name">
                <h3><?php echo $row['course_name'] ?></h3>
            </div>
            <span class="price">Giá <?php echo $row['course_price'] ?></span>
        </div>
        <h3>Tên Giảng Viên</h3>
        <div class="tutor">
            <div class="tutor-dt">
                <p> <?php echo $row['course_author']  ?></p>
            </div>
        </div>
        <!-- <hr> -->
        <h3>Mô Tả</h3>
        <p class="description"> <?php echo $row['course_desc']  ?></p>
    </div>

    <div class="enroll">
        <h3>Khóa học này bao gồm:</h3>
        <p><i class="uil uil-book"></i><?php echo $row['course_lessons']  ?> bài giảng</p>
        <p><i class="uil uil-clock"></i><?php echo $row['course_duration']  ?> giờ video trực tuyến</p>
        <p><i class="uil uil-life-ring"></i>Truy cập trọn đời</p>
        <p><i class="uil uil-mobile-android"></i>Truy cập trên di động</p>
        <p><i class="uil uil-newspaper"></i>Tham gia bài kiểm tra</p>
        <div class="enroll-btn">
            <?php
            if (isset($_SESSION['stu_id'])) {
                echo '
                <form action="" method="POST" class="d-inline">
                <input type="hidden" name="id" value="' . $row["course_price"] . '">
                <button type="submit" class="button" name="view">Đăng Ký Ngay</button>
                </form>
                    ';
            } else {
                echo '
                <a href="popup.php" class="button">Đăng Ký Ngay</a>
                ';
            }
            ?>
        </div>
    </div>

</section>

<table>
    <thead>
        <th scope="col-2">Bài Học Số</th>
        <th scope="col-10">Tên Bài Học</th>
    </thead>

    <tbody>
        <?php
        $sql = "SELECT * FROM lesson";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $num = 0;
            while ($row = $result->fetch_assoc()) {
                if ($course_id == $row['course_id']) {
                    $num++;
                    echo ' <tr class="tr">
        <th scope="row">' . $num . '</th>
        <td>' . $row['lesson_name'] . '</td>
        </tr>';
                }
            }
        }
        ?>
    </tbody>
</table>
<br>
<style>
    table {
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        padding-bottom: 100px;
        font-size: 1.3rem;
        margin-top: -50px;
    }
    td {
        text-align: center;
    }
</style>
<?php
include_once("footer.php");
?>

<?php
session_start();
include_once("../database/db.php");

if (!isset($_SESSION['stu_id'])) {
    header('Location:../index/home.php');
}
?>
<link rel="stylesheet" href="css/watchcourse.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<title>Khóa học</title>
<script type="text/javascript">
    function preventbackbutton() {
        window.history.forward();
    }
    setTimeout("preventbackbutton()", 0);
    window.onunload = function() {
        alert("nfdsjdsn");
    }; 
</script>

<body>


    <?php
    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];
        $sql = "SELECT * FROM course WHERE course_id='$course_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    
    <div style="height: 120px; background-color: #004AAD;" class="container-fluid bg p-2 d-flex flex-column align-items-center justify-content-center">
        <h4 class="text-white mb-3"><?php echo $row['course_name']  ?></h4>
        <a href="course.php" class="btn fw-bolder btn btn-primary">Trở Về Danh Sách Khóa Học</a>
    </div>


    <div class="col-sm-9 mt-5 m-auto">
        <p class="bg text-white p-2 fw-bolder text-center" style="background-color: #004AAD;">Danh Sách Bài Giảng</p>
        <?php
        $course_id = $_GET['course_id'];
        $sql = "SELECT * FROM lesson WHERE course_id='$course_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-dark fw-bolder" scope="col">ID Bài Giảng</th>
                        <th class="text-dark fw-bolder" scope="col">Tên Bài Giảng</th>
                        <th class="text-dark fw-bolder" scope="col">Hoạt Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<th class="text-dark fw-bolder" scope="row">' . $row['lesson_id'] . '</th>';
                        echo '<td class="text-dark fw-bolder">' . $row['lesson_name'] . '</td>';
                        echo '<td>';
                        echo '
                <form action="Watch.php?lesson_link=' . $row['lesson_link'] . '" method="POST" class="d-inline">
                <input type="hidden" name="link" value=' . $row['lesson_link'] . '>
                <button type="submit" class="btn btn-info mr-3"  name="view" value="View">Xem</button>
                </form>
                </td>
            </tr>';
                    } ?>
                </tbody>
            </table>
        <?php } else {
            echo "<p class='text-dark p-2 fw-bolder'>Chưa có bài giảng. </p>";
        }


        ?>
    </div>
    </div>
    </div>
</body>
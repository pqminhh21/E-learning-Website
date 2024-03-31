<?php
include_once("header.php");
include_once("../database/db.php");

$c_name = '';
$c_desc = '';
$c_auth = '';
$c_dur = '';
$c_price = '';
$c_less = '';
$course_level = '';

if (isset($_POST['courseSubmitBtn'])) {

    $c_name = $_POST['course_name'];
    $c_desc = $_POST['course_desc'];
    $c_auth = $_POST['course_author'];
    $c_dur = $_POST['course_duration'];
    $c_price = $_POST['course_price'];
    $c_less = $_POST['course_lessons'];
    $course_level = $_POST['course_level'];

    if (empty($c_name) || empty($c_desc) || empty($c_auth) || empty($c_dur) || empty($c_price) || empty($c_less)) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">All Fields Required</div>';
    } else {
        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];
        $course_author = $_POST['course_author'];
        $course_duration = $_POST['course_duration'];
        $course_price = $_POST['course_price'];
        $course_lessons = $_POST['course_lessons'];
        $course_image = $_FILES['course_img']['name'];
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../images/course-img/' . $course_image;
        move_uploaded_file($course_image_temp, $img_folder);

        $sql = "INSERT INTO course(course_name, course_desc, course_author, course_img, course_duration, course_price, course_lessons, level) VALUES ('$course_name','$course_desc','$course_author','$img_folder','$course_duration','$course_price','$course_lessons', '$course_level')";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Course Added Successfully</div>';
            echo "<script>setTimeout(()=>{window.location.href='Course.php';},300);</script>";
        } else {
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Course Added Failed</div>';
        }
    }
}
?>
<div class="col-sm-6 mt-5 jumbotron">
    <h3 class="text-center">Add New Course</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <br>
        <?php if (isset($msg)) {
            echo $msg;
        } ?><br>
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" id="course_name" name="course_name" class="form-control" <?php echo 'value="' . $c_name . '"' ?>>
        </div><br>
        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <input type="text" id="course_desc" name="course_desc" row=2 class="form-control" <?php echo 'value="' . $c_desc . '"' ?>>
        </div>
        <br>
        <div class="form-group">
            <label for="course_author">Lecture</label>
            <?php echo '' . $c_auth . '' ?>
            <select class="form-control" name="course_author" id="course_author">
                                    <?php
                                    $sql = "SELECT * FROM lectures";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="none" selected disabled hidden>--Select Lecture--</option>
                                        <option value="<?php echo $row['l_name']; ?>"><?php echo $row['l_name']; ?></option> <?php } ?>
                                </select>
        </div>
        <br>
        <div class="form-group">
            <label for="course_duration">Course Duration (Hours)</label>
            <input type="number" id="course_duration" name="course_duration" class="form-control"<?php echo 'value="' . $c_dur . '"' ?>>
        </div>
        <br>
        <div class="form-group">
            <label for="course_price">Course Price</label>
            <input type="float" id="course_price" name="course_price" class="form-control" <?php echo 'value="' . $c_price . '"' ?>>
        </div>
        <br>
        <div class="form-group">
            <label for="course_lessons">Course Lessons</label>
            <input type="number" id="course_lessons" name="course_lessons" class="form-control"<?php echo 'value="' . $c_less . '"' ?>>
        </div>
        <br>
        <div class="form-group">
            <label for="course_img">Course Image</label>
            <input type="file" id="course_img" name="course_img" class="form-control-file">
        </div>
        <br>
        <div class="form-group">
            <label for="course_level">Course Level</label>
            <select class="form-control" id="course_level" name="course_level">
            <option value="Beginner">Cơ Bản</option>
            <option value="Intermediate">Trung Bình</option>
            <option value="Advanced">Nâng Cao</option>
            </select>
        </div>
        <br>                                   
        <div class="text-center">
            <button class="btn btn-danger" type="submit" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
            <a href="course.php" class="btn btn-secondary">Close</a>
        </div>



    </form>
</div>
<?php
include_once("footer.php");
?>
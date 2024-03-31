<?php

include_once("header.php");
include_once("../database/db.php");

if (isset($_REQUEST['reqUpdate'])) {
    if (($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") ||  ($_REQUEST['course_author'] == "")  ||  ($_REQUEST['course_duration'] == "")  ||  ($_REQUEST['course_price'] == "") ||  ($_REQUEST['course_lessons'] == "")) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">All Fields Required</div>';
    } else {
        $cid = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];
        $cdesc = $_REQUEST['course_desc'];
        $cauthor = $_REQUEST['course_author'];
        $cduration = $_REQUEST['course_duration'];
        $cprice = $_REQUEST['course_price'];
        $course_level = $_REQUEST['course_level'];

        $sql = "UPDATE course SET course_id='$cid',course_name='$cname',course_desc='$cdesc',course_author='$cauthor',course_duration='$cduration',course_price='$cprice',course_lessons='$clessons',level='$course_level' WHERE course_id='$cid'";


        if ($conn->query($sql) == TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Updated Successfully</div>';
            echo "<script>setTimeout(()=>{window.location.href='course.php';},300);</script>";
        } else {
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Updated Failed</div>';
        }
    }
}
?>

    
<div class="col-sm-6 mt-5 jumbotron">
    <h3 class="text-center">Edit Course Details</h3>
    <?php
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM course WHERE course_id={$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }



    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <br>
        <?php if (isset($msg)) {
            echo $msg;
        } ?><br>
        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" id="course_id" name="course_id" class="form-control" value="<?php if (isset($row['course_id'])) {
                                                                                                echo $row['course_id'];
                                                                                            } ?>" readonly>
        </div><br>
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" id="course_name" name="course_name" class="form-control" value="<?php if (isset($row['course_name'])) {
                                                                                                    echo $row['course_name'];
                                                                                                } ?>">
        </div><br>
        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <input id="course_desc" name="course_desc" class="form-control" value="<?php if (isset($row['course_desc'])) {
                echo $row['course_desc'];
            } ?>">
            </input>
        </div>
        <br>
        <div class="form-group">
            <label for="course_author">Author</label>
            <input type="text" id="course_author" name="course_author" class="form-control" value="<?php if (isset($row['course_author'])) {
                                                                                                        echo $row['course_author'];
                                                                                                    } ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="course_duration">Course Duration</label>
            <input type="text" id="course_duration" name="course_duration" class="form-control" value="<?php if (isset($row['course_duration'])) {
                                                                                                            echo $row['course_duration'];
                                                                                                        } ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="course_price">Course Price</label>
            <input type="text" id="course_price" name="course_price" class="form-control" value="<?php if (isset($row['course_price'])) {
                                                                                                        echo $row['course_price'];
                                                                                                    } ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="course_lessons">Course Lessons</label>
            <input type="text" id="course_lessons" name="course_lessons" class="form-control" value="<?php if (isset($row['course_lessons'])) {
                                                                                                            echo $row['course_lessons'];
                                                                                                        } ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="course_img">Course Image</label>
            <br>
            <img style="height: 300px; width:400px;" src="<?php if (isset($row['course_img'])) {
                            echo $row['course_img'];
                        } ?>" alt="" class="img-thumbnail">
        </div>
        <br>
        <div class="form-group">
    <label for="course_level">Course Level</label>
    <select id="course_level" name="course_level" class="form-control">
        <option value="Beginner" <?php if (isset($row['level']) && $row['level'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
        <option value="Intermediate" <?php if (isset($row['level']) && $row['level'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
        <option value="Advanced" <?php if (isset($row['level']) && $row['level'] == 'Advanced') echo 'selected'; ?>>Advanced</option>
    </select>
    </div>
        <br>               
        <div class="text-center">
            <button class="btn btn-danger" type="submit" id="reqUpdate" name="reqUpdate">Update</button>
            <a href="course.php" class="btn btn-secondary">Close</a>
        </div>



    </form>
</div>


<?php
include_once("footer.php");
?>
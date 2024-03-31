<?php
include_once("header.php");
include_once("../database/db.php");
?>

<link rel="stylesheet" href="CSS/course.css">
<link rel="stylesheet" href="CSS/responsive.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<section class="courses">
    <h2>Tất Cả Khóa Học</h2>

    <div class="col">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="search_text" name="search_text" placeholder="Tìm Kiếm Tại Đây">
        </div>
        <div class="input-group mb-3">
            <select class="form-control" id="level" name="level">
                <option value="">Tất Cả</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
        </div>
        <br><br><br><br>
        <div id="result" class="container courses__container">
            <!-- Kết quả tìm kiếm sẽ được hiển thị ở đây -->
        </div>
        <br><br><br><br><br><br><br>
    </div>

    <div class="container courses__container">
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $course_id = $row['course_id'];
            $_SESSION["course_id"] = $course_id;
            echo '
            <article class="course">
                <a href="course-details.php?course_id=' . $course_id . '">
                    <div class="course__image">
                        <img src="' . $row['course_img'] . '" alt="">
                    </div>
                    <div class="course__info">
                        <h3 style="text-align: start;">' . $row['course_name'] . '</h3>
                        <h5 style="text-align: start; margin-top: 10px;">' . $row['course_author'] . '</h5>
                        
                        <p style="text-align: start; margin-top: 5px; font-size: smaller; font-style: italic;">Cấp độ: ' . $row['level'] . '</p>
                        
                        <h4 style="text-align: start; margin-top: 10px;">Giá ' . $row['course_price'] . '</h4>
                        <br>
                        <a href="course-details.php?course_id=' . $course_id . '">
                            <button class="button">Tìm Hiểu Thêm</button>
                        </a>
                    </div>
                </a>
            </article>';
        }
    }
    ?>

    </div>
</section>

<script>
    $(document).ready(function () {
        $('#search_text, #level').on('change keyup', function () {
            searchCourses();
        });
    });

    function searchCourses() {
        var txt = $('#search_text').val();
        var level = $('#level').val();

        $.ajax({
            url: "course_fetch.php",
            type: "post",
            data: { search: txt, level: level },
            dataType: "text",
            success: function (data) {
                $('#result').html(data);
            }
        });
    }
</script>

<?php
include_once("footer.php");
?>

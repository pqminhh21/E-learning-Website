<?php
include_once("../database/db.php");

$output = '';

$sql = "SELECT * FROM course WHERE course_name LIKE '%" . $_POST["search"] . "%'";
if (!empty($_POST["level"])) {
    $sql .= " AND level = '" . $_POST["level"] . "'";
}
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row["course_id"];
        $output .= '
        <article class="course">
            <a href="course-details.php?course_id=' . $id . '">
                <div class="course__image">
                    <img src="' . $row['course_img'] . '" alt="">
                </div>
                <div class="course__info">
                    <h3 style="text-align: start;">' . $row['course_name'] . '</h3>
                    <h5 style="text-align: start; margin-top: 10px;">' . $row['course_author'] . '</h5>
                    <p style="text-align: start; margin-top: 5px; font-size: smaller; font-style: italic;">Cấp độ: ' . $row['level'] . '</p>
                    <h4 style="text-align: start; margin-top: 10px;">Giá: ' . $row['course_price'] . '</h4>
                    <br>
                    <a href="course-details.php?course_id=' . $id . '">
                        <button class="button">Tìm Hiểu Thêm</button>
                    </a>
                </div>
            </a>
        </article>';
    }
    echo '<div class="container courses__container">' . $output . '</div>';
} else {
    echo "<p class='alert'>Khóa học không được tìm thấy. </p>";
}
?>

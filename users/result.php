<?php
include_once("header.php");
include_once("../database/db.php");
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
?>
<div class="col-sm-9 mt-5 bg-transparent carousel-fade ms-5">
    <h5 class="bg card text-white p-2 text-center" style="background-color: #004AAD; font-size: 1.3rem;">Kết quả</h5>
    <?php
    $correct = 0;
    $wrong = 0;
    $answers = array();

    if (isset($_SESSION["answer"])) {
        for ($i = 1; $i <= sizeof($_SESSION["answer"]); $i++) {
            $answer = "";
            $res = mysqli_query($conn, "SELECT * FROM add_ques WHERE category='$_SESSION[exam_category]' && ques_no=$i");
            $row = mysqli_fetch_array($res);

            if ($row) {
                $answer = $row["answer"];
            } else {
                continue;
            }
            $user_answer = isset($_SESSION["answer"][$i]) ? $_SESSION["answer"][$i] : "";
            $answers[$i] = $user_answer;

            if (isset($_SESSION["answer"][$i])) {
                if ($answer == $_SESSION["answer"][$i]) {
                    $correct = $correct + 1;
                } else {
                    $wrong = $wrong + 1;
                }
            } else {
                $wrong = $wrong + 1;
            }
        }
    }

    $count = 0;
    $res = mysqli_query($conn, "SELECT * FROM add_ques WHERE category='$_SESSION[exam_category]'");
    $count = mysqli_num_rows($res);

    $wrong = $count - $correct;
    $mark = ($correct / $count) * 100;
    echo "<br>"; echo "<br>";
    echo "<center>";
    echo "<h4 class='fw-bolder text-dark'>Tổng Số Câu Hỏi= $count</h4>";
    echo "<h4 class='fw-bolder text-dark'>Câu Đúng= $correct</h4>";
    echo "<h4 class='fw-bolder text-dark'>Câu Sai= $wrong</h4>";
    echo "<h4 class='fw-bolder text-dark'>Điểm= $mark</h4>";
    echo "</center>";
    ?>

    <br><br><br><br>
    <div class="container">
        <div class="col-md-12 text-center">
            <a href="enrollquiz.php">
                <button type="button" name="mainmenu" class="btn btn-primary text-light fw-bolder" style="background-color: #004AAD;">Trở về</button>
            </a>
            <br><br>

            <?php
            if ($mark < 80) {
                $msg = '<div class="alert alert-warning m-auto col-sm-6 ml-5 mt-2 fw-bolder text-danger">Lưu ý: Điểm của bạn ít hơn 80. Bạn cần đạt được chứng chỉ với điểm cao hơn 80. Hãy thử làm bài kiểm tra lại để đạt được hơn 80 điểm.</div>';
            }

            // Display user's answers
            echo '<table class="table">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th scope="col">Câu hỏi</th>';
            echo '<th scope="col">Đáp Án Đã Chọn</th>';
            echo '<th scope="col">Kết Quả</th>';
            echo '<th scope="col">Gợi Ý</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Loop through each question
            for ($i = 1; $i <= sizeof($answers); $i++) {
                $user_answer = $answers[$i];
                $res = mysqli_query($conn, "SELECT * FROM add_ques WHERE category='$_SESSION[exam_category]' && ques_no=$i");
                $row = mysqli_fetch_array($res);

                echo '<tr>';
                echo "<td>{$row['question']}</td>";
                echo "<td>$user_answer</td>";

                // Check if the answer is correct or incorrect
                if ($user_answer == $row['answer']) {
                    echo '<td class="text-success">Đúng</td>';
                } else {
                    echo '<td class="text-danger">Sai</td>';
                    if (!empty($row['suggestion'])) {
                        echo "<td>{$row['suggestion']}</td>";
                    } else {
                        echo '<td></td>';
                    }
                }

                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';    
            ?>

            <?php if (isset($msg)) {
                echo $msg;
            } ?>
            <br>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION["exam_start"])) {
    $date = date("Y-m-d H:i:s");
    if ($mark >= 80) {
        mysqli_query($conn, "INSERT INTO exam_result( email, exam_type, total_question, correct_answer, wrong_answer, exam_time, mark) VALUES ('$_SESSION[stu_email]','$_SESSION[exam_category]','$count','$correct','$wrong','$date','$mark')");
    } else {
        $msg = '<div class="alert alert-warning m-auto col-sm-6 ml-5 mt-2 fw-bolder text-danger">Lưu ý: Điểm của bạn ít hơn 80. Bạn cần đạt được chứng chỉ với điểm cao hơn 80. Hãy thử làm bài kiểm tra lại để đạt được hơn 80 điểm.</div>';
    }
}
if (isset($_SESSION["exam_start"])) {
    unset($_SESSION["exam_start"]);
    ?>
    <script type="text/javascript">
        window.location.href = window.location.href;
    </script>
<?php
}
?>

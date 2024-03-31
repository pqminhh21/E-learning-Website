<?php
include_once("header.php");
include_once("../database/db.php");

if (isset($_REQUEST['quesSubmitBtn'])) {
    if (empty($_REQUEST['add_ques']) || empty($_REQUEST['ans1']) || empty($_REQUEST['ans2']) || empty($_REQUEST['ans3']) || empty($_REQUEST['ans4']) || empty($_REQUEST['correct_ans'])) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">All Fields Required</div>';
    } else {
        $add_ques = $_REQUEST['add_ques'];
        $ans1 = $_REQUEST['ans1'];
        $ans2 = $_REQUEST['ans2'];
        $ans3 = $_REQUEST['ans3'];
        $ans4 = $_REQUEST['ans4'];
        $correct_ans = $_REQUEST['correct_ans'];  // Lấy trực tiếp giá trị của radio button

        // Kiểm tra giá trị của radio button đã được chọn
        if ($correct_ans == "ans1") {
            $correct_ans = $_REQUEST['ans1'];
        } else if ($correct_ans == "ans2") {
            $correct_ans = $_REQUEST['ans2'];
        } else if ($correct_ans == "ans3") {
            $correct_ans = $_REQUEST['ans3'];
        } else if ($correct_ans == "ans4") {
            $correct_ans = $_REQUEST['ans4'];
        }

        $name = $_REQUEST['name'];

        $loop = 0;
        $count = 0;

        $res = mysqli_query($conn, "SELECT * FROM add_ques WHERE category='$name' ORDER BY id ASC") or die(mysqli_error($conn));
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_array($res)) {
                $loop = $loop + 1;
                mysqli_query($conn, "UPDATE add_ques SET ques_no='$loop' WHERE id=$row[id]");
            }
        }

        $loop = $loop + 1;
        
        $suggestion = isset($_REQUEST['suggestion']) ? $_REQUEST['suggestion'] : '';
        
        $sql = "INSERT INTO add_ques(ques_no, question, opt1, opt2, opt3, opt4, answer, category, suggestion) 
        VALUES ('$loop', '$add_ques', '$ans1', '$ans2', '$ans3', '$ans4', '$correct_ans', '$name', '$suggestion')";


        if ($conn->query($sql) == TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Question Added Successfully</div>';
            echo "<script>setTimeout(()=>{window.location.href='add-quizz.php';},100);</script>";
        } else {
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Question Added Failed</div>';
        }
    }
}
?>



<!-- Form -->
<div class="col-sm-6 mt-5 jumbotron">
    <?php
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM exam_category WHERE id={$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <h3 class="text-center">Add Question</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <br>
        <?php if (isset($msg)) { echo $msg; } ?><br>
        <div class="form-group">
            <label for="course_name">Exam Category</label>
            <input type="text" id="name" name="name" value="<?php if (isset($row['exam_name'])) { echo $row['exam_name']; } ?>" class="form-control fw-bold bg-transparent border-0 text-dark" readonly>
        </div>
        <br>
        <div class="form-group">
            <label for="course_name">Add Question</label>
            <input type="text" id="add_ques" name="add_ques" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="course_desc">Answer 01</label>
            <input type="text" id="ans1" name="ans1" row=2 class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="course_desc">Answer 02</label>
            <input type="text" id="ans2" name="ans2" row=2 class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="course_desc">Answer 03</label>
            <input type="text" id="ans3" name="ans3" row=2 class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="course_desc">Answer 04</label>
            <input type="text" id="ans4" name="ans4" class="form-control">
        </div>
        <br>
        <div class="form-group">
            <label for="course_desc">Correct Answer</label><br>
            <input type="radio" id="ans1Radio" name="correct_ans" value="ans1">
            <label for="ans1Radio">Answer 01</label><br>
            <input type="radio" id="ans2Radio" name="correct_ans" value="ans2">
            <label for="ans2Radio">Answer 02</label><br>
            <input type="radio" id="ans3Radio" name="correct_ans" value="ans3">
            <label for="ans3Radio">Answer 03</label><br>
            <input type="radio" id="ans4Radio" name="correct_ans" value="ans4">
            <label for="ans4Radio">Answer 04</label>
        </div>
        <br>
        <div class="form-group">
            <label for="suggestion">Suggestion (for incorect answer)</label>
            <input type="text" id="suggestion" name="suggestion" class="form-control">
        </div>



        <br>
        <div class="text-center">
            <button class="btn btn-danger" type="submit" id="quesSubmitBtn" name="quesSubmitBtn">Submit</button>
            <a href="add-quizz.php" class="btn btn-secondary">Close</a>
        </div>
    </form>
    <br>
    <!-- Display Questions -->
    <div class="col-lg-12">
        <div class="card bg-transparent">
            <div class="card-body">
                <?php
                $sql = "SELECT * FROM add_ques WHERE category='$row[exam_name]'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                ?>
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th class="text-dark" scope="col">ID</th>
                                <th class="text-dark" scope="col">Question</th>
                                <th class="text-dark" scope="col">Ans 1</th>
                                <th class="text-dark" scope="col">Ans 2</th>
                                <th class="text-dark" scope="col">Ans 3</th>
                                <th class="text-dark" scope="col">Ans 4</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <th class="text-dark" scope="row"><?php echo $row['id']; ?></th>
                                    <td class="text-dark"><?php echo $row['question']; ?></td>
                                    <td class="text-dark"><?php echo $row['opt1']; ?></td>
                                    <td class="text-dark"><?php echo $row['opt2']; ?></td>
                                    <td class="text-dark"><?php echo $row['opt3']; ?></td>
                                    <td class="text-dark"><?php echo $row['opt4']; ?></td>
                                    <td>
                                        <form action="edit-quiz.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value='<?php echo $row["id"]; ?>'>
                                            <button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="uil uil-pen"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else {
                    echo "Exam Not Found";
                } ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once("footer.php");
?>

<?php
include_once("header.php");
include_once("../database/db.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="col-sm-7 mt-5 ms-5">
    <p class="bg text-white p-2 fw-bolder text-center" style="background-color: #004AAD;">List of Quiz</p>
    <br>
    <?php
    $sql = "SELECT * FROM exam_category";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $category = $row["exam_name"];
    ?>
        <div class="mt-3">
            <form action="" method="post">
                <input name="test" class="btn btn-secondary border-5 form-control fw-bolder text-light" value="<?php echo $row["exam_name"]; ?>" onclick="set_exam_type_session('<?php echo $category; ?>');">
            </form>
        </div>
    <?php
    }
    ?>
    <br><br><br><br><br><br><br>

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="oldresult.php">
                    <input type="button" class="btn btn-primary fw-bolder" style="background-color: #004AAD;" value="Show Result">
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function set_exam_type_session(exam_category) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location = "quiz.php";
            }
        };
        xmlhttp.open("GET", "forajax/set_exam_type_session.php?exam_category=" + exam_category, true);
        xmlhttp.send(null);
    }
</script>


<style>
    .bg.text-white.p-2.fw-bolder{
        font-size: 1.1rem;
    }
</style>
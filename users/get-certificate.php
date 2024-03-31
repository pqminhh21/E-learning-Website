<?php
include_once("header.php");
include_once("../database/db.php");
?>

<div class="col-sm-9 ms-5 mt-5 border-0">
    <p class="bg text-white p-2 fw-bolder text-center" style="background-color: #004AAD; font-size: 1.1rem;">Danh Mục</p>

    <?php
    $sql = "SELECT DISTINCT exam_type FROM exam_result WHERE email='$_SESSION[stu_email]'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <table class="table table-borderless text-center text-dark fw-bolder mt-5">
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $examType = $row['exam_type'];
                    echo '<tr>';
                    echo '<th scope="row">' . $examType . '</th>';
                    echo '<td>
                            <form action="genarate-certificate.php" method="POST" class="d-inline">
                                <input type="hidden" name="exam_name" value="'.$examType.'">
                                <button type="submit" name="getCertificate" class="btn btn-primary text-light fw-bold" style="background-color: #004AAD;">Nhận Chứng Chỉ</button> 
                            </form>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    <?php } else {
        echo "<p class='text-dark p-2 fw-bolder'>Không Tìm Thấy Kết Quả. </p>";
    }
    ?>
</div>

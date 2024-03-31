<?php
include_once("header.php");
include_once("../database/db.php");
?>
<div class="col-sm-9 mt-5 ms-5 border-0">

<?php
                $sql = "SELECT * FROM exam_result WHERE email='$_SESSION[stu_email]'";
                $result = $conn->query($sql);
                echo '
<table class="table table-borderless text-center text-light fw-bolder mt-5" >
<thead class="bg-secondary">
    <tr >
        <th class="text-white" style="background-color: #004AAD;" scope="col">Môn học</th>
        <th class="text-white" style="background-color: #004AAD;" scope="col">Điểm</th>
        <th class="text-white" style="background-color: #004AAD;" scope="col">Ngày kiểm tra</th>
    </tr>
</thead>
<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr  class="border-0">';
                    echo '<th class="text-dark" scope="row">' . $row['exam_type'] . '</th>';
                    echo '<td class="text-dark">' . $row['mark'] . '</td>';
                    echo '<td class="text-dark">' . $row['exam_time'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>
</table>';
?>
</div>
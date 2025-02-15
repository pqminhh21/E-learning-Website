<?php
include_once("header.php");
include_once("../database/db.php");
?>


<div class="col-sm-9 mt-5">
    <p class="bg-dark text-white p-2 text-center">Courses</p>
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    ?>
    <table class="table">
        <thead>
            <tr>
                <th class="text-dark fw-bolder" scope="col">Course ID</th>
                <th class="text-dark fw-bolder" scope="col">Course Name</th>
                <th class="text-dark fw-bolder" scope="col">Lecturers</th>
                <th class="text-dark fw-bolder" scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php  while($row=$result->fetch_assoc()){ 
            echo '<tr>';
                echo '<th class="text-dark fw-bolder" scope="row">'.$row['course_id'].'</th>';
                echo '<td class="text-dark fw-bolder">'.$row['course_name'].'</td>';
                echo '<td class="text-dark fw-bolder">'.$row['course_author'].'</td>';
                echo '<td>';
                echo '
                <form action="edit-course.php" method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["course_id"].'>
                <button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="uil uil-pen"></i></button>
                </form>
                <form action="" method="POST" class="d-inline">
                <input type="hidden" name="id" value='.$row["course_id"].'>
                    <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                        <i class="uil uil-trash-alt"></i>
                    </button>
                    </form>
                </td>
            </tr>';
            } ?>
        </tbody>
    </table>
    <?php }else{ echo "<p class='text-dark p-2 fw-bolder'>Không Tìm Thấy Khóa Học</p>";} 
    
    if(isset($_REQUEST['delete'])){
        $sql="DELETE FROM course WHERE course_id={$_REQUEST['id']}";
        if($conn->query($sql)==TRUE){
            echo '<meta http-equiv="refresh" content="0;URL=?deleted"/>';
        }else{
            echo "Delete Failed";
        }
    }
    
    
    ?>
</div>
</div>


<div>
    <a href="add-course.php" class="btn btn-primary box" >
        <i class="uil uil-plus fa-2x"></i>
    </a>
</div>
</div>

<?php
include_once("footer.php");
?>
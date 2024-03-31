<?php

include_once("header.php");
include_once("../database/db.php");

$stu_email=$_SESSION['stu_email'];
$sql="SELECT * FROM students WHERE stu_email='$stu_email'";
$result=$conn->query($sql);
if($result->num_rows==1){
    $row=$result->fetch_assoc();
    $stuId=$row['stu_id'];
    $stuName=$row["stu_name"];
    $stuOcc=$row["stu_occ"];
    $stuImg=$row["stu_img"];
}
if(isset($_REQUEST['updateStuNameBtn'])){
    if(($_REQUEST['stuName'] =="")){
        $passmsg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">All Field Required</div>';
    }else{
        $stuName=$_REQUEST["stuName"];
        $stuOcc=$_REQUEST["stuOcc"];
        $stu_image=$_FILES['stuImg']['name'];
        $stu_image_temp=$_FILES['stuImg']['tmp_name'];
        $img_folder='../images/student/'.$stu_image;
        move_uploaded_file($stu_image_temp,$img_folder);

        $sql="UPDATE students SET stu_name='$stuName',
        stu_occ='$stuOcc',stu_img='$img_folder' WHERE stu_email='$stu_email'";
        if($conn->query($sql)==TRUE){
            $passmsg='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
        
            // Cập nhật giá trị trong phiên làm việc
            $_SESSION['stu_img'] = $img_folder; // Giả sử $img_folder là đường dẫn mới của hình ảnh
        
        }else{
            $passmsg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Updated Failed</div>';
        }
        
    }

}
?>
<style>
    small{
        font-size: .9rem;
    }
</style>
<div class="col-sm-6 mt-4 ms-5">
<p class="bg text-white p-2 fw-bolder text-center" style="background-color: #004AAD; font-size: 1.1rem;">Thông tin cá nhân</p>
    <form method="POST" enctype="multipart/form-data" class="mx-5">
    <?php  if(isset($passmsg))  {echo $passmsg;}?>
        <div class="form-group">
            <label class="text-dark" for="stuId">ID</label>
            <input type="text" id="stuId" class="form-control" name="stuId" value="<?php if(isset($stuId)) {echo $stuId;} ?>" readonly>
        </div>
        <br>
        <div class="form-group">
            <label class="text-dark" for="stuEmail">Email</label>
            <input type="email" id="stuEmail"  class="form-control" value="<?php echo $stu_email ?>"  readonly>
        </div>
        <br>
        <div class="form-group">
            <label class="text-dark" for="stuName">Họ và Tên</label>
            <input type="text" id="stuName" name="stuName" class="form-control" value="<?php if(isset($stuName)) {echo $stuName;} ?>"  >
        </div>
        <br>
        <div class="form-group">
            <label class="text-dark" for="stuOcc">Ngành học</label>
            <input type="text" id="stuOcc" name="stuOcc" class="form-control" value="<?php if(isset($stuOcc))  {echo $stuOcc;} ?>">
        </div>
        <br>
        <div class="form-group">
            <label class="text-dark" for="stuImg">Thêm hình ảnh</label>
            <input type="file" class="form-control-file" id="stuImg" name="stuImg">
        </div>
        <br>
        <button type="submit" name="updateStuNameBtn" class="btn btn-primary" style="background-color: #004AAD">Cập nhật</button>
        <br><br>
        <a href="changepass.php" class="btn btn-primary" style="background-color: #004AAD">Đổi Mật Khẩu</a>
        <br>
    </form>
</div>

<style>
    .bg.text-white.p-2.fw-bolder {
        font-size: 1.1rem;
    }
</style>

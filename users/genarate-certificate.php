<?php
session_start();
include_once("header.php");
include_once("../database/db.php");

if (isset($_POST["exam_name"])) {
    $_SESSION["exam_name"] = $_POST["exam_name"];
}

$category = $_SESSION["exam_name"];

$stu_email = $_SESSION['stu_email'];
$sql = "SELECT * FROM students WHERE stu_email='$stu_email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stuName = $row["stu_name"];
}


?>


<?php

use PHPMailer\PHPMailer\PHPMailer;


    if (isset($_REQUEST["generate"])) {
        $font = "geometric.otf";
        $image = imagecreatefromjpeg("../Images/Certificate/Certificate.jpg");
        $color = imagecolorallocate($image, 0, 134, 249);
        $color1 = imagecolorallocate($image, 64, 46, 14);
        $name = $stuName;
        $width = imagesx($image);
        $centerX = $width / 2;


        $fontSizeStuName = 140;
        list($leftStuName, $bottomStuName, $rightStuName,, $topStuName) = imagettfbbox($fontSizeStuName, 0, $font, $stuName);
        $left_offsetStuName = ($rightStuName - $leftStuName) / 2;
        $xStuName = $centerX - $left_offsetStuName;


        $fontSizeCategory = 50;
        list($leftCategory, $bottomCategory, $rightCategory,, $topCategory) = imagettfbbox($fontSizeCategory, 0, $font, $category);
        $left_offsetCategory = ($rightCategory - $leftCategory) / 2;
        $xCategory = $centerX - $left_offsetCategory;

        imagettftext($image, $fontSizeStuName, 0, $xStuName, 820, $color, $font, $stuName);
        imagettftext($image, $fontSizeCategory, 0, $xCategory, 1050, $color, $font, $category);
        $date = "Date: " . date("Y-m-d");
        imagettftext($image, 35, 0, 50, imagesy($image) - 50, $color1, $font, $date);
        
    
        $exam_category = $category;
        $img = "certificates/" . $name . "-" . $exam_category . ".jpg";
        $img_pdf = "certificates/" . $name . "-" . $exam_category . ".pdf";
        $_SESSION["pdf_path"] = $img_pdf;   
        imagejpeg($image, $img);
        imagedestroy($image);
        

    require('../vendor/setasign/fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage("L");
    $pdf->Image($img, 10, 10, 280, 190);
    $pdf->Output($img_pdf, "F");

        
}

$img_pdf = isset($_SESSION['pdf_path']) ? $_SESSION['pdf_path'] : '';


if (isset($_REQUEST['email'])) {
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function

    //use PHPMailer\PHPMailer\SMTP;
    //use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    include('../vendor/autoload.php');

    include '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer();


    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'knowledgenesttest1@gmail.com';                 
    $mail->Password   = 'kquwwymiqihxoixl';                               
    $mail->SMTPSecure = "tls";            
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('knowledgenesttest1@gmail.com', 'Knowledge Nest College');
    $mail->addAddress($_POST["email"]);                
    $mail->addAttachment($img_pdf);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    // //Attachments

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = " $category " . "Certificate of Knowledge Nest College ";
    $mail->Body    = 'Thank you for Participating for the Knowledge Nest College..';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // $mail->send();
    
    if ($mail->send()) {
        
        $passmsg='<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Gửi Mail Thành Công</div>';
    } else {
        $passmsg='<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Gửi Mail Không Thành Công.</div>';
    }
}
?>


<div class="col-sm-6 mt-4 ms-5">
    <div class="container">
        <div class="col-md-12">
            <form action="" method="POST">
                <button type="submit" name="generate" class="btn btn-primary text-light fw-bolder" style="background-color: #004AAD;">Tạo Chứng Chỉ</button>
                <br><br>
                <img class="img-thumbnail" src="<?php echo $img; ?>" alt="">
                <br><br>
                <?php if (isset($passmsg)) { echo $passmsg; } ?>
            </form>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Enter Email Address" name="email">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary text-light fw-bolder" style="background-color: #004AAD;">Gửi dưới dạng PDF qua Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once("header.php");
include_once("../database/db.php");

if (isset($_REQUEST['sent'])) {
    $FirstName = $_REQUEST['First_Name'];
    $LastName = $_REQUEST['Last_Name'];
    $Email_Address = $_REQUEST['Email_Address'];
    $Message = $_REQUEST['Message'];

    $sql = "INSERT INTO contact(f_name, l_name, email, msg) VALUES ('$FirstName','$LastName','$Email_Address','$Message')";

    if ($conn->query($sql) == TRUE) {
        // Xử lý khi dữ liệu được thêm vào cơ sở dữ liệu thành công
    } else {
        // Xử lý khi có lỗi xảy ra
    }
}
?>

<link rel="stylesheet" href="css/contact.css">
<link rel="stylesheet" href="css/responsive.css">

<section class="contact">
    <div class="container contact__container">
        <aside class="contact__aside">
            <div class="aside__image">
                <img src="Img/contact.svg" alt="">
            </div>
            <h2>Liên Hệ</h2>
            <p>Đề Xuất và Phản Hồi</p>
            <ul class="contact__details">
                <li>
                    <i class="uil uil-phone-alt"></i>
                    <h5>+84-86874-0201</h5>
                </li>
                <li>
                    <i class="uil uil-envelope-check"></i>
                    <h5>minhpq20@uef.edu.vn</h5>
                </li>
                <li>
                    <i class="uil uil-location-point"></i>
                    <h5>Thành phố Hồ Chí Minh</h5>
                </li>
            </ul>
            <ul class="contact__socials">
                <li><a href="#"><i class="uil uil-facebook-f"></i></a></li>
                <li><a href="#"><i class="uil uil-instagram"></i></a></li>
                <li><a href="#"><i class="uil uil-twitter-alt"></i></a></li>
                <li><a href="#"><i class="uil uil-linkedin-alt"></i></a></li>
            </ul>
        </aside>

        <form action="" method="POST" class="contact__form">
            <div class="form__name">
                <input type="text" name="First_Name" placeholder="Họ" required>
                <input type="text" name="Last_Name" placeholder="Tên" required>
            </div>
            <input type="email" name="Email_Address" placeholder="Địa chỉ Email của bạn" required>
            <textarea name="Message" placeholder="Nội dung tin nhắn" rows="7" required></textarea>
            <button type="submit" class="button" name="sent">Gửi Tin Nhắn</button>
        </form>
    </div>
</section>

<?php
include_once("footer.php");
?>

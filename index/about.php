<?php
include_once("header.php");
include_once("../database/db.php");
?>

<link rel="stylesheet" href="css/about.css">
<link rel="stylesheet" href="css/responsive.css">

<section class="about__achievements">
    <div class="container about__achievements-container">
        <div class="about__achievements-left">
            <img src="https://www.growthengineering.co.uk/wp-content/uploads/2022/05/Learner-Engagement-Biz-Impact-ill-2_Hi-Performance-Learning-Culture-2-1024x754.png" alt="">
        </div>
        <div class="about__achievements-right">
            <h1>Thành Tích</h1>
            <p>Danh mục khóa học ngày càng phát triển mỗi ngày. Các con số mới nhất của chúng tôi tính đến tháng 12 năm 2023.</p>
            <div class="achievements__cards">
                <article class="achievements__card">
                    <span class="achievement__icon">
                        <i class="uil uil-video"></i>
                    </span>
                    <h3>80+</h3>
                    <p>Khóa học</p>
                </article>

                <article class="achievements__card">
                    <span class="achievement__icon">
                        <i class="uil uil-users-alt"></i>
                    </span>
                    <h3>1500+</h3>
                    <p>Học viên</p>
                </article>

                <article class="achievements__card">
                    <span class="achievement__icon">
                        <i class="uil uil-trophy"></i>
                    </span>
                    <h3>8+</h3>
                    <p>Giải thưởng</p>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Đội Ngũ -->
<section class="team reveal">
    <h2>Gặp Gỡ Đội Ngũ Chúng Tôi</h2>
    <div class="container team__container">
        <?php
        $sql = "SELECT * FROM lectures";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $l_id = $row['l_id'];
                echo '
        <article class="team__member">
            <div class="team__member-image">
                <img src="'.$row['l_img'].'" alt="">
            </div>
            <div class="team__member-info">
                <h4>' . $row['l_name'] . '</h4>
                <p>' . $row['l_design'] . '</p>
            </div>
        </article>
        ';
            }
        }
        ?>
    </div>
</section>

<!-- Câu hỏi Thường Gặp -->
<section class="faqs reveal">
    <h2>Câu Hỏi Thường Gặp</h2>
    <div class="container faqs__container">
        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Khóa học của FLASH VN bao gồm những gì?</h4>
                <p>Mỗi khóa học của FLASH VN được tạo ra, sở hữu và quản lý bởi giảng viên. Nền tảng của mỗi khóa học FLASH VN là bài giảng, có thể bao gồm video. Ngoài ra, giảng viên còn có thể thêm tài nguyên và các loại hoạt động thực hành khác nhau để tăng cường trải nghiệm học tập của sinh viên.</p>
            </div>
        </article>

        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Có cách nào để xem trước một khóa học không?</h4>
                <p>Có! Bạn có thể làm thế nào để xem trước một khóa học và xem lại thông tin quan trọng về nó.</p>
            </div>
        </article>

        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Làm thế nào để thanh toán cho một khóa học?</h4>
                <p>FLASH VN hỗ trợ nhiều phương thức thanh toán khác nhau, tùy thuộc vào quốc gia và địa điểm tài khoản của bạn.</p>
            </div>
        </article>

        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Nếu tôi không thích một khóa học mà tôi đã mua thì sao?</h4>
                <p>Chúng tôi muốn bạn hài lòng, vì vậy tất cả các khóa học đủ điều kiện mà bạn mua trên FLASH VN đều có thể được hoàn tiền trong vòng 30 ngày.</p>
            </div>
        </article>

        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Nơi nào tôi có thể tìm kiếm sự giúp đỡ?</h4>
                <p>Nếu bạn có câu hỏi về một khóa học có phí trong khi bạn đang học, bạn có thể tìm kiếm câu trả lời trong phần Hỏi và Đáp hoặc hỏi giảng viên.</p>
            </div>
        </article>

        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Tôi có phải bắt đầu khóa học của mình vào một thời điểm cụ thể không?</h4>
                <p>Nếu bạn có câu hỏi về một khóa học có phí trong khi bạn đang học nó, bạn có thể tìm kiếm câu trả lời trong phần Hỏi và Đáp hoặc hỏi giảng viên.</p>
            </div>
        </article>

        <article class="faq">
            <div class="faq__icon"><i class="uil uil-plus"></i></div>
            <div class="question__answer ">
                <h4>Tôi có phải bắt đầu khóa học của mình vào một thời điểm cụ thể không? Và tôi có bao lâu để hoàn thành nó?</h4>
                <p>Như đã nêu ở trên, không có hạn chót để bắt đầu hoặc hoàn thành khóa học. Ngay cả sau khi bạn hoàn thành khóa học, bạn sẽ tiếp tục có quyền truy cập vào nó, miễn là tài khoản của bạn đang trong tình trạng tốt và FLASH VN vẫn giữ giấy phép cho khóa học đó.</p>
            </div>
        </article>
    </div>
</section>

<script src="../js/custom.js"></script>

<script>
    // Hiệu ứng cuộn trang
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 150;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                reveals[i].classList.remove("active");
            }
        }
    }

    window.addEventListener("scroll", reveal);
</script>

<?php
include_once("footer.php");
?>

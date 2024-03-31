<?php
include_once("header.php");
include_once("../database/db.php");
?>

<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

<header>
    <div class="container header__container">
        <div class="header__left">
            <h1>FLASH VN</h1>
            <p>Giáo dục là nơi mà sự học bắt đầu nhưng không bao giờ kết thúc.</p>
            <?php
            if (isset($_SESSION['stu_id'])) {
                echo '
                <a href="../users/profile.php">
                <button class="button"> Xem Hồ Sơ
                </button></a>
                ';
            } else {
                echo '
                <a href="login-signup.php">
                <button class="button">Bắt Đầu
                </button></a>
                ';
            }
            ?>
        </div>
        <div class="header__right">
            <div class="header__right-image">
                <img src="img/depositphotos_132044380-stock-photo-graphic-text-and-learning-concept.webp" alt="">
            </div>
        </div>
    </div>
</header>

<section class="categories reveal">
    <div class="container categories__container">
        <div class="categories__left">
            <h1>Danh mục</h1>
            <p>Học sinh có thể học môn học một cách dễ dàng với khả năng kiến thức tốt từ FLASH VN.</p>
        </div>
        <div class="categories__right">
            <article class="category">
                <span class="category__icon"><i class="uil uil-sigma"></i></span>
                <h5>Toán Học</h5>
            </article>

            <article class="category">
                <span class="category__icon"><i class="uil uil-dna"></i></span>
                <h5>Khoa Học</h5>
            </article>

            <article class="category">
                <span class="category__icon"><i class="uil uil-plus-circle"></i></span>
                <h5>Hóa Học</h5>
            </article>

            <article class="category">
                <span class="category__icon"><i class="uil uil-history"></i></span>
                <h5>Lịch Sử</h5>
            </article>

            <article class="category">
                <span class="category__icon"><i class="uil uil-globe"></i></span>
                <h5>Địa Lý</h5>
            </article>
        </div>
    </div>
</section>

<section class="courses reveal">
    <h2>Các Khóa Học Phổ Biến Của Chúng Tôi</h2>
    <div class="container courses__container">
        <?php
        $sql = "SELECT * FROM course ORDER BY RAND() LIMIT 6";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];
                echo '
                <article class="course">
                <a href="course-details.php?course_id=' . $course_id . '">
                <div class="course__image">
                <img src="' . $row['course_img'] . '" alt="">
                </div>
                <div class="course__info">
                <h3 style="text-align: start;">' . $row['course_name'] . '</h3>
                <h5 style="text-align: start; margin-top: 10px;">' . $row['course_author'] . '</h5>
                <p style="text-align: start; margin-top: 5px; font-size: smaller; font-style: italic;">Cấp độ: ' . $row['level'] . '</p>
                <h4 style="text-align: start; margin-top: 10px;">Giá ' . $row['course_price'] . '</h4>
                <br>
                    <a href="course-details.php?course_id=' . $course_id . '">
                <button class="button">Tìm Hiểu Thêm
                </button></a>
                </div>
                </a>
            </article>
                ';
            }
        }
        ?>
    </div>
</section>
<p style="margin-top: 5px;"></p>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            600: {
                slidesPerView: 3
            }
        }
    });

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

<section id="features" class="reveal">
    <h1>Các Tính Năng Tuyệt Vời</h1>
    <div class="fea-base">
        <div class="fea-box">
            <i class="uil uil-graduation-cap"></i>
            <h3>Chế độ Học Bổng</h3>
        </div>
        <div class="fea-box">
            <i class="uil uil-trophy"></i>
            <h3>Uy Tín Toàn Cầu</h3>
        </div>
        <div class="fea-box">
            <i class="uil uil-clipboard-alt"></i>
            <h3>Đăng Ký Khóa Học</h3>
        </div>
    </div>
</section>

<?php
include_once("footer.php");
?>

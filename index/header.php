<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLASH VN</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
</head>

<body>

    <nav>
        <div class="container nav__container">
            <a class="custom__links" href="home.php">
                <img src="img/Flash_logo_mau.jpg" alt="Logo Knowledge Nest" class="logo-img">
            </a>

            <ul class="nav__menu">
                <li>
                    <a class="custom__links" href="home.php">Trang Chủ</a>
                </li>
                <li>
                    <a class="custom__links" href="about.php">Giới Thiệu</a>
                </li>
                <li>
                    <a class="custom__links" href="course.php">Khóa Học</a>
                </li>
                <li>
                    <a class="custom__links" href="blog.php">Bài Viết</a>
                </li>
                <li>
                    <a class="custom__links" href="contact.php">Liên Hệ</a>
                </li>
                <?php
                session_start();
                if(isset($_SESSION['stu_id'])){
                    echo'
                    <li>
                    <a class="custom__links" href="../users/profile.php">Hồ Sơ</a>
                </li>
                    ';
                }else{
                    echo '
                    <li>
                    <a class="custom__links joinBtn" href="login-signup.php">Tham Gia Miễn Phí</a>
                </li>
                    ';
                }
                ?>
                
            </ul>
            <button id="open-menu-btn"><i class="uil uil-bars"></i></button>
            <button id="close-menu-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>

    <script>

        window.addEventListener('scroll', () => {
            document.querySelector('nav').classList.toggle('window-scroll', window.scrollY > 0)
        })


        const menu = document.querySelector(".nav__menu");
        const menuBtn = document.querySelector("#open-menu-btn");
        const closeBtn = document.querySelector("#close-menu-btn");

        menuBtn.addEventListener('click', () => {
            menu.style.display = "flex";
            closeBtn.style.display = "inline-block";
            menuBtn.style.display = "none";
        })


        const closeNav = () => {
            menu.style.display = "none";
            closeBtn.style.display = "none";
            menuBtn.style.display = "inline-block";
        }
        closeBtn.addEventListener('click', closeNav)

        const changeColor = () => {
            $('ul > li > a').css('background-color', 'inherit')
            $(event.target).css("background-color", "red")
        }

        $('ul > li > a').on('click', changeColor)
    </script>

<style>
    .logo-img {
        width: 210px;
        height:max-content;
    }
</style>
</body>
</html>

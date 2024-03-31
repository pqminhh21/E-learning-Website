<?php
include("../database/db.php");
$tenDangNhap = '';
$email = '';
$matKhau = '';
$xacNhanMatKhau = '';

if (isset($_POST['dangKy'])) {
    $tenDangNhap = $_POST['tenDangNhap'];
    $email = $_POST['email'];
    $matKhau = $_POST['matKhau'];
    $xacNhanMatKhau = $_POST['xacNhanMatKhau'];

    // Kiểm tra hợp lệ của tên đăng nhập
    $tenDangNhap = $_POST['tenDangNhap'];
    if (empty($tenDangNhap)) {
        $loi['TenDangNhap'] = "Tên đầy đủ là bắt buộc";
    } else if (!preg_match("/^[a-zA-Z0-9 -]*$/", $tenDangNhap)) {
        $loi['TenDangNhap'] = "Tên chỉ được chứa chữ cái";
    } else if (strlen($tenDangNhap) < 5) {
        $loi['TenDangNhap'] = "Tên phải có ít nhất 5 ký tự";
    }

    // Kiểm tra hợp lệ của địa chỉ email
    $email = $_POST['email'];
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
        $loi['Email'] = "Địa chỉ Email không hợp lệ";
    }

    // Kiểm tra hợp lệ của mật khẩu
    $matKhau = $_POST['matKhau'];
    if (empty($matKhau)) {
        $loi['MatKhau'] = "Mật khẩu là bắt buộc";
    }

    // Kiểm tra hợp lệ của xác nhận mật khẩu
    $xacNhanMatKhau = $_POST['xacNhanMatKhau'];
    if (empty($xacNhanMatKhau)) {
        $loi['XacNhanMatKhau'] = "Xác nhận mật khẩu là bắt buộc";
    }

    // Thực hiện đăng ký
    if ($tenDangNhap && $email && $matKhau) {
        $truyVanEmail = "SELECT * FROM students WHERE stu_email='$email'";
        $ketQuaTruyVanEmail = mysqli_query($conn, $truyVanEmail);
        if (mysqli_num_rows($ketQuaTruyVanEmail) > 0) {
            $loi['Email'] = "Email đã tồn tại";
        } else {
            if ($matKhau == $xacNhanMatKhau) {
                if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $matKhau)) {
                    $matKhau = md5($matKhau);
                    $sql = "INSERT INTO students (stu_name,stu_email,stu_pass) VALUES ('" . $tenDangNhap . "','" . $email . "','" . $matKhau . "')";
                    if ($conn->query($sql)) {
                        $thanhCong = true;
                        $tenDangNhap = "";
                        $email = "";
                        $matKhau = '';
                        $xacNhanMatKhau = '';
                    } else {
                        $loi[] = "Lỗi máy chủ";
                    }
                } else {
                    $loi['MatKhau'] = "Mật khẩu quá yếu";
                }
            } else {
                $loi['XacNhanMatKhau1'] = "Mật khẩu không khớp";
            }
        }
    }
}
?>

<link rel="stylesheet" href="CSS/login.css">
<link rel="stylesheet" href="CSS/responsive.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script language="javascript" type="text/javascript">
    window.history.forward();
</script>

<title>Đăng nhập</title>

<div class="wrapper">
    <div class="container right-panel-active">
        <!-- Đăng ký -->
        <div class="container__form container--signup">
            <form action="" method="POST" class="form" id="register">
                <h2 class="form__title">Đăng Ký</h2>
                <!-- Thông báo lỗi -->
                <?php
                if (!empty($loi)) {
                    foreach ($loi as $key => $value) {
                ?>
                        <div class="alert"><?php echo $value; ?></div>
                    <?php
                    }
                }
                if (isset($thanhCong)) {
                    ?>
                    <div class="success">Đăng ký thành công!</div>
                <?php
                }
                ?>

                <div class="form__group field">
                    <input type="text" name="tenDangNhap" placeholder="Họ và Tên" class="form__field" <?php echo 'value="' . $tenDangNhap . '"' ?> />
                    <label for="name" class="form__label">Họ và Tên</label>
                </div>
                <?php
                if (isset($loi['TenDangNhap'])) {
                    echo "<div class='validationError'>" . $loi['TenDangNhap'] . "</div>";
                }
                ?>
                <div class="form__group field">
                    <input type="text" name="email" placeholder="Địa chỉ Email" class="form__field checking_email" <?php echo 'value="' . $email . '"' ?> />
                    <label for="name" class="form__label">Địa chỉ Email</label>
                </div>
                <small class="error_email validationError"></small>
                <?php
                if (isset($loi['Email'])) {
                    echo "<div class='validationError'>" . $loi['Email'] . "</div>";
                }
                ?>
                <div class="form__group field">
                    <input type="password" name="matKhau" placeholder="Mật khẩu" class="form__field" <?php echo 'value="' . $matKhau . '"' ?> />
                    <label for="name" class="form__label">Mật khẩu</label>
                </div>
                <?php
                if (isset($loi['MatKhau'])) {
                    echo "<div class='validationError'>" . $loi['MatKhau'] . "</div>";
                }
                if (isset($loi['XacNhanMatKhau1'])) {
                    echo "<div class='validationError'>" . $loi['XacNhanMatKhau1'] . "</div>";
                }
                ?>
                <div class="form__group field">
                    <input type="password" name="xacNhanMatKhau" placeholder="Xác nhận mật khẩu" class="form__field" <?php echo 'value="' . $xacNhanMatKhau . '"' ?> />
                    <label for="name" class="form__label">Xác nhận mật khẩu</label>
                </div>
                <?php
                if (isset($loi['XacNhanMatKhau'])) {
                    echo "<div class='validationError'>" . $loi['XacNhanMatKhau'] . "</div>";
                }
                ?>
                <br><br>
                <button name="dangKy" type="submit" class="cta">
                    <span>Đăng Ký</span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Đăng nhập -->
        <div class="container__form container--signin">
            <form action="signin.php" method="POST" class="form" id="login">
                <h2 class="form__title">Đăng Nhập</h2>
                <!-- Nội dung đăng nhập -->
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $key => $value) {
                ?>
                        <div class="alert"><?php echo $value; ?></div>
                <?php
                    }
                }
                ?>
                <div class="form__group field">
                    <input type="email" name="email2" placeholder="Địa chỉ Email" class="form__field" />
                    <label for="name" class="form__label">Email</label>
                </div>
                <?php
                if (isset($loi['Email2'])) {
                    echo "<div class='validationError'>" . $loi['Email2'] . "</div>";
                }
                ?>
                <div class="form__group field">
                    <input type="password" name="password2" placeholder="Mật khẩu" class="form__field" />
                    <label for="name" class="form__label">Mật khẩu</label>
                </div>
                <?php
                if (isset($loi['MatKhau2'])) {
                    echo "<div class='validationError'>" . $loi['MatKhau2'] . "</div>";
                }
                ?>
                <br>
                <label class="checkbox">
                    <div class="page__section page__custom-settings">
                        <div class="page__toggle">
                            <label class="toggle">
                                <input class="toggle__input" type="checkbox" name="remember_me" checked>
                                <span class="toggle__label">
                                    <span class="toggle__text">Ghi nhớ tôi</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <a href="forgot_password.php" class="link">Quên mật khẩu?</a>
                    <br><br>
                    <button name="login" class="cta">
                        <span>Đăng Nhập</span>
                        <svg width="13px" height="10px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="8 1 12 5 8 9"></polyline>
                        </svg>
                    </button>
                </label>
            </form>
        </div>

        <!-- Phủ định -->
        <div class="container__overlay">
            <div class="overlay">
                <button class="cta cssbtn" id="signIn">
                    <span>Đăng Nhập</span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>

                <button class="cta cssbtn1" id="signUp">
                    <span>Đăng Ký</span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
<script src="../js/custom.js"></script>
<! <script src="custom.js"></script> >
<script>
    const signInBtn = document.getElementById("signIn");
    const signUpBtn = document.getElementById("signUp");
    const fistForm = document.getElementById("form1");
    const secondForm = document.getElementById("form2");
    const container = document.querySelector(".container");

    signInBtn.addEventListener("click", () => {
        container.classList.remove("right-panel-active");
    });

    signUpBtn.addEventListener("click", () => {
        container.classList.add("right-panel-active");
    });

    fistForm.addEventListener("submit", (e) => e.preventDefault());
    secondForm.addEventListener("submit", (e) => e.preventDefault());
</script>

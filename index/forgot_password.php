<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/responsive.css">
</head>
<body>
    <div class="wrapper">
        <div class="container right-panel-active">
            <div class="container__form container--forgot-password">
                <form method="post" action="" class="form">
                    <h2 class="form__title">Quên Mật Khẩu</h2>
                    <div class="form__group field">
                        <input type="email" name="email" placeholder="Địa chỉ Email" class="form__field" required>
                        <label for="email" class="form__label">Địa chỉ Email</label>
                    </div>
                    <br><br>
                    <button type="submit" class="cta reset-password-btn">
                        <span>Khôi Phục Mật Khẩu</span>
                    </button>
                    <br><br>
                    <!-- Add the Login button here -->
                    <a href="login-signup.php" class="cta login-btn">
                        <span>Đăng Nhập</span>
                    </a>
                </form>
            </div>
            
        </div>
    </div>
    <style>
        .reset-password-btn, .login-btn {
            color: white;
            padding: 12px 20px;
            font-size: 16px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            text-decoration: none;  /* Remove the underline for anchor tags */
            display: inline-block; /* Ensure the anchor tag is displayed as a block element */
            margin-top: 10px; /* Add some spacing between the buttons */
        }
    </style>
</body>
</html>

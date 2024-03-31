<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại Mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            text-align: left;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    require_once '../database/db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
        $token = $_GET['token'];

        // Kiểm tra xem token có hợp lệ không
        $check_token_query = $conn->prepare("SELECT * FROM students WHERE reset_token = ?");
        $check_token_query->bind_param("s", $token);
        $check_token_query->execute();
        $result = $check_token_query->get_result();

        if ($result->num_rows > 0) {
            // Token hợp lệ, hiển thị form đặt lại mật khẩu
            echo '
            <h2>Đặt lại Mật khẩu</h2>
            <form method="post" action="">
                <input type="hidden" name="token" value="' . $token . '">
                <label for="new_password">Mật khẩu mới:</label>
                <input type="password" name="new_password" required>
                <button type="submit">Cập nhật Mật khẩu</button>
            </form>';
        } else {
            echo 'Token không hợp lệ hoặc đã hết hạn.';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['token']) && isset($_POST['new_password'])) {
            $token = $_POST['token'];
            $new_password = md5($_POST['new_password']); // Sử dụng md5 để mã hóa mật khẩu

            // Kiểm tra xem token có hợp lệ không
            $check_token_query = $conn->prepare("SELECT * FROM students WHERE reset_token = ?");
            $check_token_query->bind_param("s", $token);
            $check_token_query->execute();
            $result = $check_token_query->get_result();

            if ($result->num_rows > 0) {
                // Token hợp lệ, cập nhật mật khẩu mới và xóa token
                $update_password_query = $conn->prepare("UPDATE students SET stu_pass = ?, reset_token = NULL WHERE reset_token = ?");
                $update_password_query->bind_param("ss", $new_password, $token);
                $update_password_query->execute();

                echo 'Mật khẩu đã được cập nhật thành công. <a href="login-signup.php">Đăng nhập</a>';
            } else {
                echo 'Token không hợp lệ hoặc đã hết hạn.';
            }
        } else {
            echo 'Tham số không hợp lệ hoặc thiếu.';
        }
    } else {
        // Nếu không phải là phương thức GET hoặc POST, chuyển hướng về trang chính
        header("Location: index.php");
        exit;
    }
    ?>
</body>
</html>

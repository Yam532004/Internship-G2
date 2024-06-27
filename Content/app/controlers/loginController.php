<?php
session_start();
require '../../public/dbconnect.php';
require '../../public/validate.php';
require_once '../../vendor/autoload.php';

use Firebase\JWT\JWT;
// kết nối dữ liệu 
// validate password đúng với format đã -> hash và so sánh vừa password và email có bằng không
// nếu có thì tạo và lưu một token -> thay đổi trang homepage avatar 
// nếu không thì hiện lỗi format password hoặc lỗi nếu đúng email sai mật khẩu trả về sai mật khẩu hoặc ngược lại
// nếu sai cả hai thì báo không tồn tại user với email ...
function validateUserData($conn, $email, $password, $recaptcha_response)
{
    $errors = [];
    // Xác thực reCAPTCHA
    $recaptcha_errors = verifyRecaptcha($recaptcha_response);
    if (!empty($recaptcha_errors)) {
        $errors['recaptcha'] = $recaptcha_errors['recaptcha'];
    }
    // Kiểm tra email đã tồn tại hay chưa
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->rowCount();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$count > 0) {
        $errors['email'] = "Email not exists";
    }
    // Kiểm tra mật khẩu đủ điều kiện
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    } elseif (!isValidPassword($password)) {
        $errors['password'] = "Password must contain uppercase, lowercase, numbers and special characters";
    }
    // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về form đăng ký
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form-data'] = $_POST;
        header('Location: ../views/auth/Login.php');
        exit();
    }
    return $user;
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])) {
        // Lấy dữ liệu từ form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $recaptcha_response = $_POST['token'];

        // Validate dữ liệu
        validateUserData($conn, $email, $password, $recaptcha_response);

        if ($user && hash('sha256', $password) === $user['password']) {
            $key = "6LeQIAEqAAAAAGp-Fiqsu7EJCQuVuE4aT-CX3TLV";
            $payload = [
                'iat' => time(),
                'exp' => time() + 60 * 60,
                'data' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                ]
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
            $_SESSION['token'] = $jwt;
        }

        unset($_SESSION['form-data']);
        unset($_SESSION['errors']);
        header("Location: ../views/users/Homepage.php");
        exit();
    } else {
        $_SESSION['errors'] = ['login' => 'Invalid email or password'];
        // Chuyển hướng lại trang đăng nhập
        header('Location: ../views/auth/Login.php');
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

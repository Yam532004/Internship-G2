<?php
// session_start();
require '../../public/dbconnect.php';
require '../../public/validate.php';

function validateUserData($recaptcha_response)
{
    $errors = [];
    // Xác thực reCAPTCHA
    $recaptcha_errors = verifyRecaptcha($recaptcha_response);
    if (!empty($recaptcha_errors)) {
        $errors['recaptcha'] = $recaptcha_errors['recaptcha'];
    }
    // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về form đăng ký
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form-data'] = $_POST;
        header('Location: ../views/auth/Register.php');
        exit();
    }
    return true;
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $user_name = $_POST['username'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $recaptcha_response = $_POST['token'];
        // Validate dữ liệu
        validateUserData($recaptcha_response);
        // Mã hóa mật khẩu
        $hashed_password = hash('sha256', $password);
        // Thực hiện chèn dữ liệu vào cơ sở dữ liệu
        $sql_insert_user = "INSERT INTO users (username, phone_number, email, password) VALUES (:username, :phone_number, :email, :password)";
        $stmt_insert_user = $conn->prepare($sql_insert_user);
        $stmt_insert_user->bindParam(':username', $user_name);
        $stmt_insert_user->bindParam(':phone_number', $phone_number);
        $stmt_insert_user->bindParam(':email', $email);
        $stmt_insert_user->bindParam(':password', $hashed_password);
        $stmt_insert_user->execute();

        // Xóa dữ liệu và lỗi khỏi session sau khi chèn thành công
        unset($_SESSION['form-data']);
        // Chuyển hướng về trang chủ sau khi đăng ký thành công
        $_SESSION['alert'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            Success to create user account
        </div>
      </div>';
        header("Location: ../views/auth/Login.php", $alert);
        exit();
    }

    // Đóng kết nối
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

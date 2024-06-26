<?php
session_start();
require '../../public/dbconnect.php';
require '../../public/validate.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])) {
        // Lấy dữ liệu từ form
        $user_name = $_POST['username'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $recaptcha_response = $_POST['token'];

        // Validate dữ liệu
        validateUserData($conn, $email, $phone_number, $password, $confirm_password, $recaptcha_response);

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
        unset($_SESSION['errors']);

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

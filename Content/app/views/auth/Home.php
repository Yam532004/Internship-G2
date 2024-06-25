<?php
session_start();
// Thông tin kết nối đến cơ sở dữ liệu
require_once '../../../public/dbconnect.php';
function isValidPhoneNumber($phone_number)
{
    // Biểu thức chính quy để kiểm tra định dạng số điện thoại
    $pattern = '/^\+?\d{1,3}[-\s]?\d{9,}$/'; // Ví dụ đơn giản, có thể cần thay đổi phù hợp với định dạng số điện thoại của bạn
    return preg_match($pattern, $phone_number);
}
// hàm kiểm tra mật khẩu chứa ít nhất 8 ký tự
function validatePassword($password)
{
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    //Hàm preg_match của PHP để kiểm tra mật khẩu với biểu thức chính quy (regex)
    return preg_match($regex, $password);
}
function json_validate($count, $phone_number, $password, $confirm_password)
{
    $errors = [];
    if ($count > 0) {
        $errors['email'] = "Email already exists";
    }
    if (!isValidPhoneNumber($phone_number)) {
        $errors['phone_number'] = "Please enter a valid phone number";
    }
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    }
    if (strlen($password) > 8) {
        if (!validatePassword($password)) {
            $errors['password'] = "Password must contain upcase, lowercase, numbers and underscores";
        }
    }
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Password and confirm password must be the same";
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form-data'] = $_POST;
        header('Location: Register.php');
        exit();
    }
    return true;
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Thiết lập chế độ lỗi và ngoại lệ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Dữ liệu cần chèn
        $user_name = $_POST['username'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $_SESSION['errors'] = $_POST;
        //validate data 
        $mySql = "SELECT email FROM users WHERE email = :email";
        $syntax = $conn->prepare($mySql);
        $syntax->bindParam(':email', $email);
        $syntax->execute();
        $count = $syntax->rowCount();
        echo  $_SESSION['form-data'];

        json_validate($count, $phone_number, $password, $confirm_password);
        $hashed_password = hash('sha256', $password);
        // Câu lệnh SQL để chèn dữ liệu
        if (isset($_POST['post'])) {
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $data = [
                'secret' => "6LeQIAEqAAAAAGp-Fiqsu7EJCQuVuE4aT-CX3TLV",
                'response' => $_POST['token'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ];
            $options =
                array(
                    'http' => array(
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($data)
                    )
                );
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);

            $res = json_decode($response, true);

            // if ($res['success'] == true) {
                $sql = "INSERT INTO users (username, phone_number, email, password) VALUES (:username, :phone_number, :email, :password)";
                $stmt = $conn->prepare($sql);

                // Bind các giá trị vào câu lệnh SQL
                $stmt->bindParam(':username', $user_name);
                $stmt->bindParam(':phone_number', $phone_number);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);

                // Thực thi câu lệnh SQL
                $stmt->execute();
            // } else {
            //     echo '<div class="alert alert-warning><strong>Success!</strong> Fail to save data</div>';
            // }
        }
        // Chuyển hướng người dùng về trang chủ hoặc trang khác sau khi thêm dữ liệu thành công
        unset($_SESSION['form_data']);
        unset($_SESSION['errors']);
        header("Location:../users/Homepage.php");
        exit();
    }
    // Đóng kết nối
    $conn = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

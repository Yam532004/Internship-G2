<?php
include_once '../config/database.php';
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

if (isset($_GET['email']) && isset($_GET['code']) && isset($_GET['expiry']) && isset($_GET['encodeKey'])) {

    function decrypt($data, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $data = base64_decode($data);
        $iv = substr($data, 0, $ivlen);
        $ciphertext = substr($data, $ivlen);
        return openssl_decrypt($ciphertext, $cipher, $key, $options = 0, $iv);
    }

    $encodeKey = $_GET['encodeKey'];
    $email = $_GET['email'];
    $code = $_GET['code'];
    $expiry = $_GET['expiry'];
    $decryptedEmail = decrypt($email, $encodeKey);
    $decryptedCode = decrypt($code, $encodeKey);
    $decryptedExpiry = decrypt($expiry, $encodeKey);

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_timestamp = date('Y-m-d H:i:s');

    // Chuyển đổi $current_timestamp và $decryptedExpiry thành đối tượng DateTime
    $current_time = new DateTime($current_timestamp);
    $expiry_time = new DateTime($_SESSION['expiry']);

    $current_time_stamp = $current_time->format('Y-m-d H:i:s');
    $expiry_time_stamp = $expiry_time->format('Y-m-d H:i:s');

    if ($current_time_stamp > $expiry_time_stamp) {
        // Nếu đã hết phiên
        $_SESSION['error_token'] = "Token link expired ";
        unset($_SESSION['reset_link']);
        header('Location: ../views/reset-password.php');
        exit();
    } elseif (isset($_SESSION['reset_link'])) {
            $stmt = $conn->prepare("SELECT * FROM reset_passwords WHERE email = :email ");
            // AND verify_token = :code AND token_expiry = :expiry
            // $time_expiry = $expiry_time->format('Y-m-d H:i:s');
            $stmt->bindParam(':email', $decryptedEmail);
            // $stmt->bindParam(':code', $decryptedCode);
            // $stmt->bindParam(':expiry', $expiry_time_stamp);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                header('Location: ../views/password-reset-form.php');
                exit();
            } else {
                $_SESSION['die_link'] = "Don't have case to reset password yet.";
                header('Location: ../views/login.php');
                exit();
            }
        } else {
            $_SESSION['die_link'] = "You already to change the password";
            header('Location: ../views/login.php');
            exit();
        }
} else {
    echo 'Token is required';
}

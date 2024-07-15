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
    $current_time  = date('Y-m-d H:i:s');
    $current_timestamp = strtotime($current_time);
    $expiry_timestamp = strtotime($decryptedExpiry);
    echo "current_timestamp:  ".$current_time;
    echo "expiry_timestamp: ".$decryptedExpiry;

    if ($current_timestamp > $expiry_timestamp) {
        $_SESSION['error_token'] = "Token expired";
        header('Location: ../views/reset-password.php');
        exit();
    } else {
        $stmt = $conn->prepare("SELECT * FROM reset_passwords WHERE email = :email AND verify_token = :code AND token_expiry = :expiry");
        $stmt->bindParam(':email', $decryptedEmail);
        $stmt->bindParam(':code', $decryptedCode);
        $stmt->bindParam(':expiry', $decryptedExpiry);
        $row = $stmt->execute();

        if ($row) {
            header('Location: ../views/password-reset-form.php');
            exit(0);
        } else {
            echo 'Invalid token';
            exit(0);
        }
    }
} else {
    echo 'Token is required';
    echo $_GET['user'];
}

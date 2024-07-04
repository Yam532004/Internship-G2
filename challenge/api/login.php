<?php
session_start();
include_once '../config/database.php';
require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

// Set headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Initialize variables
$email = '';
$password = '';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

// Read the input data
$input = file_get_contents('php://input');

// Check if input data exists
if ($input === false) {
    echo json_encode(array("message" => "Không thể đọc dữ liệu đầu vào."));
    exit;
}

// Decode the JSON input into a PHP array
// Giải mã dữ liệu URL-encoded thành mảng
parse_str($input, $data);

// Kiểm tra xem giải mã có thành công không
if (empty($data)) {
    echo json_encode(array("message" => "Dữ liệu URL-encoded không hợp lệ."));
    exit;
}

// Check for required fields
if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(array("message" => "Thiếu các trường bắt buộc (email, password)."));
    var_dump($data);
    exit;
}

// Access email and password
$email = $data['email'];
$password = $data['password'];

// Query to get user details
$table_name = 'users';
$query = "SELECT id, username, password, is_locked FROM " . $table_name . " WHERE email = ? LIMIT 0,1";

$stmt = $conn->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $username = $row['username'];
    $is_locked = $row['is_locked'];
    $password2 = $row['password'];

    if ($is_locked) {
        $message_is_locked = "The account has been locked";
        $_SESSION['old_email'] = $email;
        header('Location: ../views/login.php?message_is_locked=' . urlencode($message_is_locked));
        exit();
    } else if (password_verify($password, $password2)) {
        $secret_key = "6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS";
        $issuer_claim = "localhost"; // this can be the server name
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; // not before in seconds
        $expire_claim = $issuedat_claim + 60; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
                "username" => $username,
                "email" => $email
            )
        );

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key, 'HS256');
        $_SESSION['login_success'] = "User was successfully registered.";
        $message_is_locked = "User create successfully.";
        // Redirect to sidebar.php with success message
        header('Location: ../views/sidebar.php?message_login=' . urlencode($message_is_locked));
    } else {
        $_SESSION['error'] = "Incorrect password.";
        $_SESSION['old_email'] = $email;
        $message_is_locked = "Incorrect password";
        header('Location: ../views/login.php?message_login=' . urlencode($message_is_locked));
        exit();
    }
} else {
    $_SESSION['error'] = "Email not found.";
    http_response_code(404);
    $message_is_locked = "Email not found";
    header('Location: ../views/login.php?message_login=' . urlencode($message_is_locked));
    exit();
}

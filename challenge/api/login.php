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
$query = "SELECT id, username, password, is_locked, role 
          FROM " . $table_name . " 
          WHERE email = ? 
          AND deleted_at IS NULL 
          LIMIT 0,1";
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
    $role = $row['role'];

    if ($is_locked) {
        $_SESSION['message_is_locked'] = "The account has been locked";
        $_SESSION['old_email'] = $email;
        header('Location: ../views/login.php');
        exit();
    } else if (password_verify($password, $password2)) {
        $secret_key = "6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS";
        $issuer_claim = "localhost"; // this can be the server name
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim; // not before in seconds
        $expire_claim = $issuedat_claim + 300; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "id" => $id,
                "username" => $username,
                "email" => $email,
                "role" => $role
            )
        );

        http_response_code(200);
        $jwt = JWT::encode($token, $secret_key, 'HS256');
        $_SESSION['login_success'] = "User was successfully login.";
        $_SESSION['token'] = $jwt;
        if ($role == 2) {
            header('Location: ../views/sidebar.php');
            exit();
        } else {
            header('Location:../views/homepage.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Incorrect password.";
        $_SESSION['old_email'] = $email;
        header('Location: ../views/login.php');
        exit();
    }
} else {
    $_SESSION['error'] = "Email not found.";
    header('Location: ../views/login.php');
    exit();
}

<?php
session_start();
include_once '../config/database.php';
require "../vendor/autoload.php";

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$email = '';
$password = '';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();



// Đọc dữ liệu đầu vào
$input = file_get_contents('php://input');

// Kiểm tra xem dữ liệu đầu vào có tồn tại không
if ($input === false) {
    echo json_encode(array("message" => "Không thể đọc dữ liệu đầu vào."));
    exit;
}

// Giải mã dữ liệu URL-encoded thành mảng
parse_str($input, $data);

// Kiểm tra xem giải mã có thành công không
if (empty($data)) {
    echo json_encode(array("message" => "Dữ liệu URL-encoded không hợp lệ.", $data));
    exit;
}

// Kiểm tra các trường bắt buộc
if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(array("message" => "Thiếu các trường bắt buộc (email, password)."));
    exit;
}

// Truy cập các thuộc tính

$email = $data['email'];
$password = $data['password'];
$table_name = 'users';

$query = "SELECT id, username, password FROM " . $table_name . " WHERE email = ? LIMIT 0,1";

$stmt = $conn->prepare($query);
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $username = $row['username'];
    $password2 = $row['password'];

    if (password_verify($password, $password2)) {
        $secret_key = "6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS";
        $issuer_claim = "localhost"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
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
        // echo json_encode(
        //     array(
        //         "message" => "Successful login.",
        //         "jwt" => $jwt,
        //         "email" => $email,
        //         "expireAt" => $expire_claim
        //     )
        // );
        // echo json_encode(array("message" => "User was successfully registered."));
        sleep(1);
        header('Location: ../views/homepage.php');
    } else {
        $_SESSION['error'] = "Incorrect password.";
        http_response_code(401);
        header('Location:../views/login.php');
    }
}

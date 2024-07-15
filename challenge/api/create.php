<?php
include_once '../config/database.php';

session_start();
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$username = '';
$email = '';
$phone_number = '';
$password = '';
$conn = null;

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
    echo json_encode(array("message" => "Dữ liệu URL-encoded không hợp lệ."));
    exit;
}

// Kiểm tra các trường bắt buộc
if (!isset($data['username']) || !isset($data['phone_number']) || !isset($data['email']) || !isset($data['password']) || !isset($data['confirm_password'])) {
    echo json_encode(array("message" => "Thiếu các trường bắt buộc (username, phone_number, email, password, confirm_password)."));
    exit;
}

// Truy cập các thuộc tính
$username = $data['username'];
$phone_number = "0" . $data['phone_number'];
$email = $data['email'];
$password = $data['password'];
$table_name = 'users';

$query = "INSERT INTO " . $table_name . "
                SET username = :username,
                    email = :email,
                    phone_number = :phone_number,
                    role = :role,
                    password = :password,
                    created_at = :created_at";

$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone_number', $phone_number);
$role = 1;
$stmt->bindParam(':role', $role);
$password_hash = password_hash($password, PASSWORD_BCRYPT);
$stmt->bindParam(':password', $password_hash);
$created_at = date('Y-m-d H:i:s');
$stmt->bindParam(':created_at', $created_at);

if ($stmt->execute()) {
    $_SESSION['create_success'] = "User create successfully.";
    header('Location: ../views/sidebar.php');
    exit;
} else {
    // http_response_code(400);
    // echo json_encode(array("message" => "Unable to register the user. "));
    $_SESSION['create_fail'] = "User create failed.";
    // header('Location: ../views/sidebar.php');
    exit;
}

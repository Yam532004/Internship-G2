<?php
include_once '../config/database.php';
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$input = file_get_contents('php://input');

if ($input === false) {
    echo json_encode(array(
        'message' => 'Unable to read input.'
    ));
    exit;
}
parse_str($input, $data);

if (empty($data)) {
    echo json_encode(array(
        'message' => 'No data provided.'
    ));
    exit;
}

if (!isset($data['id']) || !isset($data['username']) || !isset($data['phone_number']) || !isset($data['email'])) {
    echo json_encode(array("message" => "Miss some field (username, phone_number, email)."));
    exit;
}

$username = $data['username'];
$phone_number = $data['phone_number'];
$email = $data['email'];
$id = $data['id'];

$table_name = 'users';


$query = "UPDATE " . $table_name . "SET username = :username,email = :email,phone_number = :phone_number WHERE id = :id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone_number', $phone_number);
$stmt->bindParam(':id', $id);
if ($stmt->execute()) {
    $success_message = "User edit successfully.";
    // Redirect to sidebar.php with success message
    header('Location: ../views/admin/sidebar.php?message_edit=' . urlencode($success_message));
    exit;
} else {
    echo "Error updating user.";
}

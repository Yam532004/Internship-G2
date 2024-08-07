<?php
include_once '../config/database.php';
session_start();
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

if (!isset($data['id'])) {
    echo json_encode(array("message" => "Miss filed user_id."));
    exit;
}

$user_id = $data['id'];
$table_name = 'users';
$deleted_at = date('Y-m-d H:i:s');

$query = "UPDATE users SET deleted_at = :deleted_at WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $user_id);
$stmt->bindParam(':deleted_at', $deleted_at);

if ($stmt->execute()) {
    $_SESSION['delete_success'] = "User deleted successfully.";
    // Redirect to sidebar.php with success message
    header('Location: ../views/sidebar.php');
    exit;
} else {
    $_SESSION['error'] = "Error updating user.";
}

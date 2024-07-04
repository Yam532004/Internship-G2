<?php
include_once '../config/database.php';
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$table_name = "users";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $isLocked = isset($_POST['is_locked']) ? 1 : 0;
    $stmt = $conn->prepare("UPDATE users SET is_locked = ? WHERE id = ?");
    $stmt->execute([$isLocked, $id]);

    if ($stmt->rowCount() > 0) { 
        $success_message = "Account status updated successfully.";
        header('Location: ../views/sidebar.php?message_is_locked=' . urlencode($success_message));
    } else {
        echo "Account not found or status not changed.";
    }
}
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

$table_name = "users";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $isLocked = isset($_POST['is_locked']) ? 1 : 0;
    // echo isset($_POST['is_locked']) ? 'is_locked exists' : 'is_locked does not exist';
    $stmt = $conn->prepare("UPDATE users SET is_locked = ? WHERE id = ?");

    $stmt->execute([$isLocked, $id]);

    if ($stmt->execute([$isLocked, $id])) {
        $_SESSION['message_is_locked'] = "Account status updated successfully.";
        // $page = "../views/sidebar.php";
        // header("Refresh:0; url=$page");
        header('Location: ../views/sidebar.php');
        exit;
    } else {
        $_SESSION['error'] = "Account not found or status not changed.";
        $page = "../views/sidebar.php";
        header("Refresh:0; url=$page");
        exit;
    }
}

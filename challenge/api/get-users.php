<?php
include_once '../config/database.php';

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include database connection
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

// Pagination parameters
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Default page number is 1
$limit = isset($_GET['limit']) ? $_GET['limit'] : 10; // Default limit is 10 records per page
$start = ($page - 1) * $limit;

// Query to fetch users with pagination
$sql = "SELECT * FROM users LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $start, PDO::PARAM_INT);
$stmt->bindParam(2, $limit, PDO::PARAM_INT);
$stmt->execute();

// Fetch all users
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are users
if ($users) {
    // Return users as JSON response
    echo json_encode($users);
} else {
    // No users found
    http_response_code(404);
    echo json_encode(array("message" => "No users found."));
}

<?php
include_once '../config/database.php';

header("Access-Control-Allow-Origin: *");
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
$search = isset($_GET['search']) ? $_GET['search'] : " ";
$start = ($page - 1) * $limit;

// Query to fetch total number of users
$totalRecordsQuery = "SELECT COUNT(*) as total FROM users WHERE username LIKE ? OR email LIKE ? OR phone_number LIKE ?";
$searchQuery = "%$search%";
$stmt = $conn->prepare($totalRecordsQuery);
$stmt->bindParam(1, $searchQuery, PDO::PARAM_STR);
$stmt->bindParam(2, $searchQuery, PDO::PARAM_STR);
$stmt->bindParam(3, $searchQuery, PDO::PARAM_STR);
$stmt->execute();
$totalRecords = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Query to fetch users with pagination
$sql = "SELECT * FROM users WHERE deleted_at IS NULL AND (username LIKE ? OR email LIKE ? OR phone_number LIKE ?) ORDER BY id DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $searchQuery, PDO::PARAM_STR);
$stmt->bindParam(2, $searchQuery, PDO::PARAM_STR);
$stmt->bindParam(3, $searchQuery, PDO::PARAM_STR);
$stmt->bindParam(4, $start, PDO::PARAM_INT);
$stmt->bindParam(5, $limit, PDO::PARAM_INT);
$stmt->execute();

// Fetch all users
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are users
if ($users) {
    // Return users and total records as JSON response
    echo json_encode([
        "data" => $users,
        "totalRecords" => $totalRecords
    ]);
} else {
    // No users found
    http_response_code(404);
    echo json_encode(array("message" => "No users found."));
}

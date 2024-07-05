<?php 
include_once '../config/database.php';
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

if (isset ($_GET['id'])){
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id =?";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $user_id);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "User not found."));
}
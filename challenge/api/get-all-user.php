<?php
session_start();
include_once '../config/database.php';
require_once '../vendor/autoload.php';

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();
$table_name = "users";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$_SESSION['results'] = $results;
header('Location: ../views/admin/user-management.php');


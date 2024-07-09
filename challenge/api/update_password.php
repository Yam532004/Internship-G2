<?php
session_start();
include_once '../config/database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

if (isset($_POST['email'], $_POST['token'], $_POST['new_password'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT email FROM users WHERE verify_token = ? AND email = ? AND token_expiry > NOW() LIMIT 1");
    $stmt->execute([$token, $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result){
        $update_stmt = $conn->prepare("UPDATE users SET password = ?, verify_token = NULL, token_expiry = NULL  WHERE email = ? LIMIT 1");
        $update_stmt->execute([$new_password, $email]);
        if ($update_stmt->rowCount() > 0) {
            $_SESSION['status'] = "Password updated";
            header("Location: login.php");
            exit(0);
        }else{
            $_SESSION['status'] = "Password can not be changed";
            header("Location: reset-password.php?token=$token");
            exit(0);
        }
    }else{
        $_SESSION['status'] = "Invalid request";
        header("Location: reset-password.php");
        exit(0);
    }

}

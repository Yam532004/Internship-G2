<?php
session_start();
var_dump($_SESSION['email']);
include_once '../config/database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

if (isset($_POST['email']) && isset($_POST['new_password'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM reset_passwords WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        $update_stmt = $conn->prepare("UPDATE users SET password = :new_password WHERE email = :email LIMIT 1");
        $update_stmt->bindParam(':new_password', $new_password);
        $update_stmt->bindParam(':email', $email);
        $result = $update_stmt->execute();

        if ($result) {
            $sql = "DELETE FROM reset_passwords WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $_SESSION['reset_password'] = 'Successfully updated password';
            header('Location:../views/login.php');
        } else {
            // Check if email was not found
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                echo "Email not found.";
            } else {
                echo "Password update failed.";
            }
        }
    }else{
        $_SESSION['die_link'] = "No case reset request found for this email";
       header('Location: ../views/login.php');
       exit();
    }    
} else {
    $_SESSION['die_link'] = "Required parameters (email and new_password) are missing.";
       header('Location: ../views/login.php');
       exit();
}

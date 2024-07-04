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
    echo json_encode(array("message" => "Missing some fields (username, phone_number, email)."));
    exit;
}

$username = $data['username'];
$phone_number = $data['phone_number'];
$email = $data['email'];
$password = $data['password'];
$default_password = 'default_password';
$id = $data['id'];

$table_name = 'users';

if ($password === $default_password) {
    // Update without password
    $query_non_update_password = "UPDATE " . $table_name . " SET username = :username, email = :email, phone_number = :phone_number WHERE id = :id";
    
    $stmt_non_update_password = $conn->prepare($query_non_update_password);
    $stmt_non_update_password->bindParam(':username', $username);
    $stmt_non_update_password->bindParam(':email', $email);
    $stmt_non_update_password->bindParam(':phone_number', $phone_number);
    $stmt_non_update_password->bindParam(':id', $id);

    if ($stmt_non_update_password->execute()) {
        $success_message = "User updated successfully.";
        header('Location: ../views/sidebar.php?message_edit=' . urlencode($success_message));
    } else {
        echo json_encode(array("error" => "Error updating user."));
    }
} else {
    // Update with password
    $query_update_password = "UPDATE " . $table_name . " SET username = :username, email = :email, phone_number = :phone_number, password = :password WHERE id = :id";
    
    $stmt_update_password = $conn->prepare($query_update_password);
    $stmt_update_password->bindParam(':username', $username);
    $stmt_update_password->bindParam(':email', $email);
    $stmt_update_password->bindParam(':phone_number', $phone_number);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt_update_password->bindParam(':password', $password_hash);
    $stmt_update_password->bindParam(':id', $id);

    if ($stmt_update_password->execute()) {
        $success_message = "User updated successfully.";
        header('Location: ../views/sidebar.php?message_edit=' . urlencode($success_message));
    } else {
        echo json_encode(array("error" => "Error updating user."));
    }
}
?>

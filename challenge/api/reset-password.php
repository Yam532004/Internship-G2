<?php
include_once '../config/database.php';
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new DatabaseService();

$conn = $databaseService->getConnection();

if (isset($_SESSION['reset_token'])) {
    $token = $_SESSION['reset_token'];

    $stmt = $conn->prepare("SELECT email FROM users WHERE verify_token = ? AND token_expiry > NOW() LIMIT 1");
    $stmt->execute([$token]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $email = $result['email'];
?>
        <form action="update_password.php" method="POST">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="password" name="new_password" placeholder="Nhập mật khẩu mới" required>
            <button type="submit">Reset password</button>
        </form>
<?php
    } else {
        echo 'Token is invalid';
    }
} else {
    echo 'Token is required';
    echo $_SESSION['reset_token'];
}

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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$token = bin2hex(random_bytes(16));
$expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

$stmt = $conn->prepare('SELECT username, email FROM users WHERE email = :email LIMIT 1');
$stmt->bindParam(':email', $email);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $get_name = $result['username'];
    $get_email = $result['email'];

    $update_stmt = $conn->prepare("UPDATE users SET verify_token = :token, token_expiry = :expiry WHERE email = :email LIMIT 1");
    $update_stmt->bindParam(':token', $token);
    $update_stmt->bindParam(':expiry', $expiry);
    $update_stmt->bindParam(':email', $get_email);
    $update_stmt->execute();

    if ($update_stmt->rowCount() > 0) {
        $_SESSION['reset_token'] = $token;
        send_password_reset($get_name, $get_email, $token);
        $_SESSION['status'] = 'Token has been sent successfully';
        // header('Location: notification.php');
        // exit(0); 
        echo 'Token has been sent successfully';
    } else {
        $_SESSION['status'] = 'Failed to update token';
        header('Location: reset-password.php');
        exit(0);
    }
} else {
    $_SESSION['status'] = 'Email không tồn tại';
    header("Location: reset-password.php");
    exit(0);
};


// Adjust the path as per your setup

function send_password_reset($name, $email, $token)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'am.y25@student.passerellesnumeriques.org'; // SMTP username
        $mail->Password   = 'yuea jvpj voow qcmm'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Sender and reply-to address
        $mail->setFrom('yam532004@gmail.com', 'Reset password');
        $mail->addReplyTo('yam532004@gmail.com', 'User email');
        $mail->addAddress($email, $name);


        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $reset_link = "http://localhost:3000/api/reset-password.php" ;
        // HTML email template
        $mail->Body = "
        <h2>Reset Password Request</h2>
        <p>Hello $name ,</p>
        <p>You are receiving this email because a password reset request was received for your account.</p>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>To reset your password, click on the following link:</p>
        <p><a href='$reset_link'>Reset Password</a></p>
        <p>If the above link does not work, copy and paste the following URL into your browser:</p>
        <br>
        <p>Best regards,</p>
        <p>Your Company Name</p>
    ";
        $mail->AltBody = "Hello $name,\n\nYou are receiving this email because a password reset request was received for your account.\n\nIf you did not request a password reset, please ignore this email.\n\nTo reset your password, click on the following link:\n\n$reset_link\n\nBest regards,\nYour Company Name";
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

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

$email = filter_var($_POST['email_reset_password'], FILTER_SANITIZE_EMAIL);
$is_locked = 0;
$stmt = $conn->prepare('SELECT username, email FROM users WHERE email = :email AND deleted_at IS NULL AND is_locked = :is_locked LIMIT 1');
$stmt->bindParam(':email', $email);
$stmt->bindParam(':is_locked', $is_locked);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
// set token 
$token = bin2hex(random_bytes(16));

if ($result) {

    // set giờ giá hạn token 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $expiry = date('Y-m-d H:i:s', strtotime('+3 minute'));
    $_SESSION['expiry'] = $expiry;

    $insert_reset_password = $conn->prepare('INSERT INTO reset_passwords (email, token_expiry, verify_token) VALUES (:email, :token_expiry, :verify_token)');
    $insert_reset_password->bindParam(':email', $email);
    $insert_reset_password->bindParam(':token_expiry', $expiry);
    $insert_reset_password->bindParam(':verify_token', $token);
    $result = $insert_reset_password->execute();


    send_password_reset($token);
    $_SESSION['email'] = $email;
    $_SESSION['token'] = $encodedToken;
    $_SESSION['status'] = 'Success to send the request.';
    header('Location: ../views/reset-password.php');
    // echo "http://localhost:3000/api/reset-password.php?email=$encryptedEmail&code=$encodedToken&expiry=$encodedExpiry&encodeKey=$encodeKey";
} else {
    $_SESSION['error_email'] = "Email does not exist or is locked. You have to input your email address in the system";
    header("Location: ../views/reset-password.php");
}


function send_password_reset($token)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'am.y25@student.passerellesnumeriques.org'; // SMTP username
        $mail->Password   = 'cnwn naqq gyzb avzz'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // TCP port to connect to

        // Sender and reply-to address
        $mail->setFrom('yam532004@gmail.com', 'Reset password');
        $mail->addReplyTo('yam532004@gmail.com', 'User email');
        $mail->addAddress($_SESSION['email']);


        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $reset_link = "http://localhost:3000/api/reset-password.php?t=$token";
        $_SESSION['reset_link'] = $reset_link;
        $mail->Body = "
        <h2>Reset Password Request</h2>
        <p>Hello " . $_SESSION['email'] . "</p>
        <p>You are receiving this email because a password reset request was received for your account.</p>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>To reset your password, click on the following link:</p>
        <p><a href='$reset_link'>Reset Password</a></p>
        <p>If the above link does not work, copy and paste the following URL into your browser:</p>
        <br>
        <p>Best regards,</p>
        <p>Your Company Name</p>
    ";
        $mail->AltBody = "Hello " . $_SESSION['email'] . ",\n\nYou are receiving this email because a password reset request was received for your account.\n\nIf you did not request a password reset, please ignore this email.\n\nTo reset your password, click on the following link:\n\n$reset_link\n\nBest regards,\nYour Company Name";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

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

if ($result) {
    $token = bin2hex(random_bytes(16));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $expiry = date('Y-m-d H:i:s', strtotime('+3 minute'));
    $_SESSION['expiry'] = $expiry;
    $select_reset_password = $conn->prepare('SELECT * FROM reset_passwords WHERE email = :email');
    $select_reset_password->bindParam(':email', $email);
    $select_reset_password->execute();
    $row = $select_reset_password->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $update_reset_password = $conn->prepare('UPDATE reset_passwords SET verify_token = :verify_token, token_expiry = :token_expiry WHERE email = :email');
        $update_reset_password->bindParam(':verify_token', $token);
        $update_reset_password->bindParam(':token_expiry', $expiry);
        $update_reset_password->bindParam(':email', $email);
        $result = $update_reset_password->execute();
    } else {
        $insert_reset_password = $conn->prepare('INSERT INTO reset_passwords (email, token_expiry, verify_token) VALUES (:email, :token_expiry, :verify_token)');
        $insert_reset_password->bindParam(':email', $email);
        $insert_reset_password->bindParam(':token_expiry', $expiry);
        $insert_reset_password->bindParam(':verify_token', $token);
        $result = $insert_reset_password->execute();
    }
    function encrypt($data, $key)
    {
        $cipher = "AES-256-CBC";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return base64_encode($iv . $ciphertext);
    }

    if ($result) {
        $key = openssl_random_pseudo_bytes(32);
        $encodeKey = base64_encode($key);
        $encryptedEmail = encrypt($email, $encodeKey);
        $encodedToken = encrypt($token, $encodeKey);
        $encodedExpiry = encrypt($expiry, $encodeKey);

        send_password_reset($email, $encryptedEmail, $encodedToken, $encodedExpiry, $encodeKey);
        $_SESSION['email'] = $email;
        $_SESSION['token'] = $encodedToken;
        $_SESSION['status'] = 'Success to send the request.';
        header('Location: ../views/reset-password.php');
        // echo "http://localhost:3000/api/reset-password.php?email=$encryptedEmail&code=$encodedToken&expiry=$encodedExpiry&encodeKey=$encodeKey";
    } else {
        $_SESSION['error_email'] = 'Failed to send token';
        // header('Location: reset-password.php');
        // exit(0);  // or use echo
    }
} else {
    $_SESSION['error_email'] = "Email does not exist or is locked. You have to input your email address in the system";
    header("Location: ../views/reset-password.php");
}



// Adjust the path as per your setup

function send_password_reset($email, $encryptedEmail, $encodedToken, $encodedExpiry, $encodeKey)
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
        $mail->addAddress($email);


        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $reset_link = "http://localhost:3000/api/reset-password.php?email=$encryptedEmail&code=$encodedToken&expiry=$encodedExpiry&encodeKey=$encodeKey";
        $_SESSION['reset_link'] = $reset_link;
        $mail->Body = "
        <h2>Reset Password Request</h2>
        <p>Hello $email ,</p>
        <p>You are receiving this email because a password reset request was received for your account.</p>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>To reset your password, click on the following link:</p>
        <p><a href='$reset_link'>Reset Password</a></p>
        <p>If the above link does not work, copy and paste the following URL into your browser:</p>
        <br>
        <p>Best regards,</p>
        <p>Your Company Name</p>
    ";
        $mail->AltBody = "Hello $email,\n\nYou are receiving this email because a password reset request was received for your account.\n\nIf you did not request a password reset, please ignore this email.\n\nTo reset your password, click on the following link:\n\n$reset_link\n\nBest regards,\nYour Company Name";
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

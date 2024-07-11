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
$stmt = $conn->prepare('SELECT username, email FROM users WHERE email = :email LIMIT 1');
$stmt->bindParam(':email', $email);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $token = bin2hex(random_bytes(16));
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $insert_reset_password = $conn->prepare("INSERT INTO reset_passwords (email, token_expiry, verify_token) VALUES (:email, :expiry, :token)");

    $insert_reset_password->bindParam(":email", $email);

    $insert_reset_password->bindParam(":expiry", $expiry);

    $insert_reset_password->bindParam(":token", $token);

    $result = $insert_reset_password->execute();
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
        header('Location: ../views/notification.php');
    } else {
        $_SESSION['status'] = 'Failed to send token';
        // header('Location: reset-password.php');
        // exit(0);  // or use echo
        echo 'Failed to send token';
    }
}else{
    $_SESSION['status'] = "Email does not exist. You have to input your email address in the system";
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
        $mail->Password   = 'yuea jvpj voow qcmm'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Sender and reply-to address
        $mail->setFrom('yam532004@gmail.com', 'Reset password');
        $mail->addReplyTo('yam532004@gmail.com', 'User email');
        $mail->addAddress($email);


        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $reset_link = "http://localhost:3000/api/reset-password.php?email=$encryptedEmail&code=$encodedToken&expiry=$encodedExpiry&encodeKey=$encodeKey";
        // HTML email template
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
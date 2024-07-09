<?php
include_once '../config/database.php';

session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Adjust the path as per your setup

function send_password_reset($get_name, $get_email, $token)
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
        $mail->addReplyTo('test@yopmail.com', 'User email');

        // HTML email template
        $email_template = '
            <h2>Reset Password Request</h2>
            <p>Hello {name},</p>
            <p>You are receiving this email because a password reset request was received for your account.</p>
            <p>If you did not request a password reset, please ignore this email.</p>
            <p>To reset your password, click on the following link:</p>
            <p><a href="{reset_link}">Reset Password</a></p>
            <p>If the above link does not work, copy and paste the following URL into your browser:</p>
            <p>{reset_link}</p>
            <br>
            <p>Best regards,</p>
            <p>Your Company Name</p>
        ';

        // Generate the reset link
        $reset_link = "https://example.com/reset-password.php?token=" . $token;

        // Personalize the message
        $email_content = str_replace(['{name}', '{reset_link}'], [$get_name, $reset_link], $email_template);

        // Add recipient
        $mail->addAddress($get_email, $get_name);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Reset Password Request';
        $mail->Body    = $email_content;
        $mail->AltBody = "Hello $get_name,\n\nYou are receiving this email because a password reset request was received for your account.\n\nIf you did not request a password reset, please ignore this email.\n\nTo reset your password, click on the following link: $reset_link\n\nIf the above link does not work, copy and paste the following URL into your browser: $reset_link\n\nBest regards,\nYour Company Name";

        // Send the email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Assuming $conn is your PDO connection object from DatabaseService
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

if (isset($_POST['password-reset-link'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $token = bin2hex(random_bytes(16)); // More secure token generation

    // Prepare SQL query using prepared statements
    $check_email_stmt = $conn->prepare("SELECT name, email FROM users WHERE email = :email LIMIT 1");
    $check_email_stmt->bindParam(':email', $email);
    $check_email_stmt->execute();
    $num = $check_email_stmt->rowCount();
    echo $num;

    if ($num > 0) {
        $result = $check_email_stmt->fetch(PDO::FETCH_ASSOC);
        $get_name = $row['name'];
        $get_email = $row['email'];

        // Update the user's verification token
        $update_token_stmt = $conn->prepare("UPDATE users SET verify_token = ? WHERE email = ? LIMIT 1");
        $update_token_stmt->execute([$token, $get_email]);

        if ($update_token_stmt->rowCount() > 0) {
            send_password_reset($get_name, $get_email, $token);
            // $_SESSION['status'] = 'Token has been sent to your email';
            // header("Location:../view/verify_email.php");
            // exit(0);
            echo 'Token has been sent to your email';
        } else {
            // $_SESSION['status'] = 'Failed to update token';
            // header("Location:../views/reset-password.php");
            // exit(0);
            echo 'Failed to update token';;
        }
    } else {
        // $_SESSION['status'] = 'Email does not exist';
        // header("Location:../views/reset-password.php");
        // exit(0);
        echo $email;
        echo 'Email does not exist';
    }
}

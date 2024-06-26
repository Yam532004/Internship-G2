<?php
// Kiểm tra định dạng số điện thoại
function isValidPhoneNumber($phone_number)
{
    $pattern = '/^\+?\d{1,3}[-\s]?\d{9,}$/';
    return preg_match($pattern, $phone_number);
}

// Kiểm tra mật khẩu theo tiêu chuẩn
function isValidPassword($password)
{
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    return preg_match($regex, $password);
}
function verifyRecaptcha($recaptcha_response)
{
    $errors = [];

    // Gửi yêu cầu xác thực reCAPTCHA đến Google
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_data = [
        'secret' => "6LeQIAEqAAAAAGp-Fiqsu7EJCQuVuE4aT-CX3TLV",
        'response' => $recaptcha_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];
    $recaptcha_options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data)
        ]
    ];
    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_response = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_result = json_decode($recaptcha_response, true);

    // Kiểm tra kết quả xác thực reCAPTCHA
    if (!$recaptcha_result['success']) {
        $errors['recaptcha'] = "reCAPTCHA verification failed";
    }

    return $errors;
}

// Hàm xử lý và kiểm tra dữ liệu
function validateUserData($conn, $email, $phone_number, $password, $confirm_password, $recaptcha_response)
{
    $errors = [];
    // Xác thực reCAPTCHA
    $recaptcha_errors = verifyRecaptcha($recaptcha_response);
    if (!empty($recaptcha_errors)) {
        $errors['recaptcha'] = $recaptcha_errors['recaptcha'];
    }
    // Kiểm tra email đã tồn tại hay chưa
    $sql_check_email = "SELECT email FROM users WHERE email = :email";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bindParam(':email', $email);
    $stmt_check_email->execute();
    $count = $stmt_check_email->rowCount();

    if ($count > 0) {
        $errors['email'] = "Email already exists";
    }

    // Kiểm tra định dạng số điện thoại
    if (!isValidPhoneNumber($phone_number)) {
        $errors['phone_number'] = "Please enter a valid phone number";
    }

    // Kiểm tra mật khẩu đủ điều kiện
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    } elseif (!isValidPassword($password)) {
        $errors['password'] = "Password must contain uppercase, lowercase, numbers and special characters";
    }

    // Kiểm tra mật khẩu và xác nhận mật khẩu
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Password and confirm password must be the same";
    }
    // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về form đăng ký
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form-data'] = $_POST;
        header('Location: ../views/auth/Register.php');
        exit();
    }
    return true;
}

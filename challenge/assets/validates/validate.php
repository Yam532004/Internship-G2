<?php function verifyRecaptcha($recaptcha_response)
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
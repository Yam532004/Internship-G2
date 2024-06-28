$(document).ready(function () {
  //Tạo phương thức validate email
  function validateEmail(value, element, param) {
    return /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(
      value
    );
  }
  jQuery.validator.addMethod(
    "checkEmail",
    validateEmail,
    "Please enter a valid email address"
  );

  //Tạo phương thức validate password
  function validatePassword(value, element, param) {
    return /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(
      value
    );
  }
  jQuery.validator.addMethod(
    "checkPassword",
    validatePassword,
    "Please enter a valid password"
  );
  $("#myform").validate({
    rules: {
      email: {
        required: true,
        checkEmail: true,
        remote: {
          url: "check-email-for-login.php",
          type: "post",
        },
      },
      password: {
        required: true,
        minlength: 5,
        checkPassword: true,
      },
    },
    messages: {
      email: {
        required: "We need your email address to contact you",
        checkEmail: "Please enter your email in the format yam532004@gmail.com",
        remote: "Email is not exist!",
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        checkPassword:
          "Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, one number, and one special symbol",
      },
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.siblings("span.error")); // Chèn thông báo lỗi vào span.error
    },
    highlight: function (element) {
      $(element).addClass("error"); // Thêm lớp 'error' vào phần tử không hợp lệ
    },
    unhighlight: function (element) {
      $(element).removeClass("error"); // Loại bỏ lớp 'error' từ phần tử hợp lệ
    },
    submitHandler: function (form) {
      grecaptcha.ready(function () {
        grecaptcha
          .execute("6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS", {
            action: "register",
          })
          .then(function (token) {
            document.getElementById("token").value = token;
            console.log(token);
            form.submit();
          });
      });
    },
  });
});

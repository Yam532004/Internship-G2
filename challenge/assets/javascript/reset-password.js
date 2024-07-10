//Tạo phương thức validate số điện thoại

$(document).ready(function () {
  if (window.jQuery) {
    console.log("jQuery is loaded!");
  } else {
    console.log("jQuery is not loaded!");
  }
  if ($.validator) {
    console.log("jQuery Validator is loaded!");
  } else {
    console.log("jQuery Validator is not loaded!");
  }
  //Tạo phương thức validate password
  $.validator.methods.checkPassword = function (value, element) {
    return (
      this.optional(element) ||
      /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/.test(
        value
      )
    );
  };

  $("#resetPasswordForm").validate({
    rules: {
      new_password: {
        required: true,
        minlength: 5,
        checkPassword: true,
      },
      repeat_password: {
        required: true,
        equalTo: "#new_password",
        checkPassword: true,
      },
    },
    messages: {
      new_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long",
        checkPassword:
          "Password must be at least 5 characters long, contain one uppercase letter, one lowercase letter, one number, and one special symbol",
      },
      repeat_password: {
        required: "Please confirm your password",
        equalTo: "Please enter the same password as above",
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
            action: "resetpassword",
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

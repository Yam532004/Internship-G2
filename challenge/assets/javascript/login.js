$(document).ready(function () {
  //Tạo phương thức validate email
  //Tạo phương thức validate email
  $.validator.methods.checkEmail = function (value, element) {
    return (
      this.optional(element) ||
      (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        value
      ) &&
        value.toLowerCase().endsWith("@gmail.com"))
    );
  };

  //Tạo phương thức validate password
  $.validator.methods.checkPassword = function (value, element) {
    return (
      this.optional(element) ||
      /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/.test(
        value
      )
    );
  };
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

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

  //Tạo phương thức validate email
  $.validator.methods.checkEmail = function (value, element) {
    return (
      this.optional(element) ||
      (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        value
      ))
    );
  };

  $("#emailResetPassword").validate({
    rules: {
      email_reset_password: {
        required: true,
        checkEmail: true,
      },
    },
    messages: {
      email_reset_password: {
        required: "We need your email address to contact you",
        checkEmail: "Please enter your email in the format yam532004@gmail.com",
        remote: "Email already in use!",
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
            action: "emailresetpassword",
          })
          .then(function (token) {
            document.getElementById("token").value = token;
            form.submit();
          });
      });
    },
  });
});

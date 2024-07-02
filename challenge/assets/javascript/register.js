$(document).ready(function () {
  // Check if jQuery and jQuery Validator are loaded
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

  // Define custom validation methods
  $.validator.addMethod("checkPhone", function (value, element) {
    return this.optional(element) || /([\+84|84|0]+(3|5|7|8|9|1[2|6|8|9]))+([0-9]{8})\b/.test(value);
  }, "Please enter a valid phone number");

  $.validator.addMethod("checkEmail", function (value, element) {
    return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
  }, "Please enter a valid email address");

  $.validator.addMethod("checkPassword", function (value, element) {
    return this.optional(element) || /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
  }, "Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, one number, and one special symbol");

  // Initialize form validation
  $("#myform").validate({
    rules: {
      username: {
        required: true,
        minlength: 3,
        maxlength: 8,
      },
      email: {
        required: true,
        checkEmail: true,
        remote: {
          url: "check-email-for-register.php",
          type: "post",
        },
      },
      phone_number: {
        required: true,
        checkPhone: true,
      },
      password: {
        required: true,
        minlength: 5,
        checkPassword: true,
      },
      confirm_password: {
        required: true,
        equalTo: "#password",
        checkPassword: true,
      },
    },
    messages: {
      // Validation error messages
    },
    errorPlacement: function (error, element) {
      error.appendTo(element.siblings("span.error")); // Append error message to sibling span
    },
    highlight: function (element) {
      $(element).addClass("error"); // Add 'error' class to invalid elements
    },
    unhighlight: function (element) {
      $(element).removeClass("error"); // Remove 'error' class from valid elements
    },
    submitHandler: function (form) {
      // Handle form submission
      grecaptcha.ready(function () {
        grecaptcha.execute("6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS", {
          action: "register",
        }).then(function (token) {
          document.getElementById("token").value = token;
          console.log(token);
          form.submit(); // Submit the form after recaptcha validation
        });
      });
    },
  });
});

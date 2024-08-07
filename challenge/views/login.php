<?php
include 'layouts/header.php';
session_start();
// Kiểm tra nếu có thông báo lỗi từ session
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$oldEmail = isset($_SESSION['old_email']) ? $_SESSION['old_email'] : '';
unset($_SESSION['old_email']);
unset($_SESSION['error']);
// echo isset($_SESSION['logout_token'])? $_SESSION['logout_token'] : "khong co";
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Sign in</h3>
        </div>
        <form id="myform" action="../api/login.php" method="post">
          <div class="card-body container">
            <input type="hidden" id="token" name="token">
            <div class="form-group">
              <label for="email">Email address <span style="color:red">(*)</span></label>
              <div class="input-group">
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $oldEmail; ?>">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
              </div>
              <label id="email-error" class="error" for="email" style="display:none"></label>
            </div>

            <div class="form-group">
              <label for="password">Password <span style="color:red">(*)</span></label>
              <div class="input-group">
                <input type="text" class="form-control" name="password" id="login_password" autocomplete="off">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-eye-slash" id="toggleLogin_password"></i></span>
                </div>
              </div>
              <span class="error"><b><?php echo $errorMessage ?></b></span>
              <label id="login_password-error" class="error" for="login_password" style="display:none"></label>
            </div>
            <p> <a href="reset-password.php"><i>Forgot password</i></a>? Did you <a href="register.php"> not have an account? </a></i></p>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary w-100" style="
                            width: max-content !important;
                            float: inline-end;
                        ">Submit
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-3"></div>
  </div>
</div>
<script type="text/javascript" src="../assets/javascript/login.js"></script>

<script>
  $(document).ready(function() {
    // Set toastr options
    toastr.options.timeOut = 1500; // 1.5s
    // Check if there's a success message passed from PHP
    <?php if (isset($_SESSION['create_success'])) : ?>
      toastr.success('<?php echo $_SESSION['create_success'] ?>');
      <?php unset($_SESSION['create_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['create_fail'])) : ?>
      toastr.success('<?php echo $_SESSION['create_fail'] ?>');
      <?php unset($_SESSION['create_fail']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message_is_locked'])) : ?>
      toastr.success('<?php echo $_SESSION['message_is_locked'] ?>');
      <?php unset($_SESSION['message_is_locked']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['login_success'])) : ?>
      toastr.success('<?php echo $_SESSION['login_success'] ?>');
      <?php unset($_SESSION['login_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])) : ?>
      toastr.error('<?php echo $_SESSION['error'] ?>');
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['delete_success'])) : ?>
      toastr.success('<?php echo $_SESSION['delete_success'] ?>');
      <?php unset($_SESSION['delete_success']); ?>
    <?php endif; ?>


    <?php if (isset($_SESSION['edit_success'])) : ?>
      toastr.success('<?php echo $_SESSION['edit_success'] ?>');
      <?php unset($_SESSION['edit_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['reset_password'])) : ?>
      toastr.success('<?php echo $_SESSION['reset_password'] ?>');
      <?php unset($_SESSION['reset_password']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['logout_token'])) : ?>
      toastr.error('<?php echo $_SESSION['logout_token'] ?>');
      <?php unset($_SESSION['logout_token']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['die_link'])) : ?>
      toastr.error('<?php echo $_SESSION['die_link'] ?>');
      <?php unset($_SESSION['die_link']); ?>
    <?php endif; ?>
  });
</script>
<script>
  document.getElementById('login_password').addEventListener('input', function() {
    if (this.getAttribute('type') !== 'password') {
      this.setAttribute('type', 'password');
    }
    const passwordIcon = document.getElementById('toggleLogin_password');
    passwordIcon.classList.remove('fa-eye');
    passwordIcon.classList.add('fa-eye-slash');
  });

  // Chức năng toggle mật khẩu khi nhấp vào icon mắt
  document.getElementById('toggleLogin_password').addEventListener('click', function() {
    const passwordInput = document.getElementById('login_password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
</script>
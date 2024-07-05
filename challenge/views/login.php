<?php
include 'layouts/header.php';
session_start();
// Kiểm tra nếu có thông báo lỗi từ session
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$oldEmail = isset($_SESSION['old_email']) ? $_SESSION['old_email'] : '';
unset($_SESSION['old_email']);
// Xóa thông báo lỗi sau khi hiển thị nó
unset($_SESSION['error']);
?>
<div class="d-flex justify-content-center">
    <div class="background-login">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="myform" class="form" action="../api/login.php" method="post">
        <h3 style="color:aliceblue;">Sign in</h3>
        <input type="hidden" id="token" name="token">

        <div><p style="color:aliceblue;" for="email">Email</p>
            <input type="text" name="email" id="email" placeholder="Input your email *" value="<?php echo htmlspecialchars($oldEmail); ?>" />
            <span class="error"></span>
        </div>
        <div class="mb-5">
            <p style="color:aliceblue;" for="password">Password</p>
            <input name="password" id="password" placeholder="Input your password *" />
            <span class="error" style="color: red;"><?php echo $errorMessage ?></span>
        </div>
        <button type="submit">Submit</button>
        <div class="acc-text">

            <span style="color: #0000ff; cursor: pointer;">Fogot password?</span>
        </div>
    </form>
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
  });
</script>
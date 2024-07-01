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
        <h3>Sign in</h3>
        <input type="hidden" id="token" name="token">

        <div><label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Input your email *" value="<?php echo htmlspecialchars($oldEmail); ?>" />
            <span class="error"></span>
        </div>
        <div class="mb-5">
            <label for="password">Password</label>
            <input name="password" id="password" placeholder="Input your password *" />
            <span class="error" style="color: red;"><?php echo $errorMessage ?></span>
        </div>
        <button type=" submit">Submit</button>
        <div class="acc-text">

            <span style="color: #0000ff; cursor: pointer;">Fogot password?</span>
        </div>
    </form>
</div>

<script type="text/javascript" src="../assets/javascript/login.js"></script>
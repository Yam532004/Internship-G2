<?php
require_once 'layouts/header.php';
session_start();
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-md-6 justify-content-center">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reset password</h3>
                </div>
                <form action="../api/password_reset_request.php" method="POST" id="emailResetPassword" novalidate="novalidate">
                    <input type="hidden" id="token" name="token">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email_reset_password">Email address</label>
                            <input type="email" name="email_reset_password" class="form-control" id="email_reset_password" placeholder="Enter email">
                            <span class="error"></span>
                        </div>
                        <p><i>* Please contact with Admin if you can not send email</i></p>
                    </div>
                    <div class="card-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                     <a href="login.php">Back to Login</a>
                                </div>
                                <div class="col-6 pr-0">
                                    <button type="submit" class="btn btn-primary" name="password-reset-link">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<!-- Validate -->

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/javascript/email_reset_password.js"></script>

<script>
    $(document).ready(function() {
        // Set toastr options
        toastr.options.timeOut = 2000; // 1.5s
        // Check if there's a success message passed from PHP
        <?php if (isset($_SESSION['status'])) : ?>
            toastr.success('<?php echo $_SESSION['status'] ?>');
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_email'])) : ?>
            toastr.error('<?php echo $_SESSION['error_email'] ?>');
            <?php unset($_SESSION['error_email']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_token'])) : ?>
            toastr.error('<?php echo $_SESSION['error_token'] ?>');
            <?php unset($_SESSION['error_token']); ?>
        <?php endif; ?>
    })
</script>
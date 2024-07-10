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
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="password-reset-link">Submit</button>
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
        toastr.options.timeOut = 1500; // 1.5s
        // Check if there's a success message passed from PHP
        <?php if (isset($_SESSION['status'])) : ?>
            toastr.success('<?php echo $_SESSION['status'] ?>');
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>

    })
</script>
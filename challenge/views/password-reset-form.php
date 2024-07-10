<?php
session_start();
require_once 'layouts/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-md-6 justify-content-center">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reset password</h3>
                </div>
                <form action="../api/update_password.php" method="POST" id="resetPasswordForm" novalidate="novalidate">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <label for="new_password">New Password</label>

                                    <input type="hidden" name="token" id="token" value="<?php echo !empty($_SESSION['token']) ? $_SESSION['token'] : "No token" ?>">

                                    <input name="email" type="hidden" value="<?php echo !empty($_SESSION['email']) ? $_SESSION['email'] : "No email"; ?>">
                                    <div class="conatiner">
                                        <div class="row">
                                            <input type="text" name="new_password" class="form-control col-11" id="new_password" placeholder="Enter new password">
                                            <span class="input-group-text col-1"><i class="far fa-eye-slash " id="toggleNew_password"></i></span>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="repeat_password">Repeat Password</label>

                                    <div class="conatiner">
                                        <div class="row">
                                            <input type="text" name="repeat_password" class="form-control col-11" id="repeat_password" placeholder="Repeat password">
                                            <span class="input-group-text col-1"><i class="far fa-eye-slash" id="toggleRepeat_password"></i></span>
                                            <span class="error"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="">Submit</button>
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
<script type="text/javascript" src="../assets/javascript/reset-password.js"></script>

<script>
    var new_password = document.querySelector('#new_password');
    var toggleNew_password = document.querySelector('#toggleNew_password');
    toggleNew_password.addEventListener('click', function() {
        const type = new_password.getAttribute('type') === 'password' ? 'text' : 'password';
        new_password.setAttribute('type', type);
        this.classList.toggle('fa-eye');

    })

    var repeat_password = document.querySelector('#repeat_password');
    var toggleRepeat_password = document.querySelector('#toggleRepeat_password');
    toggleRepeat_password.addEventListener('click', function() {
        const type = repeat_password.getAttribute('type') === 'password' ? 'text' : 'password';
        repeat_password.setAttribute('type', type);
        this.classList.toggle('fa-eye');

    })
</script>
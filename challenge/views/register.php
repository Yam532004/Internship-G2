<?php
include 'layouts/header.php'
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Sign up</h3>
                </div>
                <form id="myform" action="../api/register.php" method="post" accept-charset="UTF-8" >
                    <div class="card-body container">
                        <input type="hidden" id="token" name="token">
                        <div class="form-group">
                            <label for="username">Name <span style="color:red">(*)</span></label>
                            <div class="input-group">
                                <input type="username" name="username" class="form-control" id="username">
                            </div>
                            <label id="username-error" class="error" for="username" style="display:none"></label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email address <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="email">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                    </div>
                                    <label id="email-error" class="error" for="email" style="display:none"></label>
                                </div>

                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone_number">Phone number <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" name="phone_number" class="form-control">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                    </div>
                                    <label id="phone_number-error" class="error" for="phone_number" style="display:none"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="password" id="password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="togglePassword"></i></span>
                                        </div>
                                    </div>
                                    <label id="password-error" class="error" for="password" style="display:none"></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="toggleConfirmPassword"></i></span>
                                        </div>
                                    </div>
                                    <label id="confirm_password-error" class="error" for="confirm_password" style="display:none"></label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                            </div>
                        </div>
                        <p class="text-center"><i>Do you have an account? <a href="login.php" /> Please login</i></p>
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
<script type="text/javascript" src="../assets/javascript/register.js"></script>
<script>

    // Tự động đặt lại type của input là 'password' khi người dùng nhập liệu
    document.getElementById('password').addEventListener('input', function() {
        if (this.getAttribute('type') !== 'password') {
            this.setAttribute('type', 'password');
        }
        const passwordIcon = document.getElementById('togglePassword');
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    });

    // Chức năng toggle mật khẩu khi nhấp vào icon mắt
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    document.getElementById('confirm_password').addEventListener('input', function() {
        if (this.getAttribute('type') !== 'password') {
            this.setAttribute('type', 'password');
        }
        const passwordIcon = document.getElementById('toggleConfirmPassword');
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    });

    // Chức năng toggle mật khẩu khi nhấp vào icon mắt
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('confirm_password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });


</script>
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
                <form id="myform" action="../api/register.php" method="post" accept-charset="UTF-8">
                    <div class="card-body container">
                        <input type="hidden" id="token" name="token">
                        <div class="form-group">
                            <label for="username">Name <span style="color:red">(*)</span></label>
                            <input type="username" name="username" class="form-control" id="username">
                            <label id="username-error" class="error" for="username"></label>
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
                                    <label id="email-error" class="error" for="email"></label>
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
                                    <label id="phone_number-error" class="error" for="phone_number"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password">Password <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="password" id="password">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="togglePassword"></i></span>
                                        </div>
                                    </div>
                                    <label id="password-error" class="error" for="password"></label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="confirm_password" id="confirm_password">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="toggleConfirmPassword"></i></span>
                                        </div>
                                    </div>
                                    <label id="confirm_password-error" class="error" for="confirm_password"></label>
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
    var password = document.querySelector('#password');
    var togglePassword = document.querySelector('#togglePassword');
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');

    })

    password.addEventListener('input', function() {
        if (this.getAttribute('type') !== 'password') {
            this.setAttribute('type', 'password');
        }
    });

    var confirm_password = document.querySelector('#confirm_password');
    var toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirm_password.getAttribute('type') === 'password' ? 'text' : 'password';
        confirm_password.setAttribute('type', type);
        this.classList.toggle('fa-eye');

    })

    confirm_password.addEventListener('input', function() {
        if (this.getAttribute('type') !== 'password') {
            this.setAttribute('type', 'password');
        }
    });
</script>
<!-- Create user  -->
<button class="btn btn-sm btn-success " data-toggle="modal" data-target="#create-user">Create +</button>

<div class="modal fade" id="create-user" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create</h4>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span class="float-right" aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../api/create.php" id="myform" method="post">
                <div class="modal-body">
                    <div class="card-body container">
                        <input type="hidden" id="token" name="token">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label style="float: left;" for="username">Name <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your name">
                                    </div>
                                    <label style="float: left;" id="username-error" class="error" for="username"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label style="float: left;" for="email">Email address <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                    </div>
                                    <label style="float: left;" id="email-error" class="error" for="email"></label>
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label style="float: left;" for="phone_number">Phone number <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                    </div>
                                    <label style="float: left;" id="phone_number-error" class="error" for="phone_number"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label style="float: left;" for="password">Password <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="password" id="password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="togglePassword"></i></span>
                                        </div>
                                    </div>
                                    <label style="float: left;" id="password-error" class="error" for="password"></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label style="float: left;" for="confirm_password">Confirm Password <span style="color:red">(*)</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="toggleConfirm_Password"></i></span>
                                        </div>
                                    </div>
                                    <label style="float: left;" id="confirm_password-error" class="error" for="confirm_password"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between float-right">
                    <button type="submit" style="width: fit-content;" class="btn btn-primary ">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<Script>

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
        const passwordIcon = document.getElementById('toggleConfirm_Password');
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    });

    // Chức năng toggle mật khẩu khi nhấp vào icon mắt
    document.getElementById('toggleConfirm_Password').addEventListener('click', function() {
        const passwordInput = document.getElementById('confirm_password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

</Script>
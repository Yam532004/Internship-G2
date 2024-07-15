<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close" onclick="
                                        var backdrop = document.getElementsByClassName('modal-backdrop')[0]; 
                                        console.log(backdrop);
                                        if (backdrop) {
                                            backdrop.classList.remove('modal-backdrop');
                                        }
                                ">
                    <span class="float-right" aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="form_modal_edit" method="POST">
                <div class="modal-body">
                    <div class="card-body container">
                        <input type="hidden" id="token" name="token">
                        <input type="hidden" name="id" id="edit_modal_id">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_username">Full Name</label>
                                    <div class="input-group">
                                        <input type="text" name="username" class="form-control" id="edit_username" placeholder="Enter your name">
                                    </div>
                                    <label id="edit_username-error" class="error" for="edit_username"></label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_phone_number">Phone Number</label>
                                    <div class="input-group">
                                        <input type="text" name="phone_number" class="form-control" id="edit_phone_number" placeholder="Enter phone number" value="">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                    </div>
                                    <label id="edit_phone_number-error" class="error" for="edit_phone_number"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_email">Email Address</label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="edit_email" placeholder="Enter email">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                    </div>
                                    <label id="edit_email-error" class="error" for="edit_email"></label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_password">Password</label>
                                    <div class="input-group">

                                        <input type="text" name="password" class="form-control" id="edit_password" placeholder="Enter password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-eye-slash" id="toggleEdit_password"></i></span>
                                        </div>
                                        <span class="error text-left"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    
                                </div>

                                <div class="col-6 pr-0">
                                    <button type="submit" style="width: fit-content;" class="saveEdit btn btn-primary btn-block float-right">Save Changes</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>
</div>
<script>
    document.getElementById('edit_password').addEventListener('input', function() {
        if (this.getAttribute('type') !== 'password') {
            this.setAttribute('type', 'password');
        }
        const passwordIcon = document.getElementById('toggleEdit_password');
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    });

    // Chức năng toggle mật khẩu khi nhấp vào icon mắt
    document.getElementById('toggleEdit_password').addEventListener('click', function() {
        const passwordInput = document.getElementById('edit_password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
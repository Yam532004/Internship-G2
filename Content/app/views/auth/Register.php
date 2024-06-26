<?php
include '../layouts/Header.php';
// Tạo phiên để lưu trữ thông tin người dùng khi nhập lỗi 
// .... để lưu trữ lỗi 
// truy xuất lỗi và biểu mẫu từ phiên 
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
?>
<div class="container ">
    <form action="../../controlers/registerController.php" method="post" class="d-block">
        <section style="background-color: #eee;">
            <div class="container  ">
                <div class="row d-flex justify-content-center align-items-center  ">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                        <?php if (!empty($errors)) : ?>
                                            <div class="alert alert-danger">
                                                <ul>
                                                    <?php foreach ($errors as $error) : ?>
                                                        <li><?php echo $error; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                        <form class="mx-1 mx-md-4" action="../../controlers/registerController.php" method="post">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input name="username" type="text" id="form3Example1c" class="form-control" required value="<?php echo isset($form_data['username']) ? $form_data['username'] : '' ?>" />
                                                    <label class="form-label" for="form3Example1c">Your Name</label>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input name="phone_number" type="text" id="form3Example2c" class="form-control" min="1" required value="<?php echo isset($form_data['phone_number']) ? $form_data['phone_number'] : '' ?>" />
                                                    <label class="form-label" for="form3Example2c">Your Phone</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input name="email" type="email" id="form3Example3c" class="form-control" required value="<?php echo isset($form_data['email']) ? $form_data['email'] : '' ?>" />
                                                    <label class="form-label" for="form3Example3c">Your Email</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input name="password" type="password" id="form3Example4c" class="form-control" required value="<?php echo isset($form_data['password']) ? $form_data['password'] : '' ?>" />
                                                    <label class="form-label" for="form3Example4c">Password</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                    <input name="confirm_password" type="password" id="form3Example4cd" class="form-control" required value="<?php echo isset($form_data['confirm_password']) ? $form_data['confirm_password'] : '' ?>" />
                                                    <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                                </div>
                                            </div>

                                            <!-- <div class="g-recaptcha" data-sitekey="6LfT4QAqAAAAAF-pGLBTYYLHZr-CrwdaPbhGu8_b"></div> -->
                                            <input type="submit" value="Register" class=" btn btn-success d-flex float-right pl-5 pr-5" name="post">
                                            <input type="hidden" id="token" name="token">
                                        </form>
                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS', {
            action: 'Register'
        }).then(function(token) {
            console.log(token);
            document.getElementById('token').value = token;
        });
    });
</script>
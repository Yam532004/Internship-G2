<!-- Create user  -->
<?php include '../layouts/header.php' ?>
<button class="btn btn-sm btn-success " data-toggle="modal" data-target="#create-user">Create +</button>

<div class="modal fade" id="create-user" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content w-75">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-center">Create user</h3>
                    </div>
                    <form action="../../api/register.php" id="myform" method="post">
                        <div class="card-body container">
                            <input type="hidden" id="token" name="token">
                            <div class="form-group">
                                <label class="text-right" for="username">User name</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                                <span class="error text-right"></span>
                            </div>
                            <div class="form-group">
                                <label class="text-right" for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label class="text-right" for="phone_number">Phone number</label>
                                <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label class="text-right" for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <label class="text-right" for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password">
                                <span class="error"></span>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="saveEdit btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


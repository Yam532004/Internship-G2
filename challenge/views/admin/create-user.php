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
            <form action="../../api/register.php" id="myform" method="post">
                <div class="modal-body">
                    <div class="card-body container">
                        <input type="hidden" id="token" name="token">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <p class="text-left" for="username">Full name </p>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter your name">
                                    <span class="error float-left"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <p class="text-left" for="email">Email address</p>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                    <span class="error float-left"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <p class="text-left" for="phone_number">Phone number</p>
                                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number">
                                    <span class="error float-left "></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <p class="text-left" for="password">Password</p>
                                    <input type="text" name="password" class="form-control" id="password" placeholder="Password">
                                    <span class="error float-left "></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <p class="text-left" for="confirm_password">Confirm Password</p>
                                    <input type="text" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm password">
                                    <span class="error float-left "></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between d-flex">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>

    </div>
</div>
</div>
</div>
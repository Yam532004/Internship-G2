<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                    <input type="text" name="username" class="form-control" id="edit_username" placeholder="Enter your name">
                                    <span class="error float-left">
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" id="edit_phone_number" placeholder="Enter phone number" value="">
                                    <span class="error text-left"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_email">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="edit_email" placeholder="Enter email">
                                    <span class="error text-left"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="edit_password">Password</label>
                                    <input type="text" name="password" class="form-control" id="edit_password" placeholder="Enter password">
                                    <span class="error text-left"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="saveEdit btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
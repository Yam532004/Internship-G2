<?php
require_once 'layouts/header.php'
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-md-6 justify-content-center">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reset password</h3>
                </div>
                <form action="../api/password-reset-code.php" method="POST" id="quickForm" novalidate="novalidate">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"
                        name="password-reset-link">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
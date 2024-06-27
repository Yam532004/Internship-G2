<?php
include '../layouts/Header.php';
?>
<div class="d-flex justify-content-center">
    <div class="background-login">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="myform" class="form" action="../../controlers/registerController.php" method="post">
        <h3>Login Here</h3>
        <input type="hidden" id="token" name="token">

        <div><label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Input your email *" />
            <span class="error"></span>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Input your password *" />
            <span class="error"></span>
        </div>

        <button type="submit">Submit</button>
        <div class="acc-text">
            Already have an account?
            <span style="color: #0000ff; cursor: pointer;">Login</span>
        </div>
    </form>
</div>
<!-- <script type="text/javascript" src="../../../assets/javascript/register.js"></script> -->
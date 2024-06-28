<?php
include 'layouts/header.php'
?>
<div class="d-flex justify-content-center">
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="myform" class="form" action="../api/register.php" method="post">
        <h3>Login Here</h3>
        <input type="hidden" id="token" name="token">
        <div><label for="username">Name</label>
            <input type="text" name="username" id="username" placeholder="Input your name *" />
            <span class="error"></span>
        </div>

        <div><label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Input your email *" />
            <span class="error"></span>
        </div>

        <div>
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" placeholder="Input your phone number *" />
            <span class="error"></span>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Input your password *" />
            <span class="error"></span>
        </div>
        <div class="mb-3">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Input your confirm password *" />
            <span class="error mb-5"></span>
        </div>
        <button type="submit">Submit</button>
        <div class="acc-text">
            Already have an account?
            <span style="color: #0000ff; cursor: pointer;">Login</span>
        </div>
    </form>
</div>
<script type="text/javascript" src="../assets/javascript/register.js"></script>
<?php
include 'layouts/header.php'
?>
<div class="d-flex justify-content-center">
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="myform" class="form" action="../api/register.php" method="post">
        <h3 style="color:aliceblue">SignUp</h3>
        <input type="hidden" id="token" name="token">
        <div>
            <p style="color:aliceblue" for="username">Name</p>
            <input style="color:aliceblue" type="text" name="username" id="username" placeholder="Input your name *" />
            <span class="error"></span>
        </div>

        <div>
            <p style="color:aliceblue" for="email">Email</p>
            <input style="color:aliceblue" type="text" name="email" id="email" placeholder="Input your email *" />
            <span class="error"></span>
        </div>

        <div>
            <p style="color:aliceblue" for="phone_number">Phone Number</p>
            <input style="color:aliceblue" type="text" name="phone_number" id="phone_number" placeholder="Input your phone number *" />
            <span class="error"></span>
        </div>
        <div>
            <p style="color:aliceblue" for="password">Password</p>
            <input style="color:aliceblue" name="password" id="password" placeholder="Input your password *" />
            <span class="error"></span>
        </div>
        <div class="mb-3">
            <p style="color:aliceblue" for="confirm_password">Confirm Password</p>
            <input style="color:aliceblue" name="confirm_password" id="confirm_password" placeholder="Input your confirm password *" />
            <span class="error mb-5"></span>
        </div>
        <button type="submit">Submit</button>
        <div class="acc-text">
            Already have an account?
            <a href="login.php"><span style="color: #0000ff; cursor: pointer;">Login</span></a>
        </div>
    </form>
</div>
<script type="text/javascript" src="../assets/javascript/register.js"></script>
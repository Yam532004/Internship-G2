<?php
session_start();

$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';

include 'layouts/header.php'
?>
<div class="d-flex justify-content-center">
    <div class="background-login">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="myform" class="form" action="../api/login.php" method="post">
        <h3>Login Here</h3>
        <input type="hidden" id="token" name="token">

        <div><label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Input your email *" />
            <span class="error"></span>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Input your password *" />
            
        </div>
        <span class="error"><?php $errorMessage;?></span>
        <button type=" submit">Submit</button>
                <div class="acc-text">
                    Already have an account?
                    <span style="color: #0000ff; cursor: pointer;">Login</span>
                </div>
    </form>
</div>

<script type="text/javascript" src="../assets/javascript/login.js"></script>
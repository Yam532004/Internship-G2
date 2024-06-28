<?php
require 'Header.php';
?>

<body>
    <div class="container-fluid">
        <div id="header">
            <div class="offcanvas offcanvas-start" id="demo">
                <div class="offcanvas-header">
                    <h1 class="offcanvas-title">Content</h1>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav align-center">
                        <a class="navbar-brand" href="#">
                            <img src="https://media.autoexpress.co.uk/image/private/s--vZkbi5D1--/f_auto,t_primary-image-mobile@1/v1685458010/autoexpress/2023/05/Porsche%20911%20GTS%20UK%20001_otx6j7.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill">
                        </a>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-fw fa-home"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-fw fa-product-hunt"></i>Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-fw fa-user"></i>About</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-fw fa-envelope"></i>
                                Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <nav class="navbar navbar-expand-sm">
                <div class="container-fluid">
                    <ul class="navbar-nav align-center">
                        <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                            <span class="Search" style="font-size:30px;cursor:pointer; color: palevioletred; margin-right: 20px;" onclick="openNav()">&#9776;
                            </span>
                        </button>

                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-fw fa-home"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-fw fa-product-hunt"></i>Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-fw fa-user"></i>About</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-fw fa-envelope"></i>
                                Contact</a>
                        </li>
                    </ul>
                    <!-- <div class="d-flex">
                        <button class="btn btn-primary m-1" type="button" onclick="window.location.href='../auth/Register.php'">Sign in</button>
                        <button class="btn btn-outline-danger m-1" type="button" onclick="window.location.href='../auth/Login.php'">Sign up</button>
                    </div> -->

                    <?php if (isset($_SESSION['token'])) : ?>
                        <div style="width:30%;" class="bg-info rounded-circle">
                            <img src="avatar.png" alt="Avatar" class="avatar">
                        </div>
                    <?php else : ?>
                        <div class="d-flex">
                            <button class="btn btn-primary m-1 " type="button" onclick="window.location.href='../../../views/register.php'">Sign in</button>
                            <button class="btn btn-outline-danger m-1" type="button" onclick="window.location.href='../../../views/login.php'">Sign up</button>
                        </div>
                        <!-- <?php print_r($_SESSION['token']) ?> -->
                    <?php endif; ?>

                </div>
            </nav>
        </div>
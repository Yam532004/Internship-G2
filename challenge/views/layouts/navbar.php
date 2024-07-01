<?php
require 'Header.php';
// session_start();
?>

<body>
    <div class="container-fluid">

        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item dropdown">

                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <?php if (isset($_SESSION['login_success'])) : ?>
                    <div class="bg-info rounded-circle">

                        <?php unset($_SESSION['login_success']); ?>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <!-- <img src="https://stimg.cardekho.com/images/carexteriorimages/930x620/Porsche/718/10989/1690874880367/front-left-side-47.jpg" alt="Avatar" class="avatar" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
Hallo
                            <span class="caret"></span></button>

                        <ul class="dropdown-menu">
                            <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                        </ul>
                    </div>
                <?php else : ?>
                    <div class="d-flex">
                        <button class="btn btn-primary p-1 m-1 " type="button" onclick="window.location.href='../../../views/register.php'">Sign in</button>
                        <button class="btn btn-outline-danger p-1 m-1" type="button" onclick="window.location.href='../../../views/login.php'">Sign up</button>
                    </div>

                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.navbar -->
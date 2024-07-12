<?php
require '../vendor/autoload.php';
require 'header.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$secret_key = "6LeQIAEqAAAAAOmPO-298SpcJ4A_Drenp-SZDEbS";
$jwt = isset($_SESSION['token']) ? $_SESSION['token'] : null;
$username = '';
$email = '';
$role = '';

if ($jwt) {
    try {
        // Decode JWT token
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));

        // Access user data from decoded token
        $user_id = $decoded->data->id;
        $username = $decoded->data->username;
        $email = $decoded->data->email;
        $role = $decoded->data->role;
        $exp = $decoded->exp;
        if ($role != 2) {
            header('Location:../views/homepage.php');
            exit();
        }
        // Check if token has expired
        $current_time = time(); // Current timestamp
        if ($current_time > $exp) {
            // Token expired, unset session and redirect to login page
            session_unset();
            session_destroy();
            header('Location: ../views/login.php');
            exit();
        }
    } catch (Exception $e) {
        // Handle any exceptions
        session_unset();
        session_destroy();
        header('Location: ../views/login.php');
        exit();
    }
}
?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbar = document.getElementById('navbar');
        var role = <?php echo json_encode($role); ?>;
        if (role != 2) {
            navbar.classList.remove('main-header');
        }
    });
</script>

<body>
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="navbar">
            <!-- Left navbar links -->
            <div class="row">
                <div class="col-7">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" id="toggleMenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-5">
                    <!-- SEARCH FORM -->
                    <form class="form-inline ml-3 mt-1">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <?php if (isset($_SESSION['token'])) : ?>
                    <div>
                        <div class="rounded-circle border d-flex justify-content-center align-items-center" style="width:50px;height: 50px" alt="Avatar">
                            <img style="width:50px;height: 50px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFGxaSQnCZSQPXJpmEauA_tqVSflVxp9QNZg&s" alt="" id="dropdownToggle">
                        </div>
                        <li class="nav-item dropdown">
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="drop-avatar">
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-user mr-2"></i> <?php echo $username; ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i> <?php echo $email; ?>
                                </a>
                                <div class="dropdown-divider"></div>

                                <a href="#" class="dropdown-item" id="logoutLink" data-toggle="modal" data-target="#modal-logout">
                                    <i class="fa-solid fa-right-to-bracket mr-2"></i>Log out
                                </a>



                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                            </div>
                        </li>
                        <?php unset($_SESSION['login_success']); ?>
                    </div>
                <?php else : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-6"><button class="btn btn-primary p-1 m-1" type="button" onclick="window.location.href='../../../views/login.php'">Sign in</button></div>
                            <div class="col-6"><button class="btn btn-danger p-1 m-1" type="button" onclick="window.location.href='../../../views/register.php'">Sign up</button></div>
                        </div>
                    </div>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.navbar -->
    </div>

    <div class="modal fade" id="modal-logout" tabindex="-1" aria-labelledby="modal-logout-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <h5 class="modal-title col-10" id="modal-logout-label">Log out</h5>
                            <button type="button" class="close col-2" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="justify-content-center">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body justify-content-center">
                    <p class="text-center">Are you sure you want to log out?</p>
                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary" id="confirmLogout">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('dropdownToggle').addEventListener('click', function(event) {
            event.preventDefault();
            var dropdownMenu = document.getElementById('drop-avatar');
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('DOMContentLoaded', function() {
            var lougoutLink = document.getElementById('logoutLink');
            var modalLogout = document.getElementById("modal-logout");

            lougoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                modalLogout.classList.add('show');
            })
        })
    </script>

    <style>
        .dropdown-menu.show {
            display: block;
        }

        .nav-item.d-none.d-sm-inline-block {
            display: none;
        }

        @media (min-width: 576px) {
            .nav-item.d-none.d-sm-inline-block {
                display: inline-block;
            }
        }

        .show-menu .nav-item.d-none.d-sm-inline-block {
            display: block;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#confirmLogout").click(function() {
                $.ajax({
                    url: "../api/logout.php",
                    type: "POST",
                    success: function(response) {
                        window.location.href = "../views/login.php";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown);
                    }
                });
            });
        })

        $(document).ready(function() {
            $("#tonggleMenu").click(function() {
                e.preventDefault();
                $(this).closest('.navbar-nav').toggleClass('show-menu');
            });
        })
    </script>
</body>
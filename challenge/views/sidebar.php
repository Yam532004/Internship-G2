<?php require 'layouts/header.php';
include '../config/database.php';

// header('Cache-Control: no-cache, no-store, must-revalidate');
// header('Pragma: no-cache');
// header('Expires: 0');

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();


session_start();
require '../vendor/autoload.php';

// if (!isset($_SESSION['token'])) {
//   header('Location: login.php');
//   exit();
// } else {
  $email = $_SESSION['email'];
  $user = "SELECT *  FROM users WHERE email = :email";

  $stmt = $conn->prepare($user);

  $stmt->bindParam(':email', $email);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $role = $row['role'];
  if ($role != 2) {
    header('Location: homepage.php');
    exit();
  }
// }
?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');
    var role = <?php echo json_encode($role); ?>;
    if (role == 2) {
      navbar.classList.add('main-header');
    }
  });
</script>
<div class="container-fluild">
  <div class="row">
    <div class="col-lg">
      <div class="sidebar-mini">
        <div class="wrapper">
          <?php
          require 'layouts/navbar.php';
          ?>
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="../../index3.html" class="brand-link">
              <img src="https://m.media-amazon.com/images/I/7189UmH5qjL.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">Porscher</span>
            </a>


          </aside>
          <!-- Add manager user  -->
          <?php require 'user-management.blade.php';
          ?>
          <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
              <b>Version</b> 3.2.0
            </div>
            <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
          </footer>



          <div id="sidebar-overlay"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<!-- Validate -->

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTable  -->
<!-- <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<!-- <script defer src="datatable.js"></script> -->

<script type="text/javascript" src="../assets/javascript/register.js"></script>
<script type="text/javascript" src="../assets/javascript/edit.js"></script>

<!-- Toastr -->
<script>
  $(document).ready(function() {
    // Set toastr options
    toastr.options.timeOut = 1500; // 1.5s
    // Check if there's a success message passed from PHP
    <?php if (isset($_SESSION['create_success'])) : ?>
      toastr.success('<?php echo $_SESSION['create_success'] ?>');
      <?php unset($_SESSION['create_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['create_fail'])) : ?>
      toastr.success('<?php echo $_SESSION['create_fail'] ?>');
      <?php unset($_SESSION['create_fail']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message_is_locked'])) : ?>
      toastr.success('<?php echo $_SESSION['message_is_locked'] ?>');
      <?php unset($_SESSION['message_is_locked']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['login_success'])) : ?>
      toastr.success('<?php echo $_SESSION['login_success'] ?>');
      <?php unset($_SESSION['login_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])) : ?>
      toastr.error('<?php echo $_SESSION['error'] ?>');
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['delete_success'])) : ?>
      toastr.success('<?php echo $_SESSION['delete_success'] ?>');
      <?php unset($_SESSION['delete_success']); ?>
    <?php endif; ?>


    <?php if (isset($_SESSION['edit_success'])) : ?>
      toastr.success('<?php echo $_SESSION['edit_success'] ?>');
      <?php unset($_SESSION['edit_success']); ?>
    <?php endif; ?>
  });

  window.addEventListener('message', function(event) {
    if (event.data === 'reload') {
      // Reload the page if message is 'reload'
      window.location.reload(true); // Force reload from server
    }
  });
</script>
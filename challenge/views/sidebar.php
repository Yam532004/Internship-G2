<?php require 'layouts/header.php';
session_start();
require '../vendor/autoload.php';
if(!isset($_SESSION['token'])){
  header('Location: login.php');
  exit();
}
?>
<div class="container-fluild">
  <div class="row">
    <div class="col-lg">
      <div class="sidebar-mini">
        <div class="wrapper">
          <?php
          require 'layouts/navbar.php'
          ?>
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="../../index3.html" class="brand-link">
              <img src="https://m.media-amazon.com/images/I/7189UmH5qjL.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">Porscher</span>
            </a>

            <div class="sidebar">
              <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
                <div class="sidebar-search-results">
                  <div class="list-group"><a href="#" class="list-group-item">
                      <div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div>
                      <div class="search-path"></div>
                    </a></div>
                </div>
              </div>
            </div>
          </aside>
          <!-- Add manager user  -->
          <?php include 'user-management.blade.php';
          ?>
          <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
              <b>Version</b> 3.2.0
            </div>
            <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
          </footer>

          <aside class="control-sidebar control-sidebar-dark" style="display: none;">

            <div class="p-3 control-sidebar-content" style="">
              <h5>Customize AdminLTE</h5>
              <hr class="mb-2">
              <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Dark Mode</span></div>
              <h6>Header Options</h6>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Dropdown Legacy Offset</span></div>
              <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>No border</span></div>
              <h6>Sidebar Options</h6>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Collapsed</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div>
              <div class="mb-1"><input type="checkbox" value="1" checked="checked" class="mr-1"><span>Sidebar Mini</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Mini MD</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Mini XS</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Flat Style</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Legacy Style</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Compact</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Child Indent</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Nav Child Hide on Collapse</span></div>
              <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Disable Hover/Focus Auto-Expand</span></div>
              <h6>Footer Options</h6>
              <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Fixed</span></div>
              <h6>Small Text Options</h6>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Body</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Navbar</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Brand</span></div>
              <div class="mb-1"><input type="checkbox" value="1" class="mr-1"><span>Sidebar Nav</span></div>
              <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Footer</span></div>
              <h6>Navbar Variants</h6>
              <div class="d-flex"><select class="custom-select mb-3 text-light border-0 bg-white">
                  <option class="bg-primary">Primary</option>
                  <option class="bg-secondary">Secondary</option>
                  <option class="bg-info">Info</option>
                  <option class="bg-success">Success</option>
                  <option class="bg-danger">Danger</option>
                  <option class="bg-indigo">Indigo</option>
                  <option class="bg-purple">Purple</option>
                  <option class="bg-pink">Pink</option>
                  <option class="bg-navy">Navy</option>
                  <option class="bg-lightblue">Lightblue</option>
                  <option class="bg-teal">Teal</option>
                  <option class="bg-cyan">Cyan</option>
                  <option class="bg-dark">Dark</option>
                  <option class="bg-gray-dark">Gray dark</option>
                  <option class="bg-gray">Gray</option>
                  <option class="bg-light">Light</option>
                  <option class="bg-warning">Warning</option>
                  <option class="bg-white">White</option>
                  <option class="bg-orange">Orange</option>
                </select></div>
              <h6>Accent Color Variants</h6>
              <div class="d-flex"></div><select class="custom-select mb-3 border-0">
                <option>None Selected</option>
                <option class="bg-primary">Primary</option>
                <option class="bg-warning">Warning</option>
                <option class="bg-info">Info</option>
                <option class="bg-danger">Danger</option>
                <option class="bg-success">Success</option>
                <option class="bg-indigo">Indigo</option>
                <option class="bg-lightblue">Lightblue</option>
                <option class="bg-navy">Navy</option>
                <option class="bg-purple">Purple</option>
                <option class="bg-fuchsia">Fuchsia</option>
                <option class="bg-pink">Pink</option>
                <option class="bg-maroon">Maroon</option>
                <option class="bg-orange">Orange</option>
                <option class="bg-lime">Lime</option>
                <option class="bg-teal">Teal</option>
                <option class="bg-olive">Olive</option>
              </select>
              <h6>Dark Sidebar Variants</h6>
              <div class="d-flex"></div><select class="custom-select mb-3 text-light border-0 bg-primary">
                <option>None Selected</option>
                <option class="bg-primary">Primary</option>
                <option class="bg-warning">Warning</option>
                <option class="bg-info">Info</option>
                <option class="bg-danger">Danger</option>
                <option class="bg-success">Success</option>
                <option class="bg-indigo">Indigo</option>
                <option class="bg-lightblue">Lightblue</option>
                <option class="bg-navy">Navy</option>
                <option class="bg-purple">Purple</option>
                <option class="bg-fuchsia">Fuchsia</option>
                <option class="bg-pink">Pink</option>
                <option class="bg-maroon">Maroon</option>
                <option class="bg-orange">Orange</option>
                <option class="bg-lime">Lime</option>
                <option class="bg-teal">Teal</option>
                <option class="bg-olive">Olive</option>
              </select>
              <h6>Light Sidebar Variants</h6>
              <div class="d-flex"></div><select class="custom-select mb-3 border-0">
                <option>None Selected</option>
                <option class="bg-primary">Primary</option>
                <option class="bg-warning">Warning</option>
                <option class="bg-info">Info</option>
                <option class="bg-danger">Danger</option>
                <option class="bg-success">Success</option>
                <option class="bg-indigo">Indigo</option>
                <option class="bg-lightblue">Lightblue</option>
                <option class="bg-navy">Navy</option>
                <option class="bg-purple">Purple</option>
                <option class="bg-fuchsia">Fuchsia</option>
                <option class="bg-pink">Pink</option>
                <option class="bg-maroon">Maroon</option>
                <option class="bg-orange">Orange</option>
                <option class="bg-lime">Lime</option>
                <option class="bg-teal">Teal</option>
                <option class="bg-olive">Olive</option>
              </select>
              <h6>Brand Logo Variants</h6>
              <div class="d-flex"></div><select class="custom-select mb-3 border-0">
                <option>None Selected</option>
                <option class="bg-primary">Primary</option>
                <option class="bg-secondary">Secondary</option>
                <option class="bg-info">Info</option>
                <option class="bg-success">Success</option>
                <option class="bg-danger">Danger</option>
                <option class="bg-indigo">Indigo</option>
                <option class="bg-purple">Purple</option>
                <option class="bg-pink">Pink</option>
                <option class="bg-navy">Navy</option>
                <option class="bg-lightblue">Lightblue</option>
                <option class="bg-teal">Teal</option>
                <option class="bg-cyan">Cyan</option>
                <option class="bg-dark">Dark</option>
                <option class="bg-gray-dark">Gray dark</option>
                <option class="bg-gray">Gray</option>
                <option class="bg-light">Light</option>
                <option class="bg-warning">Warning</option>
                <option class="bg-white">White</option>
                <option class="bg-orange">Orange</option><a href="#">clear</a>
              </select>
            </div>
          </aside>

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
<?php
include_once 'layouts/header.php';
session_start()
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4">
            <div id="toast-container">
                <div class="toast">
                </div>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

<!-- Validate -->

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- <script defer src="datatable.js"></script> -->

<style>
    #toast-container>.toast {
        width: 500px;
        /* Increase the width */
        height: 100px;
        /* Increase the height */
        font-size: 18px;
        /* Increase the font size */
        text-align: center;
        /* Center the text */
        padding: 20px;
        /* Add padding */
        justify-content: center;
    }
</style>
<script>
    $(document).ready(function() {
        // Set toastr options
        toastr.options = {
            "positionClass": "toast-center",
            "timeOut": "50000",
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
        };
        <?php if (isset($_SESSION['status'])) : ?>
            toastr.success('<?php echo $_SESSION['status'] ?>');
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>
    });
</script>
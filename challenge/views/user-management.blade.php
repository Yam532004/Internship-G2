<?php include_once '../config/database.php';
include_once '../config/dbconnect.php';
// session_start();

?>
<div class="col-lg-12 col-md-12">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Managerment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2">
                                    </div>
                                    <div class="col-sm-12 col-md-8"></div>
                                    <div class="col-sm-12 col-md-2 text-right mb-2">
                                        <?php require 'create-user.php' ?>
                                    </div>
                                </div>
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="container">
                                                <table id="user_table" class="table table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
<?php require 'delete.php' ?>
<?php require 'edit.php' ?>

<script>
    var root = "http://localhost:3000/";

    function deleteModal(e, t) {
        $("#form_modal_delete").attr("action", root + t), $("#del_modal_id").val(e), $("#deleteModal").modal("show")
    }

    function editModal(e, t, r) {
        $("#form_modal_edit").attr("action", root + r),
            $("#edit_modal_id").val(e),
            $("#editModal").modal("show")
        $.ajax({
            url: root + t,
            method: 'GET',
            data: {
                id: e
            },
            dataType: 'json',
            success: function(response) {
                $('#edit_modal_id').val(response.id);
                $('#edit_username').val(response.username);
                $('#edit_phone_number').val(0 + response.phone_number);
                $('#edit_email').val(response.email);
                $('#edit_password').val('');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching user data:', error);
            }
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // const itemsPerPage = 10;

        // Initialize DataTable with server-side processing
        let table = $('#user_table').DataTable({
            paging: true,
            info: true,
            searching: true,
            pageLength: 10,
            lengthChange: true,
            lengthMenu: [10, 25, 50, 100],
            serverSide: true, // Use server-side processing
            ajax: function(data, callback, settings) {
                let page = Math.ceil(data.start / data.length) + 1; // Calculate the current page from start index
                let searchValue = data.search.value;
                updateTable(page, data.length, searchValue, callback, settings);
            }
        });

        function updateTable(page, limit, search, callback, settings) {
            $.ajax({
                url: root + 'api/get-users.php',
                method: 'GET',
                data: {
                    page: page,
                    limit: limit,
                    search: search
                },
                dataType: 'json',
                success: function(response) {
                    let users = response.data; // Adjust this based on your API response structure
                    let totalRecords = response.totalRecords; // Adjust this based on your API response structure
                    let tableData = [];
                    if (users.length > 0) {
                        users.forEach(function(user) {
                            let row = [
                                user.id,
                                user.username,
                                user.email,
                                "0" + user.phone_number,
                                user.email !== "<?php echo $email ?>" ? `
        <form method="POST" action="../api/is_locked.php" id="lockForm_${user.id}">
            <div class="form-check form-switch d-flex justify-content-center text-center">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked_${user.id}" name="is_locked" value="${user.is_locked}" ${user.is_locked == 0 ? 'checked' : ''} onchange="document.getElementById('lockForm_${user.id}').submit();">
                <input type="hidden" name="id" value="${user.id}"/>
            </div>
        </form>
    ` : '',
                                user.email !== "<?php echo $email ?>" ? `   
        <div class="text-center d-flex justify-content-center">
            <button type="button" onclick="editModal(${user.id}, 'api/get-user.php?id=${user.id}', 'api/edit-user.php')" title="Edit user" class="btn btn-sm btn-warning col-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#editModal">
                <i class="fa fa-edit"></i>
            </button>
            <button type="button" onclick="deleteModal(${user.id}, 'api/delete-user.php')" title="Delete user" class="btn btn-sm btn-danger col-2 ml-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#deleteModal">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    ` : ''
                            ];

                            tableData.push(row);
                        });
                    }

                    // Call DataTables callback with the data
                    callback({
                        draw: settings.draw,
                        recordsTotal: totalRecords,
                        recordsFiltered: totalRecords,
                        data: tableData
                    });
                },
                error: function() {
                    // Call DataTables callback with no data if there's an error
                    callback({
                        draw: settings.draw,
                        recordsTotal: 0,
                        recordsFiltered: 0,
                        data: []
                    });
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbar = document.getElementById('navbar');
        var role = <?php echo json_encode($role); ?>;

        if (role != 2) {
            navbar.classList.add('main-header');
        }
    });
</script>
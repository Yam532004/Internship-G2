<?php include_once '../config/database.php';
include_once '../config/dbconnect.php'
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
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-10"></div>
                                        <div class="col-sm-12 col-md-2 text-right mb-2">
                                            <?php require 'create-user.php' ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                                <thead>
                                                    <tr class="">
                                                        <th class="sorting fw-bold sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">ID</th>
                                                        <th class="sorting fw-bold sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">Name</th>
                                                        <th class="sorting fw-bold" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                                                        <th class="sorting fw-bold" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Phone</th>
                                                        <th class="sorting fw-bold" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status</th>
                                                        <th class="sorting fw-bold" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $databaseService = new DatabaseService();
                                                    $conn = $databaseService->getConnection();
                                                    $query = $conn->query("SELECT * FROM users");

                                                    // Loop through each user fetched from the database
                                                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<tr>";
                                                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                                        echo '<td>
    

                                                         <form id="lockForm' . $row['id'] . '">
                                                                 <div class="form-check form-switch d-flex justify-content-center text-center">
                                                                     <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked' . $row['id'] . '" name="is_locked" value="1" ' . ($row['is_locked'] ? 'checked' : '') . ' onchange="submitLockForm(' . $row['id'] . ', ' . ($row['is_locked'] ? 'true' : 'false') . ')">
                                                                     <input type="hidden" name="id" value="' . $row['id'] . '" />
                                                                 </div>
                                                             </form>
                                                        </td>';
                                                        // <form method="post" action="../api/is_locked.php" id="lockForm' . $row['id'] . '">
                                                        //         <div class="form-check form-switch d-flex justify-content-center text-center">
                                                        //            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked' . $row['id'] . '" name="is_locked" value="1" ' . ($row['is_locked'] ? 'checked' : '') . ' onchange="document.getElementById(\'lockForm' . $row['id'] . '\').submit();">
                                                        //            <input type="hidden" name="id" value="' . $row['id'] . '" />
                                                        //        </div>
                                                        //    </form>
                                                        

                                                        echo
                                                        '<td class="text-center d-flex">
    <div class="col-3"></div>

    <button type="button" onclick="editModal(' . $row['id'] . ', \'api/get-user.php?id=' . $row['id'] . '\', \'api/edit-user.php\')" title="Edit user" class="btn btn-sm btn-warning col-2 d-flex justify-content-center align-items-center"
                data-toggle="modal" data-target="#editModal">
            <i class="fa fa-pen-to-square"></i>
    </button>

    <button type="button" onclick="deleteModal(' . $row['id'] . ', \'api/delete-user.php\')" title="Are you sure you want to delete this item?" class="btn btn-sm btn-danger col-2 ml-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#deleteModal">
    <i class="fa fa-trash status_btn"></i>
    </button>
</td>';
                                                        echo "</tr>";
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </thead>
                        </table>
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
                $('#edit_phone_number').val(response.phone_number);
                $('#edit_email').val(response.email);
                $('#edit_password').val('');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching user data:', error);
            }
        });
    }

    function submitLockForm(id, isLocked) {
        $.ajax({
            url: '../api/is_locked.php',
            method: 'POST',
            data: {
                id: id,
                is_locked: isLocked ? 0 : 1 
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    console.log(response.message);
                    // Xử lý thành công, có thể cập nhật UI hoặc hiển thị thông báo
                } else {
                    console.error(response.message);
                    // Xử lý lỗi, có thể hiển thị thông báo lỗi
                }
            },
            error: function(xhr, status, error) {
                console.error('Error submitting form:', error);
            }
        });
    }
</script>
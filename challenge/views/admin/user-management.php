<?php include_once '../../config/database.php';
include_once '../../config/dbconnect.php'
?>
<div class="content-wrapper" style="min-height: 1302.12px;">
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
                                                <tr>
                                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">ID</th>
                                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Phone</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Lock-Unlock</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
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
                                                    echo "<td>
                <a href='#' class=''>Active</a>
              </td>";

                                                    // Edit user button with modal
                                                    echo '<td class="text-center d-flex">
                <div class="col-3"></div>
                <button class="btn btn-sm btn-warning col-2 edit-user-btn" data-toggle="modal" data-target="#editUserModal' . $row['id'] . '"><i class="fa fa-pen-to-square"></i></button>
                <form class="delete-form col-3" action="" method="POST">
    <button type="button" class="btn btn-sm btn-danger " data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash status_btn"></i></button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-5">
                Are you sure to delete user?<br /><br />
                <div class="d-flex"><button type="button" class="btn clear mr-3">Yes</button> <button type="button" class="btn no-clear" data-dismiss="modal">No</button></div>
            </div>
        </div>
    </div>
</form>
              </td>';


                                                    echo "</tr>";

                                                    // Edit User Modal
                                                    echo '<div class="modal fade" id="editUserModal' . $row['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content w-75">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title text-center">Edit user</h3>
                                </div>';

                                                    // Fetch user details based on the current row's ID
                                                    $userId = $row['id'];
                                                    $queryUser = $conn->prepare("SELECT * FROM users WHERE id = :id");
                                                    $queryUser->bindParam(':id', $userId);
                                                    $queryUser->execute();
                                                    $user = $queryUser->fetch(PDO::FETCH_ASSOC);

                                                    // Modal form to edit user details
                                                    echo '<form>
                <div class="card-body container">
                    <div class="form-group">
                        <p class="text-left">User name</p>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" value="' . htmlspecialchars($user['username']) . '">
                    </div>
                    <div class="form-group">
                        <p class="text-left">Phone number</p>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" value="' . htmlspecialchars($user['phone_number']) . '">
                    </div>
                    <div class="form-group">
                        <p class="text-left">Email address</p>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="' . htmlspecialchars($user['email']) . '">
                    </div>
                    <div class="form-group">
                        <p class="text-left">Password</p>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="">
                        <small class="form-text text-muted">Leave blank if you don\'t want to change the password.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="saveEdit btn btn-primary">Save changes</button>
                </div>
              </form>';

                                                    echo '</div>
            </div>
          </div>
        </div>';
                                                }
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <?php include '../pagination.php' ?>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <form method="post" action="../api/is_locked.php" id="lockForm' . $row['id'] . '">
                    <div class="form-check form-switch d-flex justify-content-center text-center">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked' . $row['id'] . '" name="is_locked" value="1" ' . ($row['is_locked'] ? 'checked' : '') . ' onchange="document.getElementById(\'lockForm' . $row['id'] . '\').submit();">
                        <input type="hidden" name="id" value="' . $row['id'] . '" />
                    </div>
                </form>
            </td>

                                                    ';

                                                        // Edit user button with modal
                                                        echo '<td class="text-center d-flex">
<div class="col-3"></div>
<button class="btn btn-sm btn-warning col-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#editUserModal' . $row['id'] . '"><i class="fa fa-pen-to-square "></i></button>

    <button type="button" class="btn btn-sm btn-danger col-2 ml-2 d-flex justify-content-center align-items-center " data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash status_btn"></i></button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span class="float-right aria-hidden="true">×</span>
                    </button>
                </div>
            <form  action="../api/delete-user.php" method="post">
                <div class="modal-body">
                    <h5>Are you sure to delete user ?</h5>
                    <input type="hidden" name="id" value="' . $row['id'] . '" />
                </div>
                <div class="modal-footer justify-content-between d-flex">
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>
              </td>';


                                                        echo "</tr>";

                                                        // Edit User Modal
                                                        echo '<div class="modal fade" id="editUserModal' . $row['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div class="modal-header">
                                 <h4 class="modal-title ">Edit</h4>   
                                 <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span class="float-right" aria-hidden="true">×</span>
                </button>                
                            </div>';
                                                        // Fetch user details based on the current row's ID
                                                        $userId = $row['id'];
                                                        $queryUser = $conn->prepare("SELECT * FROM users WHERE id = :id");
                                                        $queryUser->bindParam(':id', $userId);
                                                        $queryUser->execute();
                                                        $user = $queryUser->fetch(PDO::FETCH_ASSOC);

                                                        // Modal form to edit user details
                                                        echo
                                                        '<form action="../api/edit-user.php" id="myform" method="post">
    <div class="modal-body">
        <div class="card-body container">
            <input type="hidden" id="token" name="token">
            <input type="hidden" name="id" value="' . $row['id'] . '">
            <div class="row">
                <div class="col-6">
                <div class="form-group">
                    <p class="text-left" for="username">Full name </p>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter your name" value="' . htmlspecialchars($user['username']) . '">
                    <span class="error float-left"></span>
                </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <p class="text-left">Phone number</p>
                        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Enter phone number" value="' . htmlspecialchars($user['phone_number']) . '">
                        <span class="error text-left"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <p class="text-left">Email address</p>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="' . htmlspecialchars($user['email']) . '">
                        <span class="error text-left"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <p class="text-left">Password</p>
                        <input type="text" name="password" class="form-control" id="password" placeholder="Enter password" value="default_password">
                        <span class="error text-left"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="saveEdit btn btn-primary">Save changes</button>
        </div>
        </div>

</form>';
                                                        echo '
            </div>
          </div>
        </div>';
                                                    }
                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <!-- <?php include 'pagination.php' ?> -->
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
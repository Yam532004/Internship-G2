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

                                                // Sử dụng fetchAll để lấy tất cả các hàng dữ liệu
                                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                                                    echo "<td>
                                                        <a href='#' class=''>Active</a>
                                                    </td>";
                                                    echo "<td class='text-center d-flex'>
                                                    <div class='col-3'></div>";
                                                    // Bao gồm tệp edit-user.php
                                                    include 'edit-user.php';
                                                    echo "<div class='col-1'></div>";
                                                    // Bao gồm tệp delete-user.php
                                                    include 'delete-user.php';
                                                    echo "</td>";
                                                    echo "</tr>";
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
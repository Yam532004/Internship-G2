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
                                <div class="row">

                                    <div class="col-sm-12 col-md-2">
                                        <div id="user-filter" class="dataTables_filter">
                                            <label>Search:<input type="search" id="search-box" class="form-control form-control-sm" placeholder="" aria-controls="user_table"></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-8"></div>
                                    <div class="col-sm-12 col-md-2 text-right mb-2">
                                        <?php require 'create-user.php' ?>
                                    </div>
                                </div>
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="user_table" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example2_info">
                                                <thead>
                                                    <tr>
                                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Phone</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                               


                            </div>
                            <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info pl-4" id="user_table_info" role="status" aria-live="polite"></div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 pr-4">
                                        <div class="dataTables_paginate paging_simple_numbers float-right" id="example1_paginate">
                                            <ul class="pagination" id="pagination">
                                                <li class="paginate_button page-item previous disabled" id="previous_button">
                                                    <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                                <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                                <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                                <li class="paginate_button page-item"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="next_button">
                                                    <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                                </li>
                                            </ul>
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
        let currentPage = 1;
        const itemsPerPage = 6;
        updateTable(currentPage)

        function updateTable(page) {
            $.ajax({
                url: root + 'api/get-users.php',
                method: 'GET',
                data: {
                    page: page,
                    limit: itemsPerPage
                },
                dataType: 'json',
                success: function(response) {
                    let users = response; // Assuming your API returns data directly, adjust this based on your API response structure
                    let tableBody = document.querySelector('#user_table tbody');
                    tableBody.innerHTML = ''; // Clear existing table rows

                    if (users.length > 0) {
                        // Loop through each user data and create table rows
                        users.forEach(function(user) {
                            let row = `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.phone_number}</td>
                        <td>
                            <form method="POST" action="../api/is_locked.php" id="lockForm_${user.id}">
    <div class="form-check form-switch d-flex justify-content-center text-center">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked_${user.id}" name="is_locked" value="${user.is_locked}" ${user.is_locked == 0 ? 'checked' : ''} onchange="document.getElementById('lockForm_${user.id}').submit();">
        <input type="hidden" name="id" value="${user.id}"/>
    </div>
</form>

    </div>
</form>

                        </td>
                        <td class="text-center d-flex justify-content-center">
                            <button type="button" onclick="editModal(${user.id}, 'api/get-user.php?id=${user.id}', 'api/edit-user.php')" title="Edit user" class="btn btn-sm btn-warning col-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#editModal">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button type="button" onclick="deleteModal(${user.id}, 'api/delete-user.php')" title="Delete user" class="btn btn-sm btn-danger col-2 ml-2 d-flex justify-content-center align-items-center" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                            tableBody.innerHTML += row;
                        });

                        // Update pagination logic if needed (not shown here)
                        let startIndex = (page - 1) * itemsPerPage;
                        let endIndex = Math.min(startIndex + itemsPerPage, users.length);
                        let infoElement = document.getElementById('user_table_info');
                        infoElement.textContent = `Showing ${startIndex + 1} to ${endIndex} of ${users.length} entries`;
                    } else {
                        // No data returned from the API
                        tableBody.innerHTML = '<tr><td colspan="5">No users found.</td></tr>';
                        let infoElement = document.getElementById('user_table_info');
                        infoElement.textContent = `Showing 0 entries`;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching users:', error);
                    // Handle error scenario (e.g., show error message)
                    let tableBody = document.querySelector('#user_table tbody');
                    tableBody.innerHTML = '<tr><td colspan="5">No users found..</td></tr>';
                    let infoElement = document.getElementById('user_table_info');
                    infoElement.textContent = `No users found.`;
                }
            });


            const infor = document.getElementById('user_table_info')
            infor.textContent = `Showing ${itemsPerPage * (page - 1) + 1} to ${Math.min(itemsPerPage * page, 57)} of 57 entries`;
            updatePagination(page);
        }

        function updatePagination(currentPage) {
            const pagination = document.getElementById('pagination');
            const totalPages = 6;

            const previousButton = document.getElementById('previous_button');
            previousButton.classList.toggle('disabled', currentPage === 1)

            const nextButton = document.getElementById('next_button');
            nextButton.classList.toggle('disabled', currentPage === totalPages)

            const pageLinks = pagination.querySelectorAll('.page-item');
            pageLinks.forEach(link => {
                const pageNumber = parseInt(link.querySelector('.page-link').textContent);
                link.classList.toggle('active', pageNumber === currentPage)
            })

        }

        const previousButton = document.getElementById('previous_button')
        previousButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (!previousButton.classList.contains('disabled')) {
                currentPage--;
                updateTable(currentPage);
            }
        })

        const nextButton = document.getElementById('next_button')
        nextButton.addEventListener('click', function(event) {
            event.preventDefault();
            if (!nextButton.classList.contains('disabled')) {
                currentPage++;
                updateTable(currentPage);
            }
        })

        const pageLinks = pagination.querySelectorAll('.page-item');
        pageLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                if (!link.classList.contains('active')) {
                    currentPage = parseInt(link.querySelector('.page-link').textContent);
                    updateTable(currentPage);
                }
            })
        })

    })
</script>
<!-- Use iQuery to define your table  -->
<script>
   $(document).ready(function(){
    $('#search-box').on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $('#user_table tbody tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        })
    })
   }
)
</script>
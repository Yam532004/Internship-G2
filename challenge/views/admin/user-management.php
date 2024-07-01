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
                        <div class="card-header">
                            <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
                        </div>

                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="">Phone</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">Lock-Unlock</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">Webkit</td>
                                                    <td style="">Safari 1.2</td>
                                                    <td style="">OSX.3</td>
                                                    <td>
                                                        <a href="#" class="">Active</a>
                                                    </td>
                                                    <td class="text-center d-flex">

                                                        <!-- Button trigger modal -->
                                                        <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary" data-mdb-modal-init data-mdb-target="#staticBackdrop3">
                                                            <i class="edit-user fa fa-pen-to-square mr-3">
                                                            </i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop3">
                                                            <i class="fa fa-trash status_btn"></i>
                                                        </button>
                                                        <div class="modal fade" id="staticBackdrop3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                                            <div class="modal-dialog d-flex justify-content-center">
                                                                <div class="modal-content w-75">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel3">Edit User</h5>
                                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form>
                                                                            <div class="form-outline mb-4">
                                                                                <input type="text" id="name3" class="form-control" />
                                                                                <label class="form-label" for="name3">Name</label>
                                                                            </div>
                                                                            <div class="form-outline mb-4">
                                                                                <input type="email" id="email3" class="form-control" />
                                                                                <label class="form-label" for="email3">Email address</label>
                                                                            </div>
                                                                            <div class="form-check d-flex justify-content-center mb-4">
                                                                                <input class="form-check-input me-2" type="checkbox" value="" id="checkbox3" checked />
                                                                                <label class="form-check-label" for="checkbox3">
                                                                                    I have read and agree to the terms
                                                                                </label>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                                <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
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
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 0,
            "extendedTimeOut": 0,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        };
        toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": 0,
                "extendedTimeOut": 0,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": false
            },

            document.querySelector('.status_btn').addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

                toastr["error"](
                    'Are you sure to delete user?<br /><br /><div class = "d-flex"><button type="button" class="btn clear mr-3">Yes</button> <button type="button" class="btn no-clear">No</button></div>',
                    'Error', {
                        closeButton: true,
                        allowHtml: true,
                        onShown: function() {
                            document.querySelector('.btn.clear').addEventListener('click', function() {
                                toastr.clear();
                            });
                        }
                    }
                );
            });

        document.querySelector('.edit-user').addEventListener('click', function(event) {
            event.preventDefault();
            toastr['info'](
                'Edit user <br /><br />' +
                '<!-- Modal -->' +
                '<div class="modal fade" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">' +
                '<div class="modal-dialog d-flex justify-content-center">' +
                '<div class="modal-content w-75">' +
                '<div class="modal-header">' +
                '<h5 class="modal-title" id="exampleModalLabel1">Sign in</h5>' +
                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                '</div>' +
                '<div class="modal-body p-4">' +
                '<form>' +
                '<!-- Email input -->' +
                '<div class="form-outline mb-4">' +
                '<input type="email" id="email1" class="form-control" />' +
                '<label class="form-label" for="email1">Email address</label>' +
                '</div>' +
                '<!-- Password input -->' +
                '<div class="form-outline mb-4">' +
                '<input type="password" id="password1" class="form-control" />' +
                '<label class="form-label" for="password1">Password</label>' +
                '</div>' +
                '<!-- Submit button -->' +
                '<button type="submit" class="btn btn-primary btn-block">Login</button>' +
                '</form>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<!-- Modal -->',
                'Info', {
                    closeButton: true,
                    allowHtml: true,
                    onShown: function() {
                        document.querySelector('.edit-user').addEventListener('click', function() {
                            toastr.clear();
                        });
                    }
                }
            );
        });


    });
</script>
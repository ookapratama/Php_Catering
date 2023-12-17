<?php
session_start();
if (isset($_SESSION['l'])) if ($_SESSION['l'] != 1) header('Location: index.php');
$title = "User | Catering";
require_once("./templates/header.php");
require_once("./conn.php");

$data = get_data("SELECT * FROM `users` WHERE `role`='2'");
?>
<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Users</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
            <div class="mt-2 mt-md-0">
                <div class="dropdown ml-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#baruModal">
                        Baru
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="user-list" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <!-- Modal Baru -->
    <div class="modal fade" id="baruModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="baruModalTitle">User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNew" action="" method="POST" class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustomUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input name="username" type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Password</label>
                                <input name="password" type="password" class="form-control" id="validationCustom03" placeholder="Paasword" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Role</label>
                                <select class="select2-example form-control" id="validationCustom04" required>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="submit" value="Buat" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./ Modal Baru -->

    <!-- Modal Update -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalTitle">User Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdate" action="" method="POST" class="needs-validation" novalidate>
                        <div class="form-row">
                            <input type="hidden" name="id" id="formId">
                            <div class="col-md-12 mb-3">
                                <label for="usernameUpdate">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input name="username" type="text" class="form-control" id="usernameUpdate" placeholder="Username" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Password</label>
                                <input name="password" type="password" class="form-control" id="validationCustom03" placeholder="Password" required>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Role</label>
                                <select class="select2-example form-control" id="validationCustom04" required>
                                    <option value="2">User</option>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                    <button type="submit" value="Buat" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ./ Modal Update -->

    <?php require_once("./templates/footer.php") ?>

    <script type="text/javascript">
        $(document).ready(function() {
            var ids;
            $('#user-list').DataTable({
                "lengthChange": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "users_get.php",
                    type: "POST",
                    data: {
                        action: 'formNew'
                    },
                    dataType: "json"
                },
                'columns': [{
                        data: 'id'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: 'button'
                    },
                ]
            });
            $('.select2-example').select2({
                placeholder: 'User'
            });
            $('#formNew').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'users_new.php',
                    data: $(this).serialize(),
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "User Berhasil Ditambahkan!", "success");
                        $('#user-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Username Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "User Gagal Ditambahkan", "error");
                    }
                });
            });

            $('body').on('click', '.updateData', function() {
                var id = $(this).data("id");
                ids = id;
                $.ajax({
                    url: "users_get.php",
                    type: "POST",
                    data: {
                        action: 'byOne',
                        id: ids
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#usernameUpdate').val(data.username);
                    },
                    error: function() {
                        swal("Sorry!", "User Gagal ditampilkan", "error");
                    }
                });

            })

            $('#formUpdate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'users_update.php',
                    data: $(this).serialize() + '&id=' + ids,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "User Berhasil Diubah!", "success");
                        $('#user-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Username Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "User Gagal Ditambahkan", "error");
                    }
                });
            });
            $('body').on('click', '.deleteData', function() {
                var id = $(this).data("id");
                swal({
                    title: "Are you sure to Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then(function(result) {
                    if (result) {
                        $.ajax({
                            type: "POST",
                            url: "delete.php",
                            data: {
                                id: id,
                                del: "users"
                            },
                            success: function(data) {
                                $('#user-list').DataTable().ajax.reload();
                                swal("Good job!", "User Berhasil dihapus!", "success");
                            },
                            error: function(data) {
                                swal("Sorry!", "User Gagal dihapus", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
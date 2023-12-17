<?php
session_start();
if (isset($_SESSION['l'])) if ($_SESSION['l'] != 1) header('Location: index.php');
$title = "Book Admin | Perpustakaan";
require_once("./templates/header.php");
require_once("./conn.php");

$data = get_data("SELECT * FROM `users` WHERE `role`='1'");
?>
<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Books</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Books</li>
                    </ol>
                </nav>
            </div>
            <div class="mt-2 mt-md-0">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#baruModal">
                    Baru
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="book-list" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Description</th>
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
                    <h5 class="modal-title" id="baruModalTitle">Buku Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNew" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustomTitle">Title</label>
                                <div class="input-group">
                                    <input name="title" type="text" class="form-control" id="validationCustomUTitle" placeholder="Title" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Title.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Category</label>
                                <select name="category" class="select2-example form-control" id="validationCustom04" required>
                                    <option value="1">Fantasy</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Description</label>
                                <textarea name="description" class="form-control" id="validationCustom03" placeholder="Description" required rows="3"></textarea>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Image</label>
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose Image</label>
                                </div>
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
                    <h5 class="modal-title" id="baruModalTitle">Buku Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdate" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <input name="id" type="hidden" class="form-control" id="idUpdate" placeholder="Title" aria-describedby="inputGroupPrepend" required>

                            <div class="col-md-12 mb-3">
                                <label for="titleUpdate">Title</label>
                                <div class="input-group">
                                    <input name="title" type="text" class="form-control" id="titleUpdate" placeholder="Title" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Title.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="categoryUpdate">Category</label>
                                <select name="category" class="select2-example form-control" id="categoryUpdate" required>
                                    <option value="1">Fantasy</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="descriptionUpdate">Description</label>
                                <textarea name="description" class="form-control" id="descriptionUpdate" placeholder="Description" required rows="3"></textarea>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Image</label>
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="customFileUpdate">
                                    <label class="custom-file-label" for="customFileUpdate">Choose Image</label>
                                </div>
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
            $('#book-list').DataTable({
                "lengthChange": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "a-book_get.php",
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
                        data: 'title'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'description'
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
                    url: 'a-book_new.php',
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Book Berhasil Ditambahkan!", "success");
                        $('#book-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Buku Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "Book Gagal Ditambahkan", "error");
                    }
                });
            });

            $('body').on('click', '.updateData', function() {
                var id = $(this).data("id");
                ids = id;
                $.ajax({
                    url: "a-book_get.php",
                    type: "POST",
                    data: {
                        action: 'byOne',
                        id: ids
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#idUpdate').val(data.id);
                        $('#titleUpdate').val(data.title);
                        $('#descriptionUpdate').val(data.description);
                        $('#categoryUpdate').val(data.category_id);
                    },
                    error: function() {
                        swal("Sorry!", "Book Gagal ditampilkan", "error");
                    }
                });

            })
            $('#formUpdate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'a-book_update.php',
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Book Berhasil Diubah!", "success");
                        $('#book-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Buku Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "Book Gagal diubah", "error");
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
                                del: 'books'
                            },
                            success: function(data) {
                                $('#book-list').DataTable().ajax.reload();
                                swal("Good job!", "Book Berhasil dihapus!", "success");
                            },
                            error: function(data) {
                                swal("Sorry!", "Book Gagal dihapus", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
<?php
session_start();
if (isset($_SESSION['l'])) if ($_SESSION['l'] != 1) header('Location: index.php');
$title = "Chapter | Perpustakaan";
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
                <h3>Chapters</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chapters</li>
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
                                        <th>Title Books</th>
                                        <th>Page</th>
                                        <th>Content</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>title</th>
                                        <th>page</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot> -->
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
                    <h5 class="modal-title" id="baruModalTitle">Chapter Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNew" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="bookCreate">Book</label>
                                <select name="book" class="select2-example form-control" id="bookCreate" required>
                                    <?php $data = get_data("SELECT id,title FROM books");
                                    foreach ($data as $v) : ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Chapter</label>
                                <select name="page" class="select2-example form-control" id="validationCustom04" required>
                                    <option value="baru">Terbaru</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Content</label>
                                <textarea name="content" class="form-control" id="validationCustom03" placeholder="Content" required rows="3"></textarea>
                                <div class="invalid-feedback">
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
                    <h5 class="modal-title" id="baruModalTitle">Chapter Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdate" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <input name="id" type="hidden" class="form-control" id="idUpdate" placeholder="Title" aria-describedby="inputGroupPrepend" required>
                            <div class="col-md-12 mb-3">
                                <label for="bookUpdate">Book</label>
                                <select name="book" class="select2-example form-control" id="bookUpdate" required>
                                    <?php $data = get_data("SELECT id,title FROM books");
                                    foreach ($data as $v) : ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="chapterUpdate">Chapter</label>
                                <select name="page" class="select2-example form-control" id="chapterUpdate" required>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="contentUpdate">Content</label>
                                <textarea name="content" class="form-control" id="contentUpdate" placeholder="Content" required rows="3"></textarea>
                                <div class="invalid-feedback">
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
        new FroalaEditor("#validationCustom03");
        new FroalaEditor("#contentUpdate");
        $(document).ready(function() {
            var ids;
            var sear;
            var book;
            $('#book-list').DataTable({
                "lengthChange": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "chapter_get.php",
                    type: "POST",
                    data: {
                        action: 'formNew',
                        sear: sear
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
                        data: 'page'
                    },
                    {
                        data: 'content'
                    },
                    {
                        data: 'button'
                    },

                ],
                initComplete: function() {
                    this.api().columns([1, 2]).every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                console.log(sear);
                                var value = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                sear = value;

                                $('#book-list').DataTable().ajax.reload();
                            });
                        console.log(sear);
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });
            $('.select2-example').select2({
                placeholder: 'User'
            });
            $('#formNew').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'chapter_new.php',
                    data: $(this).serialize(),
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Chapter Berhasil Ditambahkan!", "success");
                        $('#book-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Chapter Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "Chapter Gagal Ditambahkan", "error");
                    }
                });
            });

            $('body').on('click', '.updateData', function() {
                var id = $(this).data("id");
                ids = id;
                $.ajax({
                    url: "chapter_get.php",
                    type: "POST",
                    data: {
                        action: 'byOne',
                        id: ids
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#idUpdate').val(data.id);
                        $('#bookUpdate').val(data.book_id).change();
                        $('#chapterUpdate').val(data.page).change();
                        $('#contentUpdate').val(data.content).change();
                    },
                    error: function() {
                        swal("Sorry!", "Chapter Gagal ditampilkan", "error");
                    }
                });
            })

            $('#bookUpdate').on('change', (event) => {
                book = event.target.value;
                $.ajax({
                    url: "chapter_get_page.php",
                    type: "POST",
                    data: {
                        id: book
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $("#chapterUpdate").html('');
                        $.each(data, function() {
                            $("#chapterUpdate").append('<option value="' + this.id + '">' + this.page + '</option>')
                        })
                    },
                    error: function(data) {
                        swal("Sorry!", "Page Gagal ditampilkan", "error");
                    }
                });
            });

            $('#formUpdate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "chapter_update.php",
                    type: "POST",
                    data: $(this).serialize(),
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Chapter Berhasil Diubah!", "success");
                        $('#book-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Chapter Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "Chapter Gagal Diubah", "error");
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
                                del: 'content'
                            },
                            success: function(data) {
                                $('#book-list').DataTable().ajax.reload();
                                swal("Good job!", "Chapter Berhasil Dihapus!", "success");
                            },
                            error: function(data) {
                                swal("Sorry!", "Chapter Gagal Dihapus", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
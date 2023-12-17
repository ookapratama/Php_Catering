<?php
session_start();
if (isset($_SESSION['l'])) if ($_SESSION['l'] != 1) header('Location: index.php');
$title = "Paket | Catering";
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
                <h3>Paket</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Paket</li>
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
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Menu</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
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
                    <h5 class="modal-title" id="baruModalTitle">Paket Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNew" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustomTitle">Nama</label>
                                <div class="input-group">
                                    <input name="nama" type="text" class="form-control" id="validationCustomUTitle" placeholder="nama" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a name.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Harga</label>
                                <input name="harga" type="text" class="form-control" id="validationCustomUTitle" placeholder="harga" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a harga.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Menu</label>
                                <input name="menu" type="text" class="form-control" id="validationCustomUTitle" placeholder="menu" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a menu.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Gambar</label>
                                <div class="custom-file">
                                    <input name="gambar" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="selesai" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Selesai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="belum" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Belum
                            </label>
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
                    <h5 class="modal-title" id="baruModalTitle">Paket Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdate" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <input name="id" type="hidden" class="form-control" id="idUpdate" placeholder="Title" aria-describedby="inputGroupPrepend" required>

                            <div class="col-md-12 mb-3">
                                <label for="namaUpdate">Nama</label>
                                <div class="input-group">
                                    <input name="nama" type="text" class="form-control" id="namaUpdate" placeholder="nama" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a nama.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="categoryUpdate">Harga</label>
                                <div class="input-group">
                                    <input name="harga" type="text" class="form-control" id="hargaUpdate" placeholder="harga" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a harga.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="descriptionUpdate">Menu</label>
                                <div class="input-group">
                                    <input name="menu" type="text" class="form-control" id="menuUpdate" placeholder="menu" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a menu.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04">Gambar</label>
                                <div class="custom-file">
                                    <input name="gambar" type="file" class="custom-file-input" id="customFileUpdate">
                                    <label class="custom-file-label" for="customFileUpdate">Pilih gambar</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="selesai" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Selesai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="belum" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Belum
                            </label>
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
                    url: "paket_get.php",
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
                        data: 'nama'
                    },
                    {
                        data: 'harga'
                    },
                    {
                        data: 'menu'
                    },
                    {
                        data: 'gambar'
                    },
                    {
                        data: 'status'
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
                    url: 'paket_new.php',
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Paket Berhasil Ditambahkan!", "success");
                        $('#book-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Paket Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "Paket Gagal Ditambahkan", "error");
                    }
                });
            });

            $('body').on('click', '.updateData', function() {
                var id = $(this).data("id");
                ids = id;
                $.ajax({
                    url: "paket_get.php",
                    type: "POST",
                    data: {
                        action: 'byOne',
                        id: ids
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#idUpdate').val(data.id);
                        $('#namaUpdate').val(data.nama);
                        $('#hargaUpdate').val(data.harga);
                        $('#menuUpdate').val(data.menu);
                        $('#gambarUpdate').val(data.gambar);

                    },
                    error: function() {
                        swal("Sorry!", "Paket Gagal ditampilkan", "error");
                    }
                });

            })
            $('#formUpdate').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'paket_update.php',
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Paket Berhasil Diubah!", "success");
                        $('#book-list').DataTable().ajax.reload();
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Paket Sudah Ada!", "warning");
                    } else {
                        swal("Sorry!", "Paket Gagal diubah", "error");
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
                                del: 'paket'
                            },
                            success: function(data) {
                                $('#book-list').DataTable().ajax.reload();
                                swal("Good job!", "paket Berhasil dihapus!", "success");
                            },
                            error: function(data) {
                                swal("Sorry!", "paket Gagal dihapus", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
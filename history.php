<?php
session_start();
if (!isset($_SESSION['l']))  header('Location: index.php');
$title = "History | Catering";
require_once("./templates/header.php");
require_once("./conn.php");

$user = get_data("SELECT * FROM `users` WHERE `role`='2'");
$paket = get_data("SELECT * FROM `paket`");
?>
<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>History</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">History</li>
                    </ol>
                </nav>
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
                                        <th>Paket</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status Proses</th>
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
                    url: "history_get.php",
                    type: "POST",
                    data: {
                        action: 'formNew',

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
                        data: 'tgl_pesanan'
                    },
                    {
                        data: 'tgl_kirim'
                    },
                    {
                        data: 'jml'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: 'sts_proses'
                    },
                    {
                        data: 'button'
                    },
                ]
            });
            $('.select2-example').select2({
                placeholder: 'User'
            });
            $('input[name="tglPesanan"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropDowns:true
            })
            $('input[name="tglKirim"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropDowns:true
            })
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
                                del: 'pesanan'
                            },
                            success: function(data) {
                                swal("Good job!", "Pesanan Berhasil dihapus!", "success");
                                $('#book-list').DataTable().ajax.reload();
                            },
                            error: function(data) {
                                swal("Sorry!", "Pesanan Gagal dihapus", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
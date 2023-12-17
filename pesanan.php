<?php
session_start();
if (isset($_SESSION['l'])) if ($_SESSION['l'] != 1) header('Location: index.php');
$title = "Pesanan | Catering";
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
                <h3>Pesanan</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
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
                                        <th>Pelanggan</th>
                                        <th>Paket</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Bukti</th>
                                        <th>Status Pembayaran</th>
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

    <!-- Modal Baru -->
    <div class="modal fade" id="baruModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="baruModalTitle">Pesanan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formNew" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                            <label for="pelangganCreate">Pelanggan</label>
                                <select name="pelanggan" class="select2-example form-control" id="pelangganCreate" required>
                                    <?php foreach ($user as $v) : ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['username'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                            <label for="paketCreate">Paket</label>
                                <select name="paket" class="select2-example form-control" id="paketCreate" required>
                                    <?php foreach ($paket as $v) : ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="tglPesanan">Tanggal Pesanan</label>
                                <input name="tglPesanan" type="text" class="form-control" id="tglPesanan" placeholder="Tanggal Pesanan" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Tanggal Pesanan.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="tglKirim">Tanggal Kirim</label>
                                <input name="tglKirim" type="text" class="form-control" id="tglKirim" placeholder="Tanggal Kirim" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Tanggal Kirim.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="jumlahCreate">Jumlah</label>
                                <input name="jumlah" type="text" class="form-control" id="jumlahCreate" placeholder="jumlah" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Jumlah.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="totalCreate">Total</label>
                                <input name="total" type="text" class="form-control" id="totalCreate" placeholder="total" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Total.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="buktiCreate">Bukti</label>
                                <input name="bukti" type="text" class="form-control" id="buktiCreate" placeholder="bukti" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Bukti.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="pembayaranCrate">Status Pembayaran</label>
                                <select name="pembayaran" class="select2-example form-control" id="pembayaranCrate" required>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Failed">Failed</option>
                                        <option value="Pending" selected>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="prosesCreate">Status Proses</label>
                                <select name="proses" class="select2-example form-control" id="prosesCreate" required>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Failed">Failed</option>
                                        <option value="Pending" selected>Pending</option>
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
                    <h5 class="modal-title" id="baruModalTitle">Paket Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formUpdate" action="" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <input name="id_booking" type="hidden" class="form-control" id="idUpdate" placeholder="Title" aria-describedby="inputGroupPrepend" required>
                            <div class="col-md-12 mb-3">
                            <label for="pelangganUpdate">Pelanggan</label>
                                <select name="pelanggan" class="select2-example form-control" id="pelangganUpdate" required>
                                    <?php foreach ($user as $v) : ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['username'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                            <label for="paketUpdate">Paket</label>
                                <select name="paket" class="select2-example form-control" id="paketUpdate" required>
                                    <?php foreach ($paket as $v) : ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="tglPesanan">Tanggal Pesanan</label>
                                <input name="tglPesanan" type="text" class="form-control" id="tglPesanan" placeholder="Tanggal Pesanan" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Tanggal Pesanan.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="tglKirim">Tanggal Kirim</label>
                                <input name="tglKirim" type="text" class="form-control" id="tglKirim" placeholder="Tanggal Kirim" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Tanggal Kirim.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="jumlahUpdate">Jumlah</label>
                                <input name="jumlah" type="text" class="form-control" id="jumlahUpdate" placeholder="jumlah" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Jumlah.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="totalUpdate">Total</label>
                                <input name="total" type="text" class="form-control" id="totalUpdate" placeholder="total" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Total.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="buktiUpdate">Bukti</label>
                                <input name="bukti" type="text" class="form-control" id="buktiUpdate" placeholder="bukti" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Bukti.
                                    </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="pembayaranUpdate">Status Pembayaran</label>
                                <select name="pembayaran" class="select2-example form-control" id="pembayaranUpdate" required>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Failed">Failed</option>
                                        <option value="Pending" selected>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="prosesUpdate">Status Proses</label>
                                <select name="proses" class="select2-example form-control" id="prosesUpdate" required>
                                        <option value="Selesai">Selesai</option>
                                        <option value="Failed">Failed</option>
                                        <option value="Pending" selected>Pending</option>
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
            $('#book-list').DataTable({
                "lengthChange": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "pesanan_get.php",
                    type: "POST",
                    data: {
                        action: 'formNew'
                    },
                    dataType: "json"
                },
                "columns": [{
                        data: 'id'
                    },
                    {
                        data: 'username'
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
                        data: 'jumlah'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'bukti'
                    },
                    {
                        data: 'status_pembayaran'
                    },
                    {
                        data: 'status_proses'
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
            $('#formNew').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'pesanan_new.php',
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
                    url: "pesanan_get.php",
                    type: "POST",
                    data: {
                        action: 'byOne',
                        id: ids
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#idUpdate').val(data.id_booking);
                        $('#pelangganUpdate').val(data.id_users).trigger('change');
                        $('#paketUpdate').val(data.id_paket).trigger('change');
                        $('#jumlahUpdate').val(data.jumlah);
                        $('#totalUpdate').val(data.total);
                        $('#buktiUpdate').val(data.bukti);
                        $('#pembayaranUpdate').val(data.status_pembayaran).trigger('change');
                        $('#prosesUpdate').val(data.status_proses).trigger('change');
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
                    url: 'pesanan_update.php',
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
                                del: 'pesanan'
                            },
                            success: function(data) {
                                $('#book-list').DataTable().ajax.reload();
                                console.log('delete data')
                                swal("Good job!", "Pesanan Berhasil dihapus!", "success");
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
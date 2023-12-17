<?php session_start();
$title = " Menu | Catering";
require_once("./templates/header.php");
require_once("./conn.php");
$data = query("SELECT * FROM `paket` WHERE id='" . $_GET['v'] . "'");
?>
<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3></h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Confirm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $data['nama']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card col-md-4 mx-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">Konfirmasi Pembayaran</p>
                                </div>
                                <form id="formNew" action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <input name="user" type="hidden" class="form-control" value="<?= $_SESSION['i'] ?>" required>
                                    <input name="paket" type="hidden" class="form-control" value="<?= $_GET['v'] ?>" required>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="buktiCreate">Bukti Pembayaran</label>
                                            <input name="pembayaran" type="file" class="form-control" id="buktiCreate" placeholder="jumlah" aria-describedby="inputGroupPrepend" required>
                                            <div class="invalid-feedback">
                                                Masukan Bukti Pembayaran
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer mx-auto">
                                <button type="submit" value="Buat" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once("./templates/footer.php") ?>

    <script type="text/javascript">
        $('#formNew').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'confirm_new.php',
                enctype: 'multipart/form-data',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            })
            .then(function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData)
                console.log(response)
                if (jsonData.success == "1") {
                    swal("Good job!", "Menu Akan Di Kirimkan!", "success")
                    .then(() => {
                        window.location.replace('index.php');
                    })
                } else if (jsonData.success == "2") {
                    swal("Sorry!", "Menu Gagal!", "warning");
                } else {
                    swal("Sorry!", "Menu Gagal Ditambahkan", "error");
                }
            });
        });
    </script>
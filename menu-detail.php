<?php session_start();
$title = " Menu | Catering";
if (!isset($_SESSION['l']))  header('Location: index.php');
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
                            <a href="#">Menu</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $data['nama']; ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="slider-for">
                                    <div class="slick-slide-item" style="text-align: -webkit-center">
                                        <img src="image/<?= $data['gambar']; ?>" class="img-fluid rounded" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">New Collection</p>
                                    <span class="d-flex align-items-center">
                                        <i class="fa fa-heart text-danger mr-2"></i> 259
                                    </span>
                                </div>
                                <h2><?= $data['nama']; ?></h2>
                                <p>
                                    <span class="badge bg-success-bright text-success">In stock</span>
                                </p>
                                <h4>Menu : <?= $data['menu']; ?></h4>
                                <h4>Harga : <?= $data['harga']; ?></h4>
                                <div class="mt-2 mt-md-0">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#baruModal">
                                        Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <form id="formNew" action="" method="POST" class="needs-validation" novalidate>
                            <input name="user" type="hidden" class="form-control" value="<?= isset($_SESSION['i']) ? $_SESSION['i'] : '' ?>" required>
                            <input name="paket" type="hidden" class="form-control" value="<?= $_GET['v'] ?>" required>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="jumlahCreate">Jumlah</label>
                                    <input required name="jumlah" type="text" class="form-control" id="jumlahCreate" placeholder="jumlah" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a Jumlah.
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
    </div>
    <!-- ./ Content -->

    <?php require_once("./templates/footer.php") ?>

    <script type="text/javascript">
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const v = urlParams.get('v')
        $('#formNew').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'menu-detail_new.php',
                data: $(this).serialize(),
                success: (data) => {
                    console.log(data)
                    swal("Good job!", "Menu Berhasil Dipesan!", "success")
                        .then(() => {
                            window.location.replace('cart.php');
                        })
                },
                error: (xhr, status, error) => {
                    console.log('error:', error);
                    swal("Sorry!", "Menu Gagal Ditambahkan", "error");
                }
            });
            // .then(function(response) {
            //     var jsonData = response;
            //     console.log(jsonData);
            //     // console.log(v);

            //     if (jsonData !== null) {
            //         swal("Good job!", "Menu Berhasil Dipesan!", "success");
            //         // window.location.replace('cart.php');
            //     } 
            //     // else if (jsonData.success == "2") {
            //     //     swal("Sorry!", "Menu Gagal!", "warning");
            //     // } 
            //     else {
            //     }
            // });
        });
    </script>
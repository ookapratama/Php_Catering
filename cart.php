<?php session_start();
if (!isset($_SESSION['l'])) header('Location: login.php');
$title = "Menu | Cart";
require_once("./templates/header.php");
require_once("./conn.php");
$data = get_data("SELECT `paket`.*,`keranjang`.`jumlah` FROM `keranjang` LEFT JOIN `paket` ON `keranjang`.`paket_id` = `paket`.`id` WHERE `keranjang`.`user_id` = '" . $_SESSION['i'] . "'");
?>

<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Cart</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Cart</a>
                        </li>
                        <!-- <li class="breadcrumb-item active" aria-current="page">Paket</li> -->
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-danger" id="checkout">Checkout</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                            <?php foreach ($data as $v) : ?>
                                <div class="col-md-3 col-xs-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- <input type="text" name="id" value="<?= $v['id'] ?>">
                                            <input type="text" name="jumlah" value="<?= $v['jumlah'] ?>"> -->
                                            <!-- <div class="d-flex justify-content-between">
                                                <div>
                                                    <i class="fa fa-heart text-danger mr-2"></i>
                                                    213
                                                </div>
                                                <span class="badge bg-warning-bright text-warning">%30 Off</span>
                                            </div> -->
                                            <div class="my-3 text-center">
                                                <a href="menu-detail.php?v=<?= $v['id'] ?>" title="<?= $v['nama'] ?>"> <img src="image/<?= $v['gambar'] ?>" style="max-height: 100px;" class="img-thumbnail rounded" alt="Vase">
                                                </a>
                                            </div>
                                            <div class="text-center">
                                                <a href="menu-detail.php?v=<?= $v['id'] ?>">
                                                    <h3><?= $v['menu'] ?> </h4>
                                                        <ht><?= $v['nama'] ?> </h4>
                                                </a>
                                                <h4><?= $v['jumlah'] ?></h4>
                                                <div class="mt-2 row align-center" style="place-content: center;">
                                                    <form action="" method="post" id="kurang_<?= $v['id'] ?>" novalidate>
                                                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                                        <input type="hidden" name="jumlah" value="<?= $v['jumlah'] ?>">
                                                        <button class="btn btn-danger mr-3" type="submit">-</button>
                                                    </form>
                                                    <form action="" method="post" id="tambah_<?= $v['id'] ?>" novalidate>
                                                        <input type="hidden" name="id" value="<?= $v['id'] ?>">
                                                        <input type="hidden" name="jumlah" value="<?= $v['jumlah'] ?>">
                                                        <button class="btn btn-success" type="submit">+</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <!-- <nav aria-label="..." class="mb-4">
                            <ul class="pagination pagination-rounded justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav> -->

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <?php
    require_once("./templates/footer.php") ?>

    <script type="text/javascript">
        $('form[id^="tambah_"]').submit(function(e) {
            e.preventDefault();
            console.log($(this))
            $.ajax({
                type: "POST",
                url: 'cart-add.php',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                // success: (data) => {
                //     console.log(data)
                //     swal("Good job!", "Menu Ditambah!", "success")
                //         .then(() => {
                //             window.location.replace('cart.php');
                //         })
                // },
                // error: (xhr, status, error) => {
                //     console.log('error:', error);
                //     swal("Sorry!", "Menu Gagal Dikurangi", "error");
                // }
            })
            .then(function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData)
                if (jsonData.success == "1") {
                    swal("Good job!", "Menu Ditambahkan!", "success");
                    window.location.replace('cart.php');
                } else if (jsonData.success == "2") {
                    swal("Sorry!", "Menu Gagal!", "warning");
                } else {
                    swal("Sorry!", "Menu Gagal Ditambahkan", "error");
                }
            });
        });
        $('form[id^="kurang_"]').submit(function(e) {
            e.preventDefault();
            console.log(new FormData(this));
            $.ajax({
                type: "POST",
                url: 'cart-kurang.php',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                // success: () => {
                //     swal("Good job!", "Menu Dikurangi!", "success")
                //         .then(() => {
                //             window.location.replace('cart.php');
                //         })
                // },
                // error: (xhr, status, error) => {
                //     console.log('error:', error);
                //     swal("Sorry!", "Menu Gagal Dikurangi", "error");
                // }
            })
            .then(function(response) {
                var jsonData = JSON.parse(response);
                console.log(jsonData)
                if (jsonData.success == "1") {
                    swal("Good job!", "Menu Dikurangi!", "success");
                    window.location.replace('cart.php');
                } else if (jsonData.success == "2") {
                    swal("Sorry!", "Menu Gagal!", "warning");
                } else {
                    swal("Sorry!", "Menu Gagal Dikurangi", "error");
                }
            });
        });
        $('#checkout').click(function(e) {
            bootbox.confirm("Apakah Benar Ingin Checkout?", function(result) {
                if (result) {
                    window.location.replace('checkout.php');
                }
            });
        });
    </script>
<?php session_start();
if (!isset($_SESSION['l']))header('Location: login.php');
$title = "Menu | Rating";
require_once("./templates/header.php");
require_once("./conn.php");
$data = get_data("SELECT `paket`.*,`keranjang`.`jumlah` FROM `keranjang` LEFT JOIN `paket` ON `keranjang`.`paket_id` = `paket`.`id` WHERE `keranjang`.`user_id` = '".$_SESSION['i']."'");
$metode = metode();
?>

<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Rating</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Rating</a>
                        </li>
                        <!-- <li class="breadcrumb-item active" aria-current="page">Paket</li> -->
                    </ol>
                </nav>
            </div>
           
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                            <?php usort($metode, function($a, $b) {
                                return $b['rank'] <=> $a['rank'];
                            }); foreach ($metode as $no => $v) : ?>
                            <?php $datas = query("SELECT * FROM `paket` WHERE nama='".$v['name']."' ") ?>
                                <div class="col-md-3 col-xs-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="my-3 text-center">
                                                <a href="menu-detail.php?v=<?= $datas['id'] ?>" title="<?= $datas['nama'] ?>"> <img src="image/<?= $datas['gambar'] ?>" style="max-height: 100px;" class="img-thumbnail rounded" alt="Vase">
                                                </a>
                                            </div>
                                            <div class="text-center">
                                                <a href="menu-detail.php?v=<?= $datas['id'] ?>">
                                                <h3><?= $datas['menu'] ?> </h4>
                                                    <ht><?= $datas['nama'] ?> </h4>
                                                </a>
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
            $('#tambah').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'cart-add.php',
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Menu Ditambahkan!", "success");
                        window.location.replace('/Catering/cart.php');
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Menu Gagal!", "warning");
                    } else {
                        swal("Sorry!", "Menu Gagal Ditambahkan", "error");
                    }
                });
            });
            $('#kurang').submit(function(e) {
                e.pre2zventDefault();
                $.ajax({
                    type: "POST",
                    url: 'cart-kurang.php',
                    enctype: 'multipart/form-data',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                }).then(function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {
                        swal("Good job!", "Menu Dikurangi!", "success");
                        window.location.replace('/Catering/cart.php');
                    } else if (jsonData.success == "2") {
                        swal("Sorry!", "Menu Gagal!", "warning");
                    } else {
                        swal("Sorry!", "Menu Gagal Dikurangi", "error");
                    }
                });
            });
            $('#checkout').click(function (e) {
                bootbox.confirm("Apakah Benar Ingin CheckoutN?", function(result) {
                    if (result) {
                        window.location.replace('/Catering/checkout.php');
                    }
                });               
            });
    
    </script>
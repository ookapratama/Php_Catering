<?php session_start();
$title = "Menu | Catering";
require_once("./templates/header.php");
require_once("./conn.php");
$data = get_data("SELECT * FROM `paket`");
?>

<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Menu</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Menu</a>
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
                            <?php foreach ($data as $v) : ?>
                                <div class="col-md-4 col-xs-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- <div class="d-flex justify-content-between">
                                                <div>
                                                    <i class="fa fa-heart text-danger mr-2"></i>
                                                    213
                                                </div>
                                                <span class="badge bg-warning-bright text-warning">%30 Off</span>
                                            </div> -->
                                            <div class="my-3 text-center">
                                                <a href="menu-detail.php?v=<?= $v['id'] ?>" title="<?= $v['nama'] ?>"> <img src="image/<?= $v['gambar'] ?>" style="max-height: 230px;" class="img-thumbnail rounded" alt="Vase">
                                                </a>
                                            </div>
                                            <div class="text-center">
                                                <a href="menu-detail.php?v=<?= $v['id'] ?>">
                                                <h3><?= $v['menu'] ?> </h4>
                                                    <ht><?= $v['nama'] ?> </h4>
                                                </a>

                                                <div class="mt-2">
                                                    <a href="menu-detail.php?v=<?= $v['id'] ?>"> <button class="btn btn-primary add-to-card">Pesan</button></a>
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
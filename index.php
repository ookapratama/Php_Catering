<?php
session_start();
if (isset($_SESSION['l']))
    if ($_SESSION['l'] != 1)
        header("Location:menu.php");
$title = "Home | Catering";
require_once("./templates/header.php");
require("./conn.php");
$user = get_rows("SELECT * FROM `users` WHERE `role`='1'");
$admin = get_rows("SELECT * FROM `users` WHERE `role`='2'");
$menus = get_rows("SELECT * FROM `paket`");
$pesanan = get_rows("SELECT * FROM `pesanan`");
$metode = metode();
?>
<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">
        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Welcome back, <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];
                                    else echo 'user' ?></h3>
                <p class="text-muted">This page shows an overview for your account summary.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Menu</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div>
                                        <div class="avatar">
                                            <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                                <i class="ti-cloud"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3"><?=  $menus ?></div>
                                </div>
                                <p class="mb-0">Jumlah Menu yang telah tersedia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">User</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div>
                                        <div class="avatar">
                                            <span class="avatar-title bg-info-bright text-info rounded-pill">
                                                <i class="ti-map"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3"><?= $user ?></div>
                                </div>
                                <p class="mb-0">Jumlah User yang telah mendaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Admin</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div>
                                        <div class="avatar">
                                            <span class="avatar-title bg-secondary-bright text-secondary rounded-pill">
                                                <i class="ti-email"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3"><?= $admin ?></div>
                                </div>
                                <p class="mb-0">Jumlah Admin yang telah terdaftar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Pesanan</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div>
                                        <div class="avatar">
                                            <span class="avatar-title bg-warning-bright text-warning rounded-pill">
                                                <i class="ti-dashboard"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold ml-1 font-size-30 ml-3"><?= $pesanan ?></div>
                                </div>
                                <p class="mb-0">Jumlah Pesanan dari Users</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Paket Yang Direkomendasikan</h6>
                                <?php
                            //    usort($metode, function($a, $b) {
                            //     return $b['rank'] <=> $a['rank'];
                            // });
                            // foreach($metode as $no => $v){
                            //     echo ++$no.'. '.$v['name'].'</br>';
                            // } 
                            ?>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="row my-3">
                            <div class="col-md-6 ml-auto mr-auto">
                                <figure>
                                    <img class="img-fluid" src="assets/media/svg/upgrade.svg" alt="upgrade">
                                </figure>
                            </div>
                        </div>
                        <h4 class="mb-3 text-center">Welcome</h4>
                        <div class="row my-3">
                            <div class="col-md-10 ml-auto mr-auto">
                                <p class="text-muted">Selamat Datang Admin <?= $_SESSION['username'] ?? 'Username' ?></p>
                            </div>
                        </div>
                        <a href="#" class="align-items-center d-flex link-1 small justify-content-center" data-dismiss="modal">
                            <i class="ti-close font-size-10 mr-1"></i>Close
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ Content -->
    <?php require_once("./templates/footer.php") ?>
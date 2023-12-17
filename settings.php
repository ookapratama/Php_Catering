<?php session_start();
$title = "Setting | Catering";
require_once("./templates/header.php");
require_once("./conn.php");

$user = query("SELECT * FROM `users` WHERE id=" . $_SESSION['i'] . "");
?>

<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header">
            <div>
                <h3>Settings</h3>
                <nav aria-label="breadcrumb" class="d-flex align-items-start">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href=index.html>Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Your
                                Profile</a>
                            <a class="nav-item nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Password</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Your Profile</h6>
                                        <form id="user_profile" method="POST">
                                            <div class="row">
                                                <input name="id" type="text" hidden class="form-control" value="<?= $user['id'] ?>">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input name="username" type="text" class="form-control" value="<?= $user['username'] ?>">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input name="email" type="text" class="form-control" value="<?= $user['email'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" value="save" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Password</h6>
                                        <form id="user_password" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input name="id" type="text" hidden class="form-control" value="<?= $user['id'] ?>">
                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input name="password" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input name="password1" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password Repeat</label>
                                                        <input name="password2" type="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <?php
    require_once("./templates/footer.php") ?>

    <script type="text/javascript">
        $('#user_profile').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'settings_req.php',
                data: $(this).serialize(),
            }).then(function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    swal("Good job!", "Data Berhasil Diubah!", "success");
                } else if (jsonData.success == "2") {
                    swal("Sorry!", "Data Sudah Ada!", "warning");
                } else {
                    swal("Sorry!", "Data Gagal diubah", "error");
                }
            });
        });
        $('#user_password').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'settings_req.php',
                data: $(this).serialize(),
            }).then(function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    swal("Good job!", "Data Berhasil Diubah!", "success");
                } else if (jsonData.success == "2") {
                    swal("Sorry!", "Data Sudah Ada!", "warning");
                } else {
                    swal("Sorry!", "Data Gagal diubah", "error");
                }
            });
        });
    </script>
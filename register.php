<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/media/image/favicon.png" />

    <!-- Plugin styles -->
    <link rel="stylesheet" href="vendors/bundle.css" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="assets/css/app.min.css" type="text/css">
</head>

<body class="form-membership">

    <!-- begin::preloader-->
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <!-- end::preloader -->

    <div class="form-wrapper">

        <!-- logo -->
        <!-- <div id="logo">
            <img src="assets/media/image/logo.png" alt="image">
        </div> -->
        <!-- ./ logo -->


        <h5>Create account</h5>

        <!-- form -->
        <form id="formRegister" action="" method="POST">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" value="Register" class="btn btn-primary btn-block">Register</button>
            <hr>
            <p class="text-muted">Already have an account?</p>
            <a href="login.php" class="btn btn-outline-light btn-sm">Sign in!</a>
        </form>
        <!-- ./ form -->


    </div>

    <!-- Plugin scripts -->
    <script src="vendors/bundle.js"></script>

    <!-- App scripts -->
    <script src="assets/js/app.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#formRegister').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'register_req.php',
                    data: $(this).serialize(),
                }).then(function(response) {
                    console.log(response);
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == "1") {
                        location.href = 'login.php';
                    } else if (jsonData.success == "2") {
                        alert('Username Sudah Ada!');
                    } else {
                        alert('Invalid Credentials!');
                    }
                });
            });
        });
    </script>
</body>

</html>
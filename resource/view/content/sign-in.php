<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/UserController.php");

$user_obj = new UserController;

if (isset($_POST['try_login'])) {
    
    $result = $user_obj->user_login($_POST);

    if($result){

        $_SESSION['ECOM_user_login_time'] = date("Y-m-d H:i:s");
        $_SESSION['ECOM_user_id'] = $result['id'];
        $_SESSION['ECOM_user_name'] = $result['customer_name'];
        $_SESSION['ECOM_user_email'] = $result['customer_email'];
        $_SESSION['ECOM_user_status'] = $result['customer_status'];
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./admin/public/images/favicon.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="./admin/public/css/style.css" rel="stylesheet">
    <style>
        .input-group-text {
            background-color: #fff;
            border: none;
        }
    </style>
</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <?php if (isset($_SESSION['USER_CREATED'])) : ?>

                                    <?php unset($_SESSION['USER_CREATED']); ?>
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Registration is Successful!</strong>
                                    </div>

                                <?php endif; ?>

                                <?php if (isset($_POST['try_login'])) : ?>

                                    <?php if (empty($result)) : ?>

                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Please, Enter Valid Email and Password!</strong>
                                        </div>

                                    <?php endif; ?>

                                <?php endif; ?>

                                <div class="mb-3 humberger__menu__logo d-flex justify-content-center">
                                    <a href="./index.php"><img src="public/images/logo.png" alt=""></a>
                                </div>

                                <h4 class="mt-5 text-center">User Login</h4>

                                <form class="mt-5 mb-5 login-input" action="" method="post">
                                    <div class="form-group">
                                        <input name="user_email" type="email" class="form-control" placeholder="Email" required autocomplete="off">
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" name="user_password" placeholder="Password" required autocomplete="off">
                                        <span class="input-group-text" id="basic-addon2"><i id="pass_eye" class="fas fa-eye-slash"></i></span>
                                    </div>
                                    <button name="try_login" type="submit" class="btn login-form__btn submit w-100">Sign In Now</button>
                                </form>

                                <p class="mt-5 login-form__footer">Have account? <a href="./sign-up.php" class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="./admin/public/plugins/common/common.min.js"></script>
    <script src="./admin/public/js/custom.min.js"></script>
    <script src="./admin/public/js/settings.js"></script>
    <script src="./admin/public/js/gleek.js"></script>
    <script src="./admin/public/js/styleSwitcher.js"></script>

    <script>
        var i = document.querySelector('#pass_eye');
        i.addEventListener('click', function() {
            var input = document.querySelector('input[name=user_password]');
            if (input.type === "password") {
                input.type = "text";
                i.classList.remove('fa-eye-slash');
                i.classList.add('fa-eye');
            } else {
                input.type = "password";
                i.classList.add('fa-eye-slash');
                i.classList.remove('fa-eye');
            }
        });
    </script>

</body>
</html>
<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");

$adminCtrl = new AdminController;

if (isset($_POST['try_login'])) 
{
    $email = $_POST['admin_email'];
    $password = sha1($_POST['admin_password']);

    $adminData = $adminCtrl->try_login($email, $password);

    if (!empty($adminData)) 
    {
        $_SESSION['ECOM_login_time'] = date("Y-m-d H:i:s");
        $_SESSION['ECOM_admin_id'] = $adminData[0]['id'];
        $_SESSION['ECOM_admin_name'] = $adminData[0]['admin_fullname'];
        $_SESSION['ECOM_admin_email'] = $adminData[0]['admin_username'];
        $_SESSION['ECOM_admin_type'] = $adminData[0]['admin_type'];

        header("Location: dashboard.php");
    }
}

?>


<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Admin Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon.png">
    <link href="public/css/style.css" rel="stylesheet">

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

                                <?php if (isset($_POST['try_login'])) : ?>

                                    <?php if (empty($adminData)) : ?>

                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Sorry!</strong> Please enter valid email and password!
                                        </div>

                                    <?php endif; ?>

                                <?php endif; ?>

                                <div class="mb-3 humberger__menu__logo d-flex justify-content-center">
                                    <a href="#"><img src="../public/images/logo.png" alt=""></a>
                                </div>

                                <h4 class="mt-5 text-center">Admin Login</h4>

                                <form class="mt-5 mb-5 login-input" method="post" action="">
                                    <div class="form-group">
                                        <input type="email" name="admin_email" class="form-control" placeholder="Enter your Email ID..." required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="admin_password" class="form-control" placeholder="Enter Password..." required>
                                    </div>
                                    <button name="try_login" type="submit" class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
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
    <script src="public/plugins/common/common.min.js"></script>
    <script src="public/js/custom.min.js"></script>
    <script src="public/js/settings.js"></script>
    <script src="public/js/gleek.js"></script>
    <script src="public/js/styleSwitcher.js"></script>
</body>

</html>
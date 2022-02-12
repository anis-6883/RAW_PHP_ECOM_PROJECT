<?php

include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/UserController.php");

$user_obj = new UserController;

if (isset($_POST['save_user'])) {
    $result = $user_obj->user_register($_POST);
    if($result){
        $_SESSION["USER_CREATED"] = "YES";
        header('Location: sign-in.php');
    }
}

?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Registration</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./admin/public/images/favicon.png">
    <link href="./admin/public/css/style.css" rel="stylesheet">
    <!-- jqueryui date picker -->
    <link rel="stylesheet" href="./admin/public/css/jquery-ui.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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

                                <div class="humberger__menu__logo d-flex justify-content-center">
                                    <a href="./index.php"><img src="public/images/logo.png" alt=""></a>
                                </div>
                                <h4 class="mt-5 text-center">User Registration</h4>

                                <form class="mt-5 mb-5 login-input" action="" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user_fullname" placeholder="Fullname" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <select name="user_gender" class="form-control">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control jqdatepicker" name="user_dob" placeholder="Date of Birth" required autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="user_email" placeholder="Email" required autocomplete="off">
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" name="user_password" placeholder="Password" required autocomplete="off">
                                        <span class="input-group-text" id="basic-addon2"><i id="pass_eye" class="fas fa-eye-slash"></i></span>
                                    </div>
                                    <button name="save_user" type="submit" class="btn login-form__btn submit w-100">Sign Up Now</button>
                                </form>

                                <p class="mt-5 login-form__footer">Need account? <a href="./sign-in.php" class="text-primary">Sign In</a> now</p>
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

    <!-- jqueryui date picker -->
    <script src="./admin/public/js/jQuery/jquery-ui.js"></script>

    <!-- jqueryui date picker -->
    <script>
        $(function() {
            $(".jqdatepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                yearRange: '1980:2025'
            });
        });
    </script>

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
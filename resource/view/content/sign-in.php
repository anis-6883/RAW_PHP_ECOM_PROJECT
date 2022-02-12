<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Registration</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./admin/public/images/favicon.png">
    <link href="./admin/public/css/style.css" rel="stylesheet">
    
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
                                
                                <div class="mb-3 humberger__menu__logo d-flex justify-content-center">
                                    <a href="./index.php"><img src="public/images/logo.png" alt=""></a>
                                </div>
                                <h4 class="mt-5 text-center">User Login</h4>
                                <form class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="email" class="form-control"  placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In Now</button>
                                </form>
                                    <p class="mt-5 login-form__footer">Have account? <a href="./sign-up.php" class="text-primary">Sign Up</a> now</p>
                                    </p>
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
</body>
</html>






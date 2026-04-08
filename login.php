<?php
$message_result = '';
//require_once './classes/organization.php';
//$obj_org = new Organization();
//$query = $obj_org->view_organization_info();
//$org = mysqli_fetch_assoc($query);
if (isset($_POST['submit'])) {
    require 'classes/login.php';
    $obj_login = new Login();
    $message_result = $obj_login->admin_login_check($_POST);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="resource/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="resource/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="resource/custom_css/AdminLTE.css">
        <link rel="shortcut icon" href="resource/image/vaccine_logo.jpg">
        <style>
            .box {
                width:100%;
                background:#FFF;
                margin:40px auto;
            }
            .effect5
            {
                position: relative;
            }
            .effect5:before, .effect5:after
            {
                z-index: -1;
                position: absolute;
                content: "";
                bottom: 25px;
                left: 10px;
                width: 50%;
                top: 80%;
                max-width:300px;
                background: #777;
                -webkit-box-shadow: 0 35px 20px #777;
                -moz-box-shadow: 0 35px 20px #777;
                box-shadow: 0 35px 20px #777;
                -webkit-transform: rotate(-8deg);
                -moz-transform: rotate(-8deg);
                -o-transform: rotate(-8deg);
                -ms-transform: rotate(-8deg);
                transform: rotate(-8deg);
            }
            .effect5:after
            {
                -webkit-transform: rotate(8deg);
                -moz-transform: rotate(8deg);
                -o-transform: rotate(8deg);
                -ms-transform: rotate(8deg);
                transform: rotate(8deg);
                right: 10px;
                left: auto;
            }

        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#">
                    <img src="resource/image/vaccine_logo.jpg" class="img-circle" height="50" width="50"/><br>
                    <small>Vaccination Software</small>
                </a>
            </div>
            <div class="login-box-body box effect5">
                <p class="login-box-msg"><strong></strong></p>
                <div class="form-errors">
                    <p style="text-align: center; color:red;"> <?php echo $message_result ?></p>
                </div>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="user_name" placeholder="User name" required>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="resource/jquery/jquery-3.1.1.js"></script>
        <script src="resource/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>

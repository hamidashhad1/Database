<?php

session_start();
if(isset($_SESSION['id']))
{
header("Location: Home.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Z&bTraders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="js/login.js"></script>
<link href="css/login.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top: 3cm">
    <div class="panel panel-default"  style="border: none; text-align: center">
        <div class="panel-body">
            <h1 class="display-1" style="color: white">Z&B Trader</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">
                    Login In</p>
                <form class="login" method="post" action="include/loginCheck.php">
                    <input name="username" type="text" placeholder="Username" />
                    <input name="password" type="password" placeholder="Password" />
                    <input name="submit" type="submit" value="Login In" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
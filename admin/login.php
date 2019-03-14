<?php
session_start();
if(isset($_SESSION['userId'])) {
    header('Location: /');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Grocery Store - Login</title>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Member Login</div>
            <div class="card-body">
                <form>
                    <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Email address" required="required" autofocus="autofocus">
                    <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required="required">
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="register.php">Not a member yet? Register now.</a>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
    <script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            var _username=$("input[type=email]").val();
            var _password=$("input[type=password]").val();
            if(_username.trim()=="" || _password.trim()=="") {
                alert("Empty fields.");
            } else
            $.post({
                url:"/config/login.php",
                dataType:"json",
                data:{
                    username:_username,
                    password:_password
                },
                success:function(_data) {
                    if(_data.err!="") {
                        alert(_data.err);
                    } else {
                        location.href="/";
                    }
                },
                error:function() {
                    alert("Unknown error! Try again.");
                }
            });
        });
    });
    </script>
</body>
</html>

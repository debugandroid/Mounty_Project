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
    <title>Grocery Store - Register</title>
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Member Registration</div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="lastName" class="form-control" placeholder="Last name" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="text" id="inputShopName" class="form-control" placeholder="Shop Name" required="required">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="inputShopAddress" class="form-control" placeholder="Shop Address" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <input type="text" id="inputShopState" class="form-control" placeholder="State" required="required">
                            </div>
                            <div class="col-md-6">
                                <input type="number" id="inputShopPincode" class="form-control" placeholder="Pincode" required="required">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Register</button>
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="login.php">Already a member? Login now</a>
                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php"); ?>
    <script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            var _firstname=$("#firstName").val();
            var _lastname=$("#lastName").val();
            var _username=$("input[type=email]").val();
            var _password=$("input[type=password]").val();
            var _rpassword=$("#confirmPassword").val();
            var _shopName=$("#inputShopName").val();
            var _address=$("#inputShopAddress").val();
            var _state=$("#inputShopState").val();
            var _pincode=$("#inputShopPincode").val();
            if(_password.trim()!=_rpassword.trim()) {
                alert("Password don't match.");
            } else if(_username.trim()=="" || _password.trim()=="" || _firstname.trim()=="" || _lastname.trim()=="") {
                alert("Empty fields.");
            } else
            $.post({
                url:"/config/register.php",
                dataType:"json",
                data:{
                    "username":_username,
                    "password":_password,
                    "firstname":_firstname,
                    "lastname":_lastname,
                    "shopName":_shopName,
                    "shopAddress":_address,
                    "shopState":_state,
                    "shopPincode":_pincode
                },
                success:function(_data) {
                    if(_data.err!="") {
                        alert(_data.err);
                    } else {
                        location.href="/";
                    }
                },
                error:function(_var1,_var2,_var3) {
                    alert("Unknown error! Try again."+_var2+"- "+_var3);
                }
            });
        });
    });
    </script>
</body>
</html>

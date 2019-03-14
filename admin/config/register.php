<?php
    require_once('connection.php');
    session_start();
    $_status=array(
        "out"=>"",
        "err"=>""
    );
    try {
        if($_SERVER['REQUEST_METHOD']==="POST") {
            if(isset($_POST['username']) && isset($_POST['password'])) {
                $_username=filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
                $_password=filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
                $_firstname=filter_var(trim($_POST['firstname']),FILTER_SANITIZE_STRING);
                $_lastname=filter_var(trim($_POST['lastname']),FILTER_SANITIZE_STRING);
                $_shopName=filter_var(trim($_POST['shopName']),FILTER_SANITIZE_STRING);
                $_shopAddress=filter_var(trim($_POST['shopAddress']),FILTER_SANITIZE_STRING);
                $_shopState=filter_var(trim($_POST['shopState']),FILTER_SANITIZE_STRING);
                $_shopPincode=filter_var(trim($_POST['shopPincode']),FILTER_SANITIZE_STRING);
                if($_username==="" || $_password==="" || $_firstname==="" || $_lastname==="" || $_shopAddress==="" || $_shopName==="" || $_shopState==="") {
                    $_status['err']="Fields cannot be blank";
                    throw new Exception();
                } else if(strlen($_password)<8) {
                    $_status['err']="Password should be minimum of length 8.";
                    throw new Exception();
                } else {
                    $_sql="select userId from users where userEmailId='".$_username."' and userPassword='".$_password."'";
                    $_result=$conn->query($_sql);
                    if($_result->num_rows===0) {
                        $_sql1="insert into users (userEmailId,userPassword,userFirstName,userLastName,userShopName,userShopAddress,userShopState,userShopPincode) value('$_username','$_password','$_firstname','$_lastname','$_shopName','$_shopAddress','$_shopState',$_shopPincode)";
                        $_result1=$conn->query($_sql1);
                        if($conn->affected_rows >0) {
                            $_SESSION['userId']=$conn->insert_id;
                            $_SESSION['userEmailId']=$_username;
                            $_SESSION['userFirstName']=$_firstname;
                            $_SESSION['userLastName']=$_lastname;
                            $_status['out']="Success";
                        } else {
                            $_status['err']="Server error.";
                            throw new Exception();
                        }
                    } else {
                        $_status['err']="User already exists!";
                        throw new Exception();
                    }
                }
            } else {
                $_status['err']="Incomplete params.";
                throw new Exception();
            }
        } else {
            $_status['err']="Only POST requests are allowed.";
            throw new Exception();
        }
    } catch(Exception $_except) {

    } finally {
        $conn->close();
        echo json_encode($_status);
    }
?>

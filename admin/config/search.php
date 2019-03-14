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
                $_barcode=filter_var(trim($_POST['barcode']),FILTER_SANITIZE_STRING);
                if($_barcode==="") {
                    $_status['err']="Fields cannot be blank";
                    throw new Exception();
                } else if(strlen($_barcode)<8) {
                    $_status['err']="Barcode is not in proper format.";
                    throw new Exception();
                } else {
                    $_sql="select productId,productName, from users where userEmailId='".$_username."' and userPassword='".$_password."'";
                    $_result=$conn->query($_sql);
                    if($_result->num_rows===0) {
                        $_status['err']="Invalid username/password combination.";
                        throw new Exception();
                    } else {
                        $_row=$_result->fetch_assoc();
                        $_SESSION['userId']=$_row['userId'];
                        $_SESSION['userEmailId']=$_username;
                        $_SESSION['userFirstName']=$_row['userFirstName'];
                        $_SESSION['userLastName']=$_row['userLastName'];
                        $_status['out']="Success";
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

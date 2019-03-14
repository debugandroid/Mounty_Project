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
                if($_username==="" || $_password==="") {
                    $_status['err']="Fields cannot be blank";
                    throw new Exception();
                } else if(strlen($_password)<8) {
                    $_status['err']="Password should be minimum of length 8.";
                    throw new Exception();
                } else {
                    $_sql="select userId,userFirstName,userLastName from users where userEmailId='".$_username."' and userPassword='".$_password."'";
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

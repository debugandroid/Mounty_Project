<?php
error_reporting(-1);
ini_set('display_errors', 'On');
    session_start();
    require("connection.php");
    try{
        if(isset($_POST['list']) && isset($_SESSION['userId'])) {
            $_status=1;
            $_stmt=$conn->prepare("insert into logs(logProductId,logUserId,logProductQuantity) values(?,?,?)");
            if($_stmt) {
                foreach ($_POST['list'] as $key => $value) {
                    if($value!=="") {
                        $_stmt->bind_param("iii",$key,$_SESSION['userId'],intval($value));
                        $_stmt->execute();
                        if($_stmt->errno) {
                            $_status=0;
                            echo "Failed to saved";
                        }
                    }
                }
            } else {
                throw new Exception("Error".$conn->error);
            }
            $_stmt->close();
            if($_status) {
                $_stmt=$conn->prepare("update products set productQuantity=productQuantity-? where productUserId=? and productId=?");
                if($_stmt) {
                    $_status=1;
                    foreach ($_POST['list'] as $key => $value) {
                        if($value!=="") {
                            $_stmt->bind_param("iii",intval($value),$_SESSION['userId'],$key);
                            $_stmt->execute();
                            if($_stmt->errno) {
                                $_status=0;
                                echo "Failed to saved";
                            }
                        }
                    }
                    if($_status)
                        echo "Success";
                } else {
                    throw new Exception("Error".$conn->error);
                }
                $_stmt->close();
            }
        }
    } catch(Exception $_except) {

    } finally {

    }
?>

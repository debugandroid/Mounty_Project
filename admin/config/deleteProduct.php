<?php
    session_start();
    require("connection.php");
    try{
        if(isset($_POST['id']) && isset($_SESSION['userId'])) {

            $_stmt=$conn->prepare("delete from products where productUserId=? and productId=?");
            if($_stmt) {
                    $_stmt->bind_param("ii",$_SESSION['userId'],$_POST['id']);
                    $_stmt->execute();
                    if($_stmt->errno) {
                            $_error=1;
                            echo "Failed to delete";
                    } else {
                        $_status=1;
                        echo "Success";
                    }
                    $_stmt->close();
            } else {
                    $_error=1;
                    throw new Exception("Error".$conn->error);
            }
        }
    } catch(Exception $_except) {

    } finally {

    }
?>

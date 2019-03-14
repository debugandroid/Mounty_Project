<?php
    $conn=new mysqli("127.0.0.1","root","codeample","grocery_store");
    if($conn->connect_error) {
        die("Connection failed | ".$conn->connect_error);
    }
?>

<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: /login.php');
    exit(0);
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
    <title>Grocery Store - Day Log</title>
</head>
<body id="page-top">
    <?php require("nav.php"); ?>
    <div id="wrapper">
        <?php require("sidebar.php"); ?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Day Log</li>
                </ol>
                <div class="container mb-4">
                    <button data-toggle="modal" data-target='#addModal' class="btn btn-lg btn-success">Add new entries</button>
                </div>
                <div class="container">
                    <table class="table table-bordered table-striped" id="productList">
                        <thead>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Sub Sub Category</th>
                            <th>Price</th>
                            <th>Time</th>
                            <th>Quantity</th>
                        </thead>
                        <tbody>
                            <?php
                            require("config/connection.php");
                            $_sql="select * from logs inner join users on userId=logUserId inner join products on productUserId=userId where logProductId=productId and userId=".$_SESSION['userId'];
                            $_result=$conn->query($_sql);
                            if(!$_result)
                                throw new Exception("Server Error");
                            else {
                                while($_row=$_result->fetch_assoc()) {
                                    echo "<tr>
                                    <td>".$_row['productName']."</td>
                                    <td>".$_row['productMainCategory']."</td>
                                    <td>".$_row['productSubCategory'] ."</td>
                                    <td>".$_row['productSubSubCategory']."</td>
                                    <td>".$_row['productPrice']."</td>
                                    <td>".$_row['logTime']."</td>
                                    <td>".$_row['logProductQuantity']."</td>
                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Grocery Store 2018</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/config/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" style="width:1000px;margin:50px auto">
        <div class="modal-dialog" role="document" style="width:100%;margin:0 auto;max-width:initial">
            <div class="modal-content" style="width:100%">
                <div class="modal-header">
                    <h5 class="modal-title">Add product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="itemList">
                        <thead>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Sub Sub Category</th>
                            <th>Quantity</th>
                            <th>Add</th>
                        </thead>
                        <tbody>
                            <?php
                            require("config/connection.php");
                            $_sql="select * from products where productUserId=".$_SESSION['userId'];
                            $_result=$conn->query($_sql);
                            if(!$_result)
                            throw new Exception("Server Error");
                            else {
                                while($_row=$_result->fetch_assoc()) {
                                    echo "<tr>
                                    <td>".$_row['productName']."</td>
                                    <td>".$_row['productMainCategory']."</td>
                                    <td>".$_row['productSubCategory'] ."</td>
                                    <td>".$_row['productSubSubCategory']."</td>
                                    <td><input rel='".$_row['productId']."'  type='text' placeholder='Enter quantity'></td>
                                    <td><button class='btn btn-primary' onclick='addItem()'>Add</button></td>
                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="saveChanges()" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php"); ?>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script>
    var _list={};
    function saveChanges() {
        $.post({
            url:'config/addToLog.php',
            data:{
                "list":_list
            },
            success:function(_response) {
                if(_response==="Success") {
                    alert("Saved");
                    location.href="";
                } else {
                    alert("Error while saving");
                }
            },
            error:function(_error) {
                console.log(_error)
            }
        });
    }
    $(document).ready(function() {
        $('#productList').DataTable();
        $('#itemList').DataTable();
        $("#itemList input").keyup(function() {
            var _rel=$(this).attr("rel");
            _list[_rel]=$(this).val();
            console.log(_list);
        });
    });
    </script>
</body>
</html>

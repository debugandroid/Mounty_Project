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
    <title>Grocery Store - List all products</title>
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
                    <li class="breadcrumb-item active">List All Products</li>
                </ol>
                <div class="container">
                    <table class="table table-bordered table-striped" id="productList">
                        <thead>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Sub Sub Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
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
                                    <td>".$_row['productPrice']."</td>
                                    <td>".$_row['productQuantity']."</td>
                                    <td><button onclick='updateRemoveId(".$_row['productId'].")' id='".$_row['productId']."' data-toggle='modal' data-target='#deleteModal' class='btn btn-danger'>Remove</button></td>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove this product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure, you want to remove this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="deleteProduct()" class="btn btn-primary">Remove</button>
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
    var _removeId=-1;
    function updateRemoveId(_id) {
        _removeId=_id;
    }
    function deleteProduct() {
        $.post({
            url:'config/deleteProduct.php',
            data:{
                id:_removeId,
            },
            success:function(_response) {
                if(_response==="Success") {
                    location.href="";
                } else {
                    alert(_response);
                }
            },
            error:function(_error) {
                console.log(_error)
            }
        })
        _removeId=-1;
    }
    $(document).ready(function() {
        $('#productList').DataTable();
    });
    </script>
</body>
</html>

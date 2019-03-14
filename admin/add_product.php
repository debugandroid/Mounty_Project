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
    <title>Grocery Store - Add New Product</title>
    <style>
        .dropdown-submenu {
        position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
        display: block;
        }

        .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
        float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
        }
    </style>
</head>
<body id="page-top">
    <?php require("nav.php"); ?>
    <div id="wrapper">
        <?php require("sidebar.php"); ?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/index.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/list_product.php">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Add New Product</li>
                </ol>
                <div style="max-width:500px;margin:40px 20px">
                    <form  autocomplete="off" style="width:700px;">
                        <div class='form-group'>
                            <label>Name</label>
                            <input class='form-control' name="productTitle" type="text" data-toggle="popover" title="Title" data-content="Enter title of new note here" autocomplete="off" required>
                        </div>
                        <div class='form-group'>
                            <label>Category : <span id="selectedCat"><b><i>Not Selected</i></b></span></label>
                            <div class="dropdown-wrapper">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mb-4" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Category<i class="fa fa-angle-down ml-3"></i>
                                    </button>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu" id="mainCategory">
                                    </ul>
                                    <input type="hidden" name="mainCategoryInput">
                                    <input type="hidden" name="subCategoryInput">
                                    <input type="hidden" name="subSubCategoryInput">
                                </div>
                            </div>
                            <div class='form-group'>
                                <label>Price</label>
                                <input class='form-control' name="productPrice" type="number" data-toggle="popover" title="Price" data-content="Enter price of new product here" autocomplete="off" required>
                            </div>
                            <div class='form-group'>
                                <label>Quantity</label>
                                <input class='form-control' name="productQuantity" type="number" data-toggle="popover" title="Price" data-content="Enter price of new product here" autocomplete="off" required>
                            </div>
                            <div class='form-group'>
                                <label>Screenshot</label>
                                <input class='form-control' name="productPreviewFile" type="file" data-toggle="popover" title="Screenshot" data-content="Select screenshot of file to upload"  required>
                            </div>
                            <div class='form-group'>
                                <input class='btn btn-lg btn-primary' id='productSubmitBtn' value="Add this product" type="submit">
                                <p id="productStatus"></p
                                </div>
                            </form>
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
            <?php require("footer.php"); ?>
            <script>
            var _categories={
            "HouseHold needs":{
                    "Laundry Detergents":["Detergent Powder","Liquid Detergent","Detergent Bars","Laundry Additives"],
                    "DishWashers":["Disk Washing Bars","Diskwashing Gels & Powder","Concentrates","Scrubbers & Cleaning Aids"],
                    "Cleaners":["Toilet Cleaners","Floor Cleaners","Multi-Purpose Cleaners"],
                    "Cleaning Tools and Brushes":["Brooms & Mops","Cleaning Accessories","Dustbin"],
                    "Pooja Needs":["Incense Sticks","Other Pooja needs"],
            		"Repellents":["Mosquito Repellents","Sprays","Creams & Other Repellents"],
            		"Home and Car Fresheners":["Air Fresheners"],
            		"Tissues Disposables":["Kitchen and Dining Disposables","Toilet and other Disposables"],
            		"Premium Home Care":["Wipes Cleaners & other"],
            		"Shoe Care":["Liquid Shoe polish","Cherry Blossom"],
                },
            "Biscuits & Cookies":{
                    "Cookies & Cakes":["Jeera Cookie","Ajwain Cookie","Atta Cookie","Tooty Fruity Cookie","Cashew Cookie","Chocolate Cookie",""],
            		"Cream Biscuits & Wafers":["Vanilla Creme Biscuits","Choco Cream Biscuits","Strawberry Creme Biscuits","Tangy Orange Biscuits","Dark Choco Delight"],
            		"Sweet and Salty":["Light Salty Manaco","Zeera Jeffs Biscuits","Maska Chaska Biscuits","Salty and Sweet Cracker"],
                    "Glucose & Marie":["Parle-G Gluco Biscuits","Britannia Marie Gold Biscuits"]
            },
            "Breakfast & Dairy":{
                	"Milk & Milk Products":["Poly Milk","tetra milk","Toned Milk"],
                	"Bread & Eggs":["brown bread","Sandwitch bread","White Bread","Special Bread"],
                	"Paneer & Curd":["Paneer","Tofu","Curd","Yogurt"],
                	"Butter & Cheese":["Cheese","Butter","Spreads"]
            },"Beverages":{
                    "Soft Drinks":["Cans","Pet Bottles","Mango Drinks"],
                    "Juices and Concentrates":["Assorted Juices","Mango and Orange Juices","Concentrates","Squash and Sharbat","Ayurvedic and Oraganic Juices"],
                    "Tea and Coffee":["Tea","Green Tea","Coffee","Tea Bags"],
                    "Health and Energy Drinks":["Chocolate Health Drinks","Health Drinks","Energy Drinks"],
                    "Milk Drinks":["Chaach","lassi","Milk Shake"]
            },"Personal care":{
                	"Hair Care":["Shampoo","Conditioner","Hair Oil"],
                	"Skin Care": ["Body Lotions","Talc Powder","Face Cream"],
                	"Deos and Perfumes":["Mens Deo","Womens Deo","Perfumes"],
                	"Shaving Needs":["Razors","Cartridges","Pre Shave","After Shave"],
                	"Cosmetics":["Eye Makeup","Nail Paint","Lip Color","Brushes and Tools"]
            }
            };
            var _mainCat=_subCat=_subSubCat="";
            $(document).ready(function() {
                $('.dropdown-submenu a.test').on("click", function(e){
                    $(this).next('ul').toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
                console.log(_categories);
                for(var _main in _categories) {
                    console.log(_main);
                    var _html='\
                    <li class="dropdown-submenu" id="mainCategory">\
                        <a  class="dropdown-item" tabindex="-1" href="#">'+_main+'</a>\
                        <ul class="dropdown-menu">';
                        for(var _sub in _categories[_main]) {
                            _html+='\
                                <li class="dropdown-submenu">\
                                    <a class="dropdown-item" href="#">'+_sub+'</a>\
                                    <ul class="dropdown-menu">';
                                        for (var i=0;i<_categories[_main][_sub].length;i++) {
                                            _html+='<a class="main-list-item dropdown-item" main="'+_main+'" sub="'+_sub+'" subsub="'+_categories[_main][_sub][i]+'" href="#">'+_categories[_main][_sub][i]+'</a>';
                                        }
                                    _html+='</ul>\
                                </li>\
                            ';
                        }
                        _html+='\
                        </ul>\
                    </li>';
                    $("#mainCategory").append(_html);
                }
                $(".main-list-item").click(function() {
                    _mainCat=$(this).attr("main");
                    _subCat=$(this).attr("sub");
                    _subSubCat=$(this).attr("subsub");
                    $("input[name=mainCategoryInput]").val(_mainCat);
                    $("input[name=subCategoryInput]").val(_subCat);
                    $("input[name=subSubCategoryInput]").val(_subSubCat);
                    $("#selectedCat b i").text(_mainCat+" > "+_subCat+" > "+_subSubCat);
                });
                $("form").submit(function(event) {
                    event.preventDefault();
                    $("#productSubmitBtn").attr("disabed","disabled");
                    $("#productStatus").text("Uploading");
                    $.ajax({
                        type: 'POST',
                        url: 'config/uploadProduct.php',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData:false,
                        xhr: function() {
                            var myXhr = $.ajaxSettings.xhr();
                            if(myXhr.upload){
                                myXhr.upload.addEventListener('progress',function(e) {
                                    console.log(e.loaded+" / "+e.total);
        							$("#productStatus").text("Uploading "+(e.loaded/1000000).toFixed(2)+"MB/"+(e.total/1000000).toFixed(2)+"MB");
                                }, false);
                            }
                            return myXhr;
                        },
                        success: function(msg){
                            if(msg==="Success") {
                                location.href=""
                                $("#productStatus").text("Done");
                            } else {
                                $("#productStatus").text(msg);
                            }
                        },error:function(_error) {
        					$("#productStatus").text("Error"+_error);
        				}
                    });
                });
            });
            </script>
        </body>
        </html>

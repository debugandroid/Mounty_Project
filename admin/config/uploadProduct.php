<?php
    session_start();
    $_status=0;
    try {
        if(isset($_SESSION['userId'])) {
            if(!empty($_POST['productTitle']) && !empty($_POST['productPrice']) && !empty($_POST['productQuantity']) && !empty($_FILES['productPreviewFile']['name']) && !empty($_POST['mainCategoryInput']) && !empty($_POST['subCategoryInput']) && !empty($_POST['subSubCategoryInput'])){
                $uploadedFile = '';
                $_error=0;
				$_targetdir="../uploadsProductPreview/";
				$_targetfile=$_targetdir.basename($_FILES['productPreviewFile']['name']);
				$_targettype=strtolower(pathinfo($_targetfile,PATHINFO_EXTENSION));
                $_tempTargetFile=time().'_'.$_SESSION['userId'].'.'.$_targettype;
				$_targetfile=$_targetdir.$_tempTargetFile;
				$_actualimagesize=getimagesize($_FILES['productPreviewFile']['tmp_name']);
				if(!$_actualimagesize) {
						throw new exception("file is not an image.");
				}
				if(file_exists($_targetfile)) {
						unlink($_targetfile);
						echo "file exists, but deleted.";
				}
				if($_FILES['productPreviewFile']['size'] > 1100000) {
						throw new exception("file size limit exceeded. it should be less than 1000kb.");
				}
				if($_targettype!=="jpg" && $_targettype!=="jpeg" && $_targettype!=="png") {
						throw new exception("invalid image type. only jpg, jpeg and png files are allowed.");
				}
				if(!move_uploaded_file($_FILES['productPreviewFile']['tmp_name'],$_targetfile)) {
						throw new exception("there was an error while uploading image.");
				}


				$_name = $_POST['productTitle'];
				$_price = $_POST['productPrice'];
				$_mainCat = $_POST['mainCategoryInput'];
				$_subCat = $_POST['subCategoryInput'];
				$_quantity = $_POST['productQuantity'];
				$_subSubCat = $_POST['subSubCategoryInput'];
				$_userId = $_SESSION['userId'];
				require("connection.php");
				if(!$_error) {
						$_stmt=$conn->prepare("insert into products(productName,productPrice,productUserId,productMainCategory,productSubCategory,productSubSubCategory,productPreviewUrl,productQuantity) values(?,?,?,?,?,?,?,?)");
						if($_stmt) {
								$_stmt->bind_param("siissssi",$_name,$_price,$_userId,$_mainCat,$_subCat,$_subSubCat,$_tempTargetFile,$_quantity);
								$_stmt->execute();
								if($_stmt->errno) {
										$_error=1;
								} else {
                                    $_status=1;
                                }
								$_stmt->close();
						} else {
								$_error=1;
                                throw new Exception("Error".$conn->error);
						}
				}
            } else {
                throw new Exception("Empty fields");
            }
        }
    } catch(Exception $_except) {
        if(!$_status) {
            echo $_except->getMessage();
        }
    } finally {
        if($_status) {
            echo "Success";
        }
    }
?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="index.html">Grocery Store</a>
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <?php
             require("config/connection.php");
             $_result=array();
                $_count=0;
            $_stmt=$conn->prepare("select productName,productQuantity from products where productQuantity < 5 and productUserId=?");
            if($_stmt) {
                $_stmt->bind_param("i",$_SESSION['userId']);
                $_stmt->execute();
                if($_stmt->errno) {
                    $_status=0;
                    echo "Failed to saved";
                } else {
                    $_result=$_stmt->get_result();
                        $_count=$_result->num_rows;
                }
            } else {
                echo "Server Error";
            }
            $_stmt->close();
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell fa-fw"></i>
                <span class="badge badge-danger"><?php echo $_count; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                <?php
                    while($_row=$_result->fetch_assoc()) {
                        echo '<a class="dropdown-item" href="#"><i class="fa fa-info-circle mr-3"></i><b>'.$_row['productName'].'</b> is going to be out of stock soon.</a>
                        <span style="display:block;margin-left:56px">Quantity <i>'.$_row['productQuantity'].'</i></span>
                        <div class="dropdown-divider"></div>';
                    }
                ?>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle fa-fw"></i>
                <span><?php echo $_SESSION['userFirstName'].' '.$_SESSION['userLastName']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="config/logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li>
    </ul>
</nav>

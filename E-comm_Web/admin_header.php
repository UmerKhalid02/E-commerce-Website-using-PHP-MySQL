<?php
    if(isset($message)){
        foreach($message as $message){
            echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fa fa-times cross" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }
?>


<header class="header">

    <div class="flex">
        <a href="#"><img src="Assets/Logos/favicon/favicon-32x32.png" alt="image" class="nav-logo"></a>
        <a href="admin_page.php" class="h-logo">Admin<span>Panel</span></a>

        <nav class="navbar">
            <a href="admin_page.php">Home</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_contacts.php">Messages</a>
        </nav>

        <div class="icons">
            <!-- <div id="menu-btn" class="fa fa-bars"></div> -->
            <div id="user-btn" class="fa fa-user"></div>
        </div>

        <div class="account-box">
            <p>Username: <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
        </div>

    </div>

</header>
<?php
    include 'config.php';

    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

    if(isset($_POST['update_cart'])){
        $cart_id = $_POST['cart_id'];
        $cart_quantity = $_POST['cart_quantity'];

        mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
        $message[] = 'Cart quantity updated';
    }

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
        header('location:cart.php');
    }

    if(isset($_GET['delete_all'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        header('location:cart.php');
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sab Lay Jao | Orders</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    
    <?php include 'header.php'; ?>

    <section class="shopping-cart">
        <h1 class="title">Shopping Cart</h1>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>
            <div class="box">
                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fa fa-times" onclick="return confirm('Delete this item from the cart?');"></a>
                <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_cart['name']; ?></div>
                <div class="price">Rs. <?php echo $fetch_cart['price']; ?></div>
                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
                    <input type="submit" name="update_cart" value="Update" class="btn">
                </form>
                <div class="sub-total">
                    Sub Total : Rs. <span><?php echo $sub_total = ($fetch_cart['quantity']) * $fetch_cart['price']; ?></span>
                </div>
            </div>
            <?php
                $grand_total += $sub_total;
                    }
                }else{
                    echo '<p class="empty">Cart is Empty</p>';
                }
            ?>
        </div>
        
        <div class="delete-all-btn" style="margin-top: 2rem; text-align: center;">
            <a href="cart.php?delete_all" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Delete all items from the cart');">Delete All</a>
        </div>

        <div class="cart-total">
            <p>Grand Total : Rs. <span><?php echo $grand_total; ?></span></p>
            <div class="flex">
                <a href="shop.php" class="btn">Continue Shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to checkout</a>
            </div>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>
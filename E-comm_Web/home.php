<?php
    include 'config.php';

    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

    if(isset($_POST['add_to_cart'])){
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_cart_number) > 0){
            $message[] = 'Already added to cart';
        }else{
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            
            $message[] = 'Product added to cart';
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sab Lay Jao | Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    
    <?php include 'header.php'; ?>

    <section class="home" id="hero">
        <div class="content">
            <h4 style="color: #e25822;">Hot Item</h4>
            <p>The Glorious PlayStation 5 is trending right now..!</p>
            <h2>Just For Rs. 109,999</h2>
            <h4>Save Rs. 20,000</h4>
            <a href="shop.php" class="btn">Shop Now</a>
        </div>

    </section>

    <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="Assets/Images/f1.png" alt="image">
                <h6>Free Shipping</h6>
            </div>
            <div class="fe-box">
                <img src="Assets/Images/f2.png" alt="image">
                <h6>Fast Delivery</h6>
            </div>
            <div class="fe-box">
                <img src="Assets/Images/f3.png" alt="image">
                <h6>Save Money</h6>
            </div>
    </section>

    <section class="products">
            <h2 class="title">New Arrivals</h2>
            <p class="slogan">...we love new things, don't you?</p>
        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price">Rs. <?php echo $fetch_products['price']; ?></div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
            </form>
            <?php
                    }
                }else{
                    echo '<p class="empty">No Products Added Yet!</p>';
                }
            ?>
        </div>
    </section>

    <section id="banner" class="section-m1">
            <h4>Discounted Prices</h4>
            <h2>Up to <span>50% OFF</span> on Clothing & Accessories</h2>
            <a href="shop.php" class="btn">Explore More</a>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Awesome Deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>Premium Items on Sale</span>
            <a href="shop.php" class="btn">Learn More</a>
        </div>
        <div class="banner-box banner-box2">
            <h4>Wardrobe</h4>
            <h2>All Clothing & Accessories</h2>
            <span>Just let the wardrobe do the acting</span>
            <a href="shop.php" class="btn">Learn More</a>
            
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>Have any Questions?</h3>
            <p>Feel free to leave us any query. We will respond as soon as possible</p>
            <a href="contact.php" class="btn">Contact Us</a>
        </div>
        
    </section>


    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>
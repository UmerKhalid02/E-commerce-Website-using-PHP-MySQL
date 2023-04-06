<?php
    @include 'config.php';
    session_start();

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            $row = mysqli_fetch_assoc($select_users);

            if($row['user_type'] == 'admin'){

                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');

            } elseif($row['user_type'] == 'user'){

                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            }

        }else{
            $message[] = 'Incorrect email or password';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- icons (font awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->

    <link rel="apple-touch-icon" sizes="180x180" href="../Assets/Logos/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Assets/Logos/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Assets/Logos/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sab Lay Jao | Login</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    

    <!-- php -->
    <?php
    if(isset($message))
    foreach($message as $message){
        echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fa fa-times cross" onclick="this.parentElement.remove();"></i>
            </div>
        ';
    }
    ?>


    <!-- <div class="home-button" id="home-button">
        <a href="index.html"><button class="h-button"><img src="Assets/Images/home.png" alt=""></button></a>
    </div> -->
    
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <h1>Login</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" class="social"><i class="fa fa-google"></i></a>
                    <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="submit" value="Login" class="btn">
                <!-- <button type="submit">SignUp</button> -->
            </form>
        </div>

        <div class="right-container">
            <div class="text">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </div>
    </div>
</body>
</html>
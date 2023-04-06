<?php
    @include 'config.php';

    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $user_type = $_POST['user_type'];

        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            $message[] = 'Account with this information already exists!';
        }else{
            if($pass != $cpass){
                $message[] = 'Confirm Password not Matched!';
            }else{
                mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')") or die('query failed');
                $message[] = 'Account Successfully Created';
                header('location:login.php');
            }
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
    <title>Sab Lay Jao | Register</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body>
    

    <!-- php -->
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


    <!-- <div class="home-button" id="home-button">
        <a href="index.html"><button class="h-button"><img src="Assets/Images/home.png" alt=""></button></a>
    </div> -->
    
    <div class="container" id="container">

        <div class="left-container">
            <div class="text">
                <h1>Hello, Friend!</h1>
                <p>Enter your details and start journey with us</p>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>

        <div class="form-container sign-up-container">
            <form action="" method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" class="social"><i class="fa fa-google"></i></a>
                    <a href="#" class="social"><i class="fa fa-linkedin"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="cpassword" placeholder="Confirm Password">
                
                <!-- <input type="txet" name="country" id="country" placeholder="Country"> -->
                <!-- <input type="number" name="phone-number" id="phone-number" placeholder="Phone Number"> -->

                <select name="user_type" id="user_type">
                    <option value="">-- Select user type --</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                <input type="submit" name="submit" value="SignUp" class="btn">
            </form>
        </div>
    </div>
</body>
</html>
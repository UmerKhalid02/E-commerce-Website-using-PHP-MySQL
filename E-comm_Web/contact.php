<?php
    include 'config.php';

    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location:login.php');
    }

    if(isset($_POST['send'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = $_POST['number'];
        $msg = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

        if(mysqli_num_rows($select_message) > 0){
            $message[] = 'Message has already been sent';
        }else{
            mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message)VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
            $message[] = 'Message sent successfully';
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
    <title>Sab Lay Jao | Contact</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    
    <?php include 'header.php'; ?>

    <section id="contact-details" class="section-p1">
            <div class="details">
                <h2>Visit our office or contact us today</h2>
                <h3>Head Office</h3>
                <div>
                    <li>
                        <i class="fa fa-map"></i>
                        <p>ARFA Software Technology Park, 9th Floor, Lahore</p>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>
                        <p>sablayjao@gmail.com</p>
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <p>(042) 35175517</p>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <p>Monday - Saturday: 10:00AM - 06:00PM</p>
                    </li>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3402.7605314546786!2d74.34037795104692!3d31.475772956400018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391904273c25c31d%3A0xb731313a15a5c7dd!2sArfa%20Software%20Technology%20Park%20%7C%20Cyber%20Security%20Company!5e0!3m2!1sen!2s!4v1655577968104!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

    <section class="contact">
        
        <form action="" method="post">
            <h1>LEAVE A MESSAGE</h1>
            <h2>We love to hear from you</h2>
            <input type="text" name="name" required placeholder="Enter your name" class="box">
            <input type="email" name="email" required placeholder="Enter your email" class="box">
            <input type="number" name="number" required placeholder="Enter your phone number" class="box">
            <textarea name="message" class="box" cols="30" rows="10" placeholder="Enter your message"></textarea>
            <input type="submit" value="Send Message" name="send" class="btn">
        </form>

    </section>
    


    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>
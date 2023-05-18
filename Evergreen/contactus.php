<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us</title>
        <link rel="icon" type="image/x-icon" href="./Client/images/logo.jpg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="Client/css/styles1.css?<?php echo time(); ?>">
        <link rel="stylesheet" href="Client/css/styles2.css?<?php echo time(); ?>">
        
        <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
        
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            } 
            function sideBar(){
                const checkbox = document.getElementById("check");
                if (checkbox.checked) {
                    document.getElementById("navbar").style.left="0";
                } else {
                    document.getElementById("navbar").style.left="-100%";
                }
            }

            $().ready(function(){
                $("#mailform").validate({
                    rules:{
                    
                    name:"required",
                    message:"required",
                    
                    email:{
                        required:true,
                        email:true,
                    }
                    },
                    messages:{
                    email:{
                        email:"Please enter a valid email address",
                    }
                    }
                })
            })
        </script>
    </head>
    
    
    <body>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $subject = $_POST['subject'];
    
          // Email variables
            $to = "rameshjayamanne5@gmail.com";
            $body = "Name: $name\nEmail: $email\nMessage: $message";
    
          // Send email
            mail($to, $subject, $body);
            exit;
        }
      ?>
        <div class="headernnav">
            <header>
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars"></i>
                </label>
                <div class="headertitle">EVERGREEN GRASS SUPPLIERS</div>
                <input type="checkbox" id="check" onchange="sideBar()"></input>
                <span class="checkbtn2">
                </span>
           
            </header>
            
            <nav id="navbar">
                <div class="firstitem"><a href="home.html" class="anav">HOME</a></div>
                <div class="item"><a href="aboutus.html" class="anav">ABOUT US</a></div>
                <div class="item"><a href="gallery.html" class="anav">GALLERY</a></div>
                <div class="item"><a href="shop.php" class="anav">SHOP</a></div>
                <div class="lastitem"><a href="contactus.php" class="anav active">CONTACT US</a></div>
            </nav>
        </div>

        <div class="contactus-container">
                <div class="contactus-form-container">
                <h1 class="h1-contactus">Contact Us</h1>
                <hr class="contact-us-hr">
                <form method="post" name="mailform" id="mailform">
                    Your Name<br>
                    <input type="text" name="name" id="name"></input><br>
                    Your Email<br>
                    <input type="text" name="email" id="email"></input><br>
                    Subject<br>
                    <input type="text" name="subject" id="subject"></input><br>
                    Your Message </span><br>
                    <textarea cols="10" rows="8" name="message" id="message"></textarea><br>
                    <input type="submit" name="send" value="send" value="Send"></input><br>
                </form>
                </div>
            <div class="contactus-container-image">
                <a href="tel:+94778977848" title="Call Us"><img src="Client/images/call_color.png" class="social-media-icon"></img></a>
                <a href="whatsapp://send?phone=+94778977848" title="Chat With Us"><img src="Client/images/whatsapp_color2.png" class="social-media-icon"></img></a>
                <a href="https://web.facebook.com/Evergreengrasss12" title="Follow Us"><img src="Client/images/facebook_color.png" class="social-media-icon"></img></a>
                <a href="mailto:rameshjayamanne5@gmail.com" title="Send a Mail"><img src="Client/images/gmail_color.png" class="social-media-icon"></img></a>
               
            </div>
        </div>
        
    
       
        

    </body>
    <div class="footer1">
        <div class="address">
            <p class="footerhead">EVERGREEN GRASS SUPPLIERS<br></p>
            No 12, Rajawaththa,<br>
            Pamunugama<br>
            <a href="tel:+94778977848" class="footer-mobile">077 8977848</a>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3958.926528045738!2d79.837295!3d7.1344949999999985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMDgnMDQuMiJOIDc5wrA1MCcxNC4zIkU!5e0!3m2!1sen!2slk!4v1679242201575!5m2!1sen!2slk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        </div>
    </div>

</html>
<?php
 session_start();
 require_once '../includes/User.php';
 require_once '../includes/UserDAO.php';
 require_once '../includes/UserAuth.php';
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $username=$_POST['username'];
                            $password=$_POST['password'];
                            $_SESSION["error_message"]=" ";
                            $db = new DatabaseManager();
                            $udao = new UserDAO($db);
                            $login = new UserAuth($udao);
                            if($login->login($username, $password)){
                                $admin_details=$udao->getIdByUsername($username);
                                $_SESSION["user_id"]=$admin_details["admin_id"];
                                $_SESSION["username"]=$admin_details["username"];
                                header("location:admin-edit-grass.php");
                            }else{ 
                                $_SESSION["error_message"]="Invalid Credintials";
                            }
                        }
                ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="image05.jpg">
        <link rel="stylesheet" type="text/css" href="../css/styles1-admin.css?<?php echo time(); ?>"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script>     
            if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
            }
            function validateform(){  
                var username=document.login.username.value;  
                var password=document.login.password.value;  
        
                if (username==null || username==""){
                    document.getElementById("user_info").innerHTML = "*required";
                    return false;  
                } 
                if (password==null || password==""){
                    document.getElementById("password_info").innerHTML = "*required";
                    return false;  
                } 
            } 
        </script>
    </head>

    <body>
    <div class="contactus-container">
           
            
            <form onsubmit="return validateform();" method="post" name="login">
                <h3>EVERGREEN GRASS SUPPLIERS</h3><br>
                <?php if(isset($_SESSION["error_message"])){ ?>
                <span id="error_message" name="error_message" class="danger"><?php echo $_SESSION["error_message"]; ?> </span>
                <?php 
                        unset($_SESSION["error_message"]);
                }
                ?>
                Username  <span id="user_info" style="color:red"></span>
                <input type="text" name="username" id="username"></input>
                Password  <span id="password_info" style="color:red"></span>
                <input type="password" name="password" id="password"></input>
                <input type="submit" name="submit" value="Log in"></input>
                <a href="admin_registration.php" style="color:red;">Register Here</a>
            </form>
        </div>
       
    </body>
            
</html>

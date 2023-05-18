<?php 
    session_start();
    require_once '../includes/Grass.php';
    require_once '../includes/DatabaseManager.php';
    require_once '../includes/GrassDAO.php';

    if(!isset($_SESSION["user_id"])){
        header("location:admin_login.php");
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name=$_POST['name'];
        $price=$_POST['price'];

        $grass=new Grass($name,$price);
        $db=new DatabaseManager();
        $dao=new GrassDAO($db);
        $dao->addGrass($grass);
        $_SESSION["add"] = "Added Successfully";
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Grass</title>
        <link rel="icon" type="image/x-icon" href="image05.jpg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/styles1-admin.css?<?php echo time(); ?>"/>

        
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
            $().ready(function () {
                $("#addgrass").validate({
                    rules: {
                        
                    name: "required",
                
                    price:{
                        required: true,
                        number: true,
                    },
        
                },
                messages: {
                name: "*required",
        
                price: {
                required: "*required",
                number:"You cannot input text in price field"
                },
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) { 
                    form.submit();
                }
            });
        });
        </script>
    </head>
    
    
    <body>
        
        <div class="headernnav">
            <header>
                <label for="check" class="checkbtn">
                    <i class="fas fa-bars"></i>
                </label>
                <input type="checkbox" id="check" onchange="sideBar()"></input>
                <div class="headertitle">EVERGREEN GRASS SUPPLIERS</div>
                <span class="checkbtn2">
                </span>
            </header>
            <nav id="navbar">
                <div class="firstitem"><a href="admin-edit-grass.php" class="anav">EDIT GRASS</a></div>
                <div class="item"><a href="admin-add-grass.php" class="anav active">ADD GRASS</a></div>
                <div class="item"><a href="admin-profile.php" class="anav">PROFILE</a></div>
                <div class="lastitem"><span class="anav"><?php echo $_SESSION["username"];?></span></div>
                <div class="item"><a href="admin_logout.php" class="anav">LOG OUT</a></div>  
            </nav>
        </div>

        <div class="contactus-container">
            <div>
                    <form method="post" id="addgrass" name="addgrass">
                    <h2 align="center">Add Grass</h2><br>

                    <?php 
                    if(isset($_SESSION["add"])){ ?>
                        <span class="cool"><?php echo $_SESSION["add"]; ?></span><br>
                    <?php
                        unset($_SESSION["add"]);
                    }
                    ?>
                    Name<br>
                    <input type="text" name="name" id="name"></input><br>
                    Price<br>
                    <input type="text" name="price" id="price"></input><br>
                    <input type="submit" name="add" value="Add"></input>
                </form>
              
            </div>
        </div>
        
    
       
        

    </body>

</html>
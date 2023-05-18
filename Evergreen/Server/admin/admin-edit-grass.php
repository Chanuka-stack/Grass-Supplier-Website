<?php 
    session_start();
    require_once '../includes/Grass.php';
    require_once '../includes/DatabaseManager.php';
    require_once '../includes/GrassDAO.php';
    if(!isset($_SESSION["user_id"])){
        header("location:admin_login.php");
    }
    if (isset($_POST["search"])){
        $_SESSION["id"] = $_POST["grasslist"];
     
        $db_serach_data = new DatabaseManager();
        $dao_search_data = new GrassDAO($db_serach_data);
        $search_results =$dao_search_data->getGrassById($_SESSION["id"]);

        $name = $search_results["grass_name"];
        $price = $search_results["price"];
    }
    if (isset($_POST["update"])){
        $updated_name=$_POST["name"];
        $updated_price=$_POST["price"];
        
        $db_update_data = new DatabaseManager();
        $dao_update_data = new GrassDAO($db_update_data);
        $dao_update_data=$dao_update_data->updateGrass($_SESSION["id"],$updated_name,$updated_price);
        $_SESSION["edit_message"]="Updated Successfully";
    }
    if (isset($_POST["delete"])){
        $db_delete_data = new DatabaseManager();
        $dao_delete_data = new GrassDAO($db_delete_data);
        $dao_delete_data= $dao_delete_data->deleteGrass($_SESSION["id"]);
        $_SESSION["edit_message"]="Deleted Successfully";
    }

    
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Grass</title>
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
            function confirmDeletion(){
                let text ="I CONFIRM DELETION";
                let input = prompt("To confirm deletion type I CONFIRM DELETION and press OK");
                if (input==text) {
                    return true;
                } else {
                    return false;
                }
            }

            $().ready(function () {
                $("#editgrass").validate({
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
                <div class="firstitem"><a href="admin-edit-grass.php" class="anav active">EDIT GRASS</a></div>
                <div class="item"><a href="admin-add-grass.php" class="anav">ADD GRASS</a></div>
                <div class="item"><a href="admin-profile.php" class="anav">PROFILE</a></div>
                <div class="lastitem"><span class="anav"><?php echo $_SESSION["username"];?></span></div>
                <div class="item"><a href="admin_logout.php" class="anav">LOG OUT</a></div> 
            </nav>
        </div>
        <?php
            $db = new DatabaseManager();
            $dao = new GrassDAO($db);
            $result = $dao->getAllGrass();
        ?>
        <div class="contactus-container">
            <div class="contactus-form-container">
                    <form method="post">
                        <?php 
                        if(isset($_SESSION["edit_message"])){ ?>
                            <span class="cool"><?php echo $_SESSION["edit_message"]; ?></span><br>
                        <?php
                            unset($_SESSION["edit_message"]);
                        }
                        ?>
                        <h2 align="center">Edit Grass</h2><br>
                        Select Grass Type<br>
                        <select name="grasslist" id="grassid">
                            <?php
                            for($i=0;$i<count($result);$i++){ ?>
                                <option value="<?php echo $result[$i]["grass_id"];?>"><?php echo $result[$i]["grass_name"];?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                        <input type="submit" name="search" value="Search"></input>
                    </form>
                    <?php if(isset($name)) { ?>
                    <form method="post" name="editgrass" id="editgrass">
                        Name<br>
                        <input type="text" name="name" id="name" value="<?php echo $name;?>"></input><br>
                        Price<br>
                        <input type="text" name="price" id="price" value="<?php echo $price;?>"></input><br>
                        <input type="submit" name="update" value="Update"></input>
                    </form> 
                    <form method="post" onsubmit="return confirmDeletion()">
                        <input type="submit" name="delete" value="Delete" style="background:#E70045; border:1px solid #E70045;"></input>
                    </form>
                    <?php } ?>
                    
            </div>
        </div>
        
    
       
        

    </body>


</html>
<?php
    require_once './Server/includes/GrassDAO.php';
    require_once './Server/includes/DatabaseManager.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop</title>
        <link rel="icon" type="image/x-icon" href="./Client/images/logo.jpg">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="Client/css/styles1.css?<?php echo time(); ?>">
        <link rel="stylesheet" href="Client/css/styles2.css?<?php echo time(); ?>">
        <script>
            function sideBar(){
                const checkbox = document.getElementById("check");
                if (checkbox.checked) {
                    document.getElementById("navbar").style.left="0";
                } else {
                    document.getElementById("navbar").style.left="-100%";
                }
            }
        </script>
    </head>
    
    
    <body>
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
                <div class="item"><a href="shop.php" class="anav active">SHOP</a></div>
                <div class="lastitem"><a href="contactus.php" class="anav">CONTACT US</a></div>
            </nav>
        </div>
        <?php
            $db = new DatabaseManager();
            $dao = new GrassDAO($db);
            $result = $dao->getAllGrass();
        
         for($i=0;$i<count($result);$i++){ ?>
        <div class="shop-pricebar">
            <img src="Client/images/mal_grass1.jpg" class="shop-price-image"></img>
            <div class="shop-price-text">
                <div class="shop-price-text-center">
                    <h1 class="shop-h1"><?php echo $result[$i]["grass_name"];?> Grass</h1> 
                    <p class="p-shop3">1 square feet : Rs <?php echo $result[$i]["price"];?></p>
                </div>
            </div>
        </div>
        <?php
         }
         ?>
        <div class="shop-carpet-container">
            
            <p class="p-shop2">We are supplying <b>5</b> feet length and <b>2</b> feet width grass carpets. Then the area of one grass carpet is <b>10</b> square feet.</p>
            <div class="shop-carpetbar">
                <img src="./Client/images/carpet_area6.svg" class="shop-carpet-image"></img>
                <div class="shop-carpetbar-text">
                    <div class="shop-carpetbar-text-center">
                    <?php  
                        for($i=0;$i<count($result);$i++){ ?>
                        <p class="p-shop">Price of the one <?php echo $result[$i]["grass_name"];?> grass carpet : Rs <?php echo $result[$i]["price"]*10;?></p>
                       <?php
                        }
                        ?>
                    </div>
                </div>
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
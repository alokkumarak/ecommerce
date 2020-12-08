<?php
require("connection.inc.php");
require("functions.inc.php");
require("add_to_cart.inc.php");
$cat_res=mysqli_query($con,"SELECT * FROM categories WHERE status=1 ORDER BY id desc");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[]=$row;
}

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Amazon</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" type="image/x-icon" href="images/amazon.png">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/core.css">

    <link rel="stylesheet" href="css/shortcode/shortcodes.css">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" href="css/custom.css">


    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <div class="wrapper">

        <header id="htc__header" class="htc__header__area header--one">

            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.php"><img src="images/amazon.png" alt="logo images" width="50px" height="50px">amazon.in</a>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                         <?php 
                                           foreach($cat_arr as $list){  ?>
                                           <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a></li>
                                               

                                               <?php
                                               }    
                                         ?>
                                        
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php 
                                           foreach($cat_arr as $list){  ?>
                                           <li><a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a></li>
                                               

                                               <?php
                                               }    
                                         ?>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                                <div class="header__right">
                                <div class="header__account">
                                      <?php if(isset($_SESSION['USER_LOGIN'])){
                                          echo '<div class="user-area dropdown float-right">
                                          <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">welcome</a>
                                          <div class="user-menu dropdown-menu">
                                             <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a><br><br>
                                             <a href="myorder.php" title="my order" ><i class="icon-handbag icons"></i>My Order</a>
                                          </div>
                                       </div>
                                          ';
                                      }else{
                                          echo '<a href="login.php" title="login/register"><i class="icon-user icons"></i></a>';
                                      } ?>

                                        

                                    </div>
                                    <div class="header__account">
                                        <a href="contact.php" title="Contact Us"><i class="icon-phone icons"></i></a>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php" title="cart"><span class="htc__qua"><?php echo $totalProduct; ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>

        </header>
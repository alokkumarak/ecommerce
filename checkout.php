<?php
require("top.inc.php");

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php';
    </script>

<?php
}

$cart_subtotal=0;
$tax=0;
$cart_total=0;

foreach ($_SESSION['cart'] as $key => $val) {

    $productArr = get_product($con, '', '', $key);
   
    $price = $productArr[0]['price'];
   
    $qty = $val['qty'];
    $cart_subtotal += $price * $qty;
    $tax += ceil(($price * $qty) / 90);
    $cart_total = $cart_subtotal + $tax;
}

if(isset($_POST['submit'])){

  $address=get_safe_value($con,$_POST['address']);
  $city=get_safe_value($con,$_POST['city']);
  $pincode=get_safe_value($con,$_POST['pincode']);
  $payment_type='COD';
  $user_id=$_SESSION['USER_ID'];
  $total_price=$cart_total;
  $payment_status='pending';
  if($payment_type=='COD'){
    $payment_status='success';
  }
  $order_status='1';
  $added_on=date('y-m-d h:i:s');

  mysqli_query($con,"INSERT INTO `order`(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on)
   VALUES('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");


   $order_id=mysqli_insert_id($con);
   foreach ($_SESSION['cart'] as $key => $val) {
    $productArr = get_product($con, '', '', $key);
    $price = $productArr[0]['price'];
    $qty = $val['qty'];
  
    mysqli_query($con,"INSERT INTO `order_detail`(order_id,product_id,qty,price) VALUES('$order_id','$key','$qty','$price')");
}
    unset($_SESSION['cart']);

    ?>
       <script>
           window.location.href='thankyou.php';
       </script>
    <?php

   
  



}
?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.png) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <?php if (!isset($_SESSION['USER_LOGIN'])) { ?>
                                <div class="alert alert-danger"><b>You are not Logged in..!!!</b><br>Login first, OtherWise your order will be <b>Rejected</b>***</div>
                                <div class="accordion__title">
                                    Checkout Method
                                </div>

                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="contact-form-wrap mt--60">
                                                    <div class="col-xs-12">
                                                        <div class="contact-title">
                                                            <h2 class="title__line--6">Login</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <form id="login-form" method="post">
                                                            <div class="single-contact-form">
                                                                <div class="contact-box name">
                                                                    <input type="text" name="login_name" id="login_email" placeholder="Your Email*" style="width:100%">
                                                                </div>
                                                                <span class="field_error" id="login_email_error"></span>
                                                            </div>
                                                            <div class="single-contact-form">
                                                                <div class="contact-box name">
                                                                    <input type="password" name="login_password" id="login_password" placeholder="Your Password*" style="width:100%">
                                                                </div>
                                                                <span class="field_error" id="login_password_error"></span>
                                                            </div>

                                                            <div class="contact-btn">
                                                                <button type="button" onclick="user_login()" class="fv-btn">Login</button>
                                                            </div>
                                                        </form>
                                                        <div class="form-output login_msg">
                                                            <p class="form-messege"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="contact-form-wrap mt--60">
                                                    <div class="col-xs-12">
                                                        <div class="contact-title">
                                                            <h2 class="title__line--6">Register</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <form id="register-form" method="post">
                                                            <div class="single-contact-form">
                                                                <div class="contact-box name">
                                                                    <input type="text" id="name" name="name" placeholder="Your Name*" style="width:100%">

                                                                </div>
                                                                <span class="field_error " id="name_error"></span>
                                                            </div>
                                                            <div class="single-contact-form">
                                                                <div class="contact-box name">
                                                                    <input type="email" id="email" name="email" placeholder="Your Email*" style="width:100%">
                                                                </div>
                                                                <span class="field_error" id="email_error"></span>

                                                            </div>
                                                            <div class="single-contact-form">
                                                                <div class="contact-box name">
                                                                    <input type="number" id="mobile" name="mobile" placeholder="Your Mobile*" style="width:100%">
                                                                </div>
                                                                <span class="field_error" id="mobile_error"></span>

                                                            </div>
                                                            <div class="single-contact-form">
                                                                <div class="contact-box name">
                                                                    <input type="password" id="password" name="password" placeholder="Your Password*" style="width:100%">
                                                                </div>
                                                                <span class="field_error" id="password_error"></span>

                                                            </div>

                                                            <div class="contact-btn">
                                                                <button type="button" class="fv-btn" onclick="user_register()">Register</button>
                                                            </div>
                                                        </form>
                                                        <div class="form-output register_msg">
                                                            <p class="form-messege "></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <form method="post">
                            <div class="accordion__title">
                                Address Information
                            </div>
                            
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" name="address" placeholder="Street Address" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="city" placeholder="City/State" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                      
                                    </div>
                                </div>
                                <div class="accordion__title">
                                    payment information
                                </div>
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            <i class="zmdi zmdi-long-arrow-right"></i> COD &nbsp;&nbsp;<input type="radio" name="payment_type" value="COD" />

                                        </div>
                                        <div class="single-method">
                                            <i class="zmdi zmdi-long-arrow-right"></i> PayU &nbsp; <input type="radio" name="payment_type" value="PayU" />
                                        </div>
                                        <div class="single-method">
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <input type="submit" name="submit" />
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>

                    <div class="order-details__item">
                        <?php
                        $cart_subtotal = 0;
                        $cart_total = 0;
                        $tax = 0;

                        foreach ($_SESSION['cart'] as $key => $val) {
                            $productArr = get_product($con, '', '', $key);
                            $pname = $productArr[0]['name'];
                            $price = $productArr[0]['price'];
                            $image = $productArr[0]['image'];
                            $qty = $val['qty'];
                            $cart_subtotal += $price * $qty;
                            $tax += ceil(($price * $qty) / 90);
                            $cart_total = $cart_subtotal + $tax;


                        ?>


                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo $pname ?></a>
                                    <span class="price">rs. <?php echo $price * $qty ?></span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>

                        <?php  } ?>

                    </div>
                    <div class="order-details__count">

                        <div class="order-details__count__single">
                            <h5>sub total</h5>
                            <span class="price">Rs. <?php echo $cart_subtotal;  ?></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Tax</h5>
                            <span class="price">Rs. <?php echo $tax; ?></span>
                        </div>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price">Rs. <?php echo $cart_total; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function user_register() {
        jQuery('.field_error').html('');
        var name = jQuery("#name").val();
        var email = jQuery("#email").val();
        var mobile = jQuery("#mobile").val();
        var password = jQuery("#password").val();
        var is_error = '';

        if (name == '') {
            jQuery('#name_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your Name !</div>");
            is_error = 'yes';
        }
        if (email == '') {
            jQuery('#email_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your Email Address !</div>");
            is_error = 'yes';
        }
        if (mobile == '') {
            jQuery('#mobile_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your mobile number !</div>");
            is_error = 'yes';
        }
        if (password == '') {
            jQuery('#password_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter password !</div>");
            is_error = 'yes';
        }
        if (is_error == '') {
            jQuery.ajax({
                url: 'register_submit.php',
                type: 'post',
                data: '&name=' + name + '&email=' + email + '&mobile=' + mobile + '&password=' + password,
                success: function(result) {
                    if (result == 'present') {
                        jQuery('#email_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Email ID already exist !!</div>");
                    }
                    if (result == 'success') {
                        jQuery('.register_msg p').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Successfully Register..Now login to place your order</div>");
                    }

                }
            })
        }

    }


    function user_login() {
        jQuery('.field_error').html('');

        var email = jQuery("#login_email").val();
        var password = jQuery("#login_password").val();
        var is_error = '';


        if (email == '') {
            jQuery('#login_email_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your Email Address !</div>");
            is_error = 'yes';
        }

        if (password == '') {
            jQuery('#login_password_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter password !</div>");
            is_error = 'yes';
        }
        if (is_error == '') {
            jQuery.ajax({
                url: 'login_submit.php',
                type: 'post',
                data: '&email=' + email + '&password=' + password,
                success: function(result) {
                    if (result == 'wrong') {
                        jQuery('.login_msg p').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please enter valid login details</div>");
                    }
                    if (result == 'valid') {
                        window.location.href = 'checkout.php';
                    }

                }
            })
        }

    }
</script>

<?php
require("footer.inc.php");
?>
<?php

require("top.inc.php");

?>
   <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.png) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Login/register</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<div class="contact-form-wrap mt--60">
							<div class="col-xs-12">
								<div class="contact-title">
									<h2 class="title__line--6">Login</h2>
								</div>
							</div>
							<div class="col-xs-12">
								<form id="login-form"  method="post">
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
        </section>

		<script>
		
function user_register(){
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
	var password=jQuery("#password").val();
	var is_error='';

    if(name==''){
        jQuery('#name_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your Name !</div>");
        is_error='yes';
    }
    if(email==''){
		jQuery('#email_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your Email Address !</div>");
		is_error='yes';
    }
     if(mobile==''){
		jQuery('#mobile_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your mobile number !</div>");
		is_error='yes';
    }
     if(password==''){
		jQuery('#password_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter password !</div>");
		is_error='yes';
    }
    if(is_error ==''){
        jQuery.ajax({
            url:'register_submit.php',
            type:'post',
            data:'&name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success:function(result){
               if(result=='present'){
				   jQuery('#email_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Email ID already exist !!</div>");
			   }
			   if(result=='success'){
				   jQuery('.register_msg p').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Successfully Register..</div>");
			   }
			   
            }
        })
    }
    
}

		
function user_login(){
	jQuery('.field_error').html('');

    var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';

    
    if(email==''){
		jQuery('#login_email_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter Your Email Address !</div>");
		is_error='yes';
    }
   
     if(password==''){
		jQuery('#login_password_error').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please Enter password !</div>");
		is_error='yes';
    }
    if(is_error ==''){
        jQuery.ajax({
            url:'login_submit.php',
            type:'post',
            data:'&email='+email+'&password='+password,
            success:function(result){
               if(result=='wrong'){
				   jQuery('.login_msg p').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'><i class='icon-close icons'></i></button>Please enter valid login details</div>");
			   }
			   if(result=='valid'){
				   window.location.href='index.php';
			   }
			   
            }
        })
    }
    
}

</script>

<?php
require("footer.inc.php");
?>
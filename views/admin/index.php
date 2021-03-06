
<!DOCTYPE html>
<html lang="en">
  

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Theme Region">
   	<meta name="description" content="">

    <title>Admin Swapiee</title>

   <!-- CSS -->
    <?= link_tag('assets/css/bootstrap.min.css');?>
    
    <?= link_tag('assets/css/main.css');?>
	
    <?= link_tag('assets/css/responsive.css');?>
	
	<!-- font -->
	
	<!-- icons -->
	

	<!-- icons -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Template Developed By LAboO -->
  </head>
  <body>
	<!-- header -->
	<?php include('inc/header.php'); ?>
	<!-- header -->

	<!-- signin-page -->
	<section id="main" class="clearfix user-page">
		<div class="container">
			<div class="row text-center">
				<!-- user-login -->			
				<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
					<div class="user-account">
						<h2>Admin Login</h2>
						<!-- form -->
						<?= form_open(base_url(''),['id'=>'frm_adminsignin','name'=>'frm_adminsignin']) ?>
							<div class="form-group"> <span id="err_txt_mobno" class="erro_msg"></span>
								<input type="text" class="form-control" placeholder="Mobile Number" name="txt_mobno" id="txt_mobno" onkeyup="fun_remove_error_message('txt_mobno','err_txt_mobno');" onkeypress="return fun_number_validate(event, this);" autofocus="on">

							</div>
							<div class="form-group"> <span id="err_txt_password" class="erro_msg"></span>
								<input type="password" class="form-control" placeholder="Password" name="txt_password" id="txt_password" onkeyup="fun_remove_error_message('txt_password','err_txt_password');" >
							</div>
                            
							<button type="button" href="JavaScript:void(0);" id="btn_login" class="btn">Login <i id="loader_signin" class="fa fa-spinner fa-spin hide"></i></button><br>
                        
                           
							 <input type="hidden" name="city" id="city" />
		                     <input type="hidden" name="state" id="state" />
		                     <input type="hidden" name="country" id="country" />  	



						<?= form_close(); ?><!-- form -->
					
						<!-- forgot-password -->
						<!-- <div class="user-option">
							<div class="checkbox pull-left">
								<label for="logged"><input type="checkbox" name="logged" id="logged"> Keep me logged in </label>
							</div>
							<div class="pull-right forgot-password">
								<a href="#">Forgot password</a>
							</div>
						</div> --><!-- forgot-password -->
					</div>
                    
				</div><!-- user-login -->			
			</div><!-- row -->	
		</div><!-- container -->
	</section><!-- signin-page -->
	
	<!-- footer -->
	<?php //include('inc/footer.php'); ?>
	<!-- footer -->

	<!--/Preset Style Chooser--> 
	
	<!--/End:Preset Style Chooser-->
	
     <!-- JS -->
    <script src="<?= base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?= base_url('assets/js/modernizr.min.js');?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
    <script src="<?= base_url('assets/js/admin_common.js');?>"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<!----<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-73239902-1', 'auto');
	  ga('send', 'pageview');             </script>---->

 <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    
 <script language="Javascript"> 
 window.onload = function() {
    //document.write("Welcome to our visitors from "+geoplugin_city()+","+geoplugin_region()+", "+geoplugin_countryName()); 
    document.getElementById("city").value = geoplugin_city();
    document.getElementById("state").value = geoplugin_region();
    document.getElementById("country").value = geoplugin_countryName();
 };



$(document).ready(function(){

	$("#btn_login").click(function(){
		fun_admin_login();
	});
	$("#txt_password").keydown(function(e){
		if(e.keyCode == 13)
		{
			fun_admin_login();
		}	
	});
});

function fun_admin_login()
{
	var mob_no = $("#txt_mobno").val();
		var password = $("#txt_password").val();
		 var m_no=/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;;
		if(mob_no == '')
		{
			$("#err_txt_mobno").text("Enter mobile no.");
			$("#txt_mobno").addClass('error_control');
			$("#txt_mobno").focus();
			return false;
		}	
	 	if(!m_no.test(mob_no))
        {                      
             $("#err_txt_mobno").text("Enter The Valid Mobile No....");
             $("#txt_mobno").addClass('error_control');
               $("#txt_mobno").focus();
               $("#txt_mobno").val('');
              return false;
        }
        if(password == '')
        {
        	$("#err_txt_password").text('Enter Password');
        	$("#txt_password").addClass('error_control');
        	$("#txt_password").focus();
        	return false;
        }
        else
        {
        	$("#loader_signin").removeClass('hide');
        	var form = document.getElementById('frm_adminsignin');
        	var formdata = new FormData(form);
        	$.ajax({
        		url:base_url+'c_ajax_admin/admin_login',
        		data:formdata,
        		type:'POST',
        		contentType:false,
        		cache:false,
        		processData:false,
        		success:function(data)
        		{
        			//alert(data);
        			 if(data == 1)
                    {

	                      $("#loader_signin").addClass('hide'); 
    	                  window.location.href=base_url+"siteadmin/home";
                    }
                    else
                    {
	      	               $('#err_txt_mobno').text(data);
            	           $("#loader_signin").addClass('hide');
                	       document.getElementById('txt_password').value = '';
                    	   return false;
                    }
        		}

        	});



        }

}

  </script>




  </body>


</html>
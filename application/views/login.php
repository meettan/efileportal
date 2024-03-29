<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">	
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/apps.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/apps_inner.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/res.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>	
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
<!--font-family: 'Roboto', sans-serif;-->
<link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&display=swap" rel="stylesheet"> 
<!--font-family: 'Gorditas', cursive;-->
</head>
<body>
<div class="loginmainDiv">
  <div class="loginBox">
	<div class="adminLogo"><img src="<?=base_url()?>assets/images/confed.jpg" alt=""/></div>
  <?php if ($this->session->flashdata('error') != ''):   ?>
    <div class="alert alert-danger alert-dismissible">
       
        <button type="button" class="close" data-dismiss="alert">&times;</button>
     
             <?php  echo $this->session->flashdata('error');  ?>
    </div>
   <?php endif; ?>
   <?php if ($this->session->flashdata('success') != ''):   ?>
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php  echo $this->session->flashdata('success');  ?>
    </div>
   <?php endif; ?>
	 <div class="fieldSec">
	    <form action="<?=base_url()?>index.php/auth" method="POST">

            <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="user_id" placeholder="Username" name="user_id">
                </div>
                <div class="form-group">
                  <input type="password" name="user_pwd" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                
                <div class="form-group">
                  <div class="row rowLoginPagBtn">
                      <?php /*?><div class="col-md-3">
                        <button class="captureImgCus"><?php echo $word //echo $image; ?></button>
                      </div> 
                      <div class="col-md-3">
                        <button class="captureBtn" onClick="window.location.reload();"> Refresh</button>
                      </div>   
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="captcha" placeholder="captcha" >
                      </div><?php */?>
                      
                      
                        <button class="captureImgCus"><?php echo $word //echo $image; ?></button>
                      
                      
                        <button class="captureBtn" onClick="window.location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>
</button>
                      
                        <input type="text" class="form-control" name="captcha" placeholder="captcha" >
                      
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" value="Submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                </div>
               <!--  <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->

              </form>
		</div>
        <div class="loginBotomTxt">
    <p>Not a account <a href="<?php echo base_url();?>index.php/auth/register/">Register</a> | <a href="<?php echo base_url();?>index.php/auth/forgotpass/">Forgot Password </a></p>
    </div>
  </div>
</div>
	
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );	
</script>

<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/main_javascript.js"></script>
<script src="<?=base_url()?>assets/js/main_jquery.js"></script>
</body>
</html>

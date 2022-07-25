<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>
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
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>	
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
<!--font-family: 'Roboto', sans-serif;-->
<link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

<!--font-family: 'Gorditas', cursive;-->
</head>
<body>
<div class="loginmainDiv">
  <div class="loginBox">
	<div class="adminLogo">
    <h2 class="loginTitle">Register</h2>
  </div>
    <?php if ($this->session->flashdata('success') != ''):   ?>
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <?php  echo $this->session->flashdata('success');  ?>
    </div>
   <?php endif; ?>
	 <div class="fieldSec">
    <div class="signup-form">
    <form action="<?=base_url()?>index.php/auth/register/" method="POST" id="regforms" autocomplete="off" onsubmit="myFunction()" >
    
       <div class="form-group">
        <div class="row">
          <div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
          <div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" ></div>
       </div>          
       </div>
       <div class="form-group">
        <div class="row">
          <div class="col"><input type="number" class="form-control" name="phone_no" placeholder="Phone Number" required="required" id='phno'></div>
          <div class="col"><input type="email" class="form-control" name="email" placeholder="Email" id='email' autocomplete="off"></div>
       </div>          
       </div>
       <div class="form-group">
        <div class="row">
          <div class="col"><select name="dept"  class="form-control" required>
            <option value="">Select Department</option>
            <?php foreach($dept as $key) { ?>
            <option value="<?=$key->sl_no?>"><?=$key->department_name?></option>
            <?php } ?>
          </select></div>
           <div class="col"><input type="text" class="form-control" name="desig" placeholder="Designation" ></div>
       </div>          
       </div>
       <div class="form-group">
        <div class="row">
          <div class="col"><input type="password" class="form-control" name="user_pwd" placeholder="Password" required="required" id='psw' onchange="return validatePassword()"></div>
           <div class="col"> <input type="password" class="form-control" name="conf_pwd" placeholder="Confirm Password" required="required"  id='psw1'></div>
       </div>          
       </div>
       <div class="form-group">
       <div class="row">
          <div class="col-md-3">
                        <button style='width:100px!important;height:50px!important;border: 2px solid #0000FF;'><?php echo $word //echo $image; ?></button>
                      </div> 
                      <div class="col-md-3">
                        <button class="captureBtn" onClick="window.location.reload();"> Refresh</button>
                      </div>  
          <div class="col"><input type="text" class="form-control" name="captcha" placeholder="captcha" ></div>
       </div>
       </div>
        <div class="form-group">
      <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
    </div>
    <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
  <div class="text-center">Already have an account? <a href="<?php echo base_url();?>">Sign in</a></div>
</div>     
		</div>
  </div>
</div>
	
<script>
	
</script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/main_javascript.js"></script>
<script src="<?=base_url()?>assets/js/main_jquery.js"></script>


<script>
  $( document ).ready(function() {
    $('#psw').val('');
});
toastr.clear();
toastr.options = {
"closeButton": true,
"debug": false,
"newestOnTop": true,
"progressBar": true,
"positionClass": "toast-bottom-center",
"preventDuplicates": true,
"showDuration": "1000",
"hideDuration": "10000",
"timeOut": "10000",
"extendedTimeOut": "1000"
};

function myFunction(){
    var password = $("#psw").val()
    var password1 = $("#psw1").val()
    var pswlen = password.length;
    var mobNum = $("#phno").val();
    var filter = /^\d*(?:\.\d{1,2})?$/;

        if(filter.test(mobNum)) {
            if(mobNum.length==10){
              } 
              else{
                alert('Please put 10  digit mobile number');
                event.preventDefault();
            }
        }
        else {
            alert('Not a valid number');
            event.preventDefault();
        }

        if(pswlen < 6) {
            alert('minmum  6 characters needed')
            event.preventDefault();
        }else if(password.search(/[0-9]/) < 0){

          alert("Your password must contain at least one digit.")
          event.preventDefault()
        }
        else if(password != password1){
                alert('Password is not same');
                event.preventDefault()
        }
}
      $("#phno1").on("change", function() {
        
        Swal.fire({
          //title: "Alert Set on Timer",
          text: "This alert will Display message.",
          position: "bottom",
          //backdrop: "linear-gradient(yellow, orange)",
          background: "black",
          showCloseButton: true,
          showCancelButton: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
          showConfirmButton: false,
          showCancelButton: false,
        // timer: 10000
        });
      });

  $(document).ready(function() {
    $("#phno").on("change", function() {
      $.ajax({
              type: "POST",
              url: '<?=base_url()?>index.php/auth/phnumber_check/',
              data: {pnnumber:$(this).val()},
              success: function(response)
              {
                  //var jsonData = JSON.parse(response);
                  if (response > "0")
                  {
                    $('#phno').val('');
                    Swal.fire({
                      title: "<h5 style='color:red'>Phone number already Exist.</h5>",
                      showCloseButton: true,
                      showCancelButton: true,
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowEnterKey: false,
                      showConfirmButton: false,
                      showCancelButton: false,
                    })
                   
                  }
                  else
                  {
                    
                      //alert('valid Credentials!');
                      //toastr.success('The process has been saved.', 'Success');
                      //toastr.success('<em class="ti ti-check toast-message-icon"></em>'+'The process has been saved');
                  }
              }
        });
    })
      $('#regform').submit(function(e) {
          e.preventDefault();
          $.ajax({
              type: "POST",
              url: '<?=base_url()?>index.php/auth/register/',
              data: $(this).serialize(),
              success: function(response)
              {
                Swal.fire({
                      //title: "Alert Set on Timer",
                      text: response,
                      position: "middle",
                      //backdrop: "linear-gradient(yellow, orange)",
                      background: "white",
                      showCloseButton: true,
                      showCancelButton: true,
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowEnterKey: false,
                      showConfirmButton: false,
                      showCancelButton: false,
                      //timer: 10000
                    });
            }
        });
      });
  });

  function validatePassword() {
    var p = document.getElementById('psw').value,
        errors = [];
    if (p.length < 6) {
        errors.push("Your password must be at least 6 characters"); 
    }
    if (p.search(/[a-z]/i) < 0) {
        errors.push("Your password must contain at least one letter.");
        document.getElementById("psw").value = '';
    }
    if (p.search(/[0-9]/) < 0) {
        errors.push("Your password must contain at least one digit.");
        document.getElementById("psw").value = '';
    }
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }
    return true;
  }
</script>

<script>
  $('#email').on('change', function(){
    
    $.ajax({
      url:'<?= base_url() ?>index.php/auth/email_check',
      type:'POST',
      data:{email: $(this).val()},
      success:function(data){
        if(data > 0){
          Swal.fire({
                      title: "<h5 style='color:red'>This email is registered already!</h5>",
                      showCloseButton: true,
                      showCancelButton: true,
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowEnterKey: false,
                      showConfirmButton: false,
                      showCancelButton: false,
                    });
         
          $('#email').val('');
          
          return false;
        }else{
          return true
        }
      }
    })
  })
</script>         
</body>
</html>
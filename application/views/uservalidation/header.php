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
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>-->	
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&display=swap" rel="stylesheet"> 
</head>

<body>
<nav class="navBar fixed-top">
	<div class="float-left logo"><img src="<?=base_url()?>assets/images/confed.jpg" alt="" style='height:50px' /></div>
	<div class="float-left navRightSec">		
		<ul class="topDate">
<li>Branch Name: Head Office</li> <li>KMS Year: 2020-21</li> <li>User: synergic</li> 
</ul>	
		<ul class="nav topDateRight">
            </ul>
</div>
	
	</div>
</nav>
	
<div class="page-body-wrapper">
	<nav class="sidebar sidebar-offcanvas" id="sidebar">
		
		<ul id="accordion" class="accordion">
  <li>
    <div class="link"><a href="<?php echo base_url();?>index.php/verify/"><i class="fa fa-tachometer"></i>Dashboard</a></div>
  </li>

	<li>
	<div class="link"><a href="<?php echo base_url();?>index.php/auth/logout/"><i class="fa fa-sign-out"></i>Log out</a></div>
	</li>
</ul>
		
</nav>
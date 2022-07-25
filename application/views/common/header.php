<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="<?php echo base_url("/confed.jpg"); ?>">
<title>Confed Efile management</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">	
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/apps.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/apps_inner.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/res.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
<!--font-family: 'Roboto', sans-serif;-->
<link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&display=swap" rel="stylesheet"> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
<!-- <script src="<?=base_url()?>ckeditor_basic/ckeditor.js"></script> -->
</head>

<body>
<nav class="navBar fixed-top">
	<div class="float-left logo"><img src="<?=base_url()?>assets/images/confed.jpg" alt="" style='height:50px'/></div>
	<div class="float-left navRightSec">		
		<ul class="topDate">
 <li>Financial Year: 2022-23</li> <li>User: <?php  if($this->session->userdata('uloggedin')->first_name) echo ucfirst($this->session->userdata('uloggedin')->first_name); ?></li> 
 <!-- <li>Module: Paddy Procurement</li> -->
</ul>
<!--
		<ul class="topDateRoght">
 <li>User: synergic</li> <li>Module: Paddy Procurement</li>
</ul>
-->
		<ul class="nav topDateRight">
			<!-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                </li> -->
			          <!-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Main Menu 1</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">Dropdown Menu 1</a>
                        <a href="#" class="dropdown-item">Dropdown Menu 2</a>
                      <a href="#" class="dropdown-item">Dropdown Menu 3</a>
                      <a href="#" class="dropdown-item">Dropdown Menu 4</a>
                    </div>
                </li> -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="fa fa-bell" aria-hidden="true"></i> Notification</a>
                </li>
      </ul>
</div>

<!--
	<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fa fa-bars"></span>
      </button>
-->
</div>
</nav>
<div class="page-body-wrapper">
	<nav class="sidebar sidebar-offcanvas" id="sidebar">
		<ul id="accordion" class="accordion">
  <li>
  <div class="link"><a href="<?=base_url()?>index.php/auth/dashboard"><i class="fa fa-tachometer"></i>Dashboard</a></div>
  </li>
  <?php if($this->session->userdata('uloggedin')->designation != 'CEO') { ?>
  <li>
    <div class="link"><a href="<?=base_url()?>index.php/dispach/"><i class="fa fa-code"></i>Docket No </a></div>
  </li>
  <!-- <li>
    <div class="link"><a href="<?=base_url()?>index.php/dispach/upload/"><i class="fa fa-code"></i>Upload </a></div>
  </li> -->
	<li>
	<div class="link"><a href="<?=base_url()?>index.php/dispach/forward"><i class="fa fa-code"></i>Forward </a></div>
	</li>
	<li>
	<div class="link"><a href="<?=base_url()?>index.php/dispach/searchdoc"><i class="fa fa-code"></i>Search</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/"><i class="fa fa-code"></i>Forwarded Docket</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/file"><i class="fa fa-code"></i>File</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/forwarded_file"><i class="fa fa-code"></i>Forwarded File</a></div>
	</li>
  
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/file_track"><i class="fa fa-code"></i>Received File</a></div>
	</li>
  <?php } ?>
  <?php if($this->session->userdata('uloggedin')->designation == 'CEO') { ?>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/ceo/"><i class="fa fa-code"></i>File Operation</a></div>
	</li>
  <?php }?>
  <li>
	 <div class="link"><a href="<?=base_url()?>index.php/file_history/"><i class="fa fa-code"></i>File history</a></div>
	</li>
  <li>
	 <div class="link"><a href="<?=base_url()?>index.php/auth/logout/"><i class="fa fa-code"></i>Logout</a></div>
	</li>
  <!--<li>
      <div class="link"><i class="fa fa-mobile"></i>Dropdown 1<i class="fa fa-chevron-down"></i></div>
      <ul class="submenu">
        <li><a href="#">Menu 1</a></li>
        <li><a href="#">Menu 2</a></li>
        <li><a href="#">Menu 3</a></li>
      </ul>
  </li> -->
 
</ul>
		
        <!--<ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">
              <i class="fa fa-tachometer" aria-hidden="true"></i>
              <span class="menu-title">Dashboard</span>
				<i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>

            </a>
          </li>
			
          <li class="nav-item">
            <a class="nav-link" href="publisher_management.html">
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
              <span class="menu-title">Publisher Management</span>
				<i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>
            </a>
          </li>
			<li class="nav-item">
            <a class="nav-link" href="user_management.html">
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
              <span class="menu-title">User Management</span>
				<i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="category.html">
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
              <span class="menu-title">Category</span>
              <i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sub_category.html">
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
              <span class="menu-title">Sub-Category</span>
              <i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all_books.html">
              <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
              <span class="menu-title">All Books</span>
              <i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>
            </a>
			</li>
			<li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <span class="menu-title">Log out</span>
              <i class="fa fa-chevron-right arowRight" aria-hidden="true"></i>
            </a>
			</li>
        </ul>-->
    </nav>
    <div class="main-panel"  id='ajaxview'>
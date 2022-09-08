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
		<?php /*?><ul class="topDate">
 <li>Financial Year: 2022-23</li> <li>User: <?php  if($this->session->userdata('uloggedin')->first_name) echo ucfirst($this->session->userdata('uloggedin')->first_name); ?></li> 
 <!-- <li>Module: Paddy Procurement</li> -->
</ul><?php */?>

<ul class="topDate">
 <li class="topHomeTitle">Home</li> 
 <!-- <li>Module: Paddy Procurement</li> -->
</ul>
<!--
		<ul class="topDateRoght">
 <li>User: synergic</li> <li>Module: Paddy Procurement</li>
</ul>
-->
		<ul class="nav topDateRight">
        <li class="searchBox"><input name="" type="search" placeholder="Search"></li>
			 <?php /*?><li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                </li> 
			           <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Main Menu 1</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">Dropdown Menu 1</a>
                        <a href="#" class="dropdown-item">Dropdown Menu 2</a>
                      <a href="#" class="dropdown-item">Dropdown Menu 3</a>
                      <a href="#" class="dropdown-item">Dropdown Menu 4</a>
                    </div>
                </li> 
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link"><i class="fa fa-bell" aria-hidden="true"></i> Notification</a>
                </li><?php */?>
                <li class="nav-item dropdown">
                    <a href="#" class="avatarTopNav" data-toggle="dropdown"><?php  if($this->session->userdata('uloggedin')->first_name) echo ucfirst($this->session->userdata('uloggedin')->first_name); ?></a>
                    <div class="dropdown-menu dropdown-menu-right dropdownCustomRight">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#userModal">My Settings…</a>
                       <!-- <a href="#" class="dropdown-item">Dropdown Menu 2</a>
                      <a href="#" class="dropdown-item">Dropdown Menu 3</a>
                      <a href="#" class="dropdown-item">Dropdown Menu 4</a>-->
                    </div>
                    
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
  <li class="dividerLine_top">
    <div class="link"><a href="<?=base_url()?>index.php/dispach/"><i class="fa fa-phone"></i>Docket No </a></div>
  </li>
  <!-- <li>
    <div class="link"><a href="<?=base_url()?>index.php/dispach/upload/"><i class="fa fa-code"></i>Upload </a></div>
  </li> -->
	<li>
	<div class="link"><a href="<?=base_url()?>index.php/dispach/forward"><i class="fa fa-share"></i>Docket Forward </a></div>
	</li>
	<li class="dividerLine_Bot">
	<div class="link"><a href="<?=base_url()?>index.php/dispach/searchdoc"><i class="fa fa-search"></i>Docket Search</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/receiveddocket"><i class="fa fa-code"></i>Received Docket</a></div>
	</li>
  <li class="dividerLine_top">
	<div class="link"><a href="<?=base_url()?>index.php/transaction/file"><i class="fa fa-plus"></i>Create File</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/file_track"><i class="fa fa-repeat"></i>Receive File</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/forward_file"><i class="fa fa-share"></i>Forward File</a></div>
	</li>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/transaction/forwarded_file"><i class="fa fa-code"></i>Forwarded File</a></div>
	</li>

  <?php } ?>
  <?php if($this->session->userdata('uloggedin')->designation == 'CEO') { ?>
  <li>
	<div class="link"><a href="<?=base_url()?>index.php/ceo/"><i class="fa fa fa-history"></i>File Operation</a></div>
	</li>
  <?php }?>
  <li class="dividerLine_Bot">
	 <div class="link"><a href="<?=base_url()?>index.php/file_history/"><i class="fa fa-history"></i>File history</a></div>
	</li>
  <li class="dividerLine_top">
	 <div class="link"><a href="<?=base_url()?>index.php/auth/logout/"><i class="fa fa-sign-out"></i>Logout</a></div>
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
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal_dialog_custom" role="document">
    <div class="modal-content">
      <div class="modal-header modal_header_CusDash">
        <h5 class="modal-title" id="exampleModalLabel">My Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal_bodyCustomDash">
      
      
    <div class="tab_cusDash">
    <button class="tablinks_Popup active" onClick="openPopupTab(event, 'Profile')">Profile</button>
    <!-- <button class="tablinks_Popup" onClick="openPopupTab(event, 'Notifications')">Notifications</button>
    <button class="tablinks_Popup" onClick="openPopupTab(event, 'Email_Forwarding')">Email Forwarding</button>
    <button class="tablinks_Popup" onClick="openPopupTab(event, 'Account')">Account</button>
    <button class="tablinks_Popup" onClick="openPopupTab(event, 'Display')">Display</button>
    <button class="tablinks_Popup" onClick="openPopupTab(event, 'Apps')">Apps</button>
    <button class="tablinks_Popup" onClick="openPopupTab(event, 'Hacks')">Hacks</button> -->
    <div id="alert-container"></div>
    </div>
    <?php $presult = $this->master->f_get_particulars('md_users',NULL,array('id'=>$this->session->userdata('uloggedin')->id),1);?>
    <form action="javascript:void(0)" id="profile_form" method="POST">
    <div id="Profile" class="tabcontent_cusDash_Popup" style="display:block;">
    <!-- <div class="photoChange">
      <h5>Your photo</h5>
      <div class="photoChangeMain">
          <div class="photoThum">
            <div class="PlaceholderAvatar--xlarge" style="background-image: url(&quot;https://d3ki9tyy5l5ruj.cloudfront.net/obj/3d4665c7cf119dc9dc38232301b18fa68b9bb17c/avatar.svg&quot;);"></div>
          </div>
          <div class="photoThumDetails">
              <h4>Upload your photo</h4>
              <p>Photos help your teammates recognize you in efile</p>
          </div>
        </div>
    </div> -->
    
    <div class="profileForm">
    <div class="profileFormRow">
      <div class="profileFieldHalf">
        <label>First name</label>
        <input type='hidden' name='id' value="<?=$this->session->userdata('uloggedin')->id?>">
        <input name="first_name" type="text" value="<?=$presult->first_name?>" >
      </div>
      <div class="profileFieldHalf">
        <label>Last name</label>
        <input name="last_name" type="text" value="<?=$presult->last_name?>" >
      </div>
    
      
    </div>
    
    <div class="profileFormRow">
      <div class="profileFieldHalf">
        <label>Mobile No</label>
        <input name="phone_no" type="text" value="<?=$presult->phone_no?>">
      </div>
      <div class="profileFieldHalf">
        <label>Email</label>
        <input name="email" type="text" readonly value="<?=$presult->email?>" style="background-color:#d3d3d37a">
      </div>
    
      
    </div>
    
    <div class="profileFormRow">

      <div class="profileFieldHalf">
        <label>Department</label>
        <input name="dept" type="text" value="<?=$presult->dept?>">
      </div>
      <div class="profileFieldHalf">
        <label>Designation</label>
        <input name="designation" type="text" value="<?=$presult->designation?>">
      </div>
    
      <!-- <div class="profileFieldHalf">
        <label>Department or team</label>
        <input name="" type="text">
      </div> -->
    </div>
    
    <!-- <div class="profileFormRow">
      <div class="profileFieldHalf">
        <label>Email</label>
        <input name="" type="text">
      </div>
    </div> -->
    
    
    <!-- <div class="profileFormRow">
        <div class="profileFieldFull">
          <label>About me</label>
          <textarea placeholder="Text here"></textarea>
        </div>
    </div>
    
    <div class="profileFormRow">
      <div class="profileFieldThree">
        <label>First day</label>
        <input name="" type="date">
      </div>
    
      <div class="profileFieldThree">
        <label>Last day</label>
        <input name="" type="date">
      </div>
    </div> -->
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="submit" type="submit" id="profile_submit">
    </div>
    </div>
  </form>
    </div>
    </div>
    
    <div id="Notifications" class="tabcontent_cusDash_Popup">
    <h3>Notifications</h3>
    <div class="profileForm">
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Your full name</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Pronouns</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Email</label>
    <input name="" type="text">
    </div>
    
    
    </div>
    
    
    <div class="profileFormRow">
    <div class="profileFieldFull">
    <label>About me</label>
    <textarea placeholder="Text here"></textarea>
    </div>
    
    
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldThree">
    <label>First day</label>
    <input name="" type="date">
    </div>
    
    <div class="profileFieldThree">
    <label>Last day</label>
    <input name="" type="date">
    </div>
    </div>
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="" type="submit">
    </div>
    </div>
    
    </div>
    </div>
    
    <div id="Email_Forwarding" class="tabcontent_cusDash_Popup">
    <h3>Email Forwarding</h3>
    <div class="profileForm">
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Your full name</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Pronouns</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Email</label>
    <input name="" type="text">
    </div>
    
    
    </div>
    
    
    <div class="profileFormRow">
    <div class="profileFieldFull">
    <label>About me</label>
    <textarea placeholder="Text here"></textarea>
    </div>
    
    
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldThree">
    <label>First day</label>
    <input name="" type="date">
    </div>
    
    <div class="profileFieldThree">
    <label>Last day</label>
    <input name="" type="date">
    </div>
    </div>
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="" type="submit">
    </div>
    </div>
    
    </div>
    </div>
    
    <div id="Account" class="tabcontent_cusDash_Popup">
    <h3>Account</h3>
    <div class="profileForm">
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Your full name</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Pronouns</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Email</label>
    <input name="" type="text">
    </div>
    
    
    </div>
    
    
    <div class="profileFormRow">
    <div class="profileFieldFull">
    <label>About me</label>
    <textarea placeholder="Text here"></textarea>
    </div>
    
    
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldThree">
    <label>First day</label>
    <input name="" type="date">
    </div>
    
    <div class="profileFieldThree">
    <label>Last day</label>
    <input name="" type="date">
    </div>
    </div>
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="" type="submit">
    </div>
    </div>
    
    </div>
    </div>
    
    <div id="Display" class="tabcontent_cusDash_Popup">
    <h3>Display</h3>
    <div class="profileForm">
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Your full name</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Pronouns</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Email</label>
    <input name="" type="text">
    </div>
    
    
    </div>
    
    
    <div class="profileFormRow">
    <div class="profileFieldFull">
    <label>About me</label>
    <textarea placeholder="Text here"></textarea>
    </div>
    
    
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldThree">
    <label>First day</label>
    <input name="" type="date">
    </div>
    
    <div class="profileFieldThree">
    <label>Last day</label>
    <input name="" type="date">
    </div>
    </div>
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="" type="submit">
    </div>
    </div>
    
    </div>
    </div>
    
    <div id="Apps" class="tabcontent_cusDash_Popup">
    <h3>Apps</h3>
    <div class="profileForm">
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Your full name</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Pronouns</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Email</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldFull">
    <label>About me</label>
    <textarea placeholder="Text here"></textarea>
    </div>
    
    </div>
    <div class="profileFormRow">
    <div class="profileFieldThree">
    <label>First day</label>
    <input name="" type="date">
    </div>
    
    <div class="profileFieldThree">
    <label>Last day</label>
    <input name="" type="date">
    </div>
    </div>
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="" type="submit">
    </div>
    </div>
    
    </div>
    </div>
    
    <div id="Hacks" class="tabcontent_cusDash_Popup">
    <h3>Hacks</h3>
    <div class="profileForm">
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Your full name</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Pronouns</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Role</label>
    <input name="" type="text">
    </div>
    
    <div class="profileFieldHalf">
    <label>Department or team</label>
    <input name="" type="text">
    </div>
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldHalf">
    <label>Email</label>
    <input name="" type="text">
    </div>
    
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldFull">
    <label>About me</label>
    <textarea placeholder="Text here"></textarea>
    </div>
    
    </div>
    
    <div class="profileFormRow">
    <div class="profileFieldThree">
    <label>First day</label>
    <input name="" type="date">
    </div>
    
    <div class="profileFieldThree">
    <label>Last day</label>
    <input name="" type="date">
    </div>
    </div>
    
    <div class="profileFormRow" style="margin-bottom:0;">
    <div class="profileFieldFull btnProfileCus">
    <input name="" type="submit">
    </div>
    </div>
  
    </div>
    </div>
    
    </div>
      
    </div>
  </div>
</div>

<script>
function openPopupTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent_cusDash_Popup");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks_Popup");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}


function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent_cusDash");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

  $("#profile_form").submit(function(e) {

      $.ajax({
        type : 'POST',
        url : '<?=base_url()?>index.php/auth/update_profile/',
        data : $('#profile_form').serialize(),
        success: function (data) {
        //var result=data;
        const obj = JSON.parse(data);
        if(obj.type == 'alert'){
          $('#alert-container').append('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>'+ obj.text +'</div>');
        }else{
          $('#alert-container').append('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'+ obj.text +'</div>');
        }

        }
      })
  
  })

</script>
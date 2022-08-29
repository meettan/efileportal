<div class="content-wrapper">
			<div class="card cardCustomNew">
			 <div class="card-body">
				 <!-- <div class="titleSec">
					 <button type="button" class="btn btn-primary">Export as CSV</button>
				 <h2>Page Title</h2> 
				 </div> -->
				 
				<div class="row">
					 <div class="col-sm-12"> 
			<!-- <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
								<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td><a href="#" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
					<a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a></td>
            </tr>

		</tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table> -->
    
    <div class="dashboardTopTxt">
    <h5><?=date('l');?>, <?=date("F", strtotime('m'));?>&nbsp;29</h5>
    <h2> <?php
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* Set the $timezone variable to become the current timezone */
    $timezone = date("e");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        echo "Good morning";
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "17") {
        echo "Good afternoon";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "17" && $time < "19") {
        echo "Good evening";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        echo "Good night";
    }
    ?> ,&nbsp;<?php  if($this->session->userdata('uloggedin')->first_name) echo ucfirst($this->session->userdata('uloggedin')->first_name); ?></h2>
    <div class="statusDash"> <div>dfgdfg</div> <div>dfgdfg</div> <div>dfgdfg</div> </div>
    
    <div class="dashboardBox">
    <div class="col-sm-6 float-left">
    <div class="dashboardBoxData">
    
    <div class="photoChange_dashboard">
    <div class="photoChangeMain">
    <div class="photoThum"><div class="PlaceholderAvatar--xlarge" style="background-image: url(&quot;https://d3ki9tyy5l5ruj.cloudfront.net/obj/3d4665c7cf119dc9dc38232301b18fa68b9bb17c/avatar.svg&quot;);"></div></div>
    <div class="photoThumDetails">
    <h2>My Priorities</h2>
    </div>
    </div>
    </div>
    
     <div class="tab_cusDash">
    <button class="tablinks active" onclick="openCity(event, 'Upcoming')">Upcoming</button>
    <button class="tablinks" onclick="openCity(event, 'Overdue')">Overdue (24)</button>
    
    </div>
    
   <div id="Upcoming" class="tabcontent_cusDash tabcontent_cusDashNoPad" style="display:block;">
    <div class="prioritiesBoxList">
    <ul>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    </ul>
    </div>
    </div>
   
    
    <div id="Overdue" class="tabcontent_cusDash tabcontent_cusDashNoPad">
    <div class="prioritiesBoxList">
    <ul>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">xxx  window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    </ul>
    </div>
    </div>
    
    
    </div>
    </div>
    <div class="col-sm-6 float-left">
    <div class="dashboardBoxData">
    
    <div class="photoChange_dashboard">
    <div class="photoChangeMain">
    
    <div class="photoThumDetails">
    <h2>File History</h2>
    </div>
    </div>
    </div>
    
    <div class="tabcontent_cusDash_NotTab tabcontent_cusDashNoPad">
    <div class="prioritiesBoxList">
    <ul>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    </ul>
    </div>
    </div>
    
    </div>
    </div>
    </div>
    
    <div class="dashboardBox">
    <div class="col-sm-12 float-left">
    <div class="dashboardBoxData">
    
    <div class="photoChange_dashboard">
    <div class="photoChangeMain">
    <div class="photoThum"><div class="PlaceholderAvatar--xlarge" style="background-image: url(&quot;https://d3ki9tyy5l5ruj.cloudfront.net/obj/3d4665c7cf119dc9dc38232301b18fa68b9bb17c/avatar.svg&quot;);"></div></div>
    <div class="photoThumDetails">
    <h2>My Priorities</h2>
    </div>
    </div>
    </div>
    
     <div class="tab_cusDash">
    <button class="tablinks active" onclick="openCity(event, 'Upcoming')">Upcoming</button>
    <button class="tablinks" onclick="openCity(event, 'Overdue')">Overdue (24)</button>
    
    </div>
    
   <div id="Upcoming" class="tabcontent_cusDash tabcontent_cusDashNoPad" style="display:block;">
    <div class="prioritiesBoxList">
    <ul>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    </ul>
    </div>
    </div>
   
    
    <div id="Overdue" class="tabcontent_cusDash tabcontent_cusDashNoPad">
    <div class="prioritiesBoxList">
    <ul>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">xxx  window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    <li>
    <div class="iconSec"><i class="fa fa-check" aria-hidden="true"></i> </div>
    <div class="listTxt">wall sign & window cling need to highlight the items & prices</div>
    </li>
    </ul>
    </div>
    </div>
    
    
    </div>
    </div>
    </div>
    
    </div>
    
    
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
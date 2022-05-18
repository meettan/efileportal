<div class="main-panel">
		<div class="content-wrapper">
			<div class="card">
			 <div class="card-body">
				<!-- <div class="titleSec">
					 <button type="button" class="btn btn-primary">Export as CSV</button>
				 <h2>Page Title</h2> 
				 </div>  -->
				 
				<div class="row">
					 <div class="col-sm-12"> 
			<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($users) { 
                    foreach($users as $key){
                      ?>
            <tr>
                <td><?=$key->first_name?> <?=$key->last_name?></td>
                <td><?=$key->dept?></td>
                <td><?=$key->email?></td>
                <td><?=$key->phone_no?></td>
                <td><?=$key->designation?></td>
                <td><a href="<?=base_url()?>index.php/verify/edit/<?=$key->id?>" data-toggle="tooltip" data-placement="bottom" title="Edit" class="deletCus"><i class="fa fa-edit menu-icon"></i></a>
				   <!-- <a href="#" onclick="" class="delete editeCus" title="Delete"><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a> -->
                </td>
            </tr>
            <?php   }
                  }else { ?>
                        <tr><td><?php echo  'No record found'?></td></tr>
            <?php } ?>    

		</tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Designation</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
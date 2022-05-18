<div class="main-panel">
		<div class="content-wrapper">
			<div class="card">
            <div class="card-body">
				<div class="titleSec">
				 <h2>User Update</h2> 
				</div>
                <form action ="<?=base_url()?>index.php/verify/useractivate/" method="POST"> 
				<div class="row">
					 <div class="col-sm-12"> 
                        <input type="hidden" name="id" value="<?=$user->id?>">
                     <div class="form-group row">
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Name"  value="<?=$user->first_name?> <?=$user->first_name?>" readonly>
                        </div>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Department" value="<?=$user->dept?>" readonly>
                        </div>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Email" value="<?=$user->email?>" readonly>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Phone no" value="<?=$user->phone_no?>" readonly>
                        </div>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="Designation" value="<?=$user->designation?>" readonly>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" required name='user_type' required>
                                <option value="">Select User Type</option>
                                <option value="Demo">Demo</option>
                                <option value="Demo1">Demo1</option>
                            
                            </select>
                        </div>
                       
                     </div>

                    <div class="form-group row">
                        <div class="col-sm-12 btnSubmitSec">
                        <input type="submit" class="btn btn-info" id="submit" name="submit" value="Approve">
                    <!--		<input type="reset" onclick="" class="btn btn-info" value="Cancel">-->
                        </div>
                    </div>				
                    </form> 	 
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
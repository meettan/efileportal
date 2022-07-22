<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                              <a href='<?=base_url()?>index.php/transaction/file_track/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/transaction/file_forward/" enctype='multipart/form-data'>
                        <?php foreach($docs as $dt);?> 
                        <div class="form-group row">
                                <div class="col-sm-2 fieldname">Department</div>
                                <div class="col-sm-4">
                                 <select class='form-control select2' name='dept' id='dept'  disabled>
                                     <option value=''>Select Department</option>
                                     <?php foreach($depts as $dt) {  ?>
                                     <option value='<?=$dt->sl_no?>' <?php if( $filedtl->dept_no == $dt->sl_no ) echo 'selected';  ?> > <?=$dt->department_name?></option>
                                     <?php } ?>
                                 </select>
                                </div>
                                <div class="col-sm-2 fieldname">Module</div>
                                <div class="col-sm-4">
                                  <select class='form-control select2' name='module' id='module' disabled>
                                    <option value=''>Select Module</option>
                                    <option value='L' <?php if( $filedtl->module == 'L' ) echo 'selected';  ?>>Leave</option>
                                    <option value='P' <?php if( $filedtl->module == 'P' ) echo 'selected';  ?>>Paddy</option>
                                    <option value='S' <?php if( $filedtl->module == 'S' ) echo 'selected';  ?>>Stationary</option>
                                    <option value='I' <?php if( $filedtl->module == 'I' ) echo 'selected';  ?>>ICDS</option>
                                    <option value='OT' <?php if( $filedtl->module == 'OT' ) echo 'selected';  ?>>Other</option>
                                   </select>
                                </div>
                        </div> 
                         
                        <div class="form-group row">
                            <div class="col-sm-2 fieldname">File Type  <??> </div>
                            <div class="col-sm-4">
                            <input type="text" name="filetype"  class="form-control" value='<?php if(isset($filetype->file_name)) echo $filetype->file_name; ?>' readonly >
                            </div>
                        </div>    
                        <div class="form-group row">
                            <div class="col-sm-2 fieldname">File No </div>
                            <div class="col-sm-4">
                            <input type="text" name="fileno"  class="form-control" value='<?=$fileno?>' readonly >
                            </div>
                            <div class="col-sm-2 fieldname">Docket No</div>
                            <div class="col-sm-4">
                            <input type="text" name="docket_no" required class="form-control" value='<?php if(isset($filedtl->docket_no)) echo $filedtl->docket_no; ?>' id='docket_no' readonly >
                            </div>
                        </div>
                        <?php if($leave) { ?>
                        <div class="form-group row">
                        <div class="col-sm-11">
                        <?php $lea = '';
                            if($leave->leave_type == 'CL'){ $lea = 'Casual Leave';}
                            else if($leave->leave_type == 'ML'){ $lea = 'Medical Leave';}
                            else if($leave->leave_type == 'EL'){ $lea = 'Earned Leave';}
                            else if($leave->leave_type == 'OD'){ $lea = 'Off Day';}
                            
                            ?>
                            <p><?php echo $leave->letterfirstline; ?> </p>
                        <!-- <p>So Sri <?php //echo $leave->emp_name; ?> has requested to adjust the leaves in <?=$lea?> ground.</p>
                        
                        <p>Put up to CEO through ARCS and Deputy Manager for perusal and taking necessary action please. </p> -->
                        </div>   
                        </div>  
                        <?php } ?> 
                      
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="card">
                                
                                    <div class="card-body">
                                    <h5 class="card-title"> Created By: <?php if(isset($filedtl->first_name)) echo $filedtl->first_name; ?>/ Created Date:  <?php if(isset($filedtl->created_at)) echo date('d/m/Y',strtotime(explode(' ',$filedtl->created_at)[0])).' '.explode(' ',$filedtl->created_at)[1] ; ?></h5>
                                    <?php if(isset($filedtl->note_sheet)) echo $filedtl->note_sheet; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($comment_author) { 
                            foreach($comment_author as $ca){
                            ?>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title"> Remarks By: <?php if(isset($ca->first_name)) echo $ca->first_name; ?> / Forwarded Date: <?php if(isset($ca->forwarded_at)) echo date('d/m/Y',strtotime(explode(' ',$ca->forwarded_at)[0])).' '.explode(' ',$ca->forwarded_at)[1] ; ?></h5>
                                    <?php if(isset($ca->remarks)) echo $ca->remarks; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }?>
                            <hr/>
                            <div class="form-group row intro2ViewBtnSec" id='intro2'>
                            <?php   
                                  if(isset($dt->docket_no)) {  ?> 
                            <?php foreach($docs as $key) { ?>  
                                <div class="col-sm-2">
                                <div class="viewListSec">
                               <a href='javascript:void(0)' class='simg'> </a>
                                <p class="titleBox"><?=$key->name?></p>
                                <button type="button" class="btn btn-success simg" value='<?=$key->document?>'>view</button>
                                </div>
                                </div>
                            <?php }  } else{ ?>
                            
                            <?php foreach($fdocs as $key) { ?>  
                                <div class="col-sm-2">
                                <div class="viewListSec">
                               <a href='javascript:void(0)' class='simg'> </a>
                                <p class="titleBox"><?=$key->name?></p>
                                <button type="button" class="btn btn-success simg" value='<?=$key->document?>'>view</button>
                                </div>
                                </div>
                            <?php } }?> 
                            </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2 fieldname">Remarks</div>
                            <div class="col-sm-10">
                            <textarea name='remarks' class="form-control" placeholder='' ></textarea>
                            </div>
                        </div>
                        <hr/>
                        
                        <?php //echo $filestatus->fwd_status;
                        if($fstatus == 'A')  { 
                            ?>
                            <div class="form-group row">
                                 <div class="col-sm-12" ><p style="text-align:center;font-size:18px;font-weight: 900;color: red;">You Forwarded File</p></div>
                            </div>
                        
                        <?php }else{ ?>
                            <div class="form-group row">
                            <div class="col-sm-2 fieldname">User</div>
                            <div class="col-sm-4">
                                <select name='user' class='form-control' required><option value=''>Select user</option>
                                        <?php foreach($users as $key) { ?>
                                        <option value='<?=$key->id?>'><?=$key->first_name?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-2 fieldname">Forward Status</div>
                            <div class="col-sm-4">
                                <select name='fwd_status' class='form-control' required>
                                    <option value='A'>Approve</option>
                                    <option value='R'>Reject</option>
                                </select>
                            </div>
                            </div>
                            <hr/>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                <button class='btn btn-primary' type='submit' value='Forward'>Submit </button>
                                </div>
                            </div>

                        <?php } ?>   
                        </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$( document ).ready(function() {
    $('#intro2').on('change', '.doc', function(){

        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['pdf','jpg','jpeg']) == -1) {
                    Swal.fire({
                        text: 'invalid extension!',
                        position: "middle",
                        color: '#f0f0f0',
                        timer: 100000
                    });
            $(this).val('');
        }else{
                //  2000000  => 2MB  File size 
            if(this.files[0].size > 100000) {
                    Swal.fire({
                            text: "Please upload file less than 100kb. Thanks!!",
                            position: "middle",
                            color: '#f0f0f0',
                            timer: 100000
                    });
            $(this).val('');
            }
            }
        });
        $('#intro2').on('click', '.simg', function(){
            var ext = $(this).val();
                Swal.fire({
                        //text: "",
                        position: "middle",
                        color: '#f0f0f0',
                        <?php if(isset($dt->docket_no)) { ?>
                        imageUrl: "<?=base_url()?>uploads/<?=$dt->docket_no?>/"+ext,
                        <?php }else{    ?>
                        imageUrl: "<?=base_url()?>uploads/<?=$fileno?>/"+ext,
                        <?php } ?>
                        timer: 100000
                });
        });
        $('#intro2').on('click', '.del', function(){
            var row = $(this).parents('tr');
            Swal.fire({  
                title: 'You will not be able to recover this imaginary file!',  
                showDenyButton: true,  showCancelButton: true,  
                confirmButtonText: `Delete`,  
                denyButtonText: `Don't Delete`,
                }).then((result) => {  
                    /* Read more about isConfirmed, isDenied below */  
                    if (result.isConfirmed) {    
                        $.ajax({
                                type: "POST",
                                url: '<?=base_url()?>index.php/dispach/del_doc/',
                                data: {sl_no:$(this).val()},
                                success: function(response)
                                {
                                    if (response == 1){ 
                                     Swal.fire('Deleted!', '', 'success')
                                     row.remove();  
                                    }else{
                                     Swal.fire('Row not deleted', '', 'info')
                                    }
                                }
                            });
                    } else if (result.isDenied) {    
                        Swal.fire('Changes are not saved', '', 'info')  
                    }
                });
        })

})
</script>
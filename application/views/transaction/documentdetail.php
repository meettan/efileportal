<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                <a href='<?=base_url()?>index.php/transaction/file/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                    <form method="post" action="<?=base_url()?>index.php/transaction/file_forward/" enctype='multipart/form-data'>
                    <input type='hidden' name='created_by' value='<?php if(isset($filedtl->created_by)) echo $filedtl->created_by; ?>'>
                        <?php foreach($docs as $dt);?>   
                        <div class="form-group row">
                            <div class="col-sm-2 fieldname">File No </div>
                            <div class="col-sm-4">
                            <input type="text" name="fileno"  class="form-control" value='<?=$fileno?>' readonly >
                            </div>
                            <div class="col-sm-2 fieldname">Docket No</div>
                            <div class="col-sm-4">
                            <input type="text" name="docket_no" required class="form-control" value='<?php if(isset($filedtl->docket_no)) echo $filedtl->docket_no;  ?>' id='docket_no' readonly >
                            </div>
                        </div>
                        <?php if($leave) { ?>
                        <div class="form-group row" id='docket_content'>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Application Date</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>No of days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?=date('d/m/Y',strtotime($leave->trans_dt))?></td>
                                        <td><?=$leave->emp_name?></td>
                                        <td><?=$leave->leave_type?></td>
                                        <td><?=date('d/m/Y',strtotime($leave->from_dt))?></td>
                                        <td><?=date('d/m/Y',strtotime($leave->to_dt))?></td>
                                        <td><?php echo $diff = (abs(strtotime($leave->to_dt) - strtotime($leave->from_dt)))/24/3600; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan='6'></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan='6'><?=$leave->remarks?></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        </div>
                       
                        <!-- <div class="form-group row">
                        <div class="col-sm-11">
                        <?php $lea = '';
                           // if($leave->leave_type == 'CL'){ $lea = 'Casual Leave';}
                           // else if($leave->leave_type == 'ML'){ $lea = 'Medical Leave';}
                           // else if($leave->leave_type == 'EL'){ $lea = 'Earned Leave';}
                          //  else if($leave->leave_type == 'OD'){ $lea = 'Off Day';}
                            
                            ?>
                            <p><?php //echo $leave->letterfirstline; ?> </p>
                        <p>So Sri <?php //echo $leave->emp_name; ?> has requested to adjust the leaves in <?=$lea?> ground.</p>
                        
                        <p>Put up to CEO through ARCS and Deputy Manager for perusal and taking necessary action please. </p>
                        </div>   
                        </div>   -->
                        <?php } ?> 
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="card">
                                
                                    <div class="card-body">
                                    <!-- <h5 class="card-title"> Creater: </h5> -->
                                    <?php if(isset($filedtl->note_sheet)) echo $filedtl->note_sheet; ?>
                                    </div>
                                </div>
                            </div>
                           </div>
                            <hr/>
                            <div class="form-group row intro2ViewBtnSec" id='intro2'>
                            <?php   
                                  if(isset($dt->docket_no)) {  ?> 
                            <?php foreach($docs as $key) { ?>  
                                <div class="col-sm-2">
                                <div class="viewListSec pdfImg">
                                <p class="titleBox"><?=$key->name?></p>
                                <a href='javascript:void(0)'type="button" class="btn btn-success simg" data-img-url='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>' data-toggle="modal" data-target="#myModal">view</a>
                                </div>
                                </div>
                            <?php }  } else{ ?>
                            
                            <?php foreach($fdocs as $key) { ?>  
                                <div class="col-sm-2">
                                <div class="viewListSec pdfImg">
                               <a href='javascript:void(0)' class='simg' > </a>
                                <p class="titleBox"><?=$key->name?></p>
                                <button type="button" class="btn btn-success simg" value='<?=$key->document?>'>view</button>
                                </div>
                                </div>
                            <?php } }?> 
                            </div>
                        <hr/>
                       
                        
                        <?php if($filestatus)  {   ?>
                            <div class="form-group row">
                                 <div class="col-sm-12" ><p style="text-align:center;font-size:18px;font-weight: 900;color: red;">You Forwarded File</p></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 fieldname">Forwarded To</div>
                                <div class="col-sm-4">
                                <input type='text' class="form-control" value='<?=$filestatus->remarks?>'  readonly/>
                                </div>
                                <div class="col-sm-2 fieldname">Forwarded at</div>
                                <div class="col-sm-4">
                                <input type='text' class="form-control" value='<?=$filestatus->forwarded_at?>'  readonly/>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group row">
                                <div class="col-sm-2 fieldname">Remarks</div>
                                <div class="col-sm-10">
                                <textarea name='remarks' class="form-control" placeholder='' ><?=$filestatus->remarks?></textarea>
                                </div>
                            </div>
                            <hr/>
                        
                        <?php }else{ ?>
                            <div class="form-group row">
                                <div class="col-sm-2 fieldname">Remarks</div>
                                <div class="col-sm-10">
                                <textarea name='remarks' class="form-control" placeholder='' ></textarea>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group row">
                            <div class="col-sm-2 fieldname">User</div>
                            <div class="col-sm-4">
                                <select name='user' class='form-control' required><option value=''>Select user</option>
                                        <?php foreach($users as $key) { ?>
                                        <option value='<?=$key->id?>'><?=$key->first_name?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-2 fieldname">Forward Status</div>
                            <div class="col-sm-4">
                                <select name='fwd_status' class='form-control' required>
                                    <option value=''>Select Status</option>
                                    <option value='A'>Approve</option>
                                    <option value='R'>Reject</option>
                                </select>
                            </div>
                            </div> -->
                            <hr/>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                <button class='btn btn-primary' type='submit' value='Forward'>Submit</button>
                                </div>
                            </div>

                        <?php } ?>   
                        </form> 
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Modal -->
<!-- <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <iframe id='pdfdata'src="" style="width: 750px;height:700px"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            
                <div class="modal-content" >
                    <div class="modal-body">
                    <iframe id='pdfdata'src="" style="width: 750px;height:700px"></iframe>
                    <img id='imagedata'src="" ></img>
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

        $('.pdfImg a').click(function(e) {
        var img = $(this).attr('data-img-url');
        //event.preventDefault()
        //var img = $(this).val();
        //alert(img);
        var extension = img.substr( (img.lastIndexOf('.') +1) );
        if(extension == 'pdf' ){
            
            $('#pdfdata').attr('src', img);
        }else{
           
            $('#imagedata').attr('src', img);
        }
            
       });
        // $('#intro2').on('click', '.simg', function(){
        //     var ext = $(this).val();
        //         Swal.fire({
        //                 //text: "",
        //                 position: "middle",
        //                 color: '#f0f0f0',
        //                 <?php if(isset($dt->docket_no)) { ?>
        //                 imageUrl: "<?=base_url()?>uploads/<?=$dt->docket_no?>/"+ext,
        //                 <?php }else{    ?>
        //                 imageUrl: "<?=base_url()?>uploads/<?=$fileno?>/"+ext,
        //                 <?php } ?>
        //                 timer: 100000
        //         });
        // });
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
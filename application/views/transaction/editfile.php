<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                              <a href='<?=base_url()?>index.php/transaction/file/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/transaction/editfile/" enctype='multipart/form-data'>
                            <input type='hidden' name='fileno' value='<?php echo $fdetail->file_no ?>'>
                        <div class="form-group row">
                                <div class="col-sm-2 fieldname">Department</div>
                                <div class="col-sm-4">
                                 <select class='form-control' name='dept' id='dept' disabled>
                                     <option value=''>Select Department</option>
                                     <?php foreach($depts as $dt) {  ?>
                                     <option value='<?=$dt->sl_no?>'<?php if($fdetail->dept_no==$dt->sl_no) echo 'selected';?> ><?=$dt->department_name?></option>
                                     <?php } ?>
                                 </select>
                                </div>
                                <div class="col-sm-2">Module</div>
                                <div class="col-sm-4">
                                  <select class='form-control select2' name='module' id='module'>
                                    <option value=''>Select Module</option>
                                    <option value='L' <?php if($fdetail->module == 'L') echo 'selected'; ?> >Leave</option>
                                    <option value='P' <?php if($fdetail->module == 'P') echo 'selected'; ?> >Paddy</option>
                                    <option value='S' <?php if($fdetail->module == 'S') echo 'selected'; ?> >Stationary</option>
                                    <option value='I' <?php if($fdetail->module == 'I') echo 'selected'; ?> >ICDS</option>
                                    <option value='OT' <?php if($fdetail->module == 'OT') echo 'selected'; ?> >Other</option>
                                   </select>
                                </div>
                                
                              
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2 fieldname">File No</div>
                                <div class="col-sm-4">
                                    <input type='text' readonly class='form-control' name='filetype' value="<?php echo $fdetail->file_no ?>">
                                
                                </div>
                                <div class="col-sm-2 fieldname">Docket No</div>
                               <div class="col-sm-4">
                               <input type='text' readonly class='form-control' name='docket_no' value="<?php echo $fdetail->docket_no ?>">
                                  
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
                        <?php } ?>
                            
                            <div class="form-group row">
                              <div class="col-sm-2 fieldname">Remarks</div>
                               <div class="col-sm-10">
                                <textarea  class="form-control" placeholder='Remarks' name="editor1">
                                    <?=$fdetail->note_sheet?>
                                </textarea>
                                </div>
                            </div>
                            <div id='imgdetails'>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 btnSubmitSec">
                                <input type="submit" class="btn btn-info" id="submit" name="submit" value="create">
                            <!-- <input type="reset" onclick="" class="btn btn-info" value="Cancel">-->
                                </div>
                            </div>	
                        </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ajaxComplete(function() {
    
        CKEDITOR.replace( 'editor1' );
                
    

    // $("#dept").on("change", function() {
    //   $.ajax({
    //           type: "POST",
    //           url: '<?=base_url()?>index.php/transaction/getfiletype/',
    //           data: {dept:$(this).val() },
    //           success: function(data)
    //           {
    //             var string = '<option value="">Select</option>';

    //                 $.each(JSON.parse(data), function( index, value ) {
    //                     string += '<option value="' + value.file_no + '">' + value.file_name + '-('+ value.file_no +')</option>'
    //                 });

    //                 $('#filetype').html(string);
    //           }
    //     });
    // })

    $("#docket_no").on("change", function() {
    $.ajax({
            type: "POST",
            url: '<?=base_url()?>index.php/transaction/docket_detail/',
            data: {docket_no:$(this).val()},
            success: function(response)
            {
                if (response != 0){

                    $("#imgdetails").html(response);
                    
                }
                else
                {
                    $("#docket_no").val('');
                    Swal.fire({
                    //title: "Alert Set on Timer",
                    text: "Docket No Does not Exist.",
                    position: "middle",
                    color: '#f0f0f0',
                    background: "#ffc0cb",
                    timer: 100000
                    });
                }
            }
    });
})
})

// function fileGroup(dept){
//         $.ajax({
//               type: "POST",
//               url: '<?=base_url()?>index.php/transaction/getfiletype/',
//               data: {dept:dept },
//               success: function(data)
//               {
//                 var string = '<option value="">Select</option>';
//                     selected = '';
//                     $.each(JSON.parse(data), function( index, value ) {
//                         if(value.sl_no == '<?php echo $fdetail->file_no ?>'){
//                             selected = 'selected';
//                         }else{
//                             selected = '';
//                         }
//                         string += '<option value="' + value.file_no + '">' + value.file_name + '-('+ value.file_no +')</option>'
//                     });
//                     $('#filetype').html(string);
//               }
//         });
//     }
   // fileGroup('<?php echo $fdetail->dept_no ?>');

  function docGroup(docket_no){
    $.ajax({
            type: "POST",
            url: '<?=base_url()?>index.php/transaction/docket_detail/',
            data: {docket_no:docket_no},
            success: function(response)
            {
                if (response != 0){

                    $("#imgdetails").html(response);
                    
                }
                else
                {
                    $("#docket_no").val('');
                    // Swal.fire({
                    // //title: "Alert Set on Timer",
                    // text: "Docket No Does not Exist.",
                    // position: "middle",
                    // color: '#f0f0f0',
                    // background: "#ffc0cb",
                    // timer: 100000
                    // });
                }
            }
    });
  } 
    docGroup('<?php echo $fdetail->docket_no; ?>');
    $("#docket_no").on("change", function() {
        docGroup($(this).val());
    });

</script>
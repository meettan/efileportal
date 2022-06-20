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
                                
                                <div class="col-sm-2 fieldname">Docket No</div>
                               <div class="col-sm-4">
                                  <select class='form-control' name='docket' id='docket_no' required>
                                    <option value=''>Select Docket</option>
                                   <?php foreach($dockets as $key) { ?>
                                   <option value='<?=$key->docket_no?>'<?php if($fdetail->docket_no==$key->docket_no) echo 'selected';?>><?=$key->docket_no?></option>
                                   <?php } ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2 fieldname">File No</div>
                                <div class="col-sm-4">
                                    <input type='text' readonly class='form-control' name='filetype' value="<?php echo $fdetail->file_no ?>">
                                 <!-- <select class='form-control' id ='filetype' name='filetype'>
                                  
                                 </select> -->
                                </div>
                            </div>
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
  } 
    docGroup('<?php echo $fdetail->docket_no; ?>');
    $("#docket_no").on("change", function() {
        docGroup($(this).val());
    });

</script>
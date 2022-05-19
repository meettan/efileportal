<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                              <a href='<?=base_url()?>index.php/transaction/file/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/transaction/generatefile/" enctype='multipart/form-data'>
                            <div class="form-group row">
                                <div class="col-sm-2">Department</div>
                                <div class="col-sm-4">
                                 <select class='form-control' name='dept' id='dept'>
                                     <option value=''>Select Department</option>
                                     <?php foreach($depts as $dt) {  ?>
                                     <option value='<?=$dt->sl_no?>'><?=$dt->department_name?></option>
                                     <?php } ?>
                                 </select>
                                </div>
                                
                                <div class="col-sm-2">Docket No</div>
                               <div class="col-sm-4">
                                  <select class='form-control' name='docket' id='docket_no'>
                                    <option value=''>Select Docket</option>
                                   <?php foreach($dockets as $key) { ?>
                                   <option value='<?=$key->docket_no?>'><?=$key->docket_no?></option>
                                   <?php } ?>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2">File Type</div>
                                <div class="col-sm-4">
                                 <select class='form-control' id ='filetype' name='filetype'>
                                  
                                 </select>
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-2">Remarks</div>
                               <div class="col-sm-10">
                                <textarea  class="form-control" placeholder='Remarks' name="editor1"></textarea>
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
                
    $("#docket_no").on("change", function() {
      $.ajax({
              type: "POST",
              url: '<?=base_url()?>index.php/dispach/docket_check/',
              data: {docket_no:$(this).val()},
              success: function(response)
              {
                  //var jsonData = JSON.parse(response);
                  if (response > "0"){     }
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

    $("#dept").on("change", function() {
      $.ajax({
              type: "POST",
              url: '<?=base_url()?>index.php/transaction/getfiletype/',
              data: {dept:$(this).val() },
              success: function(data)
              {
                var string = '<option value="">Select</option>';

                    $.each(JSON.parse(data), function( index, value ) {
                        string += '<option value="' + value.file_no + '">' + value.file_name + '-('+ value.file_no +')</option>'
                    });

                    $('#filetype').html(string);
              }
        });
    })

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

</script>
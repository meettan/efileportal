<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                        <a href='<?=base_url()?>index.php/dispach/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/dispach/add_doc/" enctype='multipart/form-data'>
                            <div class="form-group row">
                                <div class="col-sm-2 fieldname">Docket No</div>
                                <div class="col-sm-4">
                                <input type="text" name="docket_no" required class="form-control" id='docket_no' value="<?php if(isset($dockets)){ echo $dockets;}?>" readonly>
                                </div>
                                <?php if(totaldocument($dockets) > 0 ){ ?>
                                <div class="col-sm-2 fieldname">Document Uploaded</div>
                                <div class="col-sm-2 fieldname">
                                <span class="link" id ="<?=$dockets?>">
                                <a href="javascript:void(0)">
                                <?=totaldocument($dockets)?>
                                </a>
                                </span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-2 fieldname">Remarks</div>
                               <div class="col-sm-10">
                                <textarea name='remarks' class="form-control" placeholder='Remarks'></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                <table class="table">
					               <thead>
						            <tr><th>Document Name</th><th>Document.(jpg,jped,pdf Allowed and Size upto 8MB)</th><th></th></tr>
                                   </thead>
                                   <tbody id="intro2">
                                   <tr><td><input type="text" name="name[]" class="form-control" required></td><td><input type="file" name="fileToUpload[]" required class="form-control doc"></td>
                                   <td><button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus"></i></button></td>
                                   </tr>
                                   </tbody>
                             </table> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 btnSubmitSec">
                                <input type="submit" class="btn btn-info" id="submit" name="submit" value="add">
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
$('.addAnotherrow').click(function(){
    let row = '<tr>'+
                '<td><input type="text" name="name[]" class="form-control"></td><td><input type="file" name="fileToUpload[]" required class="form-control doc"></td>'
                +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>'
            +'</tr>';
    $('#intro2').append(row);
});

$("#intro2").on('click', '.removeRow',function(){
    $(this).parents('tr').remove();
});

$(document).ajaxComplete(function() {
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
})

$(document).ready(function() {
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
            if(this.files[0].size > 8000000) {
                    Swal.fire({
                            text: "Please upload file up to 8MB. Thanks!!",
                            position: "middle",
                            color: '#f0f0f0',
                            timer: 100000
                    });
            $(this).val('');
            }
            }
    });
})

$(document ).ready(function() {

        $('.link').click( function(){
            $('#ajaxview').empty();
            $.ajax({
                    type: "POST",
                    data:{docket_no:$(this).attr("id")},
                    url: '<?=base_url()?>index.php/dispach/docdetail',
                    success: function(response)
                    {
                    $('#ajaxview').html(response);
                    
                    }
            });

            });
    })

</script>
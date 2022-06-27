<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                              <a href='<?=base_url()?>index.php/transaction/file/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/transaction/generatefile/" enctype='multipart/form-data' id='form'>
                            <div class="form-group row">
                                <div class="col-sm-2 fieldname">Please check</div>
                                <div class="col-sm-2">
                                    With docket
                                <input type='radio' value='dk' name='ckdc' class='checkbox-selector'checked>
                                </div>
                                <div class="col-sm-2">
                                    With out docket
                                <input type='radio' value='wdk' name='ckdc' class='checkbox-selector' >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">Department</div>
                                <div class="col-sm-4">
                                 <select class='form-control select2' name='dept' id='dept'>
                                     <option value=''>Select Department</option>
                                     <?php foreach($depts as $dt) {  ?>
                                     <option value='<?=$dt->sl_no?>'><?=$dt->department_name?></option>
                                     <?php } ?>
                                 </select>
                                </div>
                                
                                <div class="col-sm-2">Docket No</div>
                                <div class="col-sm-4" id='dcdetail'>
                                  <select class='select2' name='docket' id='docket_no' >
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
                            <div class="form-group row" id='file_documnet'>
                            <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                <table class="table">
					               <thead>
						            <tr><th>Document Name</th><th>Document.(jpg,jped,pdf Allowed and Size upto 8MB)</th><th></th></tr>
                                   </thead>
                                   <tbody id="intro2">
                                   <tr><td><input type="text" name="name[]" class="form-control"></td><td><input type="file" name="fileToUpload[]" class="form-control doc"></td>
                                   <td><button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus"></i></button></td>
                                   </tr>
                                   </tbody>
                             </table> 
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
$( document ).ready(function() {
$('#file_documnet').hide();
$('.addAnotherrow').click(function(){
    let row = '<tr>'+
                '<td><input type="text" name="name[]" class="form-control"></td><td><input type="file" name="fileToUpload[]"  class="form-control doc"></td>'
                +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>'
            +'</tr>';
    $('#intro2').append(row);
});

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

$("#intro2").on('click', '.removeRow',function(){
    $(this).parents('tr').remove();
});

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

    $('.checkbox-selector').click(function() {
        
        var value = $(this).val();
        if(value == 'wdk'){
            $('#docket_id').prop('required',true);  
            //document.querySelector('#docket_id').required == false; 
            $('#dcdetail').hide();
            $('#file_documnet').show();
        }else{
            $('#docket_id').prop('required',true);
            $('#dcdetail').show();
            $('#file_documnet').hide();  
        }
         //return false;  // don't process the link
     });
    // $( document ).ready(function() {
    // $( "#form" ).submit(function( event ) {
    //     var checked = $('input[name="ckdc"]:checked').val();
    //     var docket_no = $('#docket_no').val();
    //     alert(checked,docket_no);
       
    //     event.preventDefault();
    // });
    // })
})

</script>
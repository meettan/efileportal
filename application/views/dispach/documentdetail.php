<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                              <a href='<?=base_url()?>index.php/dispach/upload/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/dispach/add_doc/" enctype='multipart/form-data'>
                        <?php foreach($docs as $dt);?>   
                        <div class="form-group row">
                                <div class="col-sm-2">Docket No</div>
                                <div class="col-sm-4">
                                <input type="text" name="docket_no" required class="form-control" value='<?=$dt->docket_no?>' id='docket_no' readonly >
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-2">Remarks</div>
                               <div class="col-sm-10">
                                <textarea name='remarks' class="form-control" placeholder='Remarks' readonly><?=$dt->remarks?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-sm-2"></div>
                                <div class="col-sm-9">
                                <table class="table">
					               <thead>
						            <tr><th>Name.</th><th>Document.</th><th>Show.</th><th>Option</th></tr>
                                   </thead>
                                   <tbody id="intro2">
                                   <?php foreach($docs as $key) { ?>   
                                   <tr>
                                   <td><?=$key->name?></td>   
                                   <td><?=$key->document?></td>
                                  <td><a href="<?=base_url()?>uploads/<?=$dt->docket_no?>/<?=$key->document?>" target='_blank'><button type="button" class="btn btn-success " value='<?=$key->document?>'>view</button></a></td>
                                  <?php if($key->fwd_flag == 'N') { ?>
                                  <td><button type="button" class="btn btn-danger del" value='<?=$key->sl_no?>/<?=$key->docket_no?>/<?=$key->document?>'>Delete</button></td>
                                  <?php } ?>
                                   </tr>
                                   <?php }?>
                                   </tbody>
                             </table> 
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
			'<td><input type="file" name="fileToUpload[]" required class="form-control doc"></td>'
            +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>'
          +'</tr>';
 
$('#intro2').append(row);
//$('#order_no'+count, '#intro2').select2();
});

$("#intro2").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();
 
});

$( document ).ajaxComplete(function() {
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
                        text: "Thanks!!",
                        position: "middle",
                        color: '#f0f0f0',
                        imageUrl: "<?=base_url()?>uploads/<?=$dt->docket_no?>/"+ext,
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
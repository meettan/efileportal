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
                        <?php foreach($docs as $dt);?>   
                        <div class="form-group row">
                            <div class="col-sm-2">File No</div>
                            <div class="col-sm-4">
                            <input type="text" name="fileno"  class="form-control" value='<?=$fileno?>' readonly >
                            </div>
                            <div class="col-sm-2">Docket No</div>
                            <div class="col-sm-4">
                            <input type="text" name="docket_no" required class="form-control" value='<?=$dt->docket_no?>' id='docket_no' readonly >
                            </div>
                        </div>
                            <hr/>
                            <div class="form-group row" id='intro2'>
                            <?php foreach($docs as $key) { ?>  
                                <div class="col-sm-2">
                               <a href='javascript:void(0)' class='simg'> </a>
                                <p><?=$key->name?></p>
                                <button type="button" class="btn btn-success simg" value='<?=$key->document?>'>view</button>
                                </div>
                            <?php }?> 
                                
                            </div>
                        
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">Remarks</div>
                            <div class="col-sm-10">
                            <textarea name='remarks' class="form-control" placeholder='' ></textarea>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            <div class="col-sm-2">User</div>
                            <div class="col-sm-4">
                                <select name='user' class='form-control' required><option value=''>Select user</option>
                                        <?php foreach($users as $key) { ?>
                                        <option value='<?=$key->id?>'><?=$key->first_name?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-2">Forward Status</div>
                            <div class="col-sm-4">
                                <select name='fwd_status' class='form-control' required>
                                    <option value=''>Select user</option>
                                    <option value='A'>Approve</option>
                                    <option value='R'>Reject</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group row">
                            
                            <div class="col-sm-4">
                               <button class='btn btn-primary' type='submit' value='Forward'>Submit</button>
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
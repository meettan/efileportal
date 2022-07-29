<div class="content-wrapper">
			<div class="card">
			 <div class="card-body" >
				<!-- <div class="titleSec">

	
                </div> -->
                <?php if ($this->session->flashdata('success') != ''):   ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php  echo $this->session->flashdata('success');  ?>
                    </div>
                <?php endif; ?> 
                <?php if ($this->session->flashdata('error') != ''):   ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php  echo $this->session->flashdata('error');  ?>
                    </div>
                <?php endif; ?>
				
                
                <div class="col-sm-12">
                    <form action="" method="post" > 
                   <div class="form-group row">
                            <div class='col-sm-3'><h3>List of Files</h3></div>
                            <div class='col-sm-2'><input type='date'  class='btn-sm' name='fr_date' value='<?=$fr_date?>'></div>
                            <div class='col-sm-2'><input type='date'  class='btn-sm' name='to_date' value='<?=$to_date?>'></div>
                            <div class='col-sm-2'><input type="submit" class="btn btn-info btn-sm" name="Filter" /></div>
                            <div class='col-sm-1'></div>
                            <div class='col-sm-2'><button type="button" class="btn btn-primary" id='add'>Create File</button></div>
                    </div>
                    </form>
                </div>
            
				<div class="row">
                <div class="col-sm-12"> 
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr><th>Sl No</th>
                                <th>File No</th>
                                <!-- <th>Docket No</th> -->
                                <th>File Date</th>
                                <!-- <th>Created by</th> -->
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                        <tbody id='doclist'>
                        <?php if($files){ 
                                $sl = 0 ;
                                    foreach($files as $key){
                                    ?>
                            <tr>
                                <td><?=++$sl?></td>
                                <td><?=$key->file_no?></td>
                                <!-- <td><?php if(isset($key->docket_no)){
                                    echo $key->docket_no;
                                }?></td> -->
                                <td><?=date('d/m/Y',strtotime($key->file_date))?></td>
                                <!-- <td><?=$key->first_name?></td> -->
                                <td><?php $key->docket_no?>
                                <!-- <button class="link" value="<?=$key->docket_no?>/<?=$key->file_no?>"> <i class="fa fa-eye fa-fw fa-2x"></i></button> -->
                                <?php if($key->creater_forward == '0') { ?>
                                <button class="edit" value="<?=$key->docket_no?>/<?=$key->file_no?>"> <i class="fa fa-edit fa-fw fa-2x"></i></button>
                                
                                <?php } ?>
                                </td>
                                <td>
                                <?php if($key->creater_forward == '0') { ?>
                               
                                <a href="javascript:void(0)" onclick="" class="delete editeCus" title="Delete" id='<?=$key->file_no?>'><i class="fa fa-trash-o menu-icon" style="color: #bd2130"></i></a>
                                <?php } ?>
                                </td>
                                <td>
                                <?php $str2 = substr($key->file_no,0,1); 
                                     if($str2 == 'S') { ?>
                                <a href="<?php echo site_url('index.php/notesheet/salary_notesheet?fileno='.(urldecode($key->file_no))); ?>" target="_blank"><i class="fa fa-print fa-fw fa-2x"></i></a>
                                   <?php  }else{  ?>
                                 <a href="<?php echo site_url('index.php/transaction/print_notesheet?fileno='.(urldecode($key->file_no))); ?>" target="_blank"><i class="fa fa-print fa-fw fa-2x"></i></a>          
                                 <?php   } ?>
                                </td>
                            </tr>
                            <?php   }
                                }else { ?>
                                        <tr><td colspan='6' style='text-align:center'><?php echo  'No record found'?></td></tr>
                            <?php } ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl No</th>
                                <th>File No</th>
                                <!-- <th>Docket No</th> -->
                                <th>Created Date</th>
                                <!-- <th>Created by</th> -->
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Print</th>
                            </tr>
                        </tfoot>
                        </table>
				</div>
			</div>

			</div>
		</div>
	</div>

</div>   <!-- This div start in header.php is of main-panel -->
<script>
$(document).ready(function() {

    $('#add').click(function(e){
        $('#ajaxview').empty();
        $.ajax({
                type: "POST",
                url: '<?=base_url()?>index.php/transaction/create_file',
                success: function(response)
                {
                $('#ajaxview').html(response);
                }
        });
    });

    $('#doclist').on('click', '.link', function(){
        $('#ajaxview').empty();
        $.ajax({
                type: "POST",
                data:{docket_no:$(this).val()},
                url: '<?=base_url()?>index.php/transaction/docdetail',
                success: function(response)
                {
                $('#ajaxview').html(response);
                // CKEDITOR.appendTo( 'rmk');
                CKEDITOR.replace( 'editor1' );
                // ckeditor.replace('#rmk'); // ADD THIS
                //  $('#rmk').ckeditor(); // ADD THIS
                }
        });
    });
    $('.edit').on('click', function(){
        $('#ajaxview').empty();
        $.ajax({
                type: "GET",
                data:{filedetail:$(this).val()},
                url: '<?=base_url()?>index.php/transaction/editfile',
                success: function(response)
                {
                $('#ajaxview').html(response);
                }
        });
    });

    $('#doclist').on('click', '.delete', function(){
        var row = $(this).parents('tr');
        var fileno = $(this).attr('id');
        alert(fileno);
        Swal.fire({  
            title: 'You will not be able to recover this imaginary file!',  
            showDenyButton: true,  showCancelButton: true,  
            confirmButtonText: `Delete`,  
            denyButtonText: `Don't Delete`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */  
                if(result.isConfirmed){
                    $.ajax({
                            type: "POST",
                            url: '<?=base_url()?>index.php/transaction/del_file/',
                            data: {fileno:fileno},
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
                }else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')  
                }
            });
    })
})
</script>
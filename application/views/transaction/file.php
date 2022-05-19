<div class="content-wrapper">
			<div class="card">
			 <div class="card-body" >
				<div class="titleSec">
                    <button type="button" class="btn btn-primary" id='add'>Create File</button>
				<h2>File List</h2> 
				</div>
				<div class="row">
                <div class="col-sm-12"> 
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr><th>Sl No</th>
                                <th>File No</th>
                                <th>File Date</th>
                                <th>Created by</th>
                                <th>Status</th>
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
                                <td><?=date('d/m/Y',strtotime($key->file_date))?></td>
                                <td><?=$key->created_by?></td>
                                <td><?php $key->docket_no?>
                                <a href="<?php echo site_url('index.php/transaction/print_notesheet?fileno='.(urldecode($key->file_no))); ?>" target="_blank"><i class="fa fa-print fa-fw fa-2x"></i></a>
                                <button class="link" value="<?=$key->docket_no?>/<?=$key->file_no?>"> <i class="fa fa-eye fa-fw fa-2x"></i></button>
                                <button class="edit" value="<?=$key->docket_no?>/<?=$key->file_no?>"> <i class="fa fa-edit fa-fw fa-2x"></i></button>
                               
                            </td>
                            </tr>
                            <?php   }
                                }else { ?>
                                        <tr><td colspan='5'><?php echo  'No record found'?></td></tr>
                            <?php } ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl No</th>
                                <th>File No</th>
                                <th>Created Date</th>
                                <th>Created by</th>
                                <th>Status</th>
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
})
</script>
<div class="content-wrapper">
			<div class="card">
			 <div class="card-body" >
				<div class="titleSec">
					 <button type="button" class="btn btn-primary" id='add'>Upload</button>
				<h2>Page Title</h2> 
				</div>
				<div class="row">
                <div class="col-sm-12"> 
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr><th>Sl No</th>
                                <!-- <th>Upload dt</th>  -->
                                <th>Docket No</th>
                                <th>View</th>
                                
                            </tr>
                        </thead>
                        <tbody id='doclist'>
                        <?php if($docs){ 
                                $sl = 0 ;
                                    foreach($docs as $key){
                                    ?>
                            <tr>
                                <td><?=++$sl?></td>
                                <!-- <td><?=date('d/m/Y',strtotime($key->upload_dt))?></td> -->
                                <td><?=$key->docket_no?></td>
                                <td><button type="button" class="btn btn-success link" value="<?=$key->docket_no?>">Detail</button>
                               </td>
                            </tr>
                            <?php   }
                                }else { ?>
                                        <tr><td colspan='4'><?php echo  'No record found'?></td></tr>
                            <?php } ?> 
                        </tbody>
                        <tfoot>
                            <tr><th>Sl No</th>
                                <!-- <th>Upload dt</th> -->
                                <th>Docket No</th>
                                <th>View</th>
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
    $('#add').click(function(e) {
        $('#ajaxview').empty();
        $.ajax({
                type: "POST",
                url: '<?=base_url()?>index.php/dispach/upload',
                success: function(response)
                {
                $('#ajaxview').html(response);
                
                }
        });
    });
    $(document ).ready(function() {
        $('#doclist').on('click', '.link', function(){

            $('#ajaxview').empty();
            $.ajax({
                    type: "POST",
                    data:{docket_no:$(this).val()},
                    url: '<?=base_url()?>index.php/dispach/docdetail',
                    success: function(response)
                    {
                    $('#ajaxview').html(response);
                    
                    }
            });

        });
    })
</script>
	<div class="content-wrapper">
			<div class="card">
			 <div class="card-body">
				<div class="titleSec">
                    <div class='row'>
                        <div class='col-md-3'><h2>Docket List</h2> </div>
                        <div class='col-md-6'>
                            <form action ='<?=base_url()?>index.php/dispach/' method='POST'>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <input type='date' name='from_dt' class='form-control' value='<?=$start_date?>' >
                                </div>
                               
                                <div class='col-md-4'>
                                    <input type='date' name='to_dt' class='form-control' value='<?=$end_date?>' >
                                </div>
                                <div class='col-md-3'>
                                <button type="submit" class="btn btn-success" >Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class='col-md-3'> <button type="button" class="btn btn-primary" id='gdocketno'>Generate Docket No</button> </div>
                     </div>   
				
				</div>
				<div class="row">
					 <div class="col-sm-12"> 
			<table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr><th>Sl No</th>
                    <th>Docket dt</th>
                    <th>Docket No</th>
                    <th>Created By</th>
                    <th>No Of Document</th>
                    <th>Option</th>
                    <th>Forwarded to </th>
                    <th>Forwarded by</th>
                    <th>Forwarded date</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody id='doclist'>
            <?php if($dockets){ 
                       $sl = 0 ;
                        foreach($dockets as $key){
                        ?>
                <tr>
                    <td><?=++$sl?></td>
                    <td><?=date('d/m/Y',strtotime($key->docket_dt))?></td>
                    <td><?=$key->docket_no?></td>
                    <td><?=$key->first_name?></td>
                    
                    <td>
                        <?php if(totaldocument($key->docket_no) == 0 ){ ?>
                        <?=totaldocument($key->docket_no)?>
                        <?php }else{  ?>
                            <button type="button" class="btn btn-success link" value="<?=$key->docket_no?>">Detail</button>
                        <?php } ?>    
                    </td>
                    <td><button type="button" class="btn btn-primary add" value='<?=$key->docket_no?>'>Upload</button></td>
                    <td> <?=docketfrdto($key->docket_no)?></td>
                    <td><?=docketfrdby($key->docket_no,'NAME')?></td>
                    <td><?=docketfrdby($key->docket_no,'DATE')?></td>
                    <td></td>
                </tr>
                <?php   }
                    }else { ?>
                            <tr><td colspan='4'><?php echo  'No record found'?></td></tr>
                <?php } ?> 
            </tbody>
            <tfoot>
                <tr><th>Sl No</th>
                    <th>Docket dt</th>
                    <th>Docket No</th>
                    <th>Created By</th>
                    <th>No Of Document</th>
                    <th>Option</th>
                    <th>Forwarded to </th>
                    <th>Forwarded by</th>
                    <th>Forwarded date</th>
                    <th>File</th>
                </tr>
            </tfoot>
            </table>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>


<script>
    $('#gdocketno').click(function(e) {
          $.ajax({
              type: "POST",
              url: '<?=base_url()?>index.php/dispach/gen_docket',
              //data: $(this).serialize(),
              success: function(response)
              {
                Swal.fire({
                      //title: "Alert Set on Timer",
                      text: response,
                      position: "middle",
                      //backdrop: "linear-gradient(yellow, orange)",
                      background: "white",
                      showCloseButton: true,
                      showCancelButton: true,
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowEnterKey: false,
                      showConfirmButton: false,
                      showCancelButton: false,
                      //timer: 10000
                     }).then((result) => {
                        // Reload the Page
                        location.reload();
                        });
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
        $('#doclist').on('click', '.add', function(){
        $('#ajaxview').empty();
        $.ajax({
                type: "POST",
                data:{docket_no:$(this).val()},
                url: '<?=base_url()?>index.php/dispach/upload',
                success: function(response)
                {
                $('#ajaxview').html(response);
                }
        });
    });
    })

</script>
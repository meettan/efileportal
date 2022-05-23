	<div class="content-wrapper">
			<div class="card">
			 <div class="card-body">
				<div class="titleSec">
					 <button type="button" class="btn btn-primary" id='gdocketno'>Generate Docket No</button>
				<h2>Page Title</h2> 
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
                </tr>
            </thead>
            <tbody>
            <?php if($dockets){ 
                       $sl = 0 ;
                        foreach($dockets as $key){
                        ?>
                <tr>
                    <td><?=++$sl?></td>
                    <td><?=date('d/m/Y',strtotime($key->docket_dt))?></td>
                    <td><?=$key->docket_no?></td>
                    <td><?=$key->first_name?></td>
                    <td><?=totaldocument($key->docket_no)?></td>
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

</script>
<div class="content-wrapper">
			<div class="card">
			 <div class="card-body" >
				<div class="titleSec">
					 
				<h2>Forwarded Docket No</h2> 
				</div>
				<div class="row">
                <div class="col-sm-12"> 
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr><th>Sl No</th>
                                <!-- <th>Upload dt</th>  -->
                                <th>Docket No</th>
                                <th>Forwarded Date</th>
                            </tr>
                        </thead>
                        <tbody id='doclist'>
                        <?php if($forwarded){ 
                                $sl = 0 ;
                                    foreach($forwarded as $key){
                                    ?>
                            <tr>
                                <td><?=++$sl?></td>
                                <td><?=$key->docket_no?></td>
                                <td><?=date('d/m/Y',strtotime($key->fwd_at))?></td>
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
                                <th>Forwarded Date</th>
                            </tr>
                        </tfoot>
                        </table>
				</div>
			</div>

			</div>
		</div>
	</div>

</div>   <!-- This div start in header.php is of main-panel -->
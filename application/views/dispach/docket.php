	<div class="content-wrapper">
			<div class="card">
			 <div class="card-body">
				<div class="titleSec">
                    <div class='row'>
                        <div class='col-md-3'><h2>Docket List</h2> 
                       
                        </div>
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
                        <div class='col-md-3'> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#docket_create_model" id='gdocketnof'>Generate Docket No</button> </div>
              
                     </div>   
                     <?php if ($this->session->flashdata('success') != ''):   ?>
                        <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php  echo $this->session->flashdata('success');  ?>
                        </div>
                        <?php endif; ?>
				</div>
				<div class="row">
					 <div class="col-sm-12"> 
			<table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr><th>Sl No</th>
                    <th>Docket dt</th>
                    <th>Docket No</th>
                    <th>Created By</th>
                    <th>View</th>
                    <th>Upload</th>
                    <!-- <th>Forwarded to </th>
                    <th>Forwarded by</th>
                    <th>Forwarded date</th>
                    <th>File</th> -->
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
                            <span class="link" id ="<?=$key->docket_no?>"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            <!-- <button type="button" class="btn btn-success link" value="<?=$key->docket_no?>">Detail</button> -->
                        <?php } ?>    
                    </td>
                    <td><span class="add" id='<?=$key->docket_no?>'><i class="fa fa-upload" aria-hidden="true"></i>
                     </td>
                    <!-- <td> <?=docketfrdto($key->docket_no)?></td>
                    <td><?=docketfrdby($key->docket_no,'NAME')?></td>
                    <td><?=docketfrdby($key->docket_no,'DATE')?></td>
                    <td></td> -->
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
                    <th>View</th>
                    <th>Upload</th>
                    <!-- <th>Forwarded to </th>
                    <th>Forwarded by</th>
                    <th>Forwarded date</th>
                    <th>File</th> -->
                </tr>
            </tfoot>
            </table>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="docket_create_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Generate Docket</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action ='javascript:void(0)' method="POST"  id='gdocketno'  onsubmit="formSubmit();">
      <div class="form-group row">
                    <div class="col-sm-3 fieldname">Received from<span style="color: red;"> *</span></div>
                    <div class="col-sm-9">
                            <input type ='text' name='received_from' class='form-control' required/>
                    </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-3 fieldname">Bill/Memo no<span style="color: red;"> *</span></div>
                    <div class="col-sm-9">
                             <input type ='text' name='bill_memo_no' class='form-control' required/>  
                    </div>
            </div>
            <div class="form-group row">
                    <div class="col-sm-3 fieldname">Subject<span style="color: red;"> *</span></div>
                    <div class="col-sm-9">
                             <input type ='text' name='subject' class='form-control' required/>  
                    </div>
            </div>
            <div class="form-group row">
                        <div class="col-sm-3 fieldname">Remarks</div>
                        <div class="col-sm-9">
                                <textarea name='remarks' class='form-control'></textarea>
                        </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-10"></div>
               <div class="col-sm-2"><input type="submit" name="submit" value='save' class='btn btn-primary' /></div>
                
            </div>   
            </form>    
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>  


<script>
    function formSubmit(){
          $.ajax({
              type: "POST",
              url: '<?=base_url()?>index.php/dispach/gen_docket',
              data: $('#gdocketno').serialize(),
              success: function(response)
              {
                Swal.fire({
                      //title: "Alert Set on Timer",
                      text: response,
                      position: "middle",
                      type: "success",
                      //backdrop: "linear-gradient(yellow, orange)",
                      background: "white",
                      //showCloseButton: true,
                     // showCancelButton: true,
                      allowOutsideClick: false,
                      allowEscapeKey: false,
                      allowEnterKey: false,
                      showConfirmButton: true,
                      showCancelButton: false,
                      //timer: 10000
                     }).then((result) => {
                        // Reload the Page
                        location.reload();
                        });
            }
        });
    };

    $(document ).ready(function() {

        $('#doclist').on('click', '.link', function(){

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
        $('#doclist').on('click', '.add', function(){
        $('#ajaxview').empty();
        $.ajax({
                type: "POST",
                data:{docket_no:$(this).attr("id")},
                url: '<?=base_url()?>index.php/dispach/upload',
                success: function(response)
                {
                $('#ajaxview').html(response);
                }
        });
    });
    })

</script>
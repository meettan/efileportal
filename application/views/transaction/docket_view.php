<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                              <a href='<?=base_url()?>index.php/transaction/'>  <button type="button" class="btn btn-primary" id="list">List</button></a>
                            <h2>Page Title</h2> 
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/dispach/add_doc/" enctype='multipart/form-data'>
                          
                            <div class="form-group row">
                                <div class="col-sm-2">Docket No</div>
                                <div class="col-sm-4">
                                <input type="text" name="docket_no" required class="form-control" value='<?=$dkt->docket_no?>' id='docket_no' readonly >
                                </div>
                                <div class="col-sm-2">Status</div>
                                <div class="col-sm-4">
                                <input type="text" name="*" required class="form-control" value='<?php  if($status->cnt != 0) { echo 'FORWARDED'; }else{ echo 'PENDING'; } ?>' id='*' readonly >
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-2">Docket date</div>
                               <div class="col-sm-4">
                               <input type="text" name="docket_no" required class="form-control" value='<?=date('d/m/Y',strtotime($dkt->docket_dt))?>'  readonly >
                                </div>
                                <div class="col-sm-2">Created By</div>
                               <div class="col-sm-4">
                               <input type="text" name="docket_no" required class="form-control" value='<?=$dkt->first_name?>'  readonly >
                                </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-sm-2">Remarks</div>
                               <div class="col-sm-10">
                                <textarea name='remarks' class="form-control" placeholder='Remarks' readonly><?php echo $remarks->remarks?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <div class='row' id='#intro2'>
                                <!-- <table class="table">
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
                                 </table>  -->
                                 <?php foreach($docs as $key) { 
                                     $ext = explode('.',$key->document)[1]; 
                                     $ids ='';
                                     if($ext == 'pdf'){
                                        $ids ='myModal';
                                     }else{
                                        $ids ='myModals';
                                     }
                                     ?> 
                                 <div class='col-md-3 img-wrap'>
                                 <span class="close del" value='<?=$key->sl_no?>/<?=$key->docket_no?>/<?=$key->document?>' id='<?=$key->sl_no?>/<?=$key->docket_no?>/<?=$key->document?>'>&times;</span>
                                 <li> <a href="#<?=$ids?>" data-toggle="modal" value='<?=$key->document?>' data-img-url="<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>">
                                 <?php $exten = explode('.',($key->document)); if($exten[1] != 'pdf'){ ?>
                                 <img src="<?=base_url()?>uploads/<?=$dt->docket_no?>/<?=$key->document?>" alt="pdf" class="" id="docdel" style="height: 100px !important;">
                                 <?php } else { ?>
                                <img src="<?=base_url()?>uploads/PDFsample.svg"  id='docdel'
                                   class="rounded float-left" style="" alt="pdf" >
                                 <?php } ?> 
                                </a></li>
                                  </div>
                                  <?php } ?>
                                 </div>
                            </div>	
                        </form>
                </div>
        <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            
                <div class="modal-content" >
                    <div class="modal-body">
                    <iframe src="" style="width: 750px;height:700px"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModals" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            
                <div class="modal-content" >
                    <div class="modal-body">
                    <img src="" ></img>
                    </div>
                </div>
            </div>
        </div>

            </div>
        </div>
    </div>
</div>
<script>

$( document ).ready(function() {
    
        $('#intro2').on('click', '.simg', function(){
               
            var ext = $(this).val();
                Swal.fire({
                        text: "Thanks!!",
                        position: "middle",
                        color: '#f0f0f0',
                        imageUrl: "<?=base_url()?>uploads/<?=$dkt->docket_no?>/"+ext,
                        timer: 100000
                });
        });
            
})
$('.img-wrap').on('click', 'li a', function(){ 
//$('li a').click(function(e) {
    var img = $(this).attr('data-img-url');
    var extension = img.substr( (img.lastIndexOf('.') +1) );
    if(extension == 'pdf' ){
        $('#myModal iframe').attr('src', $(this).attr('data-img-url'));
    }else{
       $('#myModals img').attr('src', $(this).attr('data-img-url'));
    }
        
});
</script>
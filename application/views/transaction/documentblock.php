                 <?php if($docs){  ?>
                    <?php foreach($docs as $doc);?> 
                    <!-- <div class="form-group row">
                        <div class="col-sm-2">Remarks</div>
                        <div class="col-sm-10">
                        <textarea class='form-control' readonly><?=$doc->remarks?></textarea></div> 
                    </div>  -->
                 <input type="hidden" name='status' value='1' id='status'>
                 <div class="form-group row">
                    <?php foreach($docs as $key){ ?>   
                          <div class="col-sm-2">
                          <div class="thumImgMain">
                              <div class='thumImg'  style="height:80px">
                              <?php $exten = explode('.',($key->document)); 
                                    if($exten[1] != 'pdf'){
                              ?>
                               <img src="<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>" data-toggle="modal" id='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>'
                               class="rounded float-left" alt="..." >
                               <?php } else { ?>
                                <img src="<?=base_url()?>uploads/PDFsample.svg" data-toggle="modal" id='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>'
                               class="rounded float-left" alt="..." style="height: 80px;width: 100px;">
                               <?php } ?> 
                               </div>
                               <div class="thumImgTitle"><?=$key->name ?></div>
                           </div>
                          </div>
                    <?php } }?>
                    </div>  
                
                              
               
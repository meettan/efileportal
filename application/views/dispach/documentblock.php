                 <?php if($docs){  ?>
                    <?php foreach($docs as $doc);?> 
                    <div class="form-group row"><div class="col-sm-2">Remarks</div><div class="col-sm-10">
                        <textarea class='form-control' readonly><?=$doc->remarks?></textarea></div> </div> 
                 <input type="hidden" name='status' value='1' id='status'>
                 <div class="form-group row">
                 <?php foreach($docs as $key){?>   
                          <div class="col-sm-3" >
                              <div class='row' style='margin-bottom:15px;'>
                               <img src="<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>" data-toggle="modal" id='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>'
                               class="rounded float-left" style="height:150px!important;"alt="..." >
                           </div>
                               <span style='font-size:22px;border: 2px solid;padding: 5px;'><b><?=$key->name ?></b></span>
                          </div>
                         
                          <?php } ?>
                 </div>
                <?php }else { ?>   
                    <input type="hidden" name='status' value='0' id='status'>
                       
                              <div class='row' >
                              <div class="col-sm-4"></div>
                              <div class="col-sm-6"><br><h2 style="color:red">No Document To Forward</h2></div>
                             </div>
                               
                         

                 <?php } ?>   
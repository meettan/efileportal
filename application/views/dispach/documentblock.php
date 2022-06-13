                <?php if($docs){  ?>
                    <?php foreach($docs as $doc);?>
                    <input type="hidden" name='status' value='1' id='status'> 
                    <div class="form-group row">
                        <div class="col-sm-2 fieldname">Created By</div>
                        <div class="col-sm-4">
                        <input type="text" class='form-control' value='<?=$docket->first_name?>' readonly> 
                        </div>
                        <div class="col-sm-2 fieldname">Created Date</div>
                        <div class="col-sm-4">
                        <input type="text" class='form-control' value='<?=$docket->docket_dt?>' readonly> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 fieldname">Remarks</div>
                        <div class="col-sm-10">
                        <textarea class='form-control' readonly><?=$doc->remarks?></textarea>
                        </div>
                    </div> 
                 
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
                 <br>
                <div class="form-group row">
                        <div class="col-sm-2 fieldname">User</div>
                        <div class="col-sm-4">
                                <select name='user' class='form-control' required>
                                    <option value=''>Select user</option>
                                        <?php foreach($users as $key) { ?>
                                        <option value='<?=$key->id?>'><?=$key->first_name?></option>
                                        <?php } ?>
                                </select>
                        </div>
                        <div class="col-sm-4 btnSubmitSec">
                                <input type="submit" class="btn btn-info" id="submit" name="submit" value="Forward">
                            <!-- <input type="reset" onclick="" class="btn btn-info" value="Cancel">-->
                        </div>
                </div>    
                <?php }else { ?>   
                    <input type="hidden" name='status' value='0' id='status'>
                       
                        <div class='row' >
                        <div class="col-sm-4"></div>
                        <div class="col-sm-6"><br><h2 style="color:red">No Document To Forward</h2></div>
                        </div>
                <?php } ?>   
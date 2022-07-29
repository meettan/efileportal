                <?php //if($docs){  ?>
                    <?php foreach($docs as $doc);?>
                    <input type="hidden" name='status' value='1' id='status'> 
                    <div class="form-group row">
                        <div class="col-sm-2 fieldname">Created By</div>
                        <div class="col-sm-4">
                        <input type="text" class='form-control' value='<?=$docket->first_name?>' readonly> 
                        </div>
                        <div class="col-sm-2 fieldname">Created Date</div>
                        <div class="col-sm-4">
                        <input type="text" class='form-control' value='<?=date('d-m-Y',strtotime($docket->docket_dt))?>' readonly> 
                        </div>
                    </div>
                    <?php if(isset($doc->remarks) && $doc->remarks !='') { ?>
                    <div class="form-group row">
                        <div class="col-sm-2 fieldname">Remarks</div>
                        <div class="col-sm-10">
                        <textarea class='form-control' readonly><?php if(isset($doc->remarks)){echo $doc->remarks;}?></textarea>
                        </div>
                    </div> 
                    <?php   } ?>
                 <div class="form-group row">
                 <div class="pdfListBlockMain">
                 <?php foreach($docs as $key){?>   
                          <div class="pdfListBlock">
                              <div class='pdfImg'>
                              <?php $exten = explode('.',($key->document)); 
                                    if($exten[1] != 'pdf'){
                              ?>
                               <img src="<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>" data-toggle="modal" id='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>'
                               class="rounded float-left" alt="..." >
                               <?php } else { ?>
                                <img src="<?=base_url()?>uploads/PDFsample.svg" data-toggle="modal" id='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>'
                               class="rounded float-left" alt="..." >
                               <?php } ?> 
                           </div>
                               <div class="pdfTitle"><?=$key->name ?></div>
                          </div>
                         
                    <?php } ?>
                    </div>
                 </div>
                 <br>
                 <div class="form-group row">
                    <div class="col-sm-2 fieldname">Received from<span style="color: red;"> *</span></div>
                    <div class="col-sm-10">
                            <input type ='text' name='received_from' class='form-control' required/>
                    </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-2 fieldname">Bill/Memo no<span style="color: red;"> *</span></div>
                    <div class="col-sm-10">
                             <input type ='text' name='bill_memo_no' class='form-control' required/>  
                    </div>
                 </div>
                 <div class="form-group row">
                    <div class="col-sm-2 fieldname">Subject<span style="color: red;"> *</span></div>
                    <div class="col-sm-10">
                             <input type ='text' name='subject' class='form-control' required/>  
                    </div>
                 </div>
                 <div class="form-group row">
                        <div class="col-sm-2 fieldname">Remarks</div>
                        <div class="col-sm-10">
                                <textarea name='remarks' class='form-control'></textarea>
                        </div>
                 </div>        
                    <div class="form-group row">
                    <div class="col-sm-2 fieldname">Department</div>
                        <div class="col-sm-3">
                                <select name='dept' class='form-control' required>
                                    <option value=''>Select</option>
                                        <?php foreach($depts as $dept) { ?>
                                        <option value='<?=$dept->sl_no?>'><?=$dept->department_name?></option>
                                        <?php } ?>
                                </select>
                        </div>
                        <div class="col-sm-1 fieldname">User</div>
                        <div class="col-sm-3">
                                <select name='user' class='form-control' required>
                                    <option value=''>Select user</option>
                                        <?php foreach($users as $key) { ?>
                                        <option value='<?=$key->id?>'><?=$key->first_name?></option>
                                        <?php } ?>
                                </select>
                        </div>
                        
                        <div class="col-sm-2 btnSubmitSec">
                                <input type="submit" class="btn btn-info" id="submit" name="submit" value="Forward">
                            <!-- <input type="reset" onclick="" class="btn btn-info" value="Cancel">-->
                        </div>
                </div>    
                <?php // }else { ?>   
                    <!-- <input type="hidden" name='status' value='0' id='status'>
                       
                        <div class='row' >
                        <div class="col-sm-4"></div>
                        <div class="col-sm-6"><br><h2 style="color:red">No Document To Forward</h2></div>
                        </div> -->
                <?php //} ?>   
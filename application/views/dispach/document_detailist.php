                 <?php if($dockets){  ?>
                   
                    <!-- <div class="form-group row">
                        <div class="col-sm-2">Remarks</div>
                        <div class="col-sm-10">
                        <textarea class='form-control' readonly><?php //$doc->remarks?></textarea>
                        </div>
                     </div>  -->
                 <div class="form-group row">
                
                         <table class="table table-striped table-bordered" style="width:100%" id="example" >
                             <thead> 
                                 <tr>
                                 <th>Sl No</th>
                                 <th>Docket dt</th>
                                <th>Docket No</th>
                                <th>Created By</th>
                                <th>No Of Document</th>
                                 <!-- <th>Forwarded to </th>
                                 <th>Forwarded by </th>
                                 <th>Forwarded date </th> -->
                                 </tr>       
                             </thead>
                             <tbody id="doclist">
                             <?php    $i = 0;
                                  foreach($dockets as $key){ ?>
                                <tr>
                                <td><?=++$i?></td>
                                 <td><?=date('d/m/Y',strtotime($key->docket_dt))?> </td>
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
                                </tr> 
                                 <?php } ?>
                             </tbody>
                         </table>
                          
                 </div>
                <?php }else { ?>   
                    
                 <?php } ?>   
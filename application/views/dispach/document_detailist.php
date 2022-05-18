                 <?php if($docs){  ?>
                    <?php foreach($docs as $doc);?> 
                    <div class="form-group row"><div class="col-sm-2">Remarks</div><div class="col-sm-10">
                        <textarea class='form-control' readonly><?=$doc->remarks?></textarea></div> </div> 
                 <div class="form-group row">
                
                         <table class="table table-bordered">
                             <thead> 
                                 <tr>
                                 <th>Sl no</th>
                                 <th>Upload Date</th>
                                 <th>Document Name</th>
                                 <th>Document</th>
                                 <th>Forwarded to </th>
                                 <th>Forwarded by </th>
                                 <th>Forwarded date </th>
                                 </tr>       
                             </thead>
                             <tbody>
                             <?php    $i = 0;
                                   foreach($docs as $key){?>   
                                <tr>
                                <td><?=++$i?></td>
                                 <td><?=date('d/m/Y',strtotime($key->upload_dt)) ?> </td>
                                 <td><b><?=$key->name ?></b> </td>
                                 <td> <img src="<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>" data-toggle="modal" id='<?=base_url()?>uploads/<?=$key->docket_no?>/<?=$key->document?>'
                               class="rounded float-left" style="height:50px!important;"alt="..." ></td>
                               <td><?=$key->first_name?> </td>
                               <td><?=$key->fwd_by?> </td>
                               <td><?=date('d/m/Y',strtotime($key->fwd_at)) ?> </td>
                                </tr> 
                                 <?php } ?>
                             </tbody>
                         </table>
                          
                 </div>
                <?php }else { ?>   
                    
                 <?php } ?>   
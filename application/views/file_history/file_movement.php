<div class="col-sm-12" style='margin-bottom:20px'>
<div class='row'>            
<div class="col-sm-4"></div><div class="col-sm-4"><div class="bg-success text-white" style='padding:10px'>
 Created By: <?php if(isset($filedtl->first_name)) echo $filedtl->first_name; ?> Created Date:  <?php if(isset($filedtl->created_at)) echo date('d/m/Y',strtotime(explode(' ',$filedtl->created_at)[0])).' '.explode(' ',$filedtl->created_at)[1] ; ?>
</div></div>
<div class='col-sm-4'></div>
</div>
</div>
<br>
<hr>
<div class="col-sm-12" style='text-align:center;margin-bottom:10px;color:red'>

    <h3>File Movement</h3>

</div>
<div class="col-sm-12" >
    <div class='row'>
    <?php if($comment_author) { $i = 0;
            foreach($comment_author as $ca){
             if($i > 0) {
                            ?>
                  
    <div style="margin-top: 30px;"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
    <?php } ?>
    <div class='col-sm-2' style="margin-bottom: 10px;">
        <div class='bg-primary text-white' style='padding:10px'>
        Forwarded By: <?php if(isset($ca->first_name)) echo $ca->first_name; ?> / Forwarded Date: <?php if(isset($ca->forwarded_at)) echo date('d/m/Y',strtotime(explode(' ',$ca->forwarded_at)[0])).' '.explode(' ',$ca->forwarded_at)[1] ; ?>
        </div>
     </div>
     <?php if ($ca->fwd_status == 'R'){ $cvar ='style="color: #ff0000;"'; $btn ='bg-danger';  }else{ $cvar = ''; $btn ='bg-success';} ?>
     <div style="margin-top: 30px;"><i class="fa fa-arrow-right" aria-hidden="true" <?=$cvar?> ></i></div>
    
     <div class='col-sm-2' style="margin-bottom: 10px;">
        <div class='<?=$btn?> text-white' style='padding:10px'>
        Forwarded To: <?php $objct = user_fist($ca->fwd_to); 
                                echo $objct->first_name;
        ?> / Forwarded Date: <?php if(isset($ca->forwarded_at)) echo date('d/m/Y',strtotime(explode(' ',$ca->forwarded_at)[0])).' '.explode(' ',$ca->forwarded_at)[1] ; ?>
        </div>
     </div>
     
    <?php   $i++;  }   
      }
    ?>
    </div>
</div>


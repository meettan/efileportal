<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                        <!--  <a href='<?=base_url()?>index.php/dispach/upload/'>  <button type="button" class="btn btn-primary" id="list">List</button></a> -->
                <h2>Page Title</h2> <?php if ($this->session->flashdata('success') != ''):   ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php  echo $this->session->flashdata('success');  ?>
    </div>
   <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                <form method="post" action="<?=base_url()?>index.php/dispach/searchdoc/" enctype='multipart/form-data' id='forward'>
                        <div class="form-group row">
                            <div class="col-sm-2 fieldname" style="color: #008000;">Search Process</div>
                            <div class="col-sm-2">
                                <input type="radio" name="searchtype" value="docket">
                                <label class="fieldname"> Docket No</label>
                            </div>   
                            <div class="col-sm-2">
                                <input type="radio" name="searchtype" value="daterange">
                                <label class="fieldname"> Date Range</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12" id='sb' style='display:none'>
                                <div class='row'>
                                <div class="col-sm-2 fieldname" style="color: #0000ff;">Docket No</div>
                                <div class="col-sm-4">
                                <input type="text" name="docket_no"  class="form-control" id='docket_no' disabled >
                                </div>
                                </div>
                            </div>
                            <div class="col-md-12" id='sr' 
                            <?php if($start_date) { ?>
                            style=''
                            <?php }else{  ?>
                                style='display:none'
                            <?php }?>
                            >
                                <div class='row'>
                                <div class="col-sm-3">
                                <input type="date" name="from_dt" required class="form-control" id='from_dt' disabled value='<?php if($start_date) { echo $start_date;}?>'>
                                </div>
                                <div class="col-sm-3">
                                <input type="date" name="to_dt" required class="form-control" id='to_dt' disabled value='<?php if($end_date) { echo $end_date;}?>'>
                                </div>
                                <div class="col-sm-2">
                                <input type="submit" name="submit" class="form-control" value='submit' id='submit' disabled>
                                </div>
                                </div>
                            </div>
                        </div>

                            </form> 
                            <div id='docdetail'>
                                
                    <?php      if($dockets){   ?>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Docket dt</th>
                                    <th>Docket No</th>
                                    <th>Created By</th>
                                    <th>No Of Document</th>
                                  
                                </tr>
                            </thead>
                            <tbody id='doclist'>
                            <?php   $sl = 0 ;
                                    foreach($dockets as $key){  ?>
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
                                   
                                </tr>
                                <?php   }
                                    ?>
                            </tbody>
                            <tfoot>
                                <tr><th>Sl No</th>
                                    <th>Docket dt</th>
                                    <th>Docket No</th>
                                    <th>Created By</th>
                                    <th>No Of Document</th>
                                   
                                </tr>
                            </tfoot>
                            </table>
                    <?php } ?> 
                            </div>
                </div>
            </div>
                    
        </div>
    </div>
</div>

        <div class="modal fade" id="exampleModal" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- w-100 class so that header
                        div covers 100% width of parent div -->
                            <h5 class="modal-title w-100"
                                id="exampleModalLabel">
                               
                            </h5>
                            <button type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                        </div>
                        <!--Modal body with image-->
                        <div class="modal-body">
                            <img id="myImage" src="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
<script>

$("#docket_no").on("change", function() {
    
    $.ajax({
            type: "POST",
            url: '<?=base_url()?>index.php/dispach/docket_detaillist/',
            data: {docket_no:$(this).val()},
            success: function(response)
            {
                if (response != 0){
                    $("#docdetail").html(response);
                }
                else
                {
                    $("#docket_no").val('');
                    Swal.fire({
                    //title: "Alert Set on Timer",
                    text: "Docket No Does not Exist.",
                    position: "middle",
                    color: '#f0f0f0',
                    background: "#ffc0cb",
                    timer: 100000
                    });
                }
            }
    });
})
$(document).ajaxComplete(function() {
    $(".rounded").click(function () {
        var myBookId = $(this).attr('id');
        $('#myImage').attr('src', myBookId);
        $(this).attr('data-target', '#exampleModal');
    });
})

$('input:radio[name="searchtype"]').change(function(){
    if($(this).val() == 'docket'){
        $("#docdetail").html('');
        $("#docket_no").prop("disabled", false);
        $("#from_dt").prop("disabled", true);
        $("#to_dt").prop("disabled", true);
        $("#submit").prop("disabled", true);
        $("#sb").show();
        $("#sr").hide();
    }else{
        $("#docdetail").html('');
        $("#docket_no").prop("disabled", true);
        $("#from_dt").prop("disabled", false);
        $("#to_dt").prop("disabled", false);
        $("#submit").prop("disabled", false);
        $("#sb").hide();
        $("#sr").show();
    }
    
});
$( document ).ready(function() {
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

})
$( document ).ajaxComplete(function() {
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
})

</script>
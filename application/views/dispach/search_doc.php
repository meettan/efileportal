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
                        <form method="post" action="<?=base_url()?>index.php/dispach/forward_doc/" enctype='multipart/form-data' id='forward'>
                            <div class="form-group row">
                                <div class="col-sm-2">Docket No</div>
                                <div class="col-sm-4">
                                <input type="text" name="docket_no" required class="form-control" id='docket_no'>
                                </div>
                            </div>
                            <div id='docdetail'>
                            </div>
                            	
                        </form> 
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
$( document ).ajaxComplete(function() {
    $(".rounded").click(function () {
        var myBookId = $(this).attr('id');
        $('#myImage').attr('src', myBookId);
        $(this).attr('data-target', '#exampleModal');
    });
})  

</script>
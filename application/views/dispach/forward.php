<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                        <!--  <a href='<?=base_url()?>index.php/dispach/upload/'>  <button type="button" class="btn btn-primary" id="list">List</button></a> -->
        <h2>Docket List</h2> 
        <?php if ($this->session->flashdata('success') != ''):   ?>
       <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php  echo $this->session->flashdata('success');  ?>
        </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error') != ''):   ?>
       <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php  echo $this->session->flashdata('error');  ?>
        </div>
        <?php endif; ?>
            </div>
            <div class="row">
            
                <div class="col-sm-12"> 
                        <form method="post" action="<?=base_url()?>index.php/dispach/forward_doc/" enctype='multipart/form-data' id='forward'>
                            <div class="form-group row">
                                <div class="col-sm-2 fieldname">Docket No</div>
                                <div class="col-sm-4">
                                    <select class="form-control select2" name='docket_no' id='docket_no' required >
                                        <option value=''>Select</option>
                                        <?php foreach($dockets as $doc){ ?>
                                        <option value='<?=$doc->docket_no?>'><?=$doc->docket_no?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div id='imgdetails'>
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
                            <iframe id="frame" style="width: 750px;height:700px"></iframe>
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
$('.addAnotherrow').click(function(){

let row = '<tr>'+
			'<td><input type="text" name="name[]" class="form-control"></td><td><input type="file" name="fileToUpload[]" required class="form-control doc"></td>'
            +'<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>'
          +'</tr>';
 
    $('#intro2').append(row);
    //$('#order_no'+count, '#intro2').select2();
    });

    $("#intro2").on('click', '.removeRow',function(){
                $(this).parents('tr').remove();
    });


    $("#docket_no").on("change", function() {
        $("#imgdetails").html();
        $.ajax({
                type: "POST",
                url: '<?=base_url()?>index.php/dispach/docket_detail/',
                data: {docket_no:$(this).val()},
                success: function(response)
                {   
                    $("#imgdetails").html(response);
                    // if (response != 0){
                    //     $("#imgdetails").html(response);
                    // }
                    // else
                    // {
                    //     $("#docket_no").val('');
                    //     $("#imgdetails").html('');
                    //     Swal.fire({
                    //     //title: "Alert Set on Timer",
                    //     text: "Docket No Does not Have Document.",
                    //     position: "middle",
                    //     color: '#f0f0f0',
                    //     background: "#ffc0cb",
                    //     timer: 100000
                    //     });
                    // }
                }
        });
    })
    $( document ).ajaxComplete(function() {
        $(".rounded").click(function () {
            var myBookId = $(this).attr('id');
            var lastItem = myBookId.split(".").pop();
            if(lastItem == 'pdf'){
                $("#frame").attr("src", myBookId);
            }else{
                $('#myImage').attr('src', myBookId);
                $("#frame").attr("src", '');
            }
            $(this).attr('data-target', '#exampleModal');
        });
    })  
    $("#forward").on("submit", function(){
    var status =$('#status').val();
    if(status == 0){
        alert('No document to forward');
        event.preventDefault()
    }else{
        return true;
    }
    })
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
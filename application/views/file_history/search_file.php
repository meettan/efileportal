<div class="content-wrapper">
	<div class="card">
        <div class="card-body" >
            <div class="titleSec">
                        <!--  <a href='<?=base_url()?>index.php/dispach/upload/'>  <button type="button" class="btn btn-primary" id="list">List</button></a> -->
                <h2>File Detail</h2> <?php if ($this->session->flashdata('success') != ''):   ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
             <?php  echo $this->session->flashdata('success');  ?>
    </div>
   <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-sm-12"> 
                <form method="post" action="javascript:void(0)" enctype='multipart/form-data' id='form'>
                        <div class="form-group row">
                            <div class="col-md-12" id='sb' style=''>
                                <div class='row'>
                                <div class="col-sm-2 fieldname" style="color: #0000ff;">File No</div>
                                <div class="col-sm-4">
                                <input type="text" name="file_no"  class="form-control" id='docket_no'  >
                                </div>
                                <div class="col-sm-2" style="color: #0000ff;"><input type='submit' class='btn btn-info' name="submit" value='submit'/></div>
                                </div>
                            </div>
                        </div>
                </form> 
               
                </div>
            </div>
            <div class="row" id='file_move'>
                
            </div>       
        </div>
    </div>
</div>

      
<script>

$("#form").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var actionUrl = "<?=base_url()?>index.php/file_history";

$.ajax({
    type: "POST",
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function(data)
    {
       $('#file_move').html(data);
    }
});

});

</script>
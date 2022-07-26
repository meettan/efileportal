<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css">
<script>

    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');
        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed; ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }

</script>

<div id="divToPrint">
    <div class="wraper"> 
        <div class="col-lg-12 container contant-wraper">
            <div class="panel-heading">
                <div class="item_body">
                    <div style="text-align:right;margin-bottom:60px">
                        <p>File NO : <b><?php  echo $notesheet->file_no; ?></b></p>
                        <h3></h3>
                    </div>
                </div>
            </div>
            <?php  echo $notesheet->note_sheet; ?>
        </div>
        <div class="col-lg-12 container contant-wraper">
            <?php if($comment_author) { 
                            foreach($comment_author as $ca){
                    ?>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title"> Remarks By: <?php if(isset($ca->first_name)) echo $ca->first_name; ?> / Forwarded Date: <?php if(isset($ca->forwarded_at)) echo date('d/m/Y',strtotime(explode(' ',$ca->forwarded_at)[0])).' '.explode(' ',$ca->forwarded_at)[1] ; ?></h5>
                                    <?php if(isset($ca->remarks)) echo $ca->remarks; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php } }?>
        </div>
    </div>
</div>
   <div class="modal-footer">

                <!-- <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/sw/billShortage');?>'">Back</button> -->
               <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
           </div>

<script type="text/javascript">
    // $(function () {
    //     $("#btnExport").click(function () {
    //         $("#htmltable").table2excel({
    //             filename: "Delivery Details From: <?php //echo date("d-m-Y", strtotime($startDt)).' To '.date("d-m-Y", strtotime($endDt) );?>.xls"
    //         });
    //     });
    // });
</script>
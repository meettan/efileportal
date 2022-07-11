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

                    <div style="text-align:center;">

                        <h3></h3>
                        <h4></h4>
                        <h4><!--Personal Leave Ledger For: <?php //echo $data->emp_name.' / '.$data->emp_no ; ?> --> </h4>
                        
                    </div>

                </div>

            </div>

            <br>
            <?php if($data != ''){   ?>
            <div>
			<?php $leave = '';
			    if($data->leave_type == 'CL'){ $leave = 'Casual Leave';}
				else if($data->leave_type == 'ML'){ $leave = 'Medical Leave';}
				else if($data->leave_type == 'EL'){ $leave = 'Earned Leave';}
				else if($data->leave_type == 'OD'){ $leave = 'Off Day';}
				?>
                <p><?php echo $data->letterfirstline; ?> </p>
	  <!--		<p>
			Sri  has submitted an application dt. duly receipt no .</p> -->
			
			<p>So Sri <?php echo $data->emp_name; ?> has requested to adjust the leaves in <?=$leave?> ground.</p>
			<p>Put up to CEO through ARCS and Deputy Manager for perusal and taking necessary action please. </p>

            </div>
               <?php }else{ ?> 
                 <p>No leave application Found with docket number.</p>
                <?php  } ?>
            <br>
            <div>

               
            </div>

        </div>
    
    </div>

</div>


<div class="modal-footer">

    <!-- <button class="btn btn-primary" type="button" onclick="location.href='<?php //echo base_url('index.php/User_Login/main');?>'">Back</button> -->

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>

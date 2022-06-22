<style>
    table {
        border-collapse: collapse;
    }

    .table{
        width: 236%;
        max-width: 250%;
        margin-bottom: 20px;
    }

    table, td, th {
        border: 1px solid #dddddd;

        padding: 6px;

        font-size: 14px;
    }

    th {

        text-align: center;

    }

    tr:hover {background-color: #f5f5f5;}

</style>

<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          .table{ width: 236%; max-width: 250%; margin-bottom: 20px; } table { border-collapse: collapse; font-size: 14px;}' +
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 10px;}' +
            '                                           th, td { }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
</script>
  

  <?php     
        $bp = $gp  =  $gross = $pf = $ptax = $tot_deduct = $net =
        $basic = $da  =  $ir = $hra = $ma = $ca = $ga = $gi =
        $fa = $lic  =  $itx = $pa = 0;        
  ?>

    <div class="wraper"> 
        <div class="col-lg-12 container contant-wraper">
            <div id="divToPrint">
                <div class="item_body">
                    <div style="text-align:center;">
                        <h3><br></h3>
                        <h3><br></h3>
                        <h3><br><!-- SALARY FOR THE -->
						<?php //if ($this->input->post('category') == 1) {
                            // echo "REGULAR ";
                        // }
                        // else if ($this->input->post('category') == 2){
                            // echo "CONTRACTUAL Basis ";
                        // } 
                        // else if ($this->input->post('category') == 3) {
                            // echo "DAILY WAGES ";
                        // }
						?>
						<!--EMPLOYEES FOR THE MONTH OF --><?php //echo $this->input->post('sal_month').' '.$this->input->post('year') ; ?></h3>
                        <!--<h3>Allowing Periodical Increment 3%</h3>-->
                    </div>
                </div>
        
                <br>

                <table class="table table-bordered table-hover" style="width: 100%;">

                    <thead>

                        <?php 
                            if($this->input->post('category') == 2 || $this->input->post('category') == 3) {
                            
                        ?>
                            <tr>
                                <th>Emplyee<br>Code</th>
                                <th>Emplyee Name</th>
                                <th>Day</th>
                                <th>Designation</th>
                                <?php echo ($this->input->post('category') == 3)?"<th></th>":"";?>
                                <th>Pay</th>
                                <th>Gross</th>
                                <th>Employee<br>12% P.F</th>
                                <th>P-tax</th>
                                <th>Total Deduction</th>
                                <th>Net Amount</th>
                                <th>Signature</th>
                            </tr>

                        </thead>

                        <tbody> 

                            <?php 
                            
                            if($list && $this->input->post('category') == 3) {
                                
                                    foreach($list as $s_list) {

                                        foreach($attendance_dtls as $a_dtls) {

                                            if($s_list->emp_no  ==  $a_dtls->emp_cd) {
                                                $pa += $s_list->band_pay * $a_dtls->no_of_days;
                                                $pf += $s_list->pf;
                                                $ptax += $s_list->ptax;
                                                $tot_deduct += $s_list->tot_deduction;
                                                $net += $s_list->net_amount;

                            ?>

                                    <tr>

                                        <td><?php echo $s_list->emp_no; ?></td>
                                        <td><?php echo $s_list->emp_name; ?></td>
                                        <td><?php echo $a_dtls->no_of_days; ?></td>
                                        <td><?php echo $s_list->designation; ?></td>
                                        <td><?php echo $s_list->band_pay." X ".$a_dtls->no_of_days; ?></td>
                                        <td><?php echo $s_list->band_pay * $a_dtls->no_of_days; ?></td>
                                        <td><?php echo $s_list->band_pay * $a_dtls->no_of_days; ?></td>
                                        <td><?php echo $s_list->pf; ?></td>
                                        <td><?php echo $s_list->ptax; ?></td>
                                        <td><?php echo $s_list->tot_deduction; ?></td>
                                        <td><?php echo $s_list->net_amount; ?></td>
                                        <td></td>

                                    </tr>

                            <?php
                                    
                                        }

                                    }
                                } ?>

                                    <tr>
                                    
                                        <td colspan="5">Total</td>
                                        <td><?php echo $pa; ?></td>
                                        <td><?php echo $pa; ?></td>
                                        <td><?php echo $pf; ?></td>
                                        <td><?php echo $ptax; ?></td>
                                        <td><?php echo $tot_deduct; ?></td>
                                        <td><?php echo $net; ?></td>
                                        <td></td>
                                        
                                    </tr>

                            <?php
                                
                            }

                            else if($list && $this->input->post('category') == 2) {

                                foreach($list as $s_list) {

                                    $pa += $s_list->band_pay;
                                    $pf += $s_list->pf;
                                    $ptax += $s_list->ptax;
                                    $tot_deduct += $s_list->tot_deduction;
                                    $net += $s_list->net_amount;
                            ?>

                                <tr>
                                    <td><?php echo $s_list->emp_no; ?></td>
                                    <td><?php echo $s_list->emp_name; ?></td>
                                    <td></td>
                                    <td><?php echo $s_list->designation; ?></td>
                                    <td><?php echo $s_list->band_pay; ?></td>
                                    <td><?php echo $s_list->band_pay; ?></td>
                                    <td><?php echo $s_list->pf; ?></td>
                                    <td><?php echo $s_list->ptax; ?></td>
                                    <td><?php echo $s_list->tot_deduction; ?></td>
                                    <td><?php echo $s_list->net_amount; ?></td>
                                    <td></td>
                                </tr>


                            <?php
                                }

                            ?>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td><?php echo $pa; ?></td>
                                    <td><?php echo $pa; ?></td>
                                    <td><?php echo $pf; ?></td>
                                    <td><?php echo $ptax; ?></td>
                                    <td><?php echo $tot_deduct; ?></td>
                                    <td><?php echo $net; ?></td>
                                    <td></td>
                                </tr>
                            <?php    

                            }

                            else {

                                echo "<tr><td colspan='12' style='text-align:center;'>No data Found</td></tr>";

                            }
                        }

                        else {

                    ?>
					<p> Salary sheet for the month of <?php echo $salarydetail->sal_month.' '.substr($salarydetail->sal_year,2,4) ; ?> for the employees of Confed-W.B. is preapred and placed for approval, details are as follows:-</p>
                        
                        <tr>
                            <th width="15px">Employee of Confed-W.B</th>
                            <th width="15px">Gross</th>
                            <th width="15px">General Adv.</th>
                            <th width="15px">SSS of<br>L.I.C</th>
                            <th width="15px">Employee<br>12% P.F</th>
                            <th width="15px">P-tax</th>
                            <th width="15px">I-Tax</th>
                            <th width="15px">Net Amount</th>
                        </tr>

                    </thead>

                    <tbody> 

                        <?php 
                            if($list) {

                                $temp_var = 0;
                                $tempCount = 0;
                                $i = 1;
                            foreach($list as $s_list) {
								$i++;
                                $bp += $s_list->band_pay;  
                                $gp += $s_list->grade_pay;
                                $basic += $s_list->basic_pay;
                                $da +=  $s_list->da;
                                $ir +=  $s_list->ir;
                                $hra += $s_list->hra;
                                $ma += $s_list->ma;
                                $ca += $s_list->cash_allow;
                                $gross += $s_list->gross;
                                $ga +=  $s_list->gen_adv;
                                $gi +=  $s_list->gen_intt;
                                $fa +=  $s_list->festival_adv;
                                $lic +=  $s_list->lic;
                                $pf += $s_list->pf;
                                $ptax += $s_list->ptax;
                                $itx += $s_list->itax;
                                $tot_deduct += $s_list->tot_deduction;
                                $net += $s_list->net_amount;
                        ?>        

                        <?php
                                $tempCount++;
                            }

                            ?>
                                <tr> 
                                    <td >Sl. No. 1-<?=$i?></td>
                                    <td><?php echo $gross; ?></td>
                                    <td><?php echo $ga; ?></td>
                                    <td><?php echo $lic; ?></td>
                                    <td><?php echo $pf; ?></td>
                                    <td><?php echo $ptax; ?></td>
                                    <td><?php echo $itx; ?></td>
                                    <td><?php echo $net; ?></td>
                                </tr>
                            <?php    
                            }
                            else {
                                echo "<tr><td colspan='22' style='text-align:center;'>No data Found</td></tr>";
                            }
                        }
                    ?>
                    
                    </tbody>
                </table>
                <br>
				<?php foreach($content as $cont){ ?>
				<p><?php if(isset($cont->content)) echo $cont->content; ?></p>
	            <?php }?>
                <br>
				<br><br><br><br><br><br>
				<p style="margin-top:200px">One payment voucher and payment sheet of Rs.<?=$net?>/- are prepared and one adjustment voucher is also prepared in this regard and placed for approval.</p>

             <!--   <div  class="bottom">
                
                    <p style="display: inline;">Prepared By</p>

                    <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>

                    <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p>

                    <p style="display: inline; margin-left: 8%;">ARCS Attached to CONFED-WB</p>

                    <p style="display: inline; margin-left: 8%;">Chief Executive Officer</p>

                </div> -->
                 <br>
            </div>
            <div style="text-align: center;">
                <button class="btn btn-info" type="button" onclick="printDiv();">Print</button>
            </div>

        </div>           
</div>
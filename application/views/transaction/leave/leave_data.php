<div class="col-sm-2"></div>
<div class="col-sm-10">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Application Date</th>
                <th>Name</th>
                <th>Leave Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>No of days</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=date('d/m/Y',strtotime($leave->trans_dt))?></td>
                <td><?=$leave->emp_name?></td>
                <td><?=$leave->leave_type?></td>
                <td><?=date('d/m/Y',strtotime($leave->from_dt))?></td>
                <td><?=date('d/m/Y',strtotime($leave->to_dt))?></td>
                <td><?php echo $diff = (abs(strtotime($leave->to_dt) - strtotime($leave->from_dt)))/24/3600; ?></td>
            </tr>
            <tr>
                <td colspan='6'></td>
                
            </tr>
            <tr>
                <td colspan='6'><?=$leave->remarks?></td>
                
            </tr>
        </tbody>
    </table>
</div>

<?php

$vacine_id = $_GET['vaccine_id'];
$form = $_GET['form'];
$to = $_GET['to'];
require_once './classes/vaccine_transaction.php';
$obj_trans = new Vaccine_Transaction();
$opening_stock = $obj_trans->get_opening_stock_for_vaccine($vacine_id, $form, $to);
$trans = $obj_trans->get_ledger_for_date_wise($vacine_id, $form, $to);
$total_used = $obj_trans->total_used_vaccine($vacine_id);
$used = mysqli_fetch_assoc($total_used);
$total_vaccine_apply = $used['total_used'];

echo "<div style='background-color: white; border: 1px solid #e0d8d8;margin-bottom: 15px; margin-top: 15px;'>
    <div class='box-header with-border'>
        <h4 align='center'>Vaccine Ledger</h4>
        <span class='pull-right'><a href='report_ledger.php?vaccine_id=$vacine_id&form=$form&to=$to' target='__blank' class='btn btn-default'> <i class='fa fa-print' aria-hidden='true'></i> Print Ledger</a>&nbsp;</span>
        <div class='form-errors'>
            <p style='text-align: center; color:green;'> </p>
        </div>
    </div>
    <div class='box-body'>
        <div class='row'>
            <div class='col-md-12'>
                <table  class='table table-responsive table-bordered table-striped'>
                    <thead>
                    <th>Entry Date</th>
                    <th>Received</th>
                    <th>Issued</th>
                    <th>Balance</th>
                    </thead>
                    <tr>
                        <td colspan='3'>Opening Balance</td>
                        <td>$opening_stock</td>
                    </tr>";
$total_rec = 0;
$total_issue = 0;
while ($row = mysqli_fetch_array($trans)) {
    $total_rec+=$row['receive_qty'];
    $total_issue+=$row['issue_qty'];
    $entry = $row['entry_date'];
    $rec = $row['receive_qty'];
    $issue = $row['issue_qty'];
    echo "<tr>
                                                    <td>$entry</td>
                                                    <td>$rec</td>
                                                    <td>$issue</td>
                                                </tr>";
}$remain = $opening_stock + $total_rec - $total_issue - $total_vaccine_apply;
echo "
                   <tr>
                      <td colspan='4'></td>
                   </tr>
                   <tr>
                      <td>Total</td>
                      <td>$total_rec</td>
                      <td>$total_issue</td>
                      <td></td>
                   </tr>
                   <tr>
                      <td colspan='3'>Used Vaccine</td>
                      <td>$total_vaccine_apply</td>
                   </tr>
                   <tr>
                      <td colspan='3'>Remaining Balance</td>
                      <td>$remain</td>
                   </tr>
                </table>
            </div>
        </div>
    </div>
</div>";

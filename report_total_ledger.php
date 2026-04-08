<?php
session_start();
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
$vacine_id = $_GET['vaccine_id'];
require_once './classes/vaccine_transaction.php';
$obj_trans = new Vaccine_Transaction();
$vaccine_info = $obj_trans->get_vaccine_name_by_id($vacine_id);
$vaccine = mysqli_fetch_assoc($vaccine_info);
$opening_stock = $obj_trans->get_opening_stock($vacine_id);
$opening_balance=  mysqli_fetch_assoc($opening_stock);
$opening=$opening_balance['opening_stock'];
$trans = $obj_trans->get_ledger($vacine_id);
$total_used = $obj_trans->total_used_vaccine($vacine_id);
$used = mysqli_fetch_assoc($total_used);
$total_vaccine_apply = $used['total_used'];
?>
<html>
    <head>
        <title><?php echo $vaccine['generic_name']; ?> ( <?php echo $vaccine['trade_name']; ?> ) - Vaccine Ledger </title>
        <link rel="stylesheet" type="text/css" href="resource/custom_css/print-receipt.css" media="screen, print, projection" />
        <link rel="stylesheet" href="resource/font-awesome/css/font-awesome.css">
    </head>
    <body>
        <div id="printableArea" >
            <div id="pcr">
                <table class="table table-bordered table-main" align="center">
                    <tr>
                        <td colspan="3" class="text-left padding-left padding-right" style="border-bottom:1px solid #000; height:90px; margin-left: 200px; margin-bottom: 5px;">
                            <table align="center">
                                <tr>
                                    <td class="text-center" colspan="3"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($org['logo']) . '" class="img-responsive" height="40" width="50"/>'; ?><br><small><?php echo $org['organization_name']; ?></small></td>
                                </tr>
                                <tr>
                                    <td class="text-left org-address" colspan="3"><?php echo $org['organization_address']; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th colspan=3 class="border-none" height="40px"> 
                            <?php echo $vaccine['generic_name']; ?> ( <?php echo $vaccine['trade_name']; ?> ) - Vaccine Ledger 
                        </th>
                    </tr>
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <table  border="1" class="table table-border" style="width:100%;">
                                <tr class="header" height="40px">
                                    <th>Entry Date</th>
                                    <th>Received</th>
                                    <th>Issued</th>
                                    <th>Balance</th>
                                </tr>
                                <tr height="30px">
                                    <td colspan='3'> Opening Balance</td>
                                    <td class="text-right"><?php echo $opening; ?></td>
                                </tr>
                                <?php
                                $total_rec = 0;
                                $total_issue = 0;
                                while ($row = mysqli_fetch_array($trans)) {
                                    $total_rec+=$row['receive_qty'];
                                    $total_issue+=$row['issue_qty'];
                                    $entry = $row['entry_date'];
                                    $rec = $row['receive_qty'];
                                    $issue = $row['issue_qty'];
                                    ?>
                                    <tr height="30px">
                                        <td class="text-center"> <?php echo $entry; ?></td>
                                        <td class="text-right"><?php echo $rec; ?></td>
                                        <td class="text-right"><?php echo $issue; ?></td>
                                        <td></td>
                                    </tr>
                                <?php } $remain = $opening + $total_rec - $total_issue - $total_vaccine_apply; ?>
                                <tr height="30px">
                                    <td colspan='4'></td>
                                </tr>
                                <tr height="30px">
                                    <td> Total</td>
                                    <td class="text-right"><?php echo $total_rec; ?></td>
                                    <td class="text-right"><?php echo $total_issue; ?></td>
                                    <td></td>
                                </tr>
                                <tr height="30px">
                                    <td colspan='3'> Used Vaccine</td>
                                    <td class="text-right"><?php echo $total_vaccine_apply; ?></td>
                                </tr>
                                <tr height="30px">
                                    <td colspan='3'> Remaining Balance</td>
                                    <td class="text-right"><?php echo $remain; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="border-none text-left padding-left" colspan='3' style="height:50px"></th>
                    </tr>
                </table>
            </div>
        </div>
        <div style="text-align: center; margin: 10px;">
            <a href="#" 
               style="background-color: #008CBA; /* Green */
               border: none;
               color: white;
               padding: 9px 57px;
               text-align: center;
               text-decoration: none;
               display: inline-block;
               font-size: 16px;" onclick="printDiv('printableArea')" />Print <i class="fa fa-print" aria-hidden="true"></i></a>
    </div>
    <script>

        function myFunction() {
            window.print();
        }
        function printDiv(available_print) {
            var printContents = document.getElementById(available_print).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>



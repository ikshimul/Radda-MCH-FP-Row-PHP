<?php
session_start();
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->vaccine_stock_list();
?>
<html>
    <head>
        <title>Vaccine Stock</title>
        <link rel="stylesheet" type="text/css" href="resource/custom_css/print-receipt.css" media="screen, print, projection" />
        <link rel="stylesheet" href="resource/font-awesome/css/font-awesome.css">
    </head>
    <body>
        <div id="printableArea" >
            <div id="pcr">
                <table class="table table-bordered table-main" align="center">
                    <tr>
                        <td colspan="3" class="text-left padding-left padding-right" style="border-bottom:1px solid #000; height:80px; margin-left: 200px; margin-bottom: 5px;">
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
                            <u>Stock Information</u>
                        </th>
                    </tr>
                    <tr>
                        <td class="text-left padding-left"><strong>Clinic : </strong><?php echo $org['organization_name']; ?></td>
                        <td></td>
                        <td class="text-right padding-right"><strong>Dept. ID : </strong><?php echo $org['organization_id']; ?></td>
                    </tr>
                    <tr>
                        <td colspan=3 class="text-left padding-left"><strong>Date : </strong></td>
                    </tr>
                    <tr>
                        <th colspan=3 class="border-none" height="40px"> 
                            <span style="padding: 20px;"> </span>
                        </th>
                    </tr>
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <table border="1" class="table table-border" style="width:100%;">
                                <tr height="40px">
                                    <th rowspan='2'>Sl.#</th>
                                    <th rowspan='2'>NAME OF THE NON-EPI VACCINES( Vaccine Name)</th>
                                    <th rowspan='2'>NAME OF THE NON-EPI VACCINES( Trade Name)</th>
                                    <th colspan='5'>VACCINE CONSUMPTION REPORT</th>
                                    <th rowspan='2'>ITEM CODE</th>
                                    <th colspan='2'>CLIENT REPORT</th>
                                </tr>
                                <tr rowspan='2' height="40px">
                                    <th>OPENING BALANCE (Vial)</th>
                                    <th>RECEIVED (Vials)</th>
                                    <th>ISSUE (Vials)</th>
                                    <th >USED (Vials)</th>
                                    <th>CLOSING BALANCE (Vials)</th>
                                    <th>NEW</th>
                                    <th>REVISIT</th>
                                </tr>
                                <?php
                                $i=0;
                                $total_used=0;
                                $total_issue=0;
                                $total_rec=0;
                                $total_stock=0;
                                while ($row = mysqli_fetch_array($query)) { $i++;
                                $total_used+=$row['total_used'];
                                $total_issue+=$row['total_issue'];
                                $total_rec+=$row['total_receive'];
                                $total_stock+=$row['current_stock'];
                                    ?>
                                    <tr height="30px">
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $row['generic_name']; ?></td>
                                        <td class="text-center"><?php echo $row['trade_name']; ?></td>
                                        <td class="text-right"><?php echo $row['opening_stock']; ?></td>
                                        <td class="text-right"><?php echo $total_rec=$row['total_receive']; ?></td>
										<td class="text-right"><?php echo $total_issue=$row['total_issue']; ?></td>
										<td class="text-right"><?php echo $total_used=$row['total_used']; ?></td>
										<td class="text-right"><?php echo  $current_stock=$total_rec-$total_issue-$total_used;?></td>
                                        <td class="text-right"><?php echo $row['code']; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                                    <tr height="40px">
                                        <td colspan="3" class="text-right"><strong>Total: </strong></td>
                                        <td></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"></td>
                                        <td class="text-right"><?php echo $total_stock;?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr height="40px">
                                        <td colspan="9" class="text-right"><strong>Grand Total: </strong></td>
                                        <td colspan="2"></td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="border-none text-left padding-left" colspan=3 style="height:18px"></th>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-left padding-left padding-right" style="height:80px; margin-bottom: 15px;">
                            <table>
                                <tr>
                                    <td>
                                        <div class="bottom-content-left">
                                            <p>&nbsp;Prepared by-</p>
                                            &nbsp;<span style="margin-bottom: 3px;">Name:</span><br>
                                            &nbsp;<span style="margin-bottom: 1px;">Date:</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bottom-content-right">
                                            <p>&nbsp;Checked by-</p>
                                            &nbsp;<span style="margin-bottom: 3px;">Name:</span><br>
                                            &nbsp;<span style="margin-bottom: 1px;">Date:</span>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
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



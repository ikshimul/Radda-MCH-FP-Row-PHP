<?php
session_start();
$from_date = $_POST['dose_from'];
$to_date = $_POST['dose_to'];
require_once '../classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once '../classes/report.php';
$obj_rep = new Report();
$query = $obj_rep->client_new_revisit_report($_POST);
?>
<html>
    <head>
        <title>Applied Vaccination Reports</title>
        <link rel="stylesheet" type="text/css" href="../resource/custom_css/print-receipt.css" media="screen, print, projection" />
        <link rel="stylesheet" href="../resource/font-awesome/css/font-awesome.css">
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
                        <th colspan=3 class="border-none"> 
                            Applied Vaccination List 
                        </th>
                    </tr>
                    <tr>
                        <td class="text-left padding-left"><strong>Clinic : </strong><?php echo $org['organization_name']; ?></td>
                        <td></td>
                        <td class="text-right padding-right"><strong>Dept. ID : </strong><?php echo $org['organization_id']; ?></td>
                    </tr>
                    <tr>
                        <td colspan=3 class="text-left padding-left"><strong>Date : </strong><?php echo date('d M, Y', strtotime($from_date)); ?> to <?php echo date('d M, Y', strtotime($to_date)); ?></td>
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
                                    <th colspan='2'>CLIENT REPORT</th>
                                </tr>
                                <tr rowspan='2' height="40px">
                                    <th>NEW</th>
                                    <th>REVISIT</th>
                                </tr>
                                <?php
                                $total_revisit=0;
                                $total_new=0;
                                $i = 0;
                                while ($row = mysqli_fetch_array($query)) {
                                   $total_revisit+=$row['reVisit'];
                                   $total_new+=$row['newpt'];
                                    } ?>
                                <tr height="30px">
                                        <td class="text-center"><?php echo $total_new;?></td>
                                        <td class="text-center"><?php echo $total_revisit;?></td>
                                    </tr>
<!--                                    <tr height="30px">-->
<!--                                        <td colspan="7" class="text-right">Total Dose(Vaccine)</td>
                                        <td class="text-center"><?php echo $i;?></td>
                                        <td colspan="2"></td>-->
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



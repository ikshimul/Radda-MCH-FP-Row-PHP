<?php
session_start();
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
require_once '../classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once '../classes/report.php';
$obj_rep = new Report();
$query = $obj_rep->vaccination_summary_report_by_age($_POST);
?>
<html>
    <head>
        <title>Vaccination Summary Report By Generic</title>
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
                            Applied Vaccination Summary By Generic
                        </th>
                    </tr>
                    <tr>
                        <th colspan=3 class="border-none" height="40px"> 
                            <span style="padding: 20px;">From <?php echo date('d M,Y', strtotime($from_date)); ?> to <?php echo date('d M,Y', strtotime($to_date)); ?></span>
                        </th>
                    </tr>
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <table border="1" class="table table-border" style="width:100%;">
                                <tr class="header" height="40px">
                                    <th>Vaccine Name</th>
                                    <th>Age Period</th>
                                    <th>Total</th>
                                </tr>
                                <?php
                                $grand_total=0;
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr height="30px">
                                        <td class="text-center"><?php echo $row['generic_name']; ?></td>
                                        <td class="text-center"><?php echo $row['days_name']; ?></td>
                                        <td class="text-right"> <?php $total= $row['total']; echo $total; $grand_total+=$total; ?>  </td>
                                    </tr>
                                <?php } ?>
                                    <tr height="40px">
                                        <td colspan="2" class="text-right"><strong>Grand Total&nbsp;</strong></td>
                                        <td class="text-right"><?php echo $grand_total;?></td>
                                    </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="border-none text-left padding-left" colspan=3 style="height:50px"></th>
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



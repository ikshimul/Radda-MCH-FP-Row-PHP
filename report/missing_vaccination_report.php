<?php
session_start();
require_once '../classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once '../classes/report.php';
$obj_rep = new Report();
$query = $obj_rep->missing_vaccination_list();
?>
<html>
    <head>
        <title>Missing Vaccination Reports</title>
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
                    <tr height="40px">
                        <th colspan=3 class="border-none"> 
                            Missing Vaccination List 
                        </th>
                    </tr>
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <table border="1" class="table table-border" style="width:100%;">
                                <tr class="header" height="40px">
                                    <th>Patient Name</th>
                                    <th>Mother Phone</th>
                                    <th>Vaccine</th>
                                    <th>Dose Name</th>
                                    <th>Dose Date</th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr height="30px">
                                        <td class="text-center"><?php echo $row['name']; ?></td>
                                        <td class="text-center"><?php echo $row['mother_phone']; ?></td>
                                        <td class="text-center"><?php echo $row['generic_name']; ?></td>
                                        <td class="text-center"><?php echo $row['dose_name']; ?></td>
                                        <td class="text-center"><?php echo date('d M,Y', strtotime($row['next_date'])) ?></td>
                                    </tr>
                                <?php } ?>
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



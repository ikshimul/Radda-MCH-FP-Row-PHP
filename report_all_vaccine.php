<?php
session_start();
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->vaccine_list_report();
?>
<html>
    <head>
        <title>Vaccine List</title>
        <link rel="stylesheet" type="text/css" href="resource/custom_css/print-receipt.css"/>
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
                            All Vaccine List 
                        </th>
                    </tr>
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <table border="1" class="table table-border" style="width:100%;">
                                <tr class="header" height="40px">
                                    <th>ID</th>
                                    <th>Vaccine Name</th>
                                    <th>Vaccination Time</th>
                                    <th>No of Dose</th>
                                    <th>Vaccination Period</th>
                                </tr>
                                <?php
                                while ($vaccine = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr height="30px">
                                        <td class="text-center"><?php echo $vaccine['vaccine_id']; ?></td>
                                        <td class="text-center"><?php echo $vaccine['generic_name']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($vaccine['eligibility_type'] == 1) {
                                                echo 'Any Time';
                                            } elseif ($vaccine['eligibility_type'] == 2) {
                                                echo 'Spaecific Date';
                                            } elseif ($vaccine['eligibility_type'] == 3) {
                                                echo 'Between Day';
                                            } else {
                                                echo 'others';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo $vaccine['no_of_dose']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            echo $vaccine['period_form'];
                                            if ($vaccine['period_form_unit'] == 'M') {
                                                echo ' Months';
                                            } elseif ($vaccine['period_form_unit'] == 'Y') {
                                                echo ' Years';
                                            } elseif ($vaccine['period_form_unit'] == 'D') {
                                                echo ' Days';
                                            } elseif ($vaccine['period_form_unit'] == 'W') {
                                                echo ' Week';
                                            }
                                            echo ' to ' . $vaccine['period_to'];
                                            if ($vaccine['period_form_unit'] == 'M') {
                                                echo ' Months';
                                            } elseif ($vaccine['period_form_unit'] == 'Y') {
                                                echo ' Years';
                                            } elseif ($vaccine['period_form_unit'] == 'D') {
                                                echo ' Days';
                                            } elseif ($vaccine['period_form_unit'] == 'W') {
                                                echo ' Week';
                                            }
                                            ?>
                                        </td>
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



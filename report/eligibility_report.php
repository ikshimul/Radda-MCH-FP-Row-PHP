<?php
session_start();
require_once '../classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
$patient_id = $_GET['id'];
$patient_dob = $_GET['dob'];
$name = $_GET['name'];
$bday = new DateTime($patient_dob);
$today = new DateTime();
$diff = $today->diff($bday);
//printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
$year = $diff->y;
$month = $diff->m;
$day = $diff->d;
$total_days = $year * 365 + $month * 30 + $day;
require_once '../classes/vaccination.php';
$obj_vac = new Vaccination();
$query = $obj_vac->future_vaccination_view_by_user_id($patient_id);
?>
<html>
    <head>
        <title>Vaccine Eligibility Reports</title>
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
                        <th colspan=3 class="border-none" height="40px"> 
                            <span>
                                <div style='background-color: white;padding: 15px;'>
                                    <p>Name:<strong> <?php echo $name; ?></strong></p>
                                    <p>Age:<strong> <?php printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d); ?></strong></p>
                                </div>
                            </span>
                        </th>
                    </tr>
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <div><h5><strong>Upcoming vaccine</strong></h5>
                            <table border="1" class="table table-border" style="width:100%;">
                                <tr class="header" height="40px">
                                    <th>Name</th>
                                    <th>Mother Phone</th>
                                    <th>Vaccine Name</th>
                                    <th>Trade</th>
                                    <th>Dose Name</th>
                                    <th>Dose Date</th>
                                </tr>
                                <?php
                                $all_trade_id;
                                $data = array();
                                while ($row = mysqli_fetch_array($query)) {
                                    $data[] = $row['vaccine_info_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['mother_phone']; ?></td>
                                        <td><?php echo $row['generic_name']; ?></td>
                                        <td><?php echo $row['trade_name']; ?></td>
                                        <td><?php echo $row['dose_name']; ?></td>
                                        <td><?php echo  date('d M,Y', strtotime($row['next_date'])); ?></td>
                                    </tr>
                                    <?php
                                }
                                $all_trade_id = implode(',', $data);
                                if ($all_trade_id != NULL) {
                                    ?>
                                </table>
                                <div><h5><strong>Other Eligibility vaccine</strong></h5>
                                    <?php
                                    $eligibility = $obj_vac->check_for_eligibility_vaccine($all_trade_id);
                                    ?>
                                    <table  border="1" class="table table-border" style="width:100%;">
                                        <thead>
                                        <th>Vaccine Name</th>
                                        <th>Vaccination Time</th>
                                        <th>No of Dose</th>
                                        <th>Period</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($eligibility)) {
                                                $days_form = $row['eligibility_days_form'];
                                                $days_to = $row['eligibility_days_to'];
                                                if ($days_form <= $total_days && $days_to >= $total_days) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['generic_name']; ?></td>
                                                        <td><?php
                                                            if ($row['eligibility_type'] == 1) {
                                                                echo 'Any Time';
                                                            } elseif ($row['eligibility_type'] == 2) {
                                                                echo 'Spaecific Date';
                                                            } elseif ($row['eligibility_type'] == 3) {
                                                                echo 'Between Day';
                                                            } else {
                                                                echo 'others';
                                                            }
                                                            ?></td>
                                                        <td><?php echo $row['no_of_dose']; ?></td>
                                                        <td><?php
                                                            echo $row['period_form'];
                                                            if ($row['period_form_unit'] == 'M') {
                                                                echo ' Months';
                                                            } elseif ($row['period_form_unit'] == 'Y') {
                                                                echo ' Years';
                                                            } elseif ($row['period_form_unit'] == 'D') {
                                                                echo ' Days';
                                                            } elseif ($row['period_form_unit'] == 'W') {
                                                                echo ' Week';
                                                            }
                                                            echo ' to ' . $row['period_to'];
                                                            if ($row['period_to_unit'] == 'M') {
                                                                echo ' Months';
                                                            } elseif ($row['period_to_unit'] == 'Y') {
                                                                echo ' Years';
                                                            } elseif ($row['period_to_unit'] == 'D') {
                                                                echo ' Days';
                                                            } elseif ($row['period_to_unit'] == 'W') {
                                                                echo ' Week';
                                                            }
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <h5><strong>Other Eligibility vaccine</strong></h5>
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <th>Vaccine Name</th>
                                        <th>Vaccination Time</th>
                                        <th>No of Dose</th>
                                        <th>Period</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $obj_vac->eligibility_vaccine();
                                            while ($row = mysqli_fetch_array($query)) {
                                                $days_form = $row['eligibility_days_form'];
                                                $days_to = $row['eligibility_days_to'];
                                                if ($days_form <= $total_days && $days_to >= $total_days) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['generic_name']; ?></td>
                                                        <td><?php
                                                            if ($row['eligibility_type'] == 1) {
                                                                echo 'Any Time';
                                                            } elseif ($row['eligibility_type'] == 2) {
                                                                echo 'Spaecific Date';
                                                            } elseif ($row['eligibility_type'] == 3) {
                                                                echo 'Between Day';
                                                            } else {
                                                                echo 'others';
                                                            }
                                                            ?></td>
                                                        <td><?php echo $row['no_of_dose']; ?></td>
                                                        <td><?php
                                                            echo $row['period_form'];
                                                            if ($row['period_form_unit'] == 'M') {
                                                                echo ' Months';
                                                            } elseif ($row['period_form_unit'] == 'Y') {
                                                                echo ' Years';
                                                            } elseif ($row['period_form_unit'] == 'D') {
                                                                echo ' Days';
                                                            } elseif ($row['period_form_unit'] == 'W') {
                                                                echo ' Week';
                                                            }
                                                            echo ' to ' . $row['period_to'];
                                                            if ($row['period_to_unit'] == 'M') {
                                                                echo ' Months';
                                                            } elseif ($row['period_to_unit'] == 'Y') {
                                                                echo ' Years';
                                                            } elseif ($row['period_to_unit'] == 'D') {
                                                                echo ' Days';
                                                            } elseif ($row['period_to_unit'] == 'W') {
                                                                echo ' Week';
                                                            }
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
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



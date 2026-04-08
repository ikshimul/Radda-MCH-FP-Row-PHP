<?php
$patient_id = $_GET['id'];
$patient_dob = $_GET['dob'];
$name=$_GET['name'];
$bday = new DateTime($patient_dob);
$today = new DateTime();
$diff = $today->diff($bday);
//printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
$year = $diff->y;
$month = $diff->m;
$day = $diff->d;
$total_days = $year * 365 + $month * 30 + $day;
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
$query = $obj_vac->future_vaccination_view_by_user_id($patient_id);
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px; padding: 10px;">
        <div class="box-header">
            <h3 class="box-title">Eligibility for Vaccine </h3>
            <span class="pull-right"><a href="report/eligibility_report.php?id=<?php echo $patient_id;?>&dob=<?php echo $patient_dob; ?>&name=<?php echo $name; ?>" target="__blank" class="btn btn-default">Print</a>&nbsp;</span>
        </div>
        <div style='background-color: white; border: 1px solid #e0d8d8;padding: 15px;'>
            <p>Name:<strong> <?php echo $name;?></strong></p>
            <p>Age:<strong> <?php printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);?></strong></p>
        </div>
        <div class="box-body">
            <div><h5><strong>Upcoming vaccine</strong></h5>
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Vaccine Name</th>
                    <th>Trade</th>
                    <th>Dose Name</th>
                    <th>Dose Date</th>
                    </thead>
                    <tbody>
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
                        </tbody>
                    </table>
                </div>

                <div><h5><strong>Other Eligibility vaccine</strong></h5>
                    <?php
                    $eligibility = $obj_vac->check_for_eligibility_vaccine($all_trade_id);
                    ?>
                    <table class="table table-responsive table-bordered table-striped">
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
            </div>
        </div>
    </div>
</div>

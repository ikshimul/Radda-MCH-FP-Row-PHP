<?php
$message = '';
require_once './classes/registration.php';
$obj_reg = new Registration();
$user_id = $_GET['id'];
$query = $obj_reg->vaccine_uesr_by_id($user_id);
$user = mysqli_fetch_assoc($query);
$dose_apply = $obj_reg->get_vaccine_apply_info_by_user($user_id);
?>
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <span><small>Vaccination Software</small>
                    <small class="pull-right">Date : <?php echo date('d/m/Y'); ?></small>
                </span>
            </h2>
        </div>
    </div>
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <address>
                <strong><?php echo $user['name']; ?></strong><br>
                Age: <?php
                $age = $user['dob'];
                $bday = new DateTime($age);
                $today = new DateTime(); // for testing purposes
                $diff = $today->diff($bday);
                printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
                ?><br>
                Address: <?php echo $user['address']; ?><br>
                Phone: (+88)<?php echo $user['mother_phone']; ?> <br>
                Email: <?php echo $user['email']; ?>
            </address>
        </div>
        <div class="col-sm-2 invoice-col">
        </div>
        <div class="col-sm-4 invoice-col">
            User Id <b>#<?php echo $user['id']; ?></b><br>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Generic Name</th>
                        <th>Trade Name</th>
                        <th>Dose Name</th>
                        <th>Vaccine Price</th>
                        <th>Vaccination Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_prize=0;
                    while ($dose_result = mysqli_fetch_array($dose_apply)) {
                        $total_prize+=$dose_result['vaccine_prize'];
                        ?>
                        <tr>
                            <td><?php echo $dose_result['generic_name']; ?></td>
                            <td><?php echo $dose_result['trade_name']; ?></td>
                            <td><?php echo $dose_result['dose_name']; ?></td>
                            <td><?php echo $dose_result['vaccine_prize']; ?></td>
                            <td><?php
                                if ($dose_result['dose_date'] == NULL) {
                                    echo '';
                                } else {
                                    echo date('d M,Y', strtotime($dose_result['dose_date']));
                                }
                                ?></td>
                            <td><?php
                                $status = $dose_result['dose_apply'];
                                if ($status == 1) {
                                    ?><i class="fa fa-check-square-o" aria-hidden="true"></i><?php } else { ?> <i class="fa fa-times" aria-hidden="true"></i><?php } ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
        </div>
        <div class="col-xs-6">
            <p class="lead"></p>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Total Prize:</th>
                        <td><?php echo 'BDT '.number_format($total_prize,2).' Tk';?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

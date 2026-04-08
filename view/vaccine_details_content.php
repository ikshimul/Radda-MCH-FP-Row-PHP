<?php
$trade_id = $_GET['id'];
$vaccine_name=$_GET['vaccine_name'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine_details = $obj_vac->vaccine_dose_details_by_vaccine_id($trade_id);
?>
<div class="row" style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
    <div class="col-xs-12">
        <h5 style="text-align: center; color: mediumblue;"><strong><?php echo $vaccine_name;?> Dose Information</strong></h5>
        <div class="box-body">
            <table  class="table table-bordered table-striped">
                <thead>
                <th>Dose Serial</th>
                <th>Dose Name</th>
                <th>After Dose Serial</th>
                <th>Dose Time To</th>
                <th>Dose Time From</th>
                <th>Time Unit</th>
                </thead>
                <tbody>
                    <?php while ($vaccine = mysqli_fetch_array($vaccine_details)) { ?>
                        <tr>
                            <td><?php echo $vaccine['dose_serial']; ?></td>
                            <td><?php echo $vaccine['dose_name']; ?></td>
                            <td><?php echo $vaccine['after_dose_id']; ?></td>
                            <td><?php echo $vaccine['dose_time_form']; ?></td>
                            <td><?php echo $vaccine['dose_time_to']; ?></td>
                            <td><?php
                                if ($vaccine['dose_time_unit'] == 'M') {
                                    echo ' Months';
                                } elseif ($vaccine['dose_time_unit'] == 'Y') {
                                    echo ' Years';
                                } elseif ($vaccine['dose_time_unit'] == 'D') {
                                    echo ' Days';
                                } elseif ($vaccine['dose_time_unit'] == 'W') {
                                    echo ' Week';
                                }
                                ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you sure to delete this?</h4>
            </div>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<?php
$message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
if (isset($_POST['btn'])) {
    $message = $obj_vac->save_vaccine($_POST);
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $vaccine_id = $_GET['id'];
        $message = $obj_vac->vaccine_delete($vaccine_id);
    }
}
if (isset($_POST['update'])) {
    $message = $obj_vac->update_vaccine_info($_POST);
}
$vaccine_list = $obj_vac->get_vaccine_all();
?>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 15px;">
    <div class="box-header with-border">
        <h3 class="box-title"><strong>Vaccine Info List</strong></h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <strong><?php echo $message; ?></strong></p>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <th>Generic Name</th>
                    <th>Code</th>
                    <th>Vaccination Time</th>
                    <th>No of Dose</th>
                    <th>Period</th>
                    <th>Manage</th>
                    </thead>
                    <tbody>
                        <?php while ($vaccine = mysqli_fetch_array($vaccine_list)) { ?>
                            <tr>
                                <td><?php echo $vaccine['generic_name']; ?></td>
                                <td><?php echo $vaccine['code']; ?></td>
                                <td><?php
                                    if ($vaccine['eligibility_type'] == 1) {
                                        echo 'Any Time';
                                    } elseif ($vaccine['eligibility_type'] == 2) {
                                        echo 'Spaecific Date';
                                    } elseif ($vaccine['eligibility_type'] == 3) {
                                        echo 'Between Day';
                                    } else {
                                        echo 'others';
                                    }
                                    ?></td>
                                <td><?php echo $vaccine['no_of_dose']; ?></td>
                                <td><?php
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
                                    if ($vaccine['period_to_unit'] == 'M') {
                                        echo ' Months';
                                    } elseif ($vaccine['period_to_unit'] == 'Y') {
                                        echo ' Years';
                                    } elseif ($vaccine['period_to_unit'] == 'D') {
                                        echo ' Days';
                                    } elseif ($vaccine['period_to_unit'] == 'W') {
                                        echo ' Week';
                                    }
                                    ?></td>
                                <td><a href="#" onclick="edit_vaccine_info(<?php echo $vaccine['vaccine_id']; ?>)" class="btn btn-sm btn-success">Edit</a> 
                                    <a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $vaccine['vaccine_id']; ?>')" class="btn btn-sm btn-danger">delete</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Vaccine Info</h4>
            </div>
            <div class="modal-body" style="height: 650px; overflow:auto;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
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



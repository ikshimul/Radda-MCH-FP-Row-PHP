<?php
$message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $vaccine_id = $_GET['id'];
        $message = $obj_vac->trade_info_with_dose_delete_by_trade_id($vaccine_id);
    }
}
if (isset($_POST['btn'])) {
    $message = $obj_vac->update_trade_info($_POST);
}
$query = $obj_vac->vaccine_list();
?>
<div class="row" style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
    <div class="col-xs-12">
        <h5 style="text-align: center;"><strong>Trade Wise Vaccine List</strong></h5>
        <span class="pull-right"><a href="report_all_vaccine.php" target="__blank" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print All Vaccine List</a>&nbsp;</span>
        <p style="text-align: center; color: red;font-size: 15px;"><?php echo $message; ?></p>
        <div class="box-body">
            <style>
                .table-responsive {
                    overflow-x: visible; 
                }
            </style>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Trade Name</th>
                    <th>Generic Name</th>
                    <th>Vaccination Time</th>
                    <th>No of Dose</th>
                    <th>Period</th>
                    <th>Manage</th>
                    </thead>
                    <tbody>
                        <?php while ($vaccine = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $vaccine['trade_id']; ?></td>
                                <td><?php echo $vaccine['trade_name']; ?></td>
                                <td><?php echo $vaccine['generic_name']; ?></td>
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
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-flat">Action</button>
                                        <button type="button" class="btn btn-danger btn-flat dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="vaccine_details.php?id=<?php echo $vaccine['trade_id']; ?>&&vaccine_name=<?php echo $vaccine['generic_name']; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Dose Details</a></li>
                                            <li><a href="#" onclick="showAjaxModal(<?php echo $vaccine['trade_id']; ?>)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $vaccine['trade_id']; ?>')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- (Ajax Modal)-->
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Vaccine Edit Form</h4>
            </div>
            <div class="modal-body" style="height: 450px; overflow:auto;">

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
<?php
$message = '';
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
if (isset($_GET['vaccine_id'])) {
    $vaccine_id = $_GET['vaccine_id'];
    $vaccination_id = $_GET['id'];
    $dob = $_GET['dob'];
    $message = $obj_vac->vaccination_apply($vaccine_id, $vaccination_id, $dob);
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $vaccination_id = $_GET['id'];
        $message = $obj_vac->delete_vaccination_info_by_id($vaccination_id);
    }
}
$query = $obj_vac->upcoming_vaccination();
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title"><strong>View upcoming vaccination list </strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <strong><p style="text-align: center; color:#990033; font-family: initial; font-size: 15px;"> <?php echo $message; ?></p></strong>
            </div>
            <style>
                .table-responsive {
                    overflow-x: visible; 
                }
            </style>
            <div class="table-responsive">
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mother Name</th>
                    <th>Mother Phone</th>
                    <th>Vaccine</th>
                    <th>Dose</th>
                    <th>Dose Apply</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['mother_name']; ?></td>
                                <td><?php echo $row['mother_phone']; ?></td>
                                <td><?php echo $row['generic_name']; ?></td>
                                <td><?php echo $row['dose_name']; ?></td>
                                <td><a href="#" onclick="confirm_dose('?vaccine_id=<?php echo $row['trade_id']; ?>&&id=<?php echo $row['vaccination_id']; ?>&&dob=<?php echo $row['dob'] ?>')" class="btn btn-sm btn-default">Apply</a></td>
                                <td> <a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $row['vaccination_id']; ?>')" class="btn btn-sm btn-danger">delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="modal fade" id="modal-dose">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you confirm to Apply this dose?</h4>
            </div>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <a href="#" class="btn btn-success" id="confirm_link">Confirm</a>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
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
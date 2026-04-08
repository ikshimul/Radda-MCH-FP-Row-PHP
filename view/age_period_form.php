<?php
$message = '';
$delete_message='';
require_once 'classes/vaccination.php';
$obj_age = new Vaccination();
if (isset($_POST['btn'])) {
    $message = $obj_age->save_age_period($_POST);
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $age_period_id= $_GET['id'];
        $delete_message = $obj_age->delete_age_period($age_period_id);
    }
}
if (isset($_POST['update'])) {
    $delete_message = $obj_age->update_age_period_info($_POST);
}
$age_period_list = $obj_age->age_period_list();
?>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
            <div class="register-box-body">
                <p class="login-box-msg" style="color:green;"><strong>Age Period</strong></p>
                <div class="form-errors">
                    <p style="text-align: center; color:red;"><?php echo $message; ?></p>
                </div>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <label>Age Period Name</label>
                        <input type="text" name="days_name" class="form-control" required/>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Age Period From</label>
                        <input type="number" name="days_from" class="form-control" required/>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Age Period To</label>
                        <input type="number" name="days_to" class="form-control" required/>
                    </div>
                    <input type="hidden" name="security_field" value="<?php echo $_SESSION['id']; ?>">
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="btn" class="btn btn-primary btn-block btn-flat">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
            <div class="box-header">
                <h4 class="box-title">
                    Age Period List
                </h4>
                <div class="form-errors">
                    <p style="text-align: center; color:red;"><?php echo $delete_message; ?></p>
                </div>
            </div>
            <div class="register-box-body">
                <table class="table table-bordered">
                    <thead>
                    <th>Age Period Id</th>
                    <th>Period Name</th>
                    <th>Days From</th>
                    <th>Days To</th>
                    <th>Manage</th>
                    </thead>
                    <tbody>
                        <?php while ($age_period = mysqli_fetch_array($age_period_list)) { ?>
                            <tr>
                                <td><?php echo $age_period['age_p_id']; ?></td>
                                <td><?php echo $age_period['days_name']; ?></td>
                                <td><?php echo $age_period['days_from']; ?></td>
                                <td><?php echo $age_period['days_to']; ?></td>
                                <td>
                                    <a href="#" onclick="edit_age_period(<?php echo $age_period['age_p_id']; ?>)" class="btn btn-sm btn-success">Edit</a> 
                                    <a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $age_period['age_p_id']; ?>')" class="btn btn-sm btn-danger">delete</a>
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
                <h4 class="modal-title">Update Age Period</h4>
            </div>
            <div class="modal-body" style="height: 350px; overflow:auto;">

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

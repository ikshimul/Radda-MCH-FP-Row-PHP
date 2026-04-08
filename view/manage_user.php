<?php
$message = '';
require_once './classes/user_permission.php';
$obj_role = new User_Permission();
require_once './classes/user.php';
$obj_user = new User();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $user_id = $_GET['id'];
        if ($_SESSION['user_delete'] == 1) {
            $message = $obj_user->delete_user($user_id);
        } else {
            header('location:error.php');
        }
    }
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'active') {
        $user_id = $_GET['id'];
        $message = $obj_user->user_set_active($user_id);
    }
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'inactive') {
        $user_id = $_GET['id'];
        $message = $obj_user->user_set_inactive($user_id);
    }
}
if (isset($_POST['reset_password'])) {
    $message=$obj_user->reset_password($_POST);
}
$user_list = $obj_role->user_list();
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">Manage Role Permission </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
            </div>
            <div class="register-box"  id="advance_search">
                <h5 style="text-align: center;"><strong>Advance Search</strong></h5>
                <div class="box-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Registration Date</label>
                            <div class="col-sm-5">
                                <input type="date" name="dob_from"   class="form-control" placeholder="From"/>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control"  name="dob_to" placeholder="To">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">DOB</label>
                            <div class="col-sm-5"><input type="text" class="form-control" name="registation_from" id="date2" placeholder="From"></div>
                            <div class="col-sm-5"><input type="text" class="form-control" name="registation_to" id="date1" placeholder="To"></div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a  id="Hide" class="btn btn-default">Cancel</a>
                    <button type="submit" name="search" class="btn btn-info pull-right">Go!</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
            <style>
                .table-responsive {
                    overflow-x: visible; 
                }
            </style>
            <div class="table-responsive">
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <th></th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Mobile</th>
                    <th>Address</th>
<!--                    <th>Active/Inactive</th>-->
                    <th>Manage</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($user = mysqli_fetch_array($user_list)) {
                            ?>
                            <tr>
                                <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($user['profile_pic']) . '" class="img-circle"  width="30"/>'; ?></td>
                                <td><?php echo $user['full_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['designation']; ?></td>
                                <td><?php echo $user['mobile']; ?></td>
                                <td><?php echo $user['address']; ?></td>
    <!--                                <td>
                                <?php if ($user['active_inactive'] == 0) { ?>
                                            <a href="?status=active&&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger" title="Inactive">Inactive</a> 
                                <?php } else { ?>
                                            <a href="?status=inactive&&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success" title="active">Active</a></td>
                                <?php } ?>
                                </td>-->
                                <td>
                                    <a href="#" onclick="showPassword(<?php echo $user['id']; ?>)" class="btn btn-sm btn-default">Password Reset</a> 
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Profile Edit</a> 
                                    <a href="manage_user_role.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Manage Role</a> 
                                    <a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $user['id']; ?>')" class="btn btn-sm btn-danger">delete</a>
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
                <h4 class="modal-title">Reset Password</h4>
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

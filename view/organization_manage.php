<?php
$message = '';
require_once './classes/organization.php';
$obj_org = new Organization();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $organization_id = $_GET['id'];
        if ($_SESSION['organization_delete'] == 1) {
            $message = $obj_org->delete_organization($organization_id);
        } else {
            header('location:error.php');
        }
    }
}
$query = $obj_org->view_all_organization_info();
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">Organization List</h3>
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
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <th>Organization Name</th>
                <th>Organization Address</th>
                <th>Organization Logo</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $row['organization_name']; ?></td>
                            <td><?php echo $row['organization_address']; ?></td>
                            <td> <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" class="img-responsive" height="40" width="40"/>'; ?></td>
                            <td>
                                <a href="organization_edit.php?id=<?php echo $row['organization_id']; ?>" class="btn btn-sm btn-primary">Edit</a> 
                                <a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $row['organization_id']; ?>')" class="btn btn-sm btn-danger">delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
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
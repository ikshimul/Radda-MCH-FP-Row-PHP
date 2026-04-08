<?php
$message = '';
require_once './classes/registration.php';
$obj_reg = new Registration();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'register') {
        $register_id = $_GET['id'];
        if ($_SESSION['patient_delete'] == 1) {
            $message = $obj_reg->delete_register_user($register_id);
        } else {
            header('location:error.php');
        }
    }
}
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">View all vaccine user </h3>
            <span class="pull-right"><a href="all_patient_list_report.php" target="_blank" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print All User</a></span>
            <span class="pull-right"><a href="#" id="search" class="btn btn-default">Advance Search</a>&nbsp;&nbsp;</span>
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
                                <input type="date" name="dob_from"   class="form-control" placeholder="From" required />
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control"  name="dob_to" placeholder="To" required />
                            </div>
                        </div>
                        <div class="col-sm-5"><input type="hidden" class="form-control" name="registation_from" id="date2" placeholder="From"></div>
                        <div class="col-sm-5"><input type="hidden" class="form-control" name="registation_to" id="date1" placeholder="To"></div>
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
                <table id="user_report" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
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
<script src="resource/jquery-ui/jquery-ui.js"></script>
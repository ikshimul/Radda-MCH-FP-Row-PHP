<?php
$message = '';
require_once './classes/user_permission.php';
$obj_role = new User_Permission();
if (isset($_POST['btn'])) {
    $message = $obj_role->user_permission_setup($_POST);
}
$user_query = $obj_role->get_user_for_role_permission();
?>
<style>
    #display_roles{
        display: none;
    }
</style>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 15px;">
    <div class="box-header with-border">
        <h3 class="box-title">User Permission</h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"><?php echo $message; ?></p>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="" method="post">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select User</label>
                            <select class="form-control select2" name="user_id" id="user_id" style="width: 100%;" required>
                                <option value="">Select User</option>
                                <?php while ($user = mysqli_fetch_array($user_query)) { ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['full_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div id="user_check"></div>
                        </div>
                        <div id="display_roles">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="patient_regi" value="1" class="minimal" required>
                                            Patient Registration
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="patient_list" value="1" class="minimal">
                                            Patient List
                                        </label>
                                    </div>
                                </div>                                            
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccination" value="1" class="minimal">
                                            Vaccination
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccination_apply" value="1" class="minimal">
                                            Vaccination Apply
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="upcoming_vaccination" value="1" class="minimal">
                                            Upcoming Vaccination
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_form" value="1" class="minimal">
                                            Vaccine Form
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_list" value="1" class="minimal">
                                            Vaccine List
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_opening_stock" value="1" class="minimal">
                                            Vaccine Opening Stock
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_stock_in" value="1" class="minimal">
                                            Vaccine Stock In
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_stock_list" value="1" class="minimal">
                                            Vaccine Stock List
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_ledger" value="1" class="minimal">
                                            Vaccine Ledger
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="user_create" value="1" class="minimal">
                                            User Create
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="user_permission" value="1" class="minimal">
                                            User Permission
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="user_manage" value="1" class="minimal">
                                            User Manage
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                </div>
                <div class="box-footer">
                    <div class="col-xs-6">
                        <button type="submit" name="btn" class="btn bg-purple btn-flat margin pull-right">Save Role Permission</button>
                    </div>
            </form>
    </div>
</form>
</div>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 35px;">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> </p>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="row">

        </div>
    </div>
</form>
</div>

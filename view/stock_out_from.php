<?php
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$issue_message = '';
$receive_message = '';
if (isset($_POST['issue'])) {
    $issue_message = $obj_vac->save_issue_stock($_POST);
}
$vaccine_list = $obj_vac->get_vaccine_all();
?>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
            <div class="register-box-body">
                <p class="login-box-msg" style="color:green;"><strong>Vaccine Issue</strong></p>
                <div class="form-errors">
                    <p style="text-align: center; color:red;"><?php echo $issue_message; ?></p>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Vaccine</label>
                        <select class="form-control select2" name="vaccine_id" id="vaccine_id" style="width: 100%;" required>
                            <option value="">Select Vaccine</option>
                            <?php while ($vaccine = mysqli_fetch_array($vaccine_list)) { ?>
                                <option value="<?php echo $vaccine['vaccine_id']; ?>"><?php echo $vaccine['generic_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class='form-group'> 
                        <label>Select Trade Name</label>
                        <select class='form-control select2' name='trade_id' id="trade_id" style='width: 100%;' required >
                        </select>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Stock Amount</label>
                        <input type="number" name="issue_qty" class="form-control" required/>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Vaccine Expire Date</label>
                        <input type="text" name="expire_date" id="expire_date" class="form-control" required/>
                        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Remarks</label>
                        <textarea type="text" name="remarks"  class="form-control" ></textarea>
                    </div>
                    <input type="hidden" name="security_field" value="<?php echo $_SESSION['id']; ?>">
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="issue" class="btn btn-primary btn-block btn-flat">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
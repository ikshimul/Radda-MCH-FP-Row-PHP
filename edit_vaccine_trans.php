<?php
session_start();
$trans_id = $_GET['trans_id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine_list = $obj_vac->get_vaccine_all();
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require './classes/vaccine_transaction.php';
$obj_trans = new Vaccine_Transaction();
$trans_info = $obj_trans->get_trans_by_trans_id($trans_id);
$trans = mysqli_fetch_assoc($trans_info);
$trans_by = $trans['trans_by'];
$session_user = $_SESSION['id'];
if ($trans_by == $session_user) {
    $entry_date = $trans['entry_date'];
   echo $today = $org['c_date'];
    if ($entry_date == $today) {
        ?>
        <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
            <div class="register-box-body">
                <form name="edit_trans_form" action="" method="post">
                    <input type="hidden" name="tr_id" value="<?php echo $trans['tr_id']; ?>">
                    <input type="hidden" name="trade_id" value="<?php echo $trans['vaccine_id']; ?>">
                    <?php if ($trans['receive_qty'] != 0) { ?>
                        <input type="hidden" name="old_receive_qty" value="<?php echo $trans['receive_qty']; ?>" class="form-control" required/>
                        <div class="form-group has-feedback">
                            <label>Stock Receive Amount</label>
                            <input type="number" name="new_receive_qty" value="<?php echo $trans['receive_qty']; ?>" class="form-control" required/>
                        </div>
                    <?php } ?>
                    <?php if ($trans['issue_qty'] != 0) { ?>
                        <input type="hidden" name="old_issue_qty" value="<?php echo $trans['issue_qty']; ?>" class="form-control" required/>
                        <div class="form-group has-feedback">
                            <label>Stock Issue Amount</label>
                            <input type="number" name="new_issue_qty" value="<?php echo $trans['issue_qty']; ?>" class="form-control" required/>
                        </div>
                    <?php } ?>
                    <div class="form-group has-feedback">
                        <label>Vaccine Expire Date</label>
                        <input type="text" name="expire_date" id="expire_date" class="form-control" required/>
                        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Remarks</label>
                        <textarea type="text" name="remarks"  class="form-control" ></textarea>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="trans_update" class="btn btn-primary btn-block btn-flat">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        echo "<span style='color:red;font-size:16px;'>Only today entry data editable</span>";
    }
} else {
    echo "<span style='color:red;font-size:16px;'>No permission</span>";
}
?>
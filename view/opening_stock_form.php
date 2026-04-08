<?php
$message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine_list = $obj_vac->get_vaccine_all();
if (isset($_POST['btn'])) {
    $message = $obj_vac->insert_opening_stock($_POST);
}
?>
<div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
    <div class="box-header with-border">
        <h3 class="box-title">Vaccine Opening Stock</h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="background-color: white; border: 1px solid #eae9e9; margin-bottom: 5px; margin-top: 10px; padding: 10px;">
                <form action="" method="post">
                    <div class="form-group">
                        <label>Vaccine</label>
                        <select class="form-control select2" name="vaccine_id" id="vaccine_id"  style="width: 100%;" required>
                            <option value="">Select Vaccine</option>
                            <?php while ($vaccine = mysqli_fetch_array($vaccine_list)) { ?>
                                <option value="<?php echo $vaccine['vaccine_id']; ?>"><?php echo $vaccine['generic_name']; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class='form-group'> 
                        <label>Select Trade Name</label>
                        <select class='form-control select2' name='trade_id' id='trade_id' onchange="check_transaction(this.value)" style='width: 100%;' required >
                        </select>
                        <div class="help-block" id="transaction_message"></div>
                    </div>
                    <div class="form-group">
                        <label>Stock Amount</label>
                        <input type="number" name="opening_stock" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="btn" id="check_tran" class="btn btn-primary btn-block btn-flat">Save</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
        <div class="box-footer">
        </div>
    </div>
</div>
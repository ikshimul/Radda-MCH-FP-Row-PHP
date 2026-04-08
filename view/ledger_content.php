<?php
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine = $obj_vac->get_vaccine_all();
?>
<style>
    #form-to{
        display: none;
    }

</style>
<div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
    <div class="box-header with-border">
        <h3 class="box-title">Specific Vaccine Ledger</h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> </p>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-offset-3 col-md-6" style="background-color: white; border: 1px solid #eae9e9; margin-bottom: 5px; margin-top: 10px; padding: 10px;">
                <div class="form-group">
                    <label>Select Vaccine</label>
                    <select class="form-control select2" name="vaccine_id" id="vaccine_id" style="width: 100%;" required >
                        <option value="">Select Vaccine</option>
                        <?php while ($list = mysqli_fetch_array($vaccine)) { ?>
                            <option value="<?php echo $list['vaccine_id']; ?>"><?php echo $list['generic_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class='form-group'> 
                    <label>Select Trade Name</label>
                    <select class='form-control select2' name='trade_id' id='trade_id' style='width: 100%;' required >
                    </select>
                </div>
                <div id="form-to">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>From</label>
                                <input type="text" class="form-control" name="from" id="vaccine_ledger_date" />
                            </div>
                            <div class="col-md-6">
                                <label>To</label>
                                <input type="text" class="form-control" name="to" id="vaccine_ledger_date1"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" name="btn" id="ledger" class="btn btn-primary btn-block btn-flat">search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ledger_details">
</div>
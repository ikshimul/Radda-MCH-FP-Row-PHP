<style>
    #applied_vaccination_report{
        background-color: white; border: 1px solid #f1f0f0; margin-bottom: 15px;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    }
</style>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-body">
            <div class="register-box" id="applied_vaccination_report">
                <h5 style="text-align: center;"><strong>Update Next Working Date</strong></h5>
                <?php echo $message; ?>
                <div class="box-body">
                    <form  action="" method="post">
                        <div class="form-group has-feedback">
                            <label>Current Operational Date</label>
                            <input type="hidden" class="form-control"  name="organization_id" value="<?php echo $org['organization_id']; ?>" />
                            <input type="date" class="form-control"  name="from_date" value="<?php echo $org['c_date']; ?>" readonly/>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Choose Operational Date</label>
                            <input type="date" class="form-control" name="c_date" required />
                        </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="system_date" class="btn btn-info pull-right">Go!</button>
            </div>
            </form>
        </div>
    </div>
</div>
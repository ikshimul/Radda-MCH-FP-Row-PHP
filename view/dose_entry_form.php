<?php
$dose_message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine = $obj_vac->vaccine_list_for_dose_entry();
if (isset($_POST['dose'])) {
    $dose_message = $obj_vac->save_dose_info($_POST);
}
?>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 35px;">
    <div class="box-header with-border">
        <h3 class="box-title">Dose Info  Entry</h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <?php echo $dose_message; ?></p>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="" method="post">
            <div class="form-group" style="border: 1px solid white; padding: 20px;">
                <label>Select Vaccine</label>
                <select class="form-control select2" name="vaccine_id" id="vaccine_id" style="width: 30%;" required >
                    <option value="">Select Vaccine</option>
                    <?php while ($list = mysqli_fetch_array($vaccine)) { ?>
                        <option value="<?php echo $list['vaccine_id']; ?>"><?php echo $list['generic_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="dose_view" style="margin-left: 20px;">

                    </div>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="row">
            <div class="col-xs-6">
                <button type="reset" class="btn bg-navy btn-flat margin">Cancel</button>
            </div>
            <div class="col-xs-6">
                <button type="submit" name="dose" class="btn bg-purple btn-flat margin pull-right">Save Dose Info</button>
            </div>
        </div>
    </div>
</form>
</div>

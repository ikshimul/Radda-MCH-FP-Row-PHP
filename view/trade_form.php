<?php
$message = '';
$dose_message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
if (isset($_POST['vaccine'])) {
    $message = $obj_vac->save_trade_info($_POST);
}
$vaccine = $obj_vac->vaccine_list();
$trade = $obj_vac->trade_info();
$trade_select = $obj_vac->trade_info();
$query = $obj_org->view_organization_info();
$prize_seeting = mysqli_fetch_assoc($query);
?>
<style>
    #dose_view{
        display: none;
    }
    #trade_list{
        display: none;
    }
</style>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 15px;">
    <div class="box-header with-border">
        <h3 class="box-title"><strong>Trade Wise Vaccine Entry</strong></h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Vaccine Name <span class="required">*</span></label>
                        <select class="form-control select2" name="vaccine_info_id"  style="width: 100%;" required>
                            <option value="">Select Vaccine</option>
                            <?php while ($trade_info = mysqli_fetch_array($trade)) { ?>
                                <option value="<?php echo $trade_info['vaccine_id']; ?>"><?php echo $trade_info['generic_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trade Name <span class="required">*</span></label>
                        <input type="text" name="trade_name" class="form-control"  required />
                    </div>
                     <?php if ($prize_seeting['prize_flag'] == 'y') { ?>
                        <div class="form-group">
                            <label>Vaccine Unit Prize <span class="required">*</span></label>
                            <input type="text" name="vaccine_prize" class="form-control"  required />
                        </div>
                    <?php } else { ?>
                        <input type="hidden" name="vaccine_prize" class="form-control" />
                    <?php } ?>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea type="text" name="remarks" class="form-control" ></textarea>
                    </div>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-xs-6">
                <button type="reset" class="btn bg-navy btn-flat  margin">Cancel</button>
            </div>
            <div class="col-xs-6">
                <button type="submit" id="sendButton" name="vaccine" class="btn bg-purple btn-flat margin pull-right">Save Trade Info</button>
            </div>
        </div>

    </div>
</form>
</div>

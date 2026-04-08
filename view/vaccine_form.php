<?php
$message = '';
$dose_message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
if (isset($_POST['vaccine'])) {
    $message = $obj_vac->save_vaccine($_POST);
}
if (isset($_POST['dose'])) {
    $dose_message = $obj_vac->save_dose_info($_POST);
}
$vaccine = $obj_vac->vaccine_list();
$trade=$obj_vac->trade_info();
$query = $obj_org->view_organization_info();
$prize_seeting = mysqli_fetch_assoc($query);
?>
<style>
    #dose_view{
        display: none;
    }
</style>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 35px;">
    <div class="box-header with-border">
        <h3 class="box-title">Vaccine Entry</h3>
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
                        <label>Generic Name <span class="required">*</span></label>
                        <input type="text" name="generic_name" class="form-control"  required />
                    </div>
                    <div class="form-group">
                        <label>Code <span class="required">*</span></label>
                        <input type="text" name="code" class="form-control" required />
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Vaccination Time <span class="required">*</span></label>
                        <select class="form-control select2" name="eligibility_type" id="vaccine_time_id" style="width: 100%;" required>
                            <option value="">Select Vaccination Time</option>
                            <option value="1">Any Time</option>
                            <option value="2">Specific Date</option>
                            <option value="3">Age Range</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. of Dose <span class="required">*</span></label>
                        <input type="text" name="no_of_dose" class="form-control" pattern="\d+" maxlength = "2" min="0" max="15" id="dose_number" placeholder="Number of Dose" data-toggle="tooltip" data-placement="right" title="Please insert only number" required />
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea type="text" name="remarks" class="form-control" ></textarea>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div id="time_display">
                        <div class="form-group">
                            <label>Age Form</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="period_form" class="form-control" id="age_form"/>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="period_form_unit" id="age_form_unit" style="width: 100%;">
                                        <option value="">Select Age Unit</option>
                                        <option value="Y">Years</option>
                                        <option value="M">Month</option>
                                        <option value="D">Days</option>
                                        <option value="W">Week</option>
                                    </select>
                                </div>
                            </div>                                            
                        </div>
                        <div class="form-group">
                            <label>Age To</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="period_to" class="form-control" id="age_to"/>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control select2" name="period_to_unit" id="age_to_unit" style="width: 100%;">
                                        <option value="">Select Age Unit</option>
                                        <option value="Y">Years</option>
                                        <option value="M">Month</option>
                                        <option value="D">Days</option>
                                        <option value="W">Week</option>
                                    </select>
                                </div>
                            </div>                                            
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-xs-6">
                <button type="reset" class="btn bg-navy btn-flat  margin">Cancel</button>
            </div>
            <div class="col-xs-6">
                <button type="submit" id="sendButton" name="vaccine" class="btn bg-purple btn-flat margin pull-right">Save Vaccine Info</button>
            </div>
        </div>

    </div>
</form>
</div>

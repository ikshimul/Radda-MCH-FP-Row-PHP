<?php
$vaccine_id = $_GET['vaccine_id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine = $obj_vac->view_vaccine_info_by_id($vaccine_id);
$info = mysqli_fetch_assoc($vaccine);
?>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-top:5px;padding:15px;">
    <form name="edit_vaccine" action="" method="post">
        <div class="form-group">
            <label>Generic Name</label>
            <input type="hidden" name="vaccine_id" value="<?php echo $info['vaccine_id']; ?>" class="form-control"  required />
            <input type="text" name="generic_name" value="<?php echo $info['generic_name']; ?>" class="form-control"  required />
        </div>
        <div class="form-group">
            <label>Code</label>
            <input type="text" name="code" value="<?php echo $info['code']; ?>" class="form-control"  required />
        </div>
        <div class="form-group">
            <label>Vaccination Time</label>
            <select class="form-control select2" name="eligibility_type" id="vaccine_time_id" style="width: 100%;" required>
                <option value="">Select Vaccination Time</option>
                <option value="1">Any Time</option>
                <option value="2">Specific Date</option>
                <option value="3">Age Range</option>
            </select>
        </div>
        <div class="form-group">
            <label>No of Dose</label>
            <input type="text" name="no_of_dose" value="<?php echo $info['no_of_dose']; ?>" class="form-control"  required />
        </div>
        <div id="time_display">
            <div class="form-group">
                <label>Age Form</label>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="period_form" value="<?php echo $info['period_form']; ?>" class="form-control" id="age_form"/>
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
                        <input type="text" name="period_to" value="<?php echo $info['period_to']; ?>" class="form-control" id="age_to"/>
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
        <div class="form-group">
            <label>Remarks</label>
            <textarea type="text" name="remarks" class="form-control" ></textarea>
        </div>
        <div class="row">
            <div class="col-xs-8">
            </div>
            <div class="col-xs-4">
                <button type="submit" name="update" class="btn btn-primary btn-block btn-flat">Update</button>
            </div>
        </div>

    </form>
</div>
<script>
    document.forms['edit_vaccine'].elements['eligibility_type'].value = '<?php echo $info['eligibility_type']; ?>';
    document.forms['edit_vaccine'].elements['period_form_unit'].value = '<?php echo $info['period_form_unit']; ?>';
    document.forms['edit_vaccine'].elements['period_to_unit'].value = '<?php echo $info['period_to_unit']; ?>';
</script>
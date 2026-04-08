<?php
$age_period_id = $_GET['age_period_id'];
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
$vaccine = $obj_vac->view_age_period_info_by_id($age_period_id);
$info = mysqli_fetch_assoc($vaccine);
?>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-top:5px;padding:15px;">
    <form name="edit_vaccine" action="" method="post">
        <div class="form-group">
            <label>Period Name</label>
            <input type="hidden" name="age_p_id" value="<?php echo $info['age_p_id'] ?>" class="form-control"  required />
            <input type="text" name="days_name" value="<?php echo $info['days_name'] ?>" class="form-control"  required />
        </div>
        <div class="form-group">
            <label>Days Form</label>
            <input type="text" name="days_from" value="<?php echo $info['days_from'] ?>" class="form-control"  required />
        </div>
        <div class="form-group">
            <label>Days To</label>
            <input type="text" name="days_to" value="<?php echo $info['days_to'] ?>" class="form-control"  required />
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


<?php
$message = '';
require_once './classes/registration.php';
$obj_reg = new Registration();
$query = $obj_org->view_organization_info();
$id_seeting = mysqli_fetch_assoc($query);
if (isset($_POST['btn'])) {
    $message = $obj_reg->save_registration($_POST);
}
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine = $obj_vac->vaccine_list();
$year = date('Y');
$month = date('m');
$auto_create = $year . '' . $month;
$get_id = $obj_reg->create_registration_id();
$result = mysqli_fetch_assoc($get_id);
$id_value = $result['id'];
$check_year = substr($result['id'], 0, 4);
//echo $check_year;
if ($id_value == null) {
    $add_id = '00001';
    $id = $auto_create . '' . $add_id;
} else {
    if ($check_year != $year) {
        $add_id = '00001';
        $id = $auto_create . '' . $add_id;
    } else {
        $id = $id_value + 1;
    }
}
?>
<div>
    <div class="register-box-body">
        <p class="login-box-msg"><strong>Register a new Patient</strong></p>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <label>ID <span class="required">*</span></label>
                <?php if ($id_seeting['id_flag'] == 'm') { ?>
                    <input   name="id" type="number" class="form-control" onblur="checkLength(this)" maxlength="10" id="check_id" placeholder="ID"  required>
                <?php } else { ?>
                    <input type="text" name="id" class="form-control" value="<?php echo $id; ?>" placeholder="ID" readonly>
                <?php } ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div  style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 35px;">
                <p style="text-align: center;"><strong>Patient Personal Info</strong></p>
                <div class="form-group has-feedback">
                    <label>Patient Name <span class="required">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Name" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Birth Registration Number</label>
                    <input type="number" name="birth_registation_number" class="form-control"/>
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Gender <span class="required">*</span> &nbsp;</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender"  required value="M" /> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender"  value="F" /> Female
                    </label>
                </div>
                <div class="form-group has-feedback">
                    <label>Date of Birth <span class="required">*</span></label>
                    <input type="text" name="dob" id="dob_date" class="form-control" required/>
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                </div>
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Year</label>
                            <input type="text" class="form-control" name="year" id="age_year" placeholder="year"/>
                        </div>
                        <div class="col-md-4">
                            <label>Month</label>
                            <input type="text" class="form-control" name="month" id="age_month" placeholder="month"/>
                        </div>
                        <div class="col-md-4">
                            <label>Day</label>
                            <input type="text" class="form-control" name="day" id="day" placeholder="day"/>
                        </div>
                    </div>
                </div>
            </div>
            <div  style="background-color: white; border: 1px solid #d4d1d1;margin-bottom:16px;padding: 35px;">
                <p style="text-align: center;"><strong>Patient Guardian Info</strong></p>
                <div class="form-group has-feedback">
                    <label>Father Name</label>
                    <input type="text" name="father_name" class="form-control" placeholder="Father Name" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
				<div class="form-group has-feedback">
                    <label>Mother Name <span class="required">*</span></label>
                    <input type="text" name="mother_name" class="form-control" placeholder="Mother Name" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Phone <span class="required">*</span></label>
                    <input type="number" name="mother_phone" class="form-control" placeholder="Phone number" />
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Address <span class="required">*</span></label>
                    <textarea type="text" name="address" class="form-control" required></textarea>
                    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                </div>
            </div>
            <input type="hidden" name="security_field" value="<?php echo $_SESSION['id']; ?>">
            <div class="row">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <button type="submit" name="btn" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
$message = '';
require_once './classes/registration.php';
$obj_reg = new Registration();
$id = $_GET['id'];
if (isset($_POST['btn'])) {
    if ($_SESSION['patient_edit'] == 1) {
        $message = $obj_reg->edit_register_user($_POST);
    } else {
        header('location:error.php');
    }
}
$result = $obj_reg->vaccine_uesr_by_id($id);
$user = mysqli_fetch_assoc($result);
?>
<div>
    <div class="register-box-body">
        <p class="login-box-msg"><strong>Edit Patient</strong></p>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input   name="id" type="number" class="form-control" value="<?php echo $user['id']; ?>"  maxlength="10" id="check_id" placeholder="ID" readonly required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div  style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 35px;">
                <p style="text-align: center;"><strong>Patient Personal Info</strong></p>
                <div class="form-group has-feedback">
                    <label>Patient Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" placeholder="Name" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Birth Registration Number</label>
                    <input type="number" name="birth_registation_number" value="<?php echo $user['birth_registation_number']; ?>" class="form-control"/>
                    <span class="glyphicon glyphicon- form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Gender &nbsp;</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender"  required value="M" <?php echo ($user['gender'] == 'M') ? 'checked' : ''; ?>/> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender"  value="F" <?php echo ($user['gender'] == 'F') ? 'checked' : ''; ?>/> Female
                    </label>
                </div>
                <div class="form-group has-feedback">
                    <label>Date of Birth</label>
                    <input type="text" name="dob" value="<?php echo $user['dob']; ?>" id="dob_date" class="form-control" required/>
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                </div>
                <div class="form-inline">
                    <?php $age = explode('-', $user['age']); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Year</label>
                            <input type="text" class="form-control" name="year" id="age_year"  placeholder="year"/>
                        </div>
                        <div class="col-md-4">
                            <label>Month</label>
                            <input type="text" class="form-control" name="month" id="age_month"  placeholder="month"/>
                        </div>
                        <div class="col-md-4">
                            <label>Day</label>
                            <input type="text" class="form-control" name="day" id="day"  placeholder="day"/>
                        </div>
                    </div>
                </div>
            </div>
            <div  style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 35px;">
                <p style="text-align: center;"><strong>Patient Guardian Info</strong></p>
                <div class="form-group has-feedback">
                    <label>Mother Name</label>
                    <input type="text" name="mother_name" class="form-control" value="<?php echo $user['mother_name']; ?>" placeholder="Mother Name" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Mother Phone</label>
                    <input type="number" name="mother_phone" class="form-control" value="<?php echo $user['mother_phone']; ?>" placeholder="Phone number" />
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" placeholder="Email" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Address</label>
                    <textarea type="text" name="address" class="form-control" required><?php echo $user['address']; ?></textarea>
                    <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
                </div>
            </div>
            <input type="hidden" name="security_field" value="<?php echo $_SESSION['id']; ?>">
            <div class="row">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <button type="submit" name="btn" class="btn btn-primary btn-block btn-flat">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

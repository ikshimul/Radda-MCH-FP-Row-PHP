<?php
$message = '';
if (isset($_POST['btn'])) {
    require_once './classes/user.php';
    $obj_user = new User();
    $message = $obj_user->user_info_save($_POST);
}
require_once './classes/organization.php';
$obj_org = new Organization();
$organization_info = $obj_org->view_all_orgnization_for_select();
?>
<style>
    #image_preview{
        padding:5px;
        height: 80px;
        width: 80px;
        margin-top: 5px;
        margin-bottom: 10px;
        margin-left: 10px;
        box-shadow: 0px 2px 2px 1px rgba(68,68,68,0.6);
    }
</style>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 5px;">
    <div class="register-box-body">
        <p class="login-box-msg"><strong>User Create Form</strong></p>
        <div class="form-errors"> <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000000">
            <div class="form-group has-feedback">
                <label>Full Name <span class="required">*</span></label>
                <input type="text" name="full_name" class="form-control" required>
            </div>
            <div class="form-group has-feedback">
                <label>User Name <span class="required">*</span></label>
                <input type="text" name="user_name" class="form-control" required>
            </div>
			<div class="form-group has-feedback">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group has-feedback">
                <label>Organization Name <span class="required">*</span></label>
                <select type="text" name="organization_id" class="form-control select2" required>
                    <option value="">Select organization</option>
                    <?php while ($organization = mysqli_fetch_array($organization_info)) { ?>
                        <option value="<?php echo $organization['organization_id']; ?>"><?php echo $organization['organization_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group has-feedback">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control"/>
            </div>
            <div class="form-group has-feedback">
                <label>Gender <span class="required">*</span></label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="gender" value="m" class="minimal"  required>
                        &nbsp;Male
                    </label>
                    <label>
                        &nbsp;&nbsp;<input type="radio" name="gender" value="f" class="minimal"> &nbsp;Female
                    </label>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label>Password <span class="required">*</span></label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group has-feedback">
                <label>Confirm Password <span class="required">*</span></label>
                <input type="password" name="c_password" class="form-control" required>
            </div>
            <div class="form-group has-feedback">
                <label>Mobile No. <span class="required">*</span></label>
                <input type="text" name="mobile" class="form-control" required>
            </div>
            <div class="form-group has-feedback">
                <label>Address <span class="required">*</span></label>
                <textarea type="text" name="address" class="form-control" rows="3" ></textarea>
            </div>
            <div class="form-group has-feedback">
                <label>Profile Pic <span class="required">*</span></label>
                <div id="image_preview"><img id="previewing" src="resource/image/no_image.gif" class="img-responsive"/></div>
                <input type="file" name="profile_pic" class="form-control" id="file" required/> 
                <div class="text-danger" id="message"></div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6">
                        <button type="submit" name="btn" class="btn bg-blue-gradient btn-flat margin pull-right">User Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
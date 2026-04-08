<?php
$message = '';
$user_id = $_GET['id'];
require_once './classes/user.php';
$obj_user = new User();
if (isset($_POST['btn'])) {
    $message = $obj_user->update_user_info($_POST);
}
$user_info = $obj_user->select_user_by_id($user_id);
$user = mysqli_fetch_assoc($user_info);
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
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 15px;">
    <div class="register-box-body">
        <p class="login-box-msg"><strong>User Edit Form</strong></p>
        <div class="form-errors"> <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
        <form name="edit_user_form" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000000">
            <div class="form-group has-feedback">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" class="form-control" required>
            </div>
<!--            <div class="form-group has-feedback">
                <label>User Name</label>
                <input type="text" name="user_name" value="<?php echo $user['user_name']; ?>" class="form-control" required>
            </div>-->
            <div class="form-group has-feedback">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control">
            </div>
            <div class="form-group has-feedback">
                <label>Organization Name</label>
                <select type="text" name="organization_id" class="form-control select2" required>
                    <option value="">Select organization</option>
                    <?php while ($organization = mysqli_fetch_array($organization_info)) { ?>
                        <option value="<?php echo $organization['organization_id']; ?>"><?php echo $organization['organization_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group has-feedback">
                <label>Designation</label>
                <input type="text" name="designation" value="<?php echo $user['designation']; ?>" class="form-control"/>
            </div>
            <div class="form-group has-feedback">
                <label>Gender</label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="gender" value="m" class="minimal" <?php
                        if ($user['gender'] == 'm') {
                            echo 'checked';
                        }
                        ?> required>
                        &nbsp;Male
                    </label>
                    <label>
                        &nbsp;&nbsp;<input type="radio" name="gender" value="f" class="minimal" <?php
                        if ($user['gender'] == 'f') {
                            echo 'checked';
                        }
                        ?>> &nbsp;Female
                    </label>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label>Mobile No.</label>
                <input type="text" name="mobile" value="<?php echo $user['mobile']; ?>" class="form-control" required>
            </div>
            <div class="form-group has-feedback">
                <label>Address</label>
                <textarea type="text" name="address" class="form-control" rows="3" ><?php echo $user['address']; ?></textarea>
            </div>
            <div class="form-group has-feedback">
                <label>Profile Pic</label>
                <div id="image_preview"><?php echo '<img id="previewing" src="data:image/jpeg;base64,' . base64_encode($user['profile_pic']) . '" class="img-responsive" height="40"  width="50"/>'; ?></div>
                <input type="file" name="profile_pic" class="form-control" id="file"/> 
                <div class="text-danger" id="message"></div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6">
                        <button type="submit" name="btn" class="btn bg-blue-gradient btn-flat margin pull-right">Update User</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.forms['edit_user_form'].elements['organization_id'].value = '<?php echo $user['organization_id']; ?>';
</script>
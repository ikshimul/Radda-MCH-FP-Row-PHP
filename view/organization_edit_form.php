<?php
$organization_id = $_GET['id'];
$message = '';
require_once './classes/organization.php';
$obj_org = new Organization();
if (isset($_POST['btn'])) {
    if ($_SESSION['organization_edit'] == 1) {
        $message = $obj_org->update_organization_info($_POST);
    } else {
        header('location:error.php');
    }
}
$query = $obj_org->view_organization_info_by_id($organization_id);
$seeting = mysqli_fetch_assoc($query);
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
        <p class="login-box-msg"><strong>Organization Setting</strong></p>

        <div class="form-errors">

            <p style="text-align: center; color:green;"> <?php echo $message; ?></p>

        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="organization_id" value="<?php echo $seeting['organization_id']; ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <div class="form-group has-feedback">
                <label>Organization Name</label>
                <input type="text" name="organization_name" class="form-control" value="<?php echo $seeting['organization_name']; ?>"  placeholder="Organization Name" required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Email</label>
                <input type="email" name="organization_email" class="form-control" value="<?php echo $seeting['organization_email']; ?>"  required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Website</label>
                <input type="url" name="organization_website" class="form-control" value="<?php echo $seeting['organization_website']; ?>"  required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Phone</label>
                <input type="text" name="organization_phone" class="form-control" value="<?php echo $seeting['organization_phone']; ?>"  required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Logo</label>
                <div id="image_preview"><?php echo '<img id="previewing" src="data:image/jpeg;base64,' . base64_encode($seeting['logo']) . '" class="img-responsive" height="40"  width="50"/>'; ?></div>
                <input class="form-control" id="file" name="userfile" type="file" /> 
                <div class="text-danger" id="message"></div>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Address</label>
                <textarea type="text" name="organization_address" class="form-control" rows="3"><?php echo $seeting['organization_address']; ?></textarea>
            </div>
            <div class="form-group has-feedback">
                <label>Software Name</label>
                <input type="text" name="software_name" class="form-control" value="<?php echo $seeting['software_name']; ?>" placeholder="Software Name" required/>
            </div>
            <div class="form-group has-feedback">
                <label>Patient Default Email</label>
                <input type="email" name="patient_default_email" class="form-control" value="<?php echo $seeting['patient_default_email']; ?>" required/>
            </div>
            <div class="form-group has-feedback">
                <label>System Time</label>
                <input type="date" name="c_date" class="form-control" value="<?php echo $seeting['c_date']; ?>" required/>
            </div>
            <div class="form-group has-feedback">
                <label>Register Id Setting</label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="id_flag" value="a" class="minimal" <?php
                        if ($seeting['id_flag'] == 'a') {
                            echo 'checked';
                        } else {
                            echo '';
                        }
                        ?> >
                        &nbsp;Auto Generate
                    </label>
                    <label>
                        &nbsp;&nbsp;<input type="radio" name="id_flag" value="m" class="minimal" <?php
                        if ($seeting['id_flag'] == 'm') {
                            echo 'checked';
                        } else {
                            echo '';
                        }
                        ?>> &nbsp;Manual
                    </label>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label>Vaccine Price</label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="prize_flag" value="y" class="minimal" <?php echo $seeting['prize_flag'] == 'y' ? 'checked' : ''; ?>>
                        &nbsp;Yes
                    </label>
                    <label>
                        &nbsp;&nbsp;<input type="radio" name="prize_flag" value="n" class="minimal" <?php echo $seeting['prize_flag'] == 'n' ? 'checked' : ''; ?>> &nbsp;No
                    </label>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6">
                        <button type="submit" name="btn" class="btn bg-purple btn-flat margin pull-right">Update Organization</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
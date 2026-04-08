<?php
$message = '';
require_once './classes/organization.php';
$obj_org = new Organization();
if (isset($_POST['btn'])) {
    $message = $obj_org->save_organization_info($_POST);
}
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
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <div class="form-group has-feedback">
                <label>Organization Name <span class="required">*</span></label>
                <input type="text" name="organization_name" class="form-control"   required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Email <span class="required">*</span></label>
                <input type="email" name="organization_email" class="form-control"   required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Website <span class="required">*</span></label>
                <input type="url" name="organization_website" class="form-control"   required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Phone <span class="required">*</span></label>
                <input type="text" name="organization_phone" class="form-control"   required>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Logo <span class="required">*</span></label>
                <div id="image_preview"><img id="previewing" src="resource/image/no_image.gif" class="img-responsive"/></div>
                <input class="form-control" id="file" name="userfile" type="file" /> 
                <div class="text-danger" id="message"></div>
            </div>
            <div class="form-group has-feedback">
                <label>Organization Address <span class="required">*</span></label>
                <textarea type="text" name="organization_address" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group has-feedback">
                <label>Software Name <span class="required">*</span></label>
                <input type="text" name="software_name" class="form-control"  required/>
            </div>
            <div class="form-group has-feedback">
                <label>Patient Default Email <span class="required">*</span></label>
                <input type="email" name="patient_default_email" class="form-control"  required/>
            </div>
            <div class="form-group has-feedback">
                <label>System Time <span class="required">*</span></label>
                <input type="date" name="c_date" class="form-control"  required/>
            </div>
            <div class="form-group has-feedback">
                <label>Register Id Setting</label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="id_flag" value="a" class="minimal"  >
                        &nbsp;Auto Generate
                    </label>
                    <label>
                        &nbsp;&nbsp;<input type="radio" name="id_flag" value="m" class="minimal" > &nbsp;Manual
                    </label>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label>Vaccine Price</label>
                <div class="form-group">
                    <label>
                        <input type="radio" name="prize_flag" value="y" class="minimal" >
                        &nbsp;Yes
                    </label>
                    <label>
                        &nbsp;&nbsp;<input type="radio" name="prize_flag" value="n" class="minimal"> &nbsp;No
                    </label>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6">
                        <button type="submit" name="btn" class="btn bg-purple btn-flat margin pull-right">Save Organization</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$message = '';
$user_id = $_SESSION['id'];
require_once './classes/user.php';
$obj_user = new User();
if (isset($_POST['password'])) {
    $message = $obj_user->change_password($_POST);
}
if(isset($_POST['image'])){
    $message=$obj_user->update_profile_pic($_POST);
}
$user_info = $obj_user->select_user_by_id($user_id);
$user = mysqli_fetch_assoc($user_info);
?>
<style>
    .edusec-img-disp {
        border: 5px solid #fff;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.25);
        width: 135px;
        height: 135px;
        margin: 15px;
    }

    .photo-edit {
        font-size: 18px;
        position: relative;
        top: -42px;
        color: white;
    }
    .edusec-pf-border {
        border: 1px solid #ececf0;
        box-shadow: 0 0 6px 1px #ececf0;
    }
	.photo-edit a.photo-edit-icon hover{
		backgroud-color:black;
	}
</style>
<div class="row">
    <div class="col-md-offset-3 col-md-5 table-responsive edusec-pf-border no-padding edusecArLangCss">
        <p style="text-align: center;padding: 5px;color: red;font-size: 16px;"><?php echo $message; ?></p>
        <div class="col-md-12 text-center">
            <?php echo '<img  src="data:image/jpeg;base64,' . base64_encode($user['profile_pic']) . '" class="img-circle edusec-img-disp"/>'; ?><div class="photo-edit">
                <a style="color:#ff0c0c;" class="photo-edit-icon" href="#" title="Change Profile Picture" data-toggle="modal" data-target="#basicModal"><i class="fa fa-camera" aria-hidden="true"></i></a></div>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Full Name</th>
                <td><?php echo $user['full_name']; ?></td>
            </tr>
            <tr>
                <th>User Name</th>
                <td><?php echo $user['user_name']; ?></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td><?php echo $user['designation']; ?></td>			
            </tr>
            <tr>
                <th><label>Mobile No</label></th>
                <td><?php echo $user['mobile']; ?></td>
            </tr>	
            <tr>
                <th><label for="empinfo-emp_email_id">Email ID</label></th>
                <td><?php echo $user['email']; ?></td>
            </tr>
            <tr>
                <th><label>Password</label></th>
                <td><a href="#" data-toggle="modal" data-target="#resetpassModal"><i class="fa fa-pencil"></i> Change Password</a></td>
            </tr>
        </table>
    </div>
</div>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content row">            
            <div class="modal-body">
                <div class="modal-body">
                    <div class="col-xs-12">
                        <div class="col-lg-12 col-sm-12 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-edit"></i>
                                <?php echo $user['full_name']; ?> </h3>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-12">
                        <div class="box box-info box-solid view-item col-xs-12 col-lg-12 no-padding">
                            <div class="box-header">
                                <h4 class="box-title"><i class="fa fa-picture-o"></i>&nbsp; Profile Photo</h4>
                            </div>
                            <div class="box-body">
                                <div class="emp-photo-form">
                                    <form id="emp-photo-form" action="" method="post" enctype="multipart/form-data">
                                        <div class="col-xs-12 col-md-12 text-center">
                                            <div id="image_preview"><?php echo '<img id="previewing" src="data:image/jpeg;base64,' . base64_encode($user['profile_pic']) . '" class="img-responsive" height="40"  width="50"/>'; ?></div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-lg-12 text-center no-padding"> 
                                            <div class="form-group field-empinfo-emp_photo">
                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                                <input type="file" id="file" name="profile_pic"  title="Browse Photo" data-filename-placement="inside" required>
                                                <p class="help-block help-block-error" id="message"></p>
                                            </div>    
                                        </div>
                                        <div class="hint col-xs-12 col-sm-12" style="color:red;padding-top:15px"><b>Note:- </b>&nbsp;Only Upload Jpeg, Jpg, Png, Gif Type    </div>
                                        <div class="form-group col-xs-12 col-sm-12 no-padding edusecArLangCss">
                                            <hr>
                                            <input type="submit" name="image" value="Update" class="btn btn-info">  
                                        </div>
                                    </form>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="resetpassModal" tabindex="-1" role="dialog" aria-labelledby="resetpassModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content row">            
            <div class="modal-body">
                <div class="modal-body">
                    <div class="col-xs-12">
                        <div class="col-lg-12 col-sm-12 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-edit"></i>
                                <?php echo $user['full_name']; ?> </h3>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-12">
                        <div class="box box-warning box-solid view-item col-xs-12 col-lg-12 no-padding">
                            <div class="box-header">
                                <h4 class="box-title"><i class="fa fa-lock"></i>&nbsp; Change Password</h4>
                            </div>
                            <div class="box-body">
                                <div class="emp-photo-form">
                                    <form id="emp-photo-form" action="" method="post" enctype="multipart/form-data">
                                        <div class="col-xs-12 col-sm-12 col-lg-12 text-center no-padding"> 
                                            <div class="form-group has-feedback">
                                                <label>Old Password <span class="required">*</span></label>
                                                <input type="password" name="old_password" class="form-control" required>
                                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>" class="form-control" required>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label>New Password <span class="required">*</span></label>
                                                <input type="password" name="new_password" class="form-control" required>
                                            </div>   
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 no-padding edusecArLangCss">
                                            <hr>
                                            <input type="submit" name="password" class="btn btn-info" value="Change">   
                                        </div>
                                    </form>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



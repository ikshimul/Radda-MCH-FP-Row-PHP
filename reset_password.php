<?php
$user_id = $_GET['user_id'];
require_once './classes/user.php';
$obj_reg = new User();
$user = $obj_reg->select_user_by_id($user_id);
$info = mysqli_fetch_assoc($user);
?>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-top:5px;padding:15px;">
    <form name="reset_password" action="" method="post">
        <div class="form-group">
            <label>Full Name</label>
            <input type="hidden" name="id" value="<?php echo $user_id; ?>" class="form-control"  required />
            <input type="text" name="full_name" value="<?php echo $info['full_name'] ?>" class="form-control" readonly/>
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password"  class="form-control"  required />
        </div>
        <div class="row">
            <div class="col-xs-8">
            </div>
            <div class="col-xs-4">
                <button type="submit" name="reset_password" class="btn btn-primary btn-block btn-flat">Reset</button>
            </div>
        </div>
    </form>
</div>

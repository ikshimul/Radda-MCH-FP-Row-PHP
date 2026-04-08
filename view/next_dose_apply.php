<?php
$message = '';
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
if (isset($_POST['btn'])) {
    $message = $obj_vac->vaccination_save($_POST);
    // $message = $obj_reg->delete_register_user($register_id);
}
?>
<style>
    #any_vaccine{
        display: none;
    }
</style>
<div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
    <div class="box-header with-border">
        <h3 class="box-title">Vaccination</h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-offset-2 col-md-8" style="background-color: white; border: 1px solid #eae9e9; margin-bottom: 5px; margin-top: 10px; padding: 15px;">
                <div class="form-group">
                    <label>Search User</label>
                    <input type="text" name="search_key" id="search_key" class="form-control" placeholder="search by name,mobile number,id" required />
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <button type="submit" name="search" id="search_user" class="btn bg-purple btn-flat margin pull-right">Search</button>
                    </div>
                </div>
                <div id="user_view">
                </div>
            </div>
        </div>
        </form>
    </div>
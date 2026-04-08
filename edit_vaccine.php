<?php
$vaccine_id = $_GET['vaccine_id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$trade = $obj_vac->trade_info();
$vaccine = $obj_vac->view_trade_info_by_id($vaccine_id);
$info = mysqli_fetch_assoc($vaccine);
?>
<div class="box-body">
    <form action="" method="post">
        <div class="row">
            <form action="" method="post">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Vaccine Name</label>
                        <select class="form-control select2" name="vaccine_info_id"  style="width: 100%;" required>
                            <option value="">Select Vaccine</option>
                            <?php while ($trade_info = mysqli_fetch_array($trade)) { ?>
                                <option value="<?php echo $trade_info['vaccine_id']; ?>" <?php
                                if ($trade_info['vaccine_id'] == $info['vaccine_info_id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $trade_info['generic_name']; ?></option>
                                    <?php } ?>
                        </select>
                        <input type="hidden" name="trade_id" class="form-control" value="<?php echo $info['trade_id']; ?>" placeholder="Vaccine Name" required />
                    </div>
                    <div class="form-group">
                        <label>Trade Name</label>
                        <input type="text" name="trade_name" class="form-control"  value="<?php echo $info['trade_name']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Vaccine Unit Prize</label>
                        <input type="text" name="vaccine_prize" class="form-control" value="<?php echo $info['vaccine_prize']; ?>" placeholder="Vaccine Prize" required />
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea type="text" name="remarks" class="form-control" placeholder="Remarks"><?php echo $info['remarks']; ?></textarea>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-xs-offset-4 col-xs-4">
                <button type="submit" name="btn" class="btn btn-primary btn-block btn-flat">Update</button>
                </form>
            </div>
            <div class="col-xs-4">
            </div>
        </div>
</div>
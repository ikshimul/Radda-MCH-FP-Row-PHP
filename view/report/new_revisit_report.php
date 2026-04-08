<style>
    #future_vaccination_report{
        background-color: white; border: 1px solid #f1f0f0; margin-bottom: 15px;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    }
</style>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-body">
            <div class="register-box" id="future_vaccination_report">
                <h5 style="text-align: center;"><strong>Future Vaccination Report</strong></h5>
                <div class="box-body">
                    <form class="form-horizontal" target="_blank" action="report/new_revisit_report.php" method="post">
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Dose Date</label>
                            <div class="col-sm-5">
                                <input type="date" name="dose_from" value="<?php echo date('Y-m-d'); ?>"  class="form-control" placeholder="From"/>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control"  name="dose_to" value="<?php echo date('Y-m-d'); ?>" placeholder="To">
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <a  id="report_hide" class="btn btn-default">Cancel</a>
                    <button type="submit" name="search" class="btn btn-info pull-right">Go!</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
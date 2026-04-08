<style>
    #applied_vaccination_report{
        background-color: white; border: 1px solid #f1f0f0; margin-bottom: 15px;-webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
    }
</style>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-body">
            <div class="register-box" id="applied_vaccination_report">
                <h5 style="text-align: center;"><strong>Vaccination Applied Details Report</strong></h5>
                <div class="box-body">
                    <form  target="_blank" action="report/vaccination_applied_report_print.php" method="post">
                        <div class="form-inline">
                            <div class="col-md-6">
                                <label>From Date</label>
                                <input type="date" class="form-control"  name="from_date" value="<?php echo date('Y-m-d'); ?>" />
                            </div>
                            <div class="col-md-6">
                                <label>To Date</label>
                                <input type="date" class="form-control" name="to_date" value="<?php echo date('Y-m-d'); ?>" />
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
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
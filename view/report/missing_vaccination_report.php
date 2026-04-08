<?php
$message = '';
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
$query = $obj_vac->missing_vaccination_list();
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">View Missing vaccination info </h3>
            <span class="pull-right"><a href="report/missing_vaccination_report.php" target="__blank" class="btn btn-default">Print</a>&nbsp;</span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <strong><p style="text-align: center; color:#990033; font-family: initial; font-size: 15px;"> <?php echo $message; ?></p></strong>
            </div>
            <style>
                .table-responsive {
                    overflow-x: visible; 
                }
            </style>
            <div class="table-responsive">
                <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                    <th>Name</th>
                    <th>Mother Phone</th>
                    <th>Vaccine Name</th>
                    <th>Trade</th>
                    <th>Dose Name</th>
                    <th>Dose Date</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['mother_phone']; ?></td>
                                <td><?php echo $row['generic_name']; ?></td>
                                <td><?php echo $row['trade_name']; ?></td>
                                <td><?php echo $row['dose_name']; ?></td>
                                <td>
                                    <?php
                                    echo date('d M,Y', strtotime($row['next_date']));
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="modal fade" id="modal-email">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you sure to send SMS?</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Message Body</label>
                    <textarea type="text" name="message" id="message_text" class="form-control">hello </textarea>
                </div>
            </div>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <input type="submit" name="btn"  class="btn btn-success" value="Send">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-sms">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you sure to send SMS?</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="mother_phone" id="mother_phone" class="form-control" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Message Body</label>
                    <textarea type="text" name="message" id="message_text_sms" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <input type="submit" name="btn"  class="btn btn-success" value="Send">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you sure to delete this?</h4>
            </div>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
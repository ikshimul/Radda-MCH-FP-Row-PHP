<?php
$message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->stock_ledger();
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">View all user </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <strong><p style="text-align: center; color:#990033; font-family: initial; font-size: 15px;"> <?php echo $message; ?></p></strong>
            </div>
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <th>Date</th>
                <th>Vaccine Name</th>
                <th>Opening Stock</th>
                <th>Receive Qty</th>
                <th>Issue Qty</th>
                <th>Balance</th>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $row['entry_date']; ?></td>
                            <td><?php echo $row['vaccine_name']; ?></td>
                            <td><?php echo number_format($row['opening_stock'],2); ?></td>
                            <td><?php echo number_format($row['receive_qty'],2); ?></td>
                            <td><?php echo number_format($row['issue_qty'],2); ?></td>
                            <td><?php echo number_format($row['current_stock'],2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="modal fade" id="modal-dose">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you confirm to Apply this dose?</h4>
            </div>
            <div class="modal-footer" style="margin:0px;border-top:0px;text-align:center;">
                <a href="#" class="btn btn-success" id="confirm_link">Confirm</a>
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

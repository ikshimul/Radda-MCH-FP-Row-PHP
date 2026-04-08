<?php
$message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->vaccine_stock_list();
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h5 style="text-align: center;"><strong>Vaccine Stock List</strong></h5>
            <span class="pull-right"><a href="report_vaccine_stock.php" target="__blank" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print All Vaccine List</a>&nbsp;</span>
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
                    <th>Vaccine ID</th>
                    <th>Generic Name</th>
                    <th>Trade Name</th>
                    <th>Opening Stock</th>
                    <th>Receive Qty</th>
                    <th>Issue Qty</th>
                    <th>Used</th>
                    <th>Current Stock</th>
                    <th>Ledger</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $row['trade_id']; ?></td>
                                <td><?php echo $row['generic_name']; ?></td>
                                <td><?php echo $row['trade_name']; ?></td>
                                <td><?php echo $row['opening_stock']; ?></td>
                                <td><?php echo $row['total_receive']; ?></td>
                                <td><?php echo $row['total_issue']; ?></td>
                                <td><?php echo $row['total_used']; ?></td>
                                <td><?php echo $row['current_stock']; ?></td>
                                <td><a href="stock_details_for_report.php?vaccine_id=<?php echo $row['trade_id']; ?>" class="btn btn-sm btn-success">Ledger</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
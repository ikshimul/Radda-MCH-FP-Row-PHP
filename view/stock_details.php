<?php
$message = '';
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$vaccine_id = $_GET['vaccine_id'];
require './classes/vaccine_transaction.php';
$obj_trans = new Vaccine_Transaction();
if (isset($_POST['trans_update'])) {
    $message = $obj_trans->update_trans($_POST);
//    echo '<pre>';
//    var_dump($_POST);
}
$query = $obj_vac->vaccine_stock_details($vaccine_id);
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">Stock List </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <strong><p style="text-align: center; color:#990033; font-family: initial; font-size: 15px;"> <?php echo $message; ?></p></strong>
            </div>
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <th>Vaccine Name</th>
                <th>Trade Name</th>
                <th>Receive Qty</th>
                <th>Issue Qty</th>
                <th>Expire Date</th>
                <th>Entry Date</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $row['generic_name']; ?></td>
                            <td><?php echo $row['trade_name']; ?></td>
                            <td><?php echo $row['receive_qty']; ?></td>
                            <td><?php echo $row['issue_qty']; ?></td>
                            <td><?php echo $row['expire_date']; ?></td>
                            <td><?php echo $row['entry_date']; ?></td>
                            <td>
                                <?php
                                if ($row['trans_by'] == $_SESSION['id']) {
                                    if ($row['entry_date'] == $org['c_date']) {
                                        ?>
                                        <a href="#" onclick="edit_vaccine_trans(<?php echo $row['tr_id']; ?>)" class="btn btn-sm btn-success">Edit</a>
                                        <?php
                                    } else {
                                        ?><a href="#"  class="btn btn-sm btn-danger">No action</a>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a href="#"  class="btn btn-sm btn-danger">No action</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Vaccine Transaction</h4>
            </div>
            <div class="modal-body" style="height: 450px; overflow:auto;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


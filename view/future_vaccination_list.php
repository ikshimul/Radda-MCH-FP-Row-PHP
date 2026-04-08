<?php
$message = '';
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'dose') {
        $vaccination_id = $_GET['id'];
        $message = $obj_vac->vaccination_apply($vaccination_id);
        // $message = $obj_reg->delete_register_user($register_id);
    }
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'delete') {
        $future_id = $_GET['id'];
        $message = $obj_vac->delete_future_vaccination_info_by_id($future_id);
    }
}
if (isset($_POST['search'])) {
    $query = $obj_vac->search_future_vaccination_by_next_date($_POST);
} else {

// Pagination settings
$limit = 10; // Rows to display per page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number from the URL parameter, default is 1

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $limit;

$total = $obj_vac->getTotalRow();
// Calculate the total number of pages
$total_pages = ceil((int)$total/(int)$limit);
$query = $obj_vac->future_vaccination_view($limit, $offset);

}
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">View future vaccination info </h3>
            <span class="pull-right"><a href="#" id="report" class="btn btn-default">Report</a>&nbsp;</span>
            <span class="pull-right"><a href="#" id="search" class="btn btn-default">Advance Search</a>&nbsp;&nbsp;</span>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <strong><p style="text-align: center; color:#990033; font-family: initial; font-size: 15px;"> <?php echo $message; ?></p></strong>
            </div>
            <div class="register-box"  id="advance_search">
                <h5 style="text-align: center;"><strong>Advance Search</strong></h5>
                <div class="box-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Dose Date</label>
                            <div class="col-sm-5">
                                <input type="date" name="dose_from"   class="form-control" placeholder="From"/>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control"  name="dose_to" placeholder="To">
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a  id="Hide" class="btn btn-default">Cancel</a>
                    <button type="submit" name="search"  class="btn btn-info pull-right">Go!</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
            <div class="register-box" id="future_vaccine_report">
                <h5 style="text-align: center;"><strong>Report</strong></h5>
                <div class="box-body">
                    <form class="form-horizontal" target="_blank" action="upcoming_vaccination_report.php" method="post">
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Dose Date</label>
                            <div class="col-sm-5">
                                <input type="date" name="dose_from"   class="form-control" placeholder="From"/>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control"  name="dose_to" placeholder="To">
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
                    <th>Action</th>
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
                                    $today = strtotime('today');
//                                    if ($row['next_date'] == $today) {
//                                        echo "<span class='blink_me'>Today</span>";
//                                    } else {
//                                        echo date('d M,Y', strtotime($row['next_date']));
//                                    }


                                    $date_timestamp = strtotime($row['next_date']);
                                    if ($date_timestamp < $today) {
                                        echo "<span style='color:red;'>Date Expire</span>";
                                    } elseif ($date_timestamp == $today) {
                                        echo "<span class='blink_me'>Today</span>";
                                    } else {
                                        echo date('d M,Y', strtotime($row['next_date']));
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="#" onclick="send_email('<?php echo $row['email']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['generic_name'] ?>', '<?php echo date('d M,Y', strtotime($row['next_date'])) ?>')" class="btn btn-sm btn-success">Email</a> 
                                    <a href="#" onclick="send_sms('<?php echo $row['mother_phone']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['generic_name'] ?>', '<?php echo date('d M,Y', strtotime($row['next_date'])) ?>')" class="btn btn-sm btn-warning">SMS</a>
                                    <a href="#" onclick="confirm_delete('?status=delete&&id=<?php echo $row['future_id']; ?>')" class="btn btn-sm btn-danger">delete</a>
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
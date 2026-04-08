<?php
$message = '';
require_once './classes/registration.php';
$obj_reg = new Registration();
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'register') {
        $register_id = $_GET['id'];
        if ($_SESSION['patient_delete'] == 1) {
            $message = $obj_reg->delete_register_user($register_id);
        } else {
            header('location:error.php');
        }
    }
}
if (isset($_POST['search'])) {
    $query = $obj_reg->search_user_by_reg_dob($_POST);
} else {
    $query = $obj_reg->vaccine_user();
}
?>
<div class="row">
    <div style="background-color: white; border: 1px solid #e0d8d8;margin-bottom: 5px;">
        <div class="box-header">
            <h3 class="box-title">View all vaccine user </h3>
            <span class="pull-right"><a href="all_patient_list_report.php" target="__blank" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print All Patient</a></span>
<!--            <span class="pull-right"><a href="#" id="search" class="btn btn-default">Advance Search</a>&nbsp;&nbsp;</span>-->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-errors">
                <p style="text-align: center; color:green;"> <?php echo $message; ?></p>
            </div>
            <div class="register-box"  id="advance_search">
                <h5 style="text-align: center;"><strong>Advance Search</strong></h5>
                <div class="box-body">
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">Registration Date</label>
                            <div class="col-sm-5">
                                <input type="date" name="dob_from"   class="form-control" placeholder="From"/>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" class="form-control"  name="dob_to" placeholder="To">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-sm-2 control-label">DOB</label>
                            <div class="col-sm-5"><input type="text" class="form-control" name="registation_from" id="date2" placeholder="From"></div>
                            <div class="col-sm-5"><input type="text" class="form-control" name="registation_to" id="date1" placeholder="To"></div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a  id="Hide" class="btn btn-default">Cancel</a>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                            $dob = $row['dob'];
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php
//                                $age = $row['age'];
//                                $full_age = explode('-', $age);
//                                echo $full_age[0] . ' Years ' . $full_age[1] . ' months ' . $full_age[2] . ' days ';
//                                
                                    ?>
                                    <?php
                                    $bday = new DateTime($dob);
                                    $today = new DateTime(); // for testing purposes
                                    $diff = $today->diff($bday);
                                    printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
                                    ?></td>
                                <td><?php
                                    if ($row['gender'] == 'M') {
                                        echo 'Male';
                                    } else {
                                        echo 'Female';
                                    }
                                    ?></td>
                                <td><?php echo $row['mother_phone']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td>
                                    <a href="eligibility.php?id=<?php echo $row['id']; ?>&dob=<?php echo $row['dob']; ?>&name=<?php echo $row['name'] ?>" target="__blank" class="btn btn-sm btn-success">Eligibility</a> 
                                    <a href="user_report.php?id=<?php echo $row['id']; ?>" target="__blank" class="btn btn-sm btn-success">Report</a> 
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
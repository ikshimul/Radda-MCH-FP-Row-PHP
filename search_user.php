<?php
session_start();
$name = '';
$id = '';
$user_id = $_GET['search_key'];
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once './classes/vaccination.php';
$obj_vac = new Vaccination();
require_once './classes/vaccine.php';
$obj_vac_list = new Vaccine();
$user = $obj_vac->future_vaccination_search($user_id);
$vaccine = $obj_vac->future_vaccination($user_id);
if (mysqli_num_rows($user) == NULL) {
    echo "<span style='color:red;'>Not found</span>";
} else {
    echo "<h4><strong>Personal info</strong></h4>";
    while ($user_info = mysqli_fetch_assoc($user)) {
        $name = $user_info['name'];
        $id = $user_info['id'];
        $vaccine_id = $user_info['vaccine_id'];
        $dose_id = $user_info['dose_id'];
        $age = $user_info['dob'];
        $bday = new DateTime($age);
        $today = new DateTime();
        $diff = $today->diff($bday);
        $age_details = $diff->y . ' Years ' . $diff->m . ' months ' . $diff->d . ' days';
        $year = $diff->y;
        $month = $diff->m;
        $day = $diff->d;
        $total_days = $year * 365 + $month * 30 + $day;
        $address = $user_info['address'];
        $phone = $user_info['mother_phone'];
        $email = $user_info['email'];
        echo "<div class='row invoice-info'>
                        <div class='col-sm-6 invoice-col'>
                            <address>
                                <strong>$name</strong><br>
                                Age: $age_details<br>
                                Address: $address<br>
                                Phone: (+88) $phone<br>
                                Email:  $email
                            </address>
                        </div>
                </div>";
    }

    echo "<hr>";
    if (mysqli_num_rows($vaccine) == NULL) {
        echo "<span style='color:red;'>No vaccination</span>";
    } else {
        echo "<h4><strong>Upcoming vaccination info</strong></h4>";
        $operational_date = $org['c_date'];
        $data = array();
        while ($vaccine_info = mysqli_fetch_assoc($vaccine)) {
            $vaccine_name = $vaccine_info['generic_name'];
            $vaccine_id = $vaccine_info['vaccine_id'];
            $trade = $obj_vac_list->vaccine_wise_trade_info($vaccine_id);
            $trade_name = $vaccine_info['trade_name'];
            $trade_id = $vaccine_info['trade_id'];
            $dose_name = $vaccine_info['dose_name'];
            $dose_id = $vaccine_info['dose_id'];
            $dose_number = $vaccine_info['dose_serial'];
            $dose_date = $vaccine_info['next_date'];
            $data[] = $vaccine_info['vaccine_id'];
            $all_trade_id = implode(',', $data);
            if ($operational_date >= $dose_date) {
                echo "<div style='background-color: white; border: 1px solid #e0d8d8;margin-bottom: 15px;'>
                    <div class='register-box-body'>
                     <p class='login-box-msg' style='color:green;'><strong>Upcoming Vaccine</strong></p>
                     <div style='background-color: white; border: 1px solid #e0d8d8;padding: 15px; margin-bottom: 15px;'>Vaccine Name:$vaccine_name<br>Trade Name : $trade_name<br>Dose Name : $dose_name<br>Dose Date: $dose_date</div>
                    <form action='' method='post'>
            <div class='form-group has-feedback'>
                <label>Full Name</label>
                <input type='text' name='name' class='form-control' value='$name' placeholder='Name' required readonly/>
                <input type='hidden' name='id' class='form-control' value='$id' placeholder='Name'/>
            </div>
			<div class='form-group has-feedback'>
                <label>Vaccine Name</label>
                <input type='hidden' name='vaccine_id' class='form-control' value='$vaccine_id' id='vaccine_id'  required />
                <input type='text'  class='form-control' value='$vaccine_name' id='vaccine_id'  required readonly />
            </div>
            <div class='form-group'> 
                <label>Select Trade Name</label>
                <select class='form-control select2' name='trade_id' style='width: 100%;' required >
                 <option value=''>Select Trade</option>";
                while ($list = mysqli_fetch_array($trade)) {
                    $trade_id_all = $list['trade_id'];
                    $trade_name = $list['trade_name'];
                    echo "<option value='$trade_id_all'";
                    if ($trade_id_all == $trade_id) {
                        echo 'selected';
                    }echo ">$trade_name</option>";
                }

                echo "</select>
               </div>
	      <div class='form-group has-feedback'>
                <label>Dose Name</label>
                <input type='hidden' name='dose_id' class='form-control' value='$dose_id-$dose_number' id='dose_id'  required />
                <input type='text'  class='form-control' value='$dose_name' id='dose_id'  required readonly/>
                <input type='hidden' name='dose_date' id='perivous_dose_date' class='form-control'>
            </div>
			<div class='form-group has-feedback'>
                <label>Remarks</label>
                <textarea type='text' name='remarks' class='form-control'></textarea>
            </div>
            <div class='row'>
                <div class='col-xs-8'>
                </div>
                <div class='col-xs-4'>
                    <button type='submit' name='btn' id='check_apply' class='btn btn-primary btn-block btn-flat'>Confirm</button>
                </div>
            </div>
        </form></div></div>";
            } else {
                echo "Vaccine Name:$vaccine_name<br>Trade Name : $trade_name<br>Dose Name : $dose_name<br><span style='font-size:20px;color:red;'>Dose Date : $dose_date</span><br>";
            }
        }
    }
    echo "<hr>";
    echo "<h5>Want to apply any other Vaccine?</h5>";
    echo "<a href='#' class='btn btn-success' id='yes'>Yes</a>";
    echo "&nbsp;<a href='#' class='btn btn-danger' id='no'>No</a>";
    echo '<hr>';
}
echo "<div id='any_vaccine'><form action='' method='post'>
            <div class='form-group has-feedback'>
                <label>Full Name</label>
                <input type='text' name='name' class='form-control' id='user_id' value='$name' placeholder='Name' readonly />
                <input type='hidden' name='id' class='form-control' id='user_id' value='$id' placeholder='Name' required />
            </div>
              <div class='col-md-6'>
	        <div class='form-group'>
                <label>Select Vaccine</label>
                <select class='form-control select2' name='vaccine_id' id='vaccine' style='width:50%' required >
                    <option value=''>Select Vaccine</option>";
$used_vaccine = (is_null($all_trade_id) ? '0' : $all_trade_id);
$vaccine_list = $obj_vac->check_for_eligibility_vaccine($used_vaccine);
while ($list = mysqli_fetch_array($vaccine_list)) {
    $vaccine_id = $list['vaccine_id'];
    $vaccine_name = $list['generic_name'];
    $days_form = $list['eligibility_days_form'];
    $days_to = $list['eligibility_days_to'];
    if ($days_form <= $total_days && $days_to >= $total_days) {
        echo "<option value='$vaccine_id'>$vaccine_name</option>";
    }
}

echo "</select>
    </div>
    </div>
    <div class='col-md-6'>
       <div class='form-group'> 
                        <label>Select Trade Name</label>
                        <select class='form-control select2' name='trade_id' id='trade_id' style='width: 50%;' required >


                        </select>
         </div>
    </div>
<input type='hidden' name='dose_date' id='perivous' class='form-control'>
            <div class='row'>
                <div class='col-md-12'>
                    <div id='dose_view' style='margin-left: 20px;'>

                    </div>
                </div>
                <div class='col-md-12'>
                <div id='previous_date'></div>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-8'>
                </div>
                <div class='col-xs-4'>
                    <button type='submit' name='btn' id='check_apply' class='btn btn-primary btn-block btn-flat'>Confirm</button>
                </div>
            </div>
        </form></div>";

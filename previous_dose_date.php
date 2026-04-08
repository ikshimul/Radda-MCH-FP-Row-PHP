<?php

$user_id = $_GET['user_id'];
$vaccine_id = $_GET['vaccine_id'];
$dose_serial = $_GET['dose_serial'];
$dose_explode = explode('-', $dose_serial);
$dose_id = $dose_explode[0];
$serial_id = $dose_explode[1];
require_once './classes/vaccination.php';
$obj_vaccination = new Vaccination();
require_once './classes/vaccine.php';
$obj_vacccine = new Vaccine();
$dose_number = $obj_vacccine->find_number_of_dose($vaccine_id);
$count = mysqli_fetch_assoc($dose_number);
$doses = array();
for ($i = 1; $i <= $count['no_of_dose']; $i++) {
    $doses[] = $i;
}
$max_dose = max($doses);
$min_dose = min($doses);
$after_dose = $obj_vacccine->after_dose_serial($vaccine_id, $serial_id);
$after_dose_serial = mysqli_fetch_assoc($after_dose);
$after = $after_dose_serial['after_dose_id'];
//echo $after;
$previous_dose_id=$obj_vacccine->get_previous_dose_id($vaccine_id,$after);
$get_dose_id=  mysqli_fetch_assoc($previous_dose_id);
$previous_dose=$get_dose_id['dose_id'];
$check_after_dose = $obj_vacccine->check_after_dose_in_vaccination($user_id, $vaccine_id, $after);
$check = mysqli_fetch_assoc($check_after_dose);
$check_after = $check['vaccine_id'];
if ($max_dose == $serial_id || $min_dose == $serial_id) {
   echo "<input type='hidden' name='dose_date' id='perivous_dose_date' class='form-control'>";
} else{
    if ($check == NULL) {
    echo "<div class='form-group has-feedback'>
            <label>Please insert your $after dose date</label>
            <input type='text' name='dose_date' id='perivous_dose_date' class='form-control' required>
            <input type='hidden' name='perivous_dose' id='perivous_dose_date' value='$after' class='form-control'>
            <input type='hidden' name='perivous_dose_id' value='$previous_dose' class='form-control'>
          </div>";
    }
}


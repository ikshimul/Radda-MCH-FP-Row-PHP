<?php

require_once './classes/vaccination.php';
$obj_vac = New Vaccination();
$search_key = $_GET['term'];
$search_result = $obj_vac->future_vaccination_search($search_key);
$vaccine = array();
while ($get = mysqli_fetch_array($search_result)) {
    $vaccine[] = array('label' => $get['name'], 'id' => $get['vaccine_id']);
}
echo json_encode($vaccine);

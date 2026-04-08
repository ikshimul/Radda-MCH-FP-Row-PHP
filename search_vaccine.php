<?php

require_once './classes/vaccine.php';
$obj_vac = New Vaccine();
$search_key = $_GET['term'];
$search_result = $obj_vac->search_vaccine($search_key);
$vaccine = array();
while ($get = mysqli_fetch_array($search_result)) {
    $vaccine[] = array('label' => $get['vaccine_name'], 'id' => $get['vaccine_id'], 'vaccine_id' => $get['vaccine_id']);
}
echo json_encode($vaccine);


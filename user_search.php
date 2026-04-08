<?php

require_once './classes/registration.php';
$obj_reg = New Registration();
$search_key = $_GET['term'];
$search_result = $obj_reg->search_registration_user($search_key);
$vaccine = array();
while ($get = mysqli_fetch_array($search_result)) {
    $vaccine[] = array('label' => $get['id'].' ( '.$get['name'].' ) '.'Mobile Number :'.$get['mother_phone'],'value'=>$get['id']);
}
echo json_encode($vaccine);

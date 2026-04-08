<?php
$message = '';
require_once './classes/registration.php';
$obj_reg = new Registration();
$list = $obj_reg->vaccine_user_report($_POST);
$data = array();
$no =$no = $_POST['start'];
$grand_total=0;
$grand_stock=0;
foreach ($list as $user) {
	$no++;
	$user_id=$user['id'];
	$user_name=$user['name'];
	$dob = $user['dob'];
	$bday = new DateTime($dob);
	$today = new DateTime(); // for testing purposes
	$diff = $today->diff($bday);
	//printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
	$dateDifference = date_diff($bday, $today)->format('%y years, %m months and %d days');
    if ($user['gender'] == 'M') {
		$gender='Male';
	} else {
		$gender='Female';
	}
	$date=$dob ;
	$row = array();
	$row[] = $no;
	$pid = $user['id'];
	$row[] =$user['name'];
	$row[] = $dateDifference;
	$row[] = $gender;
	$row[] = $user['mother_phone'];
	$row[] = $user['address'];
	$row[] = '<a href="eligibility.php?id='. $user_id. '&dob=' .$dob. '&name='. $user_name .'" target="_blank" class="btn btn-sm btn-success">Eligibility</a> 
                                    <a href="user_report.php?id='.$user_id.'" target="__blank" class="btn btn-sm btn-success">Report</a> 
                                    <a href="user_details.php?id='.$user_id.'" target="_blank" class="btn btn-sm btn-success">View</a> 
                                    <a href="edit_register_user.php?id='.$user_id.'" target="_blank" class="btn btn-sm btn-primary">Edit</a> 
                                    <a href="#" onclick="confirm_delete(?status=register&&id='.$user_id.')" class="btn btn-sm btn-danger">delete</a>';
	$data[] = $row;
}

$output = array(
	"draw" => $_POST['draw'],
	"recordsTotal" => $obj_reg->count_all_user(),
	"recordsFiltered" => $obj_reg->count_all_user(),
	"data" => $data,
);
//output to json format
echo json_encode($output);
?>
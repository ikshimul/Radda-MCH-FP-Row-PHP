<?php

$user_id = $_GET['user_id'];
require_once './classes/user_permission.php';
$obj_role = new User_Permission();
$user = $obj_role->select_role_by_user($user_id);
$check_user = mysqli_num_rows($user);
if (mysqli_num_rows($user) >= 1) {
    echo "User already have some role permission.please manage role <a href='manage_user.php'>click here</a>";
} else {
    echo 'show_roles';
}
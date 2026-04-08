<?php

if (!class_exists('database')) {
    require 'database.php';
}

class Login extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->link = $this->database_connect();
    }

    public function admin_login_check($data) {

        $password = md5($data['password']);
        $sql = "SELECT * FROM user WHERE user_name='$data[user_name]' AND password='$password' AND deleted_status='0'";
        $query_result = mysqli_query($this->link, $sql);
        $admin_info = mysqli_fetch_array($query_result);
        if ($admin_info) {
            $user_id = $admin_info['id'];
            $check = $admin_info['active_inactive'];
            if ($check == 1) {
                $message = "Your are not permission to login";
                return $message;
            } else {
                $role_query = "SELECT * FROM role_permission WHERE user_id='$user_id'";
                $role = mysqli_query($this->link, $role_query);
                $role_permission = mysqli_fetch_assoc($role);
                session_start();
                $_SESSION['id'] = $admin_info['id'];
                $_SESSION['name'] = $admin_info['full_name'];
                $_SESSION['organization_id'] = $admin_info['organization_id'];
                $_SESSION['profile_pic'] = $admin_info['profile_pic'];
                $_SESSION['registration'] = $role_permission['registration'];
                $_SESSION['main_vaccination'] = $role_permission['main_vaccination'];
                $_SESSION['vaccine'] = $role_permission['vaccine'];
                $_SESSION['vaccine_stock'] = $role_permission['vaccine_stock'];
                $_SESSION['contact'] = $role_permission['contact'];
                $_SESSION['user'] = $role_permission['user'];
                $_SESSION['operational_time'] = $role_permission['operational_time'];
                $_SESSION['patient_regi'] = $role_permission['patient_regi'];
                $_SESSION['patient_list'] = $role_permission['patient_list'];
                $_SESSION['vaccination'] = $role_permission['vaccination'];
                $_SESSION['vaccination_apply'] = $role_permission['vaccination_apply'];
                $_SESSION['upcoming_vaccination'] = $role_permission['upcoming_vaccination'];
                $_SESSION['vaccine_form'] = $role_permission['vaccine_form'];
                $_SESSION['vaccine_list'] = $role_permission['vaccine_list'];
                $_SESSION['vaccine_opening_stock'] = $role_permission['vaccine_opening_stock'];
                $_SESSION['vaccine_stock_in'] = $role_permission['vaccine_stock_in'];
                $_SESSION['vaccine_stock_list'] = $role_permission['vaccine_stock_list'];
                $_SESSION['vaccine_ledger'] = $role_permission['vaccine_ledger'];
                $_SESSION['user_create'] = $role_permission['user_create'];
                $_SESSION['user_manage'] = $role_permission['user_manage'];
                $_SESSION['role_permission'] = $role_permission['role_permission'];
                $_SESSION['role_permission_manage'] = $role_permission['role_permission_manage'];
                $_SESSION['patient_edit'] = $role_permission['patient_edit'];
                $_SESSION['patient_delete'] = $role_permission['patient_delete'];
                $_SESSION['vaccine_edit'] = $role_permission['vaccine_edit'];
                $_SESSION['vaccine_delete'] = $role_permission['vaccine_delete'];
                $_SESSION['user_edit'] = $role_permission['user_edit'];
                $_SESSION['user_delete'] = $role_permission['user_delete'];
                $_SESSION['organization'] = $role_permission['organization'];
                $_SESSION['organization_create'] = $role_permission['organization_create'];
                $_SESSION['organization_manage'] = $role_permission['organization_manage'];
                $_SESSION['age_period'] = $role_permission['age_period'];
                $_SESSION['organization_edit'] = $role_permission['organization_edit'];
                $_SESSION['organization_delete'] = $role_permission['organization_delete'];
                $_SESSION['report'] = $role_permission['report'];
                $_SESSION['patient_report'] = $role_permission['patient_report'];
                $_SESSION['future_vaccination_report'] = $role_permission['future_vaccination_report'];
                $_SESSION['vaccine_list_report'] = $role_permission['vaccine_list_report'];
                $_SESSION['vaccine_stock_report'] = $role_permission['vaccine_stock_report'];
                $_SESSION['vaccine_ledger_report'] = $role_permission['vaccine_ledger_report'];
                $_SESSION['vaccination_applied'] = $role_permission['vaccination_applied'];
                $_SESSION['vaccination_summary'] = $role_permission['vaccination_summary'];
                $_SESSION['missing_vaccination_report'] = $role_permission['missing_vaccination_report'];
                $_SESSION['vaccination_summary_by_generic'] = $role_permission['vaccination_summary_by_generic'];
                $_SESSION['vaccination_summary_by_age'] = $role_permission['vaccination_summary_by_age'];
                $oneMonth = 60 * 60 * 24 * 30 + time();
                setcookie('lastVisit', date("h:i:s a - m/d/Y"), $oneMonth);
                header('Location:check_date.php');
            }
        } else {
            $message = 'Your username or password was incorrect!';
            return $message;
        }
    }

}

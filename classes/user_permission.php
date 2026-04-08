<?php

if (!class_exists('database')) {
    require 'database.php';
}

class User_Permission extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function get_user_for_role_permission() {
        $sql = "SELECT user.full_name,user.id FROM user";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function user_permission_setup($data) {
        $patient_regi = "";
        $patient_regi = isset($data['patient_regi']) ? $data['patient_regi'] : 0;
        $patient_list = "";
        $patient_list = isset($data['patient_list']) ? $data['patient_list'] : 0;
        $vaccination = "";
        $vaccination = isset($data['vaccination']) ? $data['vaccination'] : 0;
        $vaccination_apply = "";
        $vaccination_apply = isset($data['vaccination_apply']) ? $data['vaccination_apply'] : 0;
        $upcoming_vaccination = "";
        $upcoming_vaccination = isset($data['upcoming_vaccination']) ? $data['upcoming_vaccination'] : 0;
        $vaccine_form = "";
        $vaccine_form = isset($data['vaccine_form']) ? $data['vaccine_form'] : 0;
        $vaccine_list = "";
        $vaccine_list = isset($data['vaccine_list']) ? $data['vaccine_list'] : 0;
        $vaccine_opening_stock = "";
        $vaccine_opening_stock = isset($data['vaccine_opening_stock']) ? $data['vaccine_opening_stock'] : 0;
        $vaccine_stock_in = "";
        $vaccine_stock_in = isset($data['vaccine_stock_in']) ? $data['vaccine_stock_in'] : 0;
        $vaccine_stock_list = "";
        $vaccine_stock_list = isset($data['vaccine_stock_list']) ? $data['vaccine_stock_list'] : 0;
        $vaccine_ledger = "";
        $vaccine_ledger = isset($data['vaccine_ledger']) ? $data['vaccine_ledger'] : 0;
        $user_create = "";
        $user_create = isset($data['user_create']) ? $data['user_create'] : 0;
        $user_permission = "";
        $user_permission = isset($data['user_permission']) ? $data['user_permission'] : 0;
        $user_manage = "";
        $user_manage = isset($data['user_manage']) ? $data['user_manage'] : 0;
        $user_id = $data['user_id'];
        $sql = "INSERT INTO role_permission(user_id,patient_regi,patient_list,vaccination,vaccination_apply,upcoming_vaccination,vaccine_form,vaccine_list,vaccine_opening_stock,vaccine_stock_in,vaccine_stock_list,vaccine_ledger,user_create,user_manage,role_permission)"
                . "VALUES('$user_id','$patient_regi','$patient_list','$vaccination','$vaccination_apply','$upcoming_vaccination','$vaccine_form','$vaccine_list','$vaccine_opening_stock','$vaccine_stock_in','$vaccine_stock_list','$vaccine_ledger','$user_create','$user_permission','$user_manage')";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "Role permission successfully assin";
            return $message;
        } else {
            $message = "Role permission not assin";
            return $message;
        }
    }

    public function update_user_permission_setup($data) {
        $check_user = "SELECT user_id FROM role_permission WHERE user_id='$data[user_id]'";
        $check_query = mysqli_query($this->link, $check_user);
        if (mysqli_num_rows($check_query) > 0) {
            $operational_time = isset($data['operational_time']) ? $data['operational_time'] : 0;
            $registration = isset($data['registration']) ? $data['registration'] : 0;
            $main_vaccination = isset($data['main_vaccination']) ? $data['main_vaccination'] : 0;
            $vaccine = isset($data['vaccine']) ? $data['vaccine'] : 0;
            $vaccine_stock = isset($data['vaccine_stock']) ? $data['vaccine_stock'] : 0;
            $contact = isset($data['contact']) ? $data['contact'] : 0;
            $user = isset($data['user']) ? $data['user'] : 0;
            $patient_regi = isset($data['patient_regi']) ? $data['patient_regi'] : 0;
            $patient_list = isset($data['patient_list']) ? $data['patient_list'] : 0;
            $vaccination = isset($data['vaccination']) ? $data['vaccination'] : 0;
            $vaccination_apply = isset($data['vaccination_apply']) ? $data['vaccination_apply'] : 0;
            $upcoming_vaccination = isset($data['upcoming_vaccination']) ? $data['upcoming_vaccination'] : 0;
            $vaccine_form = isset($data['vaccine_form']) ? $data['vaccine_form'] : 0;
            $vaccine_list = isset($data['vaccine_list']) ? $data['vaccine_list'] : 0;
            $vaccine_opening_stock = isset($data['vaccine_opening_stock']) ? $data['vaccine_opening_stock'] : 0;
            $vaccine_stock_in = isset($data['vaccine_stock_in']) ? $data['vaccine_stock_in'] : 0;
            $vaccine_stock_list = isset($data['vaccine_stock_list']) ? $data['vaccine_stock_list'] : 0;
            $vaccine_ledger = isset($data['vaccine_ledger']) ? $data['vaccine_ledger'] : 0;
            $user_create = isset($data['user_create']) ? $data['user_create'] : 0;
            $role_permission = isset($data['role_permission_manage']) ? $data['role_permission_manage'] : 0;
            $user_manage = isset($data['user_manage']) ? $data['user_manage'] : 0;
            $patient_edit = isset($data['patient_edit']) ? $data['patient_edit'] : 0;
            $patient_delete = isset($data['patient_delete']) ? $data['patient_delete'] : 0;
            $vaccine_edit = isset($data['vaccine_edit']) ? $data['vaccine_edit'] : 0;
            $vaccine_delete = isset($data['vaccine_delete']) ? $data['vaccine_delete'] : 0;
            $user_edit = isset($data['user_edit']) ? $data['user_edit'] : 0;
            $user_delete = isset($data['user_delete']) ? $data['user_delete'] : 0;
            $organization = isset($data['organization']) ? $data['organization'] : 0;
            $organization_create = isset($data['organization_create']) ? $data['organization_create'] : 0;
            $organization_manage = isset($data['organization_manage']) ? $data['organization_manage'] : 0;
            $age_period = isset($data['age_period']) ? $data['age_period'] : 0;
            $organization_edit = isset($data['organization_edit']) ? $data['organization_edit'] : 0;
            $organization_delete = isset($data['organization_delete']) ? $data['organization_delete'] : 0;
            $report = isset($data['report']) ? $data['report'] : 0;
            $patient_report = isset($data['patient_report']) ? $data['patient_report'] : 0;
            $vaccine_list_report = isset($data['vaccine_list_report']) ? $data['vaccine_list_report'] : 0;
            $missing_vaccination_report = isset($data['missing_vaccination_report']) ? $data['missing_vaccination_report'] : 0;
            $future_vaccination_report = isset($data['future_vaccination_report']) ? $data['future_vaccination_report'] : 0;
            $vaccine_stock_report = isset($data['vaccine_stock_report']) ? $data['vaccine_stock_report'] : 0;
            $vaccine_ledger_report = isset($data['vaccine_ledger_report']) ? $data['vaccine_ledger_report'] : 0;
            $vaccination_applied = isset($data['vaccination_applied']) ? $data['vaccination_applied'] : 0;
            $vaccination_summary = isset($data['vaccination_summary']) ? $data['vaccination_summary'] : 0;
            $vaccination_summary_by_generic = isset($data['vaccination_summary_by_generic']) ? $data['vaccination_summary_by_generic'] : 0;
            $vaccination_summary_by_age = isset($data['vaccination_summary_by_age']) ? $data['vaccination_summary_by_age'] : 0;
            $user_id = $data['user_id'];
            $sql = "UPDATE role_permission SET operational_time='$operational_time',registration='$registration',main_vaccination='$main_vaccination',vaccine='$vaccine',vaccine_stock='$vaccine_stock',contact='$contact',user='$user',patient_regi='$patient_regi',patient_list='$patient_list',vaccination='$vaccination',vaccination_apply='$vaccination_apply',upcoming_vaccination='$upcoming_vaccination',vaccine_form='$vaccine_form',vaccine_list='$vaccine_form',vaccine_opening_stock='$vaccine_opening_stock',vaccine_stock_in='$vaccine_stock_in',vaccine_stock_list='$vaccine_stock_list',vaccine_ledger='$vaccine_ledger',user_create='$user_create',user_manage='$user_manage',role_permission_manage='$role_permission',patient_edit='$patient_edit',patient_delete='$patient_delete',vaccine_edit='$vaccine_edit',vaccine_delete='$vaccine_delete',user_edit='$user_edit',user_delete='$user_delete',organization='$organization',organization_create='$organization_create',organization_manage='$organization_manage',age_period='$age_period',organization_edit='$organization_edit',organization_delete='$organization_delete',report='$report',patient_report='$patient_report',future_vaccination_report='$future_vaccination_report',vaccine_list_report='$vaccine_list_report',vaccine_stock_report='$vaccine_stock_report',vaccine_ledger_report='$vaccine_ledger_report',vaccination_applied='$vaccination_applied',vaccination_summary='$vaccination_summary',missing_vaccination_report='$missing_vaccination_report',vaccination_summary_by_generic='$vaccination_summary_by_generic',vaccination_summary_by_age='$vaccination_summary_by_age' WHERE user_id='$user_id'";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $message = "Role Permission update successfully";
                return $message;
            } else {
                $message = "Role permission not updated";
                return $message;
            }
        } else {
            $operational_time = isset($data['operational_time']) ? $data['operational_time'] : 0;
            $registration = isset($data['registration']) ? $data['registration'] : 0;
            $main_vaccination = isset($data['main_vaccination']) ? $data['main_vaccination'] : 0;
            $vaccine = isset($data['vaccine']) ? $data['vaccine'] : 0;
            $vaccine_stock = isset($data['vaccine_stock']) ? $data['vaccine_stock'] : 0;
            $contact = isset($data['contact']) ? $data['contact'] : 0;
            $user = isset($data['user']) ? $data['user'] : 0;
            $patient_regi = isset($data['patient_regi']) ? $data['patient_regi'] : 0;
            $patient_list = isset($data['patient_list']) ? $data['patient_list'] : 0;
            $vaccination = isset($data['vaccination']) ? $data['vaccination'] : 0;
            $vaccination_apply = isset($data['vaccination_apply']) ? $data['vaccination_apply'] : 0;
            $upcoming_vaccination = isset($data['upcoming_vaccination']) ? $data['upcoming_vaccination'] : 0;
            $vaccine_form = isset($data['vaccine_form']) ? $data['vaccine_form'] : 0;
            $vaccine_list = isset($data['vaccine_list']) ? $data['vaccine_list'] : 0;
            $vaccine_opening_stock = isset($data['vaccine_opening_stock']) ? $data['vaccine_opening_stock'] : 0;
            $vaccine_stock_in = isset($data['vaccine_stock_in']) ? $data['vaccine_stock_in'] : 0;
            $vaccine_stock_list = isset($data['vaccine_stock_list']) ? $data['vaccine_stock_list'] : 0;
            $vaccine_ledger = isset($data['vaccine_ledger']) ? $data['vaccine_ledger'] : 0;
            $user_create = isset($data['user_create']) ? $data['user_create'] : 0;
            $user_permission = isset($data['role_permission_manage']) ? $data['role_permission_manage'] : 0;
            $user_manage = isset($data['user_manage']) ? $data['user_manage'] : 0;
            $patient_edit = isset($data['patient_edit']) ? $data['patient_edit'] : 0;
            $patient_delete = isset($data['patient_delete']) ? $data['patient_delete'] : 0;
            $vaccine_edit = isset($data['vaccine_edit']) ? $data['vaccine_edit'] : 0;
            $vaccine_delete = isset($data['vaccine_delete']) ? $data['vaccine_delete'] : 0;
            $user_edit = isset($data['user_edit']) ? $data['user_edit'] : 0;
            $user_delete = isset($data['user_delete']) ? $data['user_delete'] : 0;
            $organization = isset($data['organization']) ? $data['organization'] : 0;
            $organization_create = isset($data['organization_create']) ? $data['organization_create'] : 0;
            $organization_manage = isset($data['organization_manage']) ? $data['organization_manage'] : 0;
            $age_period = isset($data['age_period']) ? $data['age_period'] : 0;
            $organization_edit = isset($data['organization_edit']) ? $data['organization_edit'] : 0;
            $organization_delete = isset($data['organization_delete']) ? $data['organization_delete'] : 0;
            $report = isset($data['report']) ? $data['report'] : 0;
            $patient_report = isset($data['patient_report']) ? $data['patient_report'] : 0;
            $missing_vaccination_report = isset($data['missing_vaccination_report']) ? $data['missing_vaccination_report'] : 0;
            $future_vaccination_report = isset($data['future_vaccination_report']) ? $data['future_vaccination_report'] : 0;
            $vaccine_list_report = isset($data['vaccine_list_report']) ? $data['vaccine_list_report'] : 0;
            $vaccine_stock_report = isset($data['vaccine_stock_report']) ? $data['vaccine_stock_report'] : 0;
            $vaccine_ledger_report = isset($data['vaccine_ledger_report']) ? $data['vaccine_ledger_report'] : 0;
            $vaccination_applied = isset($data['vaccination_applied']) ? $data['vaccination_applied'] : 0;
            $vaccination_summary = isset($data['vaccination_summary']) ? $data['vaccination_summary'] : 0;
            $vaccination_summary_by_generic = isset($data['vaccination_summary_by_generic']) ? $data['vaccination_summary_by_generic'] : 0;
            $vaccination_summary_by_age = isset($data['vaccination_summary_by_age']) ? $data['vaccination_summary_by_age'] : 0;
            $user_id = $data['user_id'];
            $sql = "INSERT INTO role_permission(user_id,operational_time,registration,main_vaccination,vaccine,vaccine_stock,contact,user,patient_regi,patient_list,vaccination,vaccination_apply,upcoming_vaccination,vaccine_form,vaccine_list,vaccine_opening_stock,vaccine_stock_in,vaccine_stock_list,vaccine_ledger,user_create,user_manage,role_permission_manage,patient_edit,patient_delete,vaccine_edit,vaccine_delete,user_edit,user_delete,organization,organization_create,organization_manage,age_period,organization_edit,organization_delete,report,patient_report,future_vaccination_report,vaccine_list_report,vaccine_stock_report,vaccine_ledger_report,vaccination_applied,vaccination_summary,missing_vaccination_report,vaccination_summary_by_generic,vaccination_summary_by_age)"
                    . "VALUES('$user_id','$operational_time','$registration','$main_vaccination','$vaccine','$vaccine_stock','$contact','$user','$patient_regi','$patient_list','$vaccination','$vaccination_apply','$upcoming_vaccination','$vaccine_form','$vaccine_list','$vaccine_opening_stock','$vaccine_stock_in','$vaccine_stock_list','$vaccine_ledger','$user_create','$user_manage','$user_permission','$patient_edit','$patient_delete','$vaccine_edit','$vaccine_delete','$user_edit','$user_delete','$organization','$organization_create','$organization_manage','$age_period','$organization_edit','$organization_delete','$report','$patient_report','$future_vaccination_report','$vaccine_list_report','$vaccine_stock_report','$vaccine_ledger_report','$vaccination_applied','$vaccination_summary','$missing_vaccination_report','$vaccination_summary_by_generic','$vaccination_summary_by_age')";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $message = "Role permission successfully assin";
                return $message;
            } else {
                
                echo (mysqli_error($this->link,$sql));
            }
        }
    }

    public function user_list() {
        $sql = "SELECT * FROM user WHERE deleted_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function select_role_by_user($user_id) {
        $sql = "SELECT * FROM role_permission WHERE user_id='$user_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

}

<?php

if (!class_exists('database')) {
    require './database.php';
}

class Report extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function vaccination_applied_report($data) {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT vaccination.dose_date,vaccination.remarks,registation.id,registation.name,registation.mother_phone,vaccine_info.generic_name,trade_info.trade_name,dose_info.dose_name,user.full_name
                FROM vaccination
                LEFT JOIN registation
                ON vaccination.vaccine_user_id=registation.id
                LEFT JOIN vaccine_info
                ON vaccination.vaccine_details_id=vaccine_info.vaccine_id
                LEFT JOIN trade_info
                ON vaccination.vaccine_id=trade_info.trade_id
                LEFT JOIN dose_info
                ON vaccination.dose_id=dose_info.dose_id
                LEFT JOIN user
                ON vaccination.applied_by=user.id
                WHERE vaccination.dose_apply='1' AND vaccination.used='1' AND DATE(vaccination.dose_date) BETWEEN '$data[from_date]' AND '$data[to_date]' AND vaccination.organization_id='$organization'
                GROUP BY vaccination.vaccination_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccination_summary_report($data) {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT vaccination.vaccination_id,trade_info.trade_name,vaccine_info.generic_name,
                (SELECT COUNT(vaccination.vaccination_id)  
                 FROM vaccination 
                 LEFT JOIN
                 registation
                 ON vaccination.vaccine_user_id=registation.id
                 WHERE trade_info.trade_id=vaccination.vaccine_id AND vaccination.dose_apply='1' AND vaccination.used='1' AND registation.gender='M' AND vaccination.organization_id='$organization'
                 AND DATE(vaccination.dose_date) BETWEEN '$data[from_date]' AND '$data[to_date]'
                 GROUP BY vaccination.vaccine_id) as total_male,
                 (SELECT COUNT(vaccination.vaccination_id)  
                 FROM vaccination 
                 LEFT JOIN
                 registation
                 ON vaccination.vaccine_user_id=registation.id
                 WHERE trade_info.trade_id=vaccination.vaccine_id AND vaccination.dose_apply='1' AND vaccination.used='1' AND registation.gender='F' AND vaccination.organization_id='$organization'
                 AND DATE(vaccination.dose_date) BETWEEN '$data[from_date]' AND '$data[to_date]'
                 GROUP BY vaccination.vaccine_id) as total_female
                 FROM vaccination
                 LEFT JOIN trade_info
                 ON vaccination.vaccine_id=trade_info.trade_id
                 LEFT JOIN vaccine_info
                 ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                 GROUP BY trade_info.trade_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccination_summary_report_by_generic($data) {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT vaccination.vaccination_id,trade_info.trade_name,vaccine_info.generic_name,
                (SELECT COUNT(vaccination.vaccination_id)  
                 FROM vaccination 
                 LEFT JOIN
                 registation
                 ON vaccination.vaccine_user_id=registation.id
                 WHERE trade_info.vaccine_info_id=vaccination.vaccine_details_id AND vaccination.dose_apply='1' AND vaccination.used='1' AND registation.gender='M' AND vaccination.organization_id='$organization'
                 AND DATE(vaccination.dose_date) BETWEEN '$data[from_date]' AND '$data[to_date]'
                 GROUP BY vaccination.vaccine_details_id) as total_male,
                 (SELECT COUNT(vaccination.vaccination_id)  
                 FROM vaccination 
                 LEFT JOIN
                 registation
                 ON vaccination.vaccine_user_id=registation.id
                 WHERE trade_info.vaccine_info_id=vaccination.vaccine_details_id AND vaccination.dose_apply='1' AND vaccination.used='1' AND registation.gender='F' AND vaccination.organization_id='$organization'
                 AND DATE(vaccination.dose_date) BETWEEN '$data[from_date]' AND '$data[to_date]'
                 GROUP BY vaccination.vaccine_details_id) as total_female
                 FROM vaccination
                 LEFT JOIN trade_info
                 ON vaccination.vaccine_id=trade_info.trade_id
                 LEFT JOIN vaccine_info
                 ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                 GROUP BY trade_info.vaccine_info_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccination_summary_report_by_age($data) {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT vaccination_report.vaccine_id,vaccination_report.age_period_id,COUNT(vaccination_report.vaccine_id) as total,vaccination_report.generic_name,age_period.days_name
                FROM vaccination_report
                LEFT JOIN age_period
                ON vaccination_report.age_period_id=age_period.age_p_id
                WHERE vaccination_report.dose_apply='1' AND DATE(vaccination_report.dose_date) BETWEEN '$data[from_date]' AND '$data[to_date]' AND vaccination_report.organization_id='$organization'
                GROUP BY vaccination_report.vaccine_id,vaccination_report.age_period_id
                ORDER BY vaccination_report.vaccine_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function missing_vaccination_list() {
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,registation.name,registation.email,registation.mother_phone,trade_info.trade_name,vaccine_info.generic_name
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE future_vaccination.deleted_status='0' AND future_vaccination.next_date < CURRENT_DATE
                ORDER BY future_vaccination.next_date ASC";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function client_new_revisit_report($data) {
        $organization = $_SESSION['organization_id'];
        $sql = "select vaccine_user_id, count(vaccine_user_id)-1 as reVisit,count(dose_apply)- count(vaccine_user_id)+1 as newpt 
                FROM `vaccination` 
                where dose_apply=1 AND DATE(vaccination.dose_date) BETWEEN '$data[dose_from]' AND '$data[dose_to]' AND vaccination.organization_id='$organization'
                group by vaccine_user_id, `vaccine_details_id`";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

}

<?php

if (!class_exists('database')) {
    require 'database.php';
}

class Vaccination extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function upcoming_vaccination() {
        $sql = "SELECT vaccination.vaccination_id,vaccination.dose_apply,vaccination.dose_date,registation.id,registation.name,registation.dob,registation.mother_name,registation.mother_phone,trade_info.trade_id,vaccine_info.generic_name,dose_info.dose_id,dose_info.dose_name
            FROM vaccination
            LEFT JOIN registation
            ON vaccination.vaccine_user_id=registation.id
            LEFT JOIN trade_info
            ON trade_info.trade_id=vaccination.vaccine_id
            LEFT JOIN vaccine_info
            ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
            LEFT JOIN dose_info
            ON vaccination.dose_id=dose_info.dose_id
            WHERE vaccination.dose_apply='0' AND vaccination.deleted_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccination_save($data) {
        $applied_id = $_SESSION['id'];
        $organization_id = $_SESSION['organization_id'];
        $vaccine_user_id = $data['id'];
        $vaccine_details_id = $data['vaccine_id'];
        $vaccine_id = $data['trade_id'];
        $dose_info = $data['dose_id'];
        $dose_id_and_serial = explode('-', $dose_info);
        $dose_id = $dose_id_and_serial[0];
        $serial_id = $dose_id_and_serial[1];
        if ($data['dose_date'] != NULL) {
            $perivous_serial_id = $data['perivous_dose'];
            $perivous_dose_id = $data['perivous_dose_id'];
            $previous_dose = "INSERT INTO vaccination (vaccine_user_id,organization_id, vaccine_id,vaccine_details_id,dose_id, dose_serial,dose_date,remarks,dose_apply,used) VALUES('$vaccine_user_id','$organization_id','$vaccine_id','$vaccine_details_id','$perivous_dose_id','$perivous_serial_id','$data[dose_date]','$data[remarks]','1','0')";
            $previous_dose_apply = mysqli_query($this->link, $previous_dose);
            if ($previous_dose_apply) {
                $vaccination = "INSERT INTO vaccination(vaccine_user_id,organization_id, vaccine_id,vaccine_details_id,dose_id, dose_serial, applied_by, remarks) VALUES('$vaccine_user_id','$organization_id','$vaccine_id','$vaccine_details_id','$dose_id','$serial_id','$applied_id','$data[remarks]')";
                $vaccine = mysqli_query($this->link, $vaccination);
                if ($vaccine) {
                    $message = "Registration and vaccination successfully!";
                    return $message;
                } else {
                    $message = "Vaccination not inserted!";
                    return $message;
                }
            }
        } else {
            $vaccination = "INSERT INTO vaccination(vaccine_user_id,organization_id, vaccine_id,vaccine_details_id, dose_id, dose_serial, applied_by, remarks) VALUES('$vaccine_user_id','$organization_id','$vaccine_id','$vaccine_details_id','$dose_id','$serial_id','$applied_id','$data[remarks]')";
            $vaccine = mysqli_query($this->link, $vaccination);
            if ($vaccine) {
                $message = "Registration and vaccination successfully!";
                return $message;
            } else {
                $message = "Vaccination not inserted!";
                return $message;
            }
        }
    }

    public function vaccination_apply($trade_id, $vaccination_id, $dob) {
        //check vaccine stock
        $organization = $_SESSION['organization_id'];
        $stock_check = "SELECT trade_info.current_stock FROM trade_info WHERE trade_info.trade_id='$trade_id'";
        $check = mysqli_query($this->link, $stock_check);
        $number = mysqli_fetch_assoc($check);
        if ($number['current_stock'] <= 0) {
            $message = "Vaccine are not available.Please check your stock!";
            return $message;
        } else {
            $bday = new DateTime($dob);
            $today = new DateTime();
            $diff = $today->diff($bday);
            $age_details = $diff->y . ' Years ' . $diff->m . ' months ' . $diff->d . ' days';
            $year = $diff->y;
            $month = $diff->m;
            $day = $diff->d;
            $total_days = $year * 365 + $month * 30 + $day;
            $age_sql = "SELECT * FROM `age_period` WHERE age_period.days_from <= '$total_days'  AND age_period.days_to >= '$total_days'";
            $age_query = mysqli_query($this->link, $age_sql);
            $age_period = mysqli_fetch_assoc($age_query);
            $age_period_id = $age_period['age_p_id'];
//            operation date form organization
            $organization_id = $_SESSION['organization_id'];
            $sql = "SELECT * FROM organization WHERE organization_id='$organization_id'";
            $query = mysqli_query($this->link, $sql);
            $org = mysqli_fetch_assoc($query);
            $dose_date = $org['c_date'];
            $sql = "UPDATE vaccination SET p_current_age='$total_days',age_period_id='$age_period_id',dose_apply='1',dose_date='$dose_date' WHERE vaccination_id='$vaccination_id'";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                //get vaccine id and dose id form vaccination table
                $future_vaccine = "SELECT vaccine_user_id,vaccine_id,vaccine_details_id,dose_id FROM `vaccination` WHERE vaccination_id='$vaccination_id'";
                $query = mysqli_query($this->link, $future_vaccine);
                $result = mysqli_fetch_assoc($query);
                $vaccine_user = $result['vaccine_user_id'];
                $vaccine_details_id = $result['vaccine_details_id'];
                $vaccine_id = $result['vaccine_id'];
                //set future vaccination flag disable
                $future_status = "UPDATE future_vaccination SET deleted_status='1' WHERE vaccine_user_id='$vaccine_user' AND vaccine_id='$vaccine_id'";
                $deleted_status = mysqli_query($this->link, $future_status);
                //vaccine stock update
                $stock_update = "UPDATE trade_info SET current_stock=current_stock-1 WHERE trade_info.trade_id='$vaccine_id'";
                $stock = mysqli_query($this->link, $stock_update);
                //get dose serial number form dose table
                $dose_serial = "SELECT dose_serial FROM dose_info WHERE dose_id='$result[dose_id]'";
                $query1 = mysqli_query($this->link, $dose_serial);
                $dose_serial = mysqli_fetch_assoc($query1);
                $serial = $dose_serial['dose_serial'];
                //get all info for future vaccination planning
                $query_dose = "SELECT * FROM dose_info WHERE vaccine_id='$result[vaccine_details_id]' AND dose_serial > '$serial' limit 0,1";
                $query2 = mysqli_query($this->link, $query_dose);
                while ($future = mysqli_fetch_array($query2)) {
                    $after_dose_serial = $future['after_dose_id'];
                    $dose_serial_query = "SELECT * FROM vaccination WHERE vaccine_user_id='$vaccine_user' AND vaccine_id='$vaccine_id' AND dose_serial='$after_dose_serial'";
                    $serial_query = mysqli_query($this->link, $dose_serial_query);
                    $serial_date = mysqli_fetch_assoc($serial_query);
                    $serial_date = $serial_date['dose_date'];
                    $time_form = $future['dose_time_form'];
                    $unit = $future['dose_time_unit'];
                    if ($unit == 'Y') {
                        $days = 365;
                    } elseif ($unit == 'M') {
                        $days = 30;
                    } elseif ($unit == 'W') {
                        $days = 7;
                    } else {
                        $days = 1;
                    }
                    $add_day = $time_form * $days;
                    $nextDate = strtotime($serial_date . '+ ' . $add_day . 'days');
                    $dose_id = $future['dose_id'];
                    $dose_name = $future['dose_name'];
                    $date = date('Y-m-d', $nextDate);
                    $query_insert = "INSERT INTO future_vaccination(vaccine_user_id,organization_id,vaccine_id,dose_id,dose_name,next_date)VALUES('$vaccine_user','$organization','$vaccine_id','$dose_id','$dose_name','$date')";
                    $future_vaccination_query = mysqli_query($this->link, $query_insert);
                }
                $message = 'Vaccination and future vaccination plan apply successfully';
                return $message;
            } else {
                $message = 'Vaccination not apply';
                return $message;
            }
        }
    }

    public function search_future_vaccination_by_next_date($data) {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,registation.name,registation.email,registation.mother_phone,trade_info.trade_name,vaccine_info.generic_name
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE DATE(future_vaccination.next_date) BETWEEN '$data[dose_from]' AND '$data[dose_to]' AND future_vaccination.organization_id='$organization' AND future_vaccination.deleted_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function getTotalRow()
    {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT COUNT(*) as total
                FROM future_vaccination
                WHERE future_vaccination.deleted_status='0' AND future_vaccination.organization_id=4";
        $query = mysqli_query($this->link, $sql);
        $total = $query->fetch_assoc();
        return $total;
    }

    public function future_vaccination_view($limit,$offset) {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,registation.name,registation.email,registation.mother_phone,trade_info.trade_name,vaccine_info.generic_name
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE future_vaccination.deleted_status='0' AND future_vaccination.organization_id='$organization'
                ORDER BY future_vaccination.next_date ASC LIMIT $limit OFFSET $offset";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function missing_vaccination_list() {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,registation.name,registation.email,registation.mother_phone,trade_info.trade_name,vaccine_info.generic_name
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE future_vaccination.deleted_status='0' AND future_vaccination.next_date < CURRENT_DATE AND future_vaccination.organization_id='$organization'
                ORDER BY future_vaccination.next_date ASC";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function future_vaccination_view_by_user_id($patient_id) {
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,registation.name,registation.email,registation.mother_phone,trade_info.trade_id,trade_info.vaccine_info_id,trade_info.trade_name,vaccine_info.generic_name
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE future_vaccination.vaccine_user_id='$patient_id' AND future_vaccination.deleted_status='0' ";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function eligibility_vaccine() {
        $sql = "SELECT * FROM vaccine_info WHERE deletion_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function check_for_eligibility_vaccine($trade_id) {
        $sql = "SELECT * FROM `vaccine_info` WHERE vaccine_info.vaccine_id NOT IN($trade_id)";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function future_vaccination($search_key) {
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,future_vaccination.dose_id,trade_info.trade_name,trade_info.trade_id,vaccine_info.vaccine_id,vaccine_info.generic_name,dose_info.dose_serial
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                LEFT JOIN dose_info
                ON dose_info.dose_id=future_vaccination.dose_id
                WHERE future_vaccination.vaccine_user_id='$search_key' AND future_vaccination.deleted_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function future_vaccination_search($search_key) {
        $sql = "SELECT registation.id,registation.name,registation.gender,registation.dob,registation.age,registation.mother_name,registation.mother_phone,registation.address,registation.email,future_vaccination.vaccine_id,future_vaccination.dose_id,future_vaccination.next_date
                FROM registation
                LEFT JOIN future_vaccination
                ON registation.id=future_vaccination.vaccine_user_id
                WHERE registation.id='$search_key' GROUP BY registation.id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function delete_vaccination_info_by_id($vaccination_id) {
        $sql = "UPDATE vaccination SET deleted_status='1' WHERE vaccination_id='$vaccination_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "Delete successfully";
            return $message;
        } else {
            $message = "Data not deleted";
            return $message;
        }
    }

    public function delete_future_vaccination_info_by_id($future_id) {
        $sql = "UPDATE future_vaccination SET deleted_status='1' WHERE future_id='$future_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "Delete successfully";
            return $message;
        } else {
            $message = "Data not deleted";
            return $message;
        }
    }

    public function save_age_period($data) {
        $sql = "INSERT INTO age_period(days_name,days_from,days_to) VALUES('$data[days_name]','$data[days_from]','$data[days_to]')";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'New age period save successfully';
            return $message;
        } else {
            $message = 'Query Problem';
            return $message;
        }
    }

    public function view_age_period_info_by_id($age_period_id) {
        $sql = "SELECT * FROM `age_period` WHERE age_p_id='$age_period_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function update_age_period_info($data) {
        $sql = "UPDATE age_period SET days_name='$data[days_name]',days_from='$data[days_from]',days_to='$data[days_to]' WHERE age_p_id='$data[age_p_id]'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'Age period update successfully';
            return $message;
        } else {
            $message = 'Query Problem';
            return $message;
        }
    }

    public function age_period_list() {
        $sql = "SELECT * FROM `age_period` WHERE deletion_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function delete_age_period($age_period_id) {
        $sql = "DELETE FROM age_period WHERE age_p_id='$age_period_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'Age period delete successfully';
            return $message;
        } else {
            $message = 'Query problem,not deleted';
            return $message;
        }
    }

}

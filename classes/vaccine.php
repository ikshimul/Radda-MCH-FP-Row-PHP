<?php

if (!class_exists('database')) {
    require 'database.php';
}

class Vaccine extends Database {

    //put your code here
    protected $link;

    // public $title;
    public function __construct() {
        $this->link = $this->database_connect();
        //   $this->title = $this->setTitle('Vaccine');
    }

    public function save_vaccine($data) {
        $check = "SELECT * FROM vaccine_info WHERE generic_name='$data[generic_name]'";
        $check_query = mysqli_query($this->link, $check);
        if (mysqli_num_rows($check_query) > 0) {
            $message = 'Duplicate generic name not allow';
            return $message;
        } else {
            $from = $data['period_form'];
            if ($from == NULL) {
                $days_form = 0;
                $days_to = 365 * 99;
            } else {
                $days_form_unit = $data['period_form_unit'];
                if ($days_form_unit == 'Y') {
                    $days_form = $data['period_form'] * 365;
                } elseif ($days_form_unit == 'M') {
                    $days_form = $data['period_form'] * 30;
                } elseif ($days_form_unit == 'W') {
                    $days_form = $data['period_form'] * 7;
                } else {
                    $days_form = $data['period_form'];
                }
                $days_to_unit = $data['period_to_unit'];
                if ($days_to_unit == 'Y') {
                    $days_to = $data['period_to'] * 365;
                } elseif ($days_to_unit == 'M') {
                    $days_to = $data['period_to'] * 30;
                } elseif ($days_to_unit == 'W') {
                    $days_to = $data['period_to'] * 7;
                } else {
                    $days_to = $data['period_to'];
                }
            }
            $sql = "INSERT INTO vaccine_info(generic_name,code,eligibility_type,no_of_dose,period_form,period_to,period_form_unit,period_to_unit,eligibility_days_form,eligibility_days_to,remarks) VALUES('$data[generic_name]','$data[code]','$data[eligibility_type]','$data[no_of_dose]','$data[period_form]','$data[period_to]','$data[period_form_unit]','$data[period_to_unit]','$days_form','$days_to','$data[remarks]')";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $message = "Vaccine info save successfully";
                return $message;
            } else {
                $message = "Vaccine info not inserted";
                return $message;
            }
        }
    }

    public function get_vaccine_all() {
        $sql = "SELECT * FROM vaccine_info WHERE deletion_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function trade_info() {
        $sql = "SELECT * FROM vaccine_info WHERE deletion_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function save_trade_info($data) {
        $vaccine_info_id = $data['vaccine_info_id'];
        $trade_name = $data['trade_name'];
        $check_sql = "SELECT trade_info.vaccine_info_id,trade_info.trade_name FROM trade_info WHERE trade_info.vaccine_info_id='$vaccine_info_id' AND trade_info.trade_name='$trade_name'";
        $check_query = mysqli_query($this->link, $check_sql);
        if (mysqli_num_rows($check_query) > 0) {
            $message = "This trade info already added!";
            return $message;
        }
        $sql = "INSERT INTO trade_info (vaccine_info_id,trade_name, vaccine_prize,remarks) VALUES('$data[vaccine_info_id]','$data[trade_name]','$data[vaccine_prize]','$data[remarks]')";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $vaccine_id = mysqli_insert_id($this->link);
            $message = "New trade info add successfully!";
            return $message;
        } else {
            die('query problem' . mysqli_error());
        }
    }

    public function vaccine_wise_trade_info($vaccine_id) {
        $sql = "SELECT trade_info.trade_id,trade_info.trade_name FROM trade_info WHERE trade_info.vaccine_info_id='$vaccine_id' AND trade_info.deleted_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccine_list_for_dose_entry() {
        $sql = "SELECT * FROM vaccine_info WHERE deletion_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccine_list() {
        $sql = "SELECT trade_info.*,vaccine_info.*
                FROM trade_info 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE trade_info.deleted_status='0'
                ORDER BY vaccine_id ASC";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccine_list_report() {
        $sql = "SELECT * FROM vaccine_info WHERE deletion_status='0'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function view_vaccine_info_by_id($vaccine_id) {
        $sql = "SELECT * FROM vaccine_info WHERE vaccine_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function view_trade_info_by_id($vaccine_id) {
        $sql = "SELECT trade_info.*,vaccine_info.generic_name 
                FROM trade_info 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE trade_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function update_vaccine_info($data) {
        $from = $data['period_form'];
        if ($from == NULL) {
            $days_form = 0;
            $days_to = 365 * 99;
        } else {
            $days_form_unit = $data['period_form_unit'];
            if ($days_form_unit == 'Y') {
                $days_form = $data['period_form'] * 365;
            } elseif ($days_form_unit == 'M') {
                $days_form = $data['period_form'] * 30;
            } elseif ($days_form_unit == 'W') {
                $days_form = $data['period_form'] * 7;
            } else {
                $days_form = $data['period_form'];
            }
            $days_to_unit = $data['period_to_unit'];
            if ($days_to_unit == 'Y') {
                $days_to = $data['period_to'] * 365;
            } elseif ($days_to_unit == 'M') {
                $days_to = $data['period_to'] * 30;
            } elseif ($days_to_unit == 'W') {
                $days_to = $data['period_to'] * 7;
            } else {
                $days_to = $data['period_to'];
            }
        }
        $sql = "UPDATE vaccine_info SET generic_name='$data[generic_name]',code='$data[code]',eligibility_type='$data[eligibility_type]',no_of_dose='$data[no_of_dose]',period_form='$data[period_form]',period_to='$data[period_to]',period_form_unit='$data[period_form_unit]',period_to_unit='$data[period_to_unit]',eligibility_days_form='$days_form',eligibility_days_to='$days_to',remarks='$data[remarks]' WHERE vaccine_id='$data[vaccine_id]'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'Update successfully';
            return $message;
        } else {
            $message = 'Not updated';
            return $message;
        }
    }

    public function update_trade_info($data) {
        $sql = "UPDATE trade_info SET vaccine_info_id='$data[vaccine_info_id]',trade_name='$data[trade_name]' WHERE trade_id='$data[trade_id]'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'Trade info update successfully!';
            return $message;
        } else {
            die('query problem');
        }
    }

    public function search_vaccine($search_key) {
        $sql = "SELECT trade_name,trade_id FROM `trade_info` WHERE trade_info LIKE '%$search_key%'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccine_delete($vaccine_id) {
        $sql = "UPDATE vaccine_info SET deletion_status='1' WHERE vaccine_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'Vaccine delete successfully!';
            return $message;
        } else {
            $message = 'Oooh! vaccine not deleted!';
            return $message;
        }
    }

    public function trade_info_with_dose_delete_by_trade_id($trade_id) {
        $sql = "UPDATE trade_info SET deleted_status='1' WHERE trade_id='$trade_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = 'Vaccine trade info delete successfully!';
            return $message;
        } else {
            $message = 'Oooh! vaccine not deleted!';
            return $message;
        }
    }

    public function insert_opening_stock($data) {
        $sql = "UPDATE trade_info SET trade_info.opening_stock=trade_info.opening_stock+'$data[opening_stock]' WHERE trade_info.trade_id='$data[trade_id]'";
        $opeing_stock = mysqli_query($this->link, $sql);
        if ($opeing_stock) {
            $current_stock = "UPDATE trade_info SET trade_info.current_stock=trade_info.current_stock + '$data[opening_stock]' WHERE trade_info.trade_id='$data[trade_id]'";
            $current_stock_query = mysqli_query($this->link, $current_stock);
            if ($current_stock_query) {
                $message = 'Opening stock and current stock successfully updated!';
                return $message;
            } else {
                $message = "Opening stock updated but current stock not updated!";
                return $message;
            }
        } else {
            $message = "Opening stock not inserted!";
            return $message;
        }
    }

    public function save_dose_info($data) {
        $vaccine_id = $data['vaccine_id'];
        $check_vaccine = "SELECT vaccine_id FROM dose_info WHERE vaccine_id='$vaccine_id'";
        $result = mysqli_query($this->link, $check_vaccine);
        $number = mysqli_num_rows($result);
        if ($number > 0) {
            $message = "This vaccine dose already added";
            return $message;
        } else {
            $dose_count = count($data['dose_serial']);
            for ($i = 0; $i < $dose_count; $i++) {
                $dose_serial = $data['dose_serial'][$i];
                $dose_name = $data['dose_name'][$i];
                $after_dose_id = $data['after_dose_id'][$i];
                $dose_time_form = $data['dose_time_form'][$i];
                $dose_time_to = $data['dose_time_to'][$i];
                $dose_time_unit = $data['dose_time_unit'][$i];
                $sql = "INSERT INTO dose_info(vaccine_id, dose_serial, dose_name, after_dose_id, dose_time_form, dose_time_to, dose_time_unit) VALUES('$vaccine_id', '$dose_serial', '$dose_name', '$after_dose_id', '$dose_time_form', '$dose_time_to', '$dose_time_unit')";
                $query = mysqli_query($this->link, $sql);
            }
            $message = "Save all dose info successfully!";
            return $message;
        }
    }

    public function vaccine_dose_details_by_vaccine_id($vaccine_id) {
        $sql = "SELECT trade_info.trade_name,dose_info.dose_id,dose_info.dose_serial,dose_info.dose_name,dose_info.after_dose_id,dose_info.dose_time_form,dose_info.dose_time_to,dose_info.dose_time_unit
            FROM trade_info
            LEFT JOIN dose_info
            ON trade_info.vaccine_info_id=dose_info.vaccine_id
            WHERE trade_info.trade_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function dose_form_create($vaccine_id) {
        $sql = "SELECT no_of_dose FROM vaccine_info WHERE vaccine_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function select_dose($vaccine_id) {
        $sql = "SELECT * FROM dose_info WHERE vaccine_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function find_number_of_dose($vaccine_id) {
        $sql = "SELECT vaccine_info.no_of_dose FROM vaccine_info WHERE vaccine_info.vaccine_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function after_dose_serial($vaccine_id, $dose_serial) {
        $sql = "SELECT dose_info.after_dose_id FROM dose_info WHERE dose_info.vaccine_id='$vaccine_id' AND dose_info.dose_serial='$dose_serial'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function get_previous_dose_id($vaccine_id, $after) {
        $sql = "SELECT dose_info.dose_id FROM dose_info WHERE dose_info.vaccine_id='$vaccine_id' AND dose_info.dose_serial='$after'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function check_after_dose_in_vaccination($user_id, $vaccine_id, $after) {
        $sql = "SELECT vaccination.vaccine_user_id,vaccination.vaccine_id,vaccination.dose_id,vaccination.dose_serial FROM vaccination WHERE vaccination.vaccine_user_id='$user_id' AND vaccination.vaccine_id='$vaccine_id' AND vaccination.dose_serial='$after'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function save_vaccine_stock($data) {
        $check_vaccine = "SELECT * FROM vaccine_stock WHERE vaccine_id='$data[vaccine_id]'";
        $result = mysqli_query($this->link, $check_vaccine);
        $number = mysqli_num_rows($result);
        if ($number > 0) {
            $error_message = "This vaccine  already added";
            return $error_message;
        } else {
            $sql = "INSERT INTO vaccine_stock(vaccine_id,amount,expire_date)VALUES('$data[vaccine_id]','$data[amount]','$data[expire_date]')";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $message = 'Your vaccine stock updated';
                return $message;
            } else {
                $message = 'Stock not updated';
                return $message;
            }
        }
    }

    public function save_issue_stock($data) {
        $stock_check = "SELECT current_stock FROM trade_info WHERE trade_id='$data[trade_id]'";
        $check = mysqli_query($this->link, $stock_check);
        $current_stock = mysqli_fetch_assoc($check);
        if ($current_stock['current_stock'] >= $data['issue_qty']) {
            //            operational date form organization table
            $organization_id = $_SESSION['organization_id'];
            $sql = "SELECT * FROM organization WHERE organization_id='$organization_id'";
            $query = mysqli_query($this->link, $sql);
            $org = mysqli_fetch_assoc($query);
            $date = $org['c_date'];
            $trade_id = $data['trade_id'];
            $issue_qty = $data['issue_qty'];
            $trans_by = $_SESSION['id'];
            $sql = "INSERT INTO vaccine_stock_transaction(vaccine_id,expire_date,issue_qty,entry_date,trans_by,remarks)VALUES('$trade_id','$data[expire_date]','$data[issue_qty]','$date','$trans_by','$data[remarks]')";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $query = "UPDATE trade_info SET current_stock=current_stock-'$issue_qty' WHERE trade_info.trade_id='$trade_id'";
                $sql = mysqli_query($this->link, $query);
                if ($sql) {
                    $message = 'Issue and stock update successfully';
                    return $message;
                }
            } else {
                $message = 'Issue not updated';
                return $message;
            }
        } else {
            $message = 'Current stock is too low for transaction.';
            return $message;
        }
    }

    public function save_receive_stock($data) {
        //            operational date form organization table
        $organization_id = $_SESSION['organization_id'];
        $sql = "SELECT * FROM organization WHERE organization_id='$organization_id'";
        $query = mysqli_query($this->link, $sql);
        $org = mysqli_fetch_assoc($query);
        $date = $org['c_date'];
        $trade_id = $data['trade_id'];
        $receive_qty = $data['receive_qty'];
        $trans_by = $_SESSION['id'];
        $sql = "INSERT INTO vaccine_stock_transaction(vaccine_id,expire_date,receive_qty,entry_date,trans_by,remarks)VALUES('$trade_id','$data[expire_date]','$data[receive_qty]','$date','$trans_by','$data[remarks]')";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $query = "UPDATE trade_info SET current_stock=current_stock+'$receive_qty' WHERE trade_info.trade_id='$trade_id'";
            $sql = mysqli_query($this->link, $query);
            if ($sql) {
                $message = 'Receive vaccine and stock update successfully!';
                return $message;
            }
        } else {
            $message = 'Receive vaccine and stock not updated!';
            return $message;
        }
    }

    public function vaccine_stock_list() {
        $sql = "SELECT trade_info.trade_id,trade_info.trade_name,vaccine_info.generic_name,vaccine_info.code,trade_info.opening_stock,trade_info.current_stock,SUM(vaccine_stock_transaction.receive_qty) as total_receive,SUM(vaccine_stock_transaction.issue_qty) as total_issue,
            (SELECT COUNT(vaccination.vaccination_id)  FROM vaccination WHERE trade_info.trade_id=vaccination.vaccine_id AND vaccination.dose_apply='1' AND vaccination.used='1' GROUP BY vaccination.vaccine_id) as total_used
            FROM trade_info
            LEFT JOIN vaccine_stock_transaction
            ON trade_info.trade_id=vaccine_stock_transaction.vaccine_id
            LEFT JOIN vaccine_info
            ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
            GROUP BY trade_info.trade_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function vaccine_stock_details($vaccine_id) {
        $query = "SELECT vaccine_stock_transaction.tr_id,vaccine_stock_transaction.trans_by,vaccine_stock_transaction.expire_date,vaccine_stock_transaction.receive_qty,vaccine_stock_transaction.issue_qty,vaccine_stock_transaction.entry_date,vaccine_stock_transaction.remarks,vaccine_info.generic_name,trade_info.trade_name
            FROM vaccine_stock_transaction
            LEFT JOIN trade_info
            ON vaccine_stock_transaction.vaccine_id=trade_info.trade_id
            LEFT JOIN vaccine_info
            ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
            WHERE vaccine_stock_transaction.vaccine_id='$vaccine_id'";
        $result = mysqli_query($this->link, $query);
        return $result;
    }

    public function check_vaccine_transaction($vaccine_id) {
        $sql = "SELECT vaccine_id FROM `vaccine_stock_transaction` WHERE vaccine_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function stock_ledger() {
        $sql = "SELECT vaccine_info.vaccine_name,vaccine_info.opening_stock,vaccine_info.current_stock,vaccine_stock_transaction.entry_date,vaccine_stock_transaction.receive_qty,vaccine_stock_transaction.issue_qty
            FROM vaccine_info
            LEFT JOIN vaccine_stock_transaction
            ON vaccine_info.vaccine_id=vaccine_stock_transaction.vaccine_id
            GROUP BY vaccine_info.vaccine_id,vaccine_stock_transaction.tr_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function future_vaccination_list_for_scroll() {
        $organization = $_SESSION['organization_id'];
        $sql = "SELECT future_vaccination.future_id,future_vaccination.dose_name,future_vaccination.next_date,registation.name,registation.email,registation.mother_phone,trade_info.trade_name,vaccine_info.generic_name
                FROM future_vaccination
                LEFT JOIN registation
                ON future_vaccination.vaccine_user_id=registation.id
                LEFT JOIN trade_info
                ON future_vaccination.vaccine_id=trade_info.trade_id 
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE future_vaccination.deleted_status='0' AND future_vaccination.next_date BETWEEN curdate() and curdate() + interval 3 day AND future_vaccination.organization_id='$organization'
                ORDER BY future_vaccination.next_date ASC";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

}

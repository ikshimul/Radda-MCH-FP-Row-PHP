<?php

if (!class_exists('database')) {
    require 'database.php';
}

class stock_information extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function delete_temp_data() {
        $sql_temp_rep = "DELETE FROM `temp_stock_information_report`";
        $query = mysqli_query($this->link, $sql_temp_rep);
        if ($query) {
            $sql_temp = "DELETE FROM `temp_stock_information`";
            $query = mysqli_query($this->link, $sql_temp);
        }
    }

    public function stock_information_report($data) {
        $sql_stock = "INSERT INTO temp_stock_information (vaccine_id,generic_name,code,trade_id,trade_name,entry_date,receive_qty,issue_qty,used)
            SELECT vaccine_info.vaccine_id,vaccine_info.generic_name,vaccine_info.code,trade_info.trade_id,trade_info.trade_name,vaccine_stock_transaction.entry_date,vaccine_stock_transaction.receive_qty,vaccine_stock_transaction.issue_qty,0 as used_qty
            FROM vaccine_stock_transaction
            LEFT JOIN trade_info
            ON vaccine_stock_transaction.vaccine_id=trade_info.trade_id
            LEFT JOIN vaccine_info
            ON trade_info.vaccine_info_id=vaccine_info.vaccine_id";
        $query_stock = mysqli_query($this->link, $sql_stock);
        if ($query_stock) {
            $sql_used = "INSERT INTO temp_stock_information (vaccine_id,generic_name,code,trade_id,trade_name,entry_date,receive_qty,issue_qty,used)
                SELECT vaccination.vaccine_details_id,vaccine_info.generic_name,vaccine_info.code,vaccination.vaccine_id,trade_info.trade_name,vaccination.dose_date as entry_date,0 as receive_qty,0 as issue_qty,vaccination.used
                FROM vaccination
                LEFT JOIN vaccine_info 
                ON vaccination.vaccine_details_id=vaccine_info.vaccine_id
                LEFT JOIN trade_info
                ON vaccination.vaccine_id=trade_info.trade_id
                WHERE vaccination.used='1' AND vaccination.deleted_status='0'";
            $query_used = mysqli_query($this->link, $sql_used);
            if ($query_used) {
                $sql_opening_balance = "INSERT INTO temp_stock_information_report (trade_id,generic_name,code,trade_name,opening_qty)
                    SELECT trade_id, generic_name,code, trade_name,SUM(receive_qty)-SUM(issue_qty)-SUM(used) as opening_balance FROM temp_stock_information 
                    WHERE entry_date < '$data[from_date]' GROUP BY trade_id";
                $query_opening = mysqli_query($this->link, $sql_opening_balance);
                if ($query_opening) {
                    $sql_current_balance = "INSERT INTO temp_stock_information_report (trade_id,generic_name,code,trade_name,receive_qty,issue_qty,used)
                                            select trade_id,generic_name,code, trade_name, sum(`receive_qty`)  as rcv_qty, sum(`issue_qty`) as iss_qty,  
                                            sum(`used`) as used_qty  from temp_stock_information where DATE(entry_date) BETWEEN '$data[from_date]' AND '$data[to_date]' group by trade_id";
                    $query_current = mysqli_query($this->link, $sql_current_balance);
                    if ($query_current) {
                        $sql_report = "SELECT trade_id,generic_name,code,trade_name,SUM(opening_qty) as opening_balance,SUM(receive_qty) as total_rec,SUM(issue_qty) as total_issue,SUM(used) as total_used FROM `temp_stock_information_report` GROUP BY trade_id";
                        $query_report = mysqli_query($this->link, $sql_report);
                        return $query_report;
                    }
                }
            } else {
                echo 'stock_information used failed';
            }
        } else {
            echo 'stock_information stock failed';
        }
    }

}

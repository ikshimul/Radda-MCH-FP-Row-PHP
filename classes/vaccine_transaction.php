<?php

if (!class_exists('database')) {
    require 'database.php';
}

class Vaccine_Transaction extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function get_vaccine_name_by_id($vaccine_id) {
        $sql = "SELECT trade_info.trade_name,vaccine_info.generic_name
                FROM trade_info
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                WHERE trade_info.trade_id='$vaccine_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function get_opening_stock_for_vaccine($vacine_id, $form, $to) {
//        echo '<pre>';
//        var_dump($data);
        $opening_sql = "SELECT sum(vaccine_stock_transaction.receive_qty) as total_receive,SUM(vaccine_stock_transaction.issue_qty) as total_issue,trade_info.opening_stock
            FROM vaccine_stock_transaction
            LEFT JOIN trade_info
            ON vaccine_stock_transaction.vaccine_id=trade_info.trade_id
            WHERE trade_info.trade_id='$vacine_id' AND vaccine_stock_transaction.entry_date < '$form'";
        $query = mysqli_query($this->link, $opening_sql);
        $opening = mysqli_fetch_assoc($query);
        $receive = $opening['total_receive'];
        $issue = $opening['total_issue'];
        $opening_stock = $opening['opening_stock'];
        $opening_balance = $opening_stock + $receive - $issue;
        return $opening_balance;
    }

    public function get_ledger_for_date_wise($vacine_id, $form, $to) {
        $trans_query = "SELECT vaccine_stock_transaction.entry_date,vaccine_stock_transaction.receive_qty,vaccine_stock_transaction.issue_qty
            FROM vaccine_stock_transaction
            WHERE vaccine_stock_transaction.vaccine_id='$vacine_id' AND vaccine_stock_transaction.entry_date BETWEEN '$form' AND '$to'
            GROUP BY vaccine_stock_transaction.tr_id";
        $query = mysqli_query($this->link, $trans_query);
        return $query;
    }

    public function total_used_vaccine($vaccine_id) {
        $sql = "SELECT vaccination.vaccine_id, COUNT(vaccination.vaccination_id) as total_used FROM vaccination
                WHERE vaccination.vaccine_id='$vaccine_id' AND vaccination.used='1'
                GROUP BY vaccination.vaccine_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function get_opening_stock($trade_id) {
        $sql = "SELECT trade_info.opening_stock FROM trade_info WHERE trade_info.trade_id='$trade_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function get_ledger($trade_id) {
        $trans_query = "SELECT vaccine_stock_transaction.entry_date,vaccine_stock_transaction.receive_qty,vaccine_stock_transaction.issue_qty
            FROM vaccine_stock_transaction
            WHERE vaccine_stock_transaction.vaccine_id='$trade_id'
            GROUP BY vaccine_stock_transaction.tr_id";
        $query = mysqli_query($this->link, $trans_query);
        return $query;
    }

    public function get_trans_by_trans_id($trans_id) {
        $sql = "SELECT * FROM vaccine_stock_transaction WHERE tr_id='$trans_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function update_trans($data) {
        $old_issue_qty = "";
        $old_issue_qty = isset($data['old_issue_qty']) ? $data['old_issue_qty'] : 0;
        $old_receive_qty = "";
        $old_receive_qty = isset($data['old_receive_qty']) ? $data['old_receive_qty'] : 0;
        if ($old_issue_qty != 0) {
            if ($data['new_issue_qty'] == $data['old_issue_qty']) {
                $message = 'Issue quantity is same as previous value';
                return $message;
            } else {
                $sql = "UPDATE vaccine_stock_transaction SET issue_qty='$data[new_issue_qty]' , expire_date='$data[expire_date]' WHERE tr_id='$data[tr_id]'";
                $query = mysqli_query($this->link, $sql);
                if ($query) {
                    $query = "UPDATE trade_info SET current_stock=current_stock+'$old_issue_qty'-'$data[new_issue_qty]' WHERE trade_info.trade_id='$data[trade_id]'";
                    $sql = mysqli_query($this->link, $query);
                    if ($sql) {
                        $message = 'Transaction update successfully';
                        return $message;
                    }
                }
            }
        } elseif ($old_receive_qty != 0) {
            if ($data['new_receive_qty'] == $old_receive_qty) {
                $message = 'Receive Quantity is same as previous value';
                return $message;
            } else {
                $sql = "UPDATE vaccine_stock_transaction SET receive_qty='$data[new_receive_qty]' , expire_date='$data[expire_date]' WHERE tr_id='$data[tr_id]'";
                $query = mysqli_query($this->link, $sql);
                if ($query) {
                    $query = "UPDATE trade_info SET current_stock=current_stock-'$old_receive_qty'+'$data[new_receive_qty]' WHERE trade_info.trade_id='$data[trade_id]'";
                    $sql = mysqli_query($this->link, $query);
                    if ($sql) {
                        $message = 'Transaction update successfully';
                        return $message;
                    }
                }
            }
        }
    }

}

<?php

if (!class_exists('database')) {
    require 'database.php';
}

class Registration extends Database {

//put your code here
    protected $link;
    public $title;

    public function __construct() {
        $this->link = $this->database_connect();
//parent::setTitle("My title"); 
        $this->title = $this->setTitle('Registration');
    }

    public function create_registration_id() {
        $get_id = "SELECT id FROM registation ORDER BY id DESC LIMIT 1;";
        $query = mysqli_query($this->link, $get_id);
        return $query;
    }

    public function save_registration($data) {
        $id_sql = "SELECT * FROM registation WHERE id='$data[id]'";
        $result = mysqli_query($this->link, $id_sql);
        $number = mysqli_num_rows($result);
        if ($number > 0) {
            $message = "Id must be unique!";
            return $message;
        } else {
            $login_id = $_POST['security_field'];
            $session_login_id = $_SESSION['id'];
            if ($login_id == $session_login_id) {
				if($data['email']==''){
				$email ='mchfp@raddacentre.org';
			}else{
				$email = $data['email'];
			}
                $year = $_POST['year'];
                $month = $_POST['month'];
                $day = $_POST['day'];
                $age = $year . '-' . $month . '-' . $day;
                $sql = "INSERT INTO registation (id,name,email,gender,birth_registation_number,dob,age,mother_name,mother_phone,address) VALUES('$data[id]','$data[name]','$email','$data[gender]','$data[birth_registation_number]','$data[dob]','$age','$data[mother_name]','$data[mother_phone]','$data[address]')";
                $result = mysqli_query($this->link, $sql);
                if ($result) {
                    $message = "Registration successfully!";
                    return $message;
                } else {
                    $message = "Registration not successfully!";
                    return $message;
                }
            } else {
                $message = "Please login first!";
                return $message;
            }
        }
    }

    public function vaccine_user() {
        $sql = "SELECT * FROM registation WHERE deleted_status='0' ORDER BY registation_date DESC";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }
	
	public function vaccine_user_report($data){
	  $limit_start=$data['start'];
      $limit_length=$data['length'];
	  $search=$data['search']['value'];
	  if($search){ 
		 $sql = "SELECT id,name,dob,mother_name,mother_phone,address,gender FROM registation WHERE deleted_status='0' AND (
			name LIKE '%$search%' 
			OR mother_name LIKE '%$search%' 
			OR mother_phone LIKE '%$search%'
		) ORDER BY registation_date DESC LIMIT $limit_start,$limit_length";
	  }else{
        $sql = "SELECT id,name,dob,mother_phone,address,gender FROM registation WHERE deleted_status='0' ORDER BY registation_date DESC LIMIT $limit_start,$limit_length";
	  }
      $query = mysqli_query($this->link, $sql);
       return $query;
	}
	
	public function count_all_user(){
		$sql = "SELECT COUNT(*) as count FROM registation WHERE deleted_status='0'";
        $query = mysqli_query($this->link, $sql);
		$user = mysqli_fetch_assoc($query);
        return $user['count'];
	}

    public function search_user_by_reg_dob($data) {
        $dob_from = $data['dob_from'];
        $dob_to = $data['dob_to'];
        $registation_from = $data['registation_from'];
        $registation_to = $data['registation_to'];
        if ($dob_from != null || $dob_to != null) {
            $sql = "SELECT id,name,dob,mother_phone,age,address,gender  FROM registation WHERE DATE(registation_date) BETWEEN '$dob_from' AND '$dob_to' ORDER BY id DESC";
            $query = mysqli_query($this->link, $sql);
            return $query;
        } elseif ($registation_from != null || $registation_to != null) {
            $sql = "SELECT id,name,mother_phone,dob,age,address,gender FROM registation WHERE  dob >= DATE_FORMAT('" . $registation_from . "', '%m%d%Y') AND dob <=  DATE_FORMAT('" . $registation_to . "', '%m%d%Y')";
            $query = mysqli_query($this->link, $sql);
            return $query;
        }
    }

    public function vaccine_uesr_by_id($id) {
        $sql = "SELECT * FROM registation WHERE id='$id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function edit_register_user($data) {
        $login_id = $_POST['security_field'];
        $session_login_id = $_SESSION['id'];
        if ($login_id == $session_login_id) {
			if($data['email']==''){
				$email ='mchfp@raddacentre.org';
			}else{
				$email = $data['email'];
			}
            $year = $_POST['year'];
            $month = $_POST['month'];
            $day = $_POST['day'];
            $age = $year . '-' . $month . '-' . $day;
            $update_date = date('Y/m/d h:i:sa');
            $sql = "UPDATE registation SET id='$data[id]',name='$data[name]',gender='$data[gender]',birth_registation_number='$data[birth_registation_number]',dob='$data[dob]',age='$age',mother_name='$data[mother_name]',mother_phone='$data[mother_phone]',email='$email',address='$data[address]',update_date='$update_date' WHERE id='$data[id]'";
            $result = mysqli_query($this->link, $sql);
            if ($result) {
                $message = "Update successfully!";
                return $message;
            } else {
                $message = "Update not successfully!";
                return $message;
            }
        } else {
            $message = "please login first!";
            return $message;
        }
    }

    public function delete_register_user($id) {
        $sql = "UPDATE registation SET deleted_status='1' WHERE id='$id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "<span style='color:red;'>Delete successfully!</sapn>";
            return $message;
        } else {
            $message = "Data not delete!";
            return $message;
        }
    }

    public function get_vaccine_apply_info_by_user($user_id) {
        $sql = "SELECT registation.id,vaccine_info.generic_name,trade_info.trade_name,trade_info.vaccine_prize,vaccination.dose_apply,vaccination.dose_date,dose_info.dose_name
                from registation
                left join vaccination
                on registation.id=vaccination.vaccine_user_id
                left join trade_info
                on vaccination.vaccine_id=trade_info.trade_id
                LEFT JOIN vaccine_info
                ON trade_info.vaccine_info_id=vaccine_info.vaccine_id
                left join dose_info
                on vaccination.dose_id=dose_info.dose_id
                where registation.id='$user_id'
                group by dose_info.dose_id";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function search_registration_user($search_key) {
        $sql = "SELECT registation.name, registation.id, registation.mother_phone
                FROM registation
                WHERE registation.id LIKE '%$search_key%' OR registation.name LIKE '%$search_key%' OR registation.mother_phone LIKE '$search_key%' LIMIT 0,8";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

}

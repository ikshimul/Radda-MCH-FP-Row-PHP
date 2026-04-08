<?php

if (!class_exists('database')) {
    require 'database.php';
}

class Organization extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function save_organization_info($data) {
        $c_date = $data['c_date'];
        $current_date = date('Y-m-d');
        if ($c_date >= $current_date) {
            $fileName = $_FILES['userfile']['name'];
            $tmpName = $_FILES['userfile']['tmp_name'];
            $fileSize = $_FILES['userfile']['size'];
            $fileType = $_FILES['userfile']['type'];
            $fp = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $content = addslashes($content);
            fclose($fp);
            if (!get_magic_quotes_gpc()) {
                $fileName = addslashes($fileName);
            }
            if ($fileSize > 1000000) {
                $message = "File $fileName too large!";
                return $message;
            } else {
                $query = "INSERT INTO organization (organization_name, organization_email, patient_default_email, organization_website, organization_phone ,organization_address, size, type, logo, software_name, c_date, id_flag, prize_flag ) VALUES ('$data[organization_name]','$data[organization_email]','$data[patient_default_email]','$data[organization_website]','$data[organization_phone]', '$data[organization_address]', '$fileSize', '$fileType', '$content','$data[software_name]','$data[c_date]', '$data[id_flag]', '$data[prize_flag]')";
                mysqli_query($this->link, $query);
                $message = "New organization save successfully!";
                return $message;
            }
        } else {
            $message = "<p style='color:red; text-align:center;'>oops sorry!.System date always forward date or equal today.</p>";
            return $message;
        }
    }

    public function update_organization_info($data) {
        $c_date = $data['c_date'];
        $current_date = date('Y-m-d');
        if ($c_date >= $current_date) {
            $fileName = $_FILES['userfile']['name'];
            if ($fileName == NULL) {
                $sql = "UPDATE organization SET organization_name='$data[organization_name]',organization_email='$data[organization_email]',patient_default_email='$data[patient_default_email]',organization_website='$data[organization_website]',organization_phone='$data[organization_phone]',organization_address='$data[organization_address]', software_name='$data[software_name]',c_date='$data[c_date]', id_flag='$data[id_flag]', prize_flag='$data[prize_flag]' WHERE organization_id='$data[organization_id]'";
                mysqli_query($this->link, $sql);
                $message = "Organization update successfully!";
                return $message;
            } else {
                $fileName = $_FILES['userfile']['name'];
                $tmpName = $_FILES['userfile']['tmp_name'];
                $fileSize = $_FILES['userfile']['size'];
                $fileType = $_FILES['userfile']['type'];
                $fp = fopen($tmpName, 'r');
                $content = fread($fp, filesize($tmpName));
                $content = addslashes($content);
                fclose($fp);
                if (!get_magic_quotes_gpc()) {
                    $fileName = addslashes($fileName);
                }
                if ($fileSize > 1000000) {
                    $message = "File $fileName too large!";
                    return $message;
                } else {
                    $query = "UPDATE organization SET organization_name='$data[organization_name]',organization_email='$data[organization_email]',patient_default_email='$data[patient_default_email]',organization_website='$data[organization_website]',organization_phone='$data[organization_phone]',organization_address='$data[organization_address]', size='$fileSize', type='$fileType', logo='$content', software_name='$data[software_name]',c_date='$data[c_date]', id_flag='$data[id_flag]', prize_flag='$data[prize_flag]' WHERE organization_id='$data[organization_id]'";
                    mysqli_query($this->link, $query);
                    $message = "New organization save successfully!";
                    return $message;
                }
            }
        } else {
            $message = "<p style='color:red; text-align:center;'>oops sorry!.System date always forward date or equal today.</p>";
            return $message;
        }
    }

    public function update_organization_system_time($data) {
        $c_date = $data['c_date'];
        $current_date = $data['from_date'];
        if ($c_date >= $current_date) {
            $sql = "UPDATE organization SET c_date='$data[c_date]' WHERE organization_id='$data[organization_id]'";
                mysqli_query($this->link, $sql);
                $message = "<p style='color:green; text-align:center;'><strong>Operational date changed.</strong></p>";
                return $message;
        } else {
            $message = "<p style='color:red; text-align:center;'><strong>oops sorry ! Operational date always forward date or equal today date.</strong></p>";
            return $message;
        }
    }

    public function view_all_organization_info() {
        $sql = "SELECT * FROM organization";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function view_organization_info_by_id($organization_id) {
        $sql = "SELECT * FROM organization WHERE organization_id='$organization_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function view_organization_info() {
        $organization_id = $_SESSION['organization_id'];
        $sql = "SELECT * FROM organization WHERE organization_id='$organization_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function view_all_orgnization_for_select() {
        $sql = "SELECT organization_id,organization_name FROM organization";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function delete_organization($organization_id) {
        $sql = "DELETE FROM organization WHERE organization_id='$organization_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "Delete Successfully";
            return $message;
        } else {
            $message = "Not deleted";
            return $message;
        }
    }

}

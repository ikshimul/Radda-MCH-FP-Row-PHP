<?php

if (!class_exists('database')) {
    require 'database.php';
}

class User extends Database {

    //put your code here
    protected $link;

    public function __construct() {
        $this->link = $this->database_connect();
    }

    public function user_info_save($data) {
        $user_name = $data['user_name'];
        $user_name_sql = "SELECT * FROM user WHERE user_name='$user_name'";
        $check_user_name_query = mysqli_query($this->link, $user_name_sql);
        if (mysqli_num_rows($check_user_name_query) > 0) {
            $message = 'User name already exits';
            return $message;
        } else {
            $email = $data['email'];
            $sql = "SELECT * FROM user WHERE email='$email'";
            $check_query = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($check_query) > 0) {
                $message = 'Email already exits';
                return $message;
            } else {
                $password = $data['password'];
                $confirm_password = $data['c_password'];
                if ($password == $confirm_password) {
                    $filename = $_FILES['profile_pic']['name'];
                    $tmp_name = $_FILES['profile_pic']['tmp_name'];
                    $file_type = $_FILES['profile_pic']['type'];
                    $file_size = $_FILES['profile_pic']['size'];
                    $fp = fopen($tmp_name, 'r');
                    $content = fread($fp, filesize($tmp_name));
                    $content = addslashes($content);
                    fclose($fp);
                    if (!get_magic_quotes_gpc()) {
                        $fileName = addslashes($filename);
                    }
                    if ($file_size > 10000000) {
                        $message = "File $fileName too large!";
                        return $message;
                    } else {
                        $enc_password = md5($password);
                        $sql = "INSERT INTO user(full_name,user_name,organization_id,email,password,designation,gender,mobile,address,profile_pic) VALUES('$data[full_name]','$data[user_name]','$data[organization_id]','$data[email]','$enc_password','$data[designation]','$data[gender]','$data[mobile]','$data[address]','$content')";
                        $query = mysqli_query($this->link, $sql);
                        if ($query) {
                            $message = 'New user create successfully!';
                            return $message;
                        } else {
                            die('Query problem');
                        }
                    }
                } else {
                    $message = "Confirm password does not match";
                    return $message;
                }
            }
        }
    }

    public function select_user_by_id($user_id) {
        $sql = "SELECT * FROM user WHERE id='$user_id'";
        $query = mysqli_query($this->link, $sql);
        return $query;
    }

    public function update_user_info($data) {
        $fileName = $_FILES['profile_pic']['name'];
        if ($fileName == NULL) {
            $sql = "UPDATE user SET full_name='$data[full_name]',organization_id='$data[organization_id]',email='$data[email]',designation='$data[designation]',gender='$data[gender]',mobile='$data[mobile]',address='$data[address]' WHERE id='$data[user_id]'";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $message = "User update successfully!";
                return $message;
            } else {
                $message = "User Not updated";
                return $message;
            }
        } else {
            $filename = $_FILES['profile_pic']['name'];
            $tmp_name = $_FILES['profile_pic']['tmp_name'];
            $file_type = $_FILES['profile_pic']['type'];
            $file_size = $_FILES['profile_pic']['size'];
            $fp = fopen($tmp_name, 'r');
            $content = fread($fp, filesize($tmp_name));
            $content = addslashes($content);
            fclose($fp);
            if (!get_magic_quotes_gpc()) {
                $fileName = addslashes($filename);
            }
            if ($file_size > 10000000) {
                $message = "File $fileName too large!";
                return $message;
            } else {
                $sql = "UPDATE user SET full_name='$data[full_name]',user_name='$data[user_name]',organization_id='$data[organization_id]',email='$data[email]',designation='$data[designation]',gender='$data[gender]',mobile='$data[mobile]',address='$data[address]',profile_pic='$content' WHERE id='$data[user_id]'";
                $query = mysqli_query($this->link, $sql);
                if ($query) {
                    $message = "User update successfully!";
                    return $message;
                } else {
                    $message = "User Not updated";
                    return $message;
                }
            }
        }
    }

	public function reset_password($data) {
        $new_password = md5($data['password']);
        $reset_password = "UPDATE user SET password='$new_password' WHERE id='$data[id]'";
        $reset_query = mysqli_query($this->link, $reset_password);
        if ($reset_query) {
            $message = 'Password reset successfully!';
            return $message;
        } else {
            $message = 'Password not reset';
            return $message;
        }
    }
	
    public function change_password($data) {
        $check_old_password = md5($data['old_password']);
        $sql = "SELECT password FROM user WHERE id='$data[id]'";
        $query = mysqli_query($this->link, $sql);
        $user_info = mysqli_fetch_array($query);
        $old_password = $user_info['password'];
        if ($check_old_password == $old_password) {
            $new_passowrd = md5($data['new_password']);
            $update_password = "UPDATE user SET password='$new_passowrd' WHERE id='$data[id]'";
            $update_query = mysqli_query($this->link, $update_password);
            if ($update_query) {
                $message = 'Password update successfully.';
                return $message;
            }
        } else {
            $message = 'Old Password not matched.';
            return $message;
        }
    }

    public function update_profile_pic($data) {
        $filename = $_FILES['profile_pic']['name'];
        $tmp_name = $_FILES['profile_pic']['tmp_name'];
        $file_type = $_FILES['profile_pic']['type'];
        $file_size = $_FILES['profile_pic']['size'];
        $fp = fopen($tmp_name, 'r');
        $content = fread($fp, filesize($tmp_name));
        $content = addslashes($content);
        fclose($fp);
        if (!get_magic_quotes_gpc()) {
            $fileName = addslashes($filename);
        }
        if ($file_size > 10000000) {
            $message = "File $fileName too large!";
            return $message;
        } else {
            $sql = "UPDATE user SET profile_pic='$content' WHERE id='$data[id]'";
            $query = mysqli_query($this->link, $sql);
            if ($query) {
                $message = "Profile picture update successfully!";
                return $message;
            } else {
                $message = "Not updated";
                return $message;
            }
        }
    }

    public function user_set_active($id) {
        $sql = "UPDATE  user SET active_inactive='1' WHERE id='$id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "User active successfully!";
            return $message;
        } else {
            $message = "User not active";
            return $message;
        }
    }

    public function user_set_inactive($id) {
        $sql = "UPDATE  user SET active_inactive='0' WHERE id='$id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "User inactive successfully!";
            return $message;
        } else {
            $message = "User not inactive";
            return $message;
        }
    }

    public function delete_user($user_id) {
        $sql = "UPDATE user SET deleted_status='1' WHERE id='$user_id'";
        $query = mysqli_query($this->link, $sql);
        if ($query) {
            $message = "User delete successfully!";
            return $message;
        } else {
            $message = "User not deleted";
            return $message;
        }
    }

}

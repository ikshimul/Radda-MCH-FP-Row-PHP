<?php

class Logout {

    public function admin_logout() {
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        header('location:login.php');
    }

}

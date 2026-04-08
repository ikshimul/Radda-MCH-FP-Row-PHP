<?php

$trade_id = $_GET['vaccine_id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$trans = $obj_vac->check_vaccine_transaction($trade_id);
$check = mysqli_fetch_assoc($trans);
if ($check) {
    echo "Already insert your opening balance.Please insert only receive quantity of this vaccine <a href='vaccine_stock.php'>Click this link</a>";
} else {
    echo "Please opening your vaccine balance";
}

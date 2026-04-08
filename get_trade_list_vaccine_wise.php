<?php
$vaccine_id = $_GET['id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$trade = $obj_vac->vaccine_wise_trade_info($vaccine_id);

echo "<option value=''>Select Trade</option>";
while ($list = mysqli_fetch_array($trade)) {
    $trade_id = $list['trade_id'];
    $trade_name = $list['trade_name'];
    echo "<option value='$trade_id'>$trade_name</option>";
}
?>
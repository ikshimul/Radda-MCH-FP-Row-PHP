<?php

$trade_id = $_GET['id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->select_dose($trade_id);
if (mysqli_num_rows($query) > 0) {
    echo "<table class='table design'>
                                            <thead>
                                            <th>Dose serial</th>
                                            <th>Select Dose</th>
                                            <th>Remarks</th>
                                            </thead>";
    while ($no_dose = mysqli_fetch_assoc($query)) {
        $dose_number = $no_dose['dose_serial'];
        $dose_name = $no_dose['dose_name'];
        $dose_id = $no_dose['dose_id'];
        echo "<tr>
                                                <td>$dose_number</td>
                                                <td><input type='radio' class='minimal' name='dose_id' value='$dose_id-$dose_number' id='dose_select' required/> $dose_name </td>
                                                <td><textarea type='text' class='form-control' name='remarks'  placeholder='Remarks'></textarea></td>
                                            </tr>
                                        ";
    }
    echo "</table>";
} else {
    echo "This vaccine has no dose information";
}
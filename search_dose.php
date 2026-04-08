<?php

$vaccine_id = $_GET['id'];
require_once './classes/vaccine.php';
$obj_vac = new Vaccine();
$query = $obj_vac->dose_form_create($vaccine_id);
$no_dose = mysqli_fetch_assoc($query);
$dose_count = $no_dose['no_of_dose'];
$no_of_dose = array();
for ($i = 1; $i <= $dose_count; $i++) {
    $no_of_dose[] = $i;
}
$max=max($no_of_dose);
$min=min($no_of_dose);
echo "<table class='table design'>
                                            <thead>
                                            <th>Dose Serial</th>
                                            <th>Dose Name</th>
                                            <th>After Dose Id</th>
                                            <th>Dose time Start</th>
                                            <th>Dose time End</th>
                                            <th>Unit</th>
                                            </thead>";
for ($i = 1; $i <= $dose_count; $i++) {
    echo "<tr>
                                                <td><input type='text' class='form-control' name='dose_serial[]' value='$i' placeholder='dose_serial' readonly/></td>
                                                <td> <input type='text' class='form-control' name='dose_name[]'  placeholder='Dose Name' required/></td>
                                                <td><input type='text' class='form-control' name='after_dose_id[]'  placeholder='After Dose Serial'/></td>
                                                <td><input type='text' class='form-control' name='dose_time_form[]'  placeholder='Dose Start Date'/></td>
                                                <td><input type='text' class='form-control' name='dose_time_to[]' placeholder='Dose End Date'/></td>
                                                <td>
                                                    <select class='form-control select2' name='dose_time_unit[]' style='width: 100%;'>
                                                        <option value=''>Select Period To</option>
                                                        <option value='Y'>Years</option>
                                                        <option value='M'>Month</option>
                                                        <option value='D'>Days</option>
                                                        <option value='W'>Week</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        ";
}
echo "</table>";

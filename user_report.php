<?php
session_start();
$message = '';
require_once './classes/organization.php';
$obj_org = new Organization();
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
require_once './classes/registration.php';
$obj_reg = new Registration();
$user_id = $_GET['id'];
$query = $obj_reg->vaccine_uesr_by_id($user_id);
$user = mysqli_fetch_assoc($query);
$dose_apply = $obj_reg->get_vaccine_apply_info_by_user($user_id);
?>
<html>
    <head>
        <title>User Reports</title>
        <link rel="stylesheet" type="text/css" href="resource/custom_css/print-receipt.css" media="screen, print, projection" />
        <link rel="stylesheet" href="resource/font-awesome/css/font-awesome.css">
    </head>
    <body>
        <div id="printableArea" >
            <div id="pcr">
                <table class="table table-bordered table-main" align="center">
                    <tr>
                        <td colspan="3" class="text-left padding-left padding-right" style="border-bottom:1px solid #000; height:80px; margin-left: 200px; margin-bottom: 5px;">
                            <table align="center">
                                <tr>
                                    <td class="text-center" colspan="3"><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($org['logo']) . '" class="img-responsive" height="40" width="50"/>'; ?><br><small><?php echo $org['organization_name']; ?></small></td>
                                </tr>
                                <tr>
                                    <td class="text-left org-address" colspan="3"><?php echo $org['organization_address']; ?></td>
                                </tr>
                            </table>
                        </td>
                        
                    </tr>
                    <tr>
                        <th colspan=3 class="border-none"> 
                            Patient Details
                        </th>
                    </tr>
                    <tr>
                        <td class="text-left padding-left"><strong>Patient no : </strong><?php echo $user['id']; ?></td>
                        <td></td>
                        <td class="text-right padding-right"><strong>Report Date : </strong><?php echo date('D,M d,Y'); ?></td>
                    </tr>
                    <tr>
                        <td colspan=3 class="text-left padding-left"><strong>Patient name : </strong><?php echo $user['name']; ?></td>
                    </tr>
                    <tr>
                        <td colspan=3 class="text-left padding-left"><strong>Age : </strong>
                            <?php
                            $age = $user['dob'];
                            $bday = new DateTime($age);
                            $today = new DateTime(); // for testing purposes
                            $diff = $today->diff($bday);
                            printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left padding-left"><strong>Address : </strong><?php echo $user['address']; ?></td>
                        <td></td>
                        <td class="text-right padding-right"></td>
                    </tr>
                    <tr>
                        <th colspan=3 style="padding:1%;" class="border-none"><strong>Vaccination Details</strong> </th>
                    </tr>
                    <!-----Start fees collection category fees details description---->
                    <tr>
                        <td colspan=3 class="padding-left padding-right">
                            <table border="1" class="table table-border" style="width:100%;">
                                <tr class="header" height='40px'>
                                    <th>Vaccine Name</th>
                                    <th>Dose Name</th>
                                    <th>Vaccination Date</th>
                                </tr>
                                <?php
                                $total_prize = 0;
                                while ($dose_result = mysqli_fetch_array($dose_apply)) {
                                    $total_prize+=$dose_result['vaccine_prize'];
                                    ?>
                                    <tr height='30px'>
                                        <td class="text-center"><?php echo $dose_result['generic_name']; ?></td>
                                        <td class="text-center"><?php echo $dose_result['dose_name']; ?></td>
                                        <td class="text-center"><?php
                                            if ($dose_result['dose_date'] == NULL) {
                                                echo '';
                                            } else {
                                                echo date('d M,Y', strtotime($dose_result['dose_date']));
                                            }
                                            ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="border-none text-left padding-left" colspan=3 style="height:50px"></th>
                    </tr>
                </table>
            </div>
        </div>
        <div style="text-align: center; margin: 10px;">
            <a href="#" 
               style="background-color: #008CBA; /* Green */
               border: none;
               color: white;
               padding: 10px 25px;
               text-align: center;
               text-decoration: none;
               display: inline-block;
               font-size: 16px;" onclick="printDiv('printableArea')" />Print <i class="fa fa-print" aria-hidden="true"></i></a>
    </div>
    <script>

        function myFunction() {
            window.print();
        }
        function printDiv(available_print) {
            var printContents = document.getElementById(available_print).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>

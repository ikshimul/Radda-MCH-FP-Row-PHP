<?php
session_start();
ob_start();
$message = '';
date_default_timezone_set('Asia/Dhaka');
if ($_SESSION['id'] == NULL) {
    header('location:login.php');
}
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'logout') {
        require 'classes/logout.php';
        $obj_logout = new Logout();
        $obj_logout->admin_logout();
    }
}
require_once './classes/organization.php';
$obj_org = new Organization();
if (isset($_POST['system_date'])) {
    if ($_SESSION['operational_time'] == 1) {
        $message = $obj_org->update_organization_system_time($_POST);
    } else {
        header('location:error.php');
    }
}
$query = $obj_org->view_organization_info();
$org = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>VMIS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="resource/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="resource/jquery-ui/jquery-ui.css">
        <link rel="stylesheet" href="resource/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="resource/iCheck/all.css">
        <link rel="stylesheet" href="resource/select2/select2.min.css">
        <link rel="stylesheet" href="resource/custom_css/AdminLTE.css">
        <link rel="stylesheet" href="resource/custom_css/style.css">
        <link rel="stylesheet" href="resource/custom_css/blink.css">
        <link rel="shortcut icon" href="resource/image/vaccine_logo.jpg">
        <style>

            #time {
                background-color:rgba(0, 0, 0, 0.67);
                color: white;
                width: 40%;
                margin: 0 auto;
                text-align: center;
                font-size: 2.5em;
            }

            #ampm {
                font-size: .5em;
            }


            #days, #fullDate {
                font-size: 27px;
                background-color: rgba(22, 22, 23, 0.84);
                color: #12b0ff;
                width: 65%;
                height: 55px;
                margin: 0 auto;
                display: flex;
                text-align: center;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 6px -6px black;
            }

            .days {
                flex: 1;
                color: #444;
                text-align: center;
            }

            .active {
                color:#2fb2b9;
                text-shadow: 0px 2px 25px rgba(144, 244, 253, .6);
            }
            #fullDate {
                /*                margin-top:.2em;*/
            }
            #sec{
                display:inline-block;
                width:40px;
            }

        </style>
    </head>
    <body class="hold-transition">
        <div class="container ">
            <div class="drop-shadow curved curved-hz-2">
                <div class="row">
                    <div id="topbar" class="clear">
                        <nav>
                            <ul id="menu-top-links">
                                <li><a href="index.php">&nbsp;Home </a></li>
                                <li><a href="profile_setting.php">&nbsp;Profile Setting</a></li>
                                <li><a href="?status=logout"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row header">
                        <div class="col-md-offset-1 col-md-2">
                            <div>
                                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($org['logo']) . '" class="img-responsive" height="40" width="50"/>'; ?>
                                <small><?php echo $org['organization_name']; ?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div  id="main">
                                <!--                                 <div  id="time">
                                                                    <span id="hours"></span><span id="min"></span><span id="sec"></span> <span id="ampm"></span>
                                                                </div>-->
                                <div id="fullDate">
                                    <?php echo date('l, M d, Y', strtotime($org['c_date'])); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <ul id="people" style="
                                margin: 0px ;
                                padding: 9px;
                                width: 95%;
                                font-size: 16px;
                                line-height: 22px;
                                color: #3b3b3b;
                                -webkit-font-smoothing: antialiased;
                                list-style-type: none;">
                                <li style="position: relative;
                                    margin: 0 0 40px 0;
                                    padding: 5px 8px 8px 44px;
                                    height: 42px;
                                    width:100%;
                                    border: 1px solid #bbbbbb;
                                    border-radius: 4px;
                                    box-shadow: 0 1px 3px rgba(0,0,0,0.06), inset 0 1px 0 #ffffff;
                                    background: #f6f6f6;">
                                    <a href="#"><?php echo '<img style="position: absolute;
                                                     top: -16px;
                                                     left: -16px;
                                                     z-index: 10;
                                                     margin: 0;
                                                     padding: 4px;
                                                     width: 50px;
                                                     height: 50px;
                                                     border: 1px solid #bbbbbb;
                                                     box-shadow: 0 1px 0 #ffffff;
                                                     border-radius: 50%;
                                                     background: #ffffff;" src="data:image/jpeg;base64,' . base64_encode($_SESSION['profile_pic']) . '" /></a>'; ?>
                                        <h2 style="
                                            margin: 0;
                                            font-size: 14px;
                                            line-height: 22px;
                                            font-weight: 400;
                                            color: #4b4b4b;
                                            text-shadow: -1px -1px 0 rgba(255,255,255,0.7);"><?php echo $_SESSION['name']; ?></h2>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 menu home_menu">
                        <div>
                            <nav>
                                <ul>
                                    <li class="active"><a href="index.php">Home</a></li>
                                    <?php if ($_SESSION['registration'] == 1) { ?>
                                        <li><a href="#">Registration</a>
                                            <ul>
                                                <?php if ($_SESSION['patient_regi'] == 1) { ?>
                                                    <li><a href="registration_form.php">Patient Registration</a></li>
                                                <?php } if ($_SESSION['patient_list'] == 1) { ?>
                                                    <li><a href="user_reports.php">Patient List</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if ($_SESSION['main_vaccination'] == 1) { ?>
                                        <li><a href="#">Vaccination</a>
                                            <ul>
                                                <?php if ($_SESSION['vaccination'] == 1) { ?>
                                                    <li><a href="next_dose_apply.php">Vaccination</a></li>
                                                <?php } if ($_SESSION['vaccination_apply'] == 1) { ?>
                                                    <li><a href="upcoming_vaccination.php">Vaccination Apply</a></li>
                                                <?php } if ($_SESSION['upcoming_vaccination'] == 1) { ?>
                                                    <li><a href="future_vaccination.php">Upcoming Vaccination</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?> 
                                    <?php if ($_SESSION['vaccine'] == 1) { ?>
                                        <li><a href="#">Vaccine</a>
                                            <ul>
                                                <?php if ($_SESSION['vaccine_form'] == 1) { ?>
                                                    <li><a href="vaccine_form.php">Vaccine Form</a></li>
                                                    <li><a href="dose_info.php">Vaccine Dose</a></li>
                                                    <li><a href="trade.php">Trade Entry</a></li>
                                                <?php } if ($_SESSION['vaccine_list'] == 1) { ?>
                                                    <li><a href="vaccine_info.php">Vaccine List</a></li>
                                                    <li><a href="vaccine_list.php">Trade Wise Vaccine List</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if ($_SESSION['vaccine_stock'] == 1) { ?>
                                        <li><a href="#">Vaccine Stock</a>
                                            <ul>
                                                <?php if ($_SESSION['vaccine_opening_stock'] == 1) { ?>
                                                    <li><a href="opening_stock.php">Opening Stock</a></li>
                                                <?php } if ($_SESSION['vaccine_stock_in'] == 1) { ?>
                                                    <li><a href="vaccine_stock.php">Stock In</a></li>
                                                    <li><a href="stock_out.php">Stock Out</a></li>
                                                <?php } if ($_SESSION['vaccine_stock_list'] == 1) { ?>
                                                    <li><a href="vaccine_stock_list.php">Stock List</a></li>
                                                    <!--<li><a href="stock_ledger.php">Vaccine Stock Ledger</a></li>-->
                                                <?php } if ($_SESSION['vaccine_ledger'] == 1) { ?>
                                                    <li><a href="ledger.php">Ledger</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <li><a href="contact.php">Contacts</a></li>
                                    <?php if ($_SESSION['user'] == 1) { ?>
                                        <li><a href="#">User Manage</a>
                                            <ul>
                                                <?php if ($_SESSION['user_create'] == 1) { ?>
                                                    <li><a href="user_create.php">User Create</a></li>
                                                <?php } if ($_SESSION['user_manage'] == 1) { ?>
                                                    <!--                                            <li><a href="user_permission.php">User Permission</a></li>-->
                                                    <li><a href="manage_user.php">Manage User</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if ($_SESSION['organization'] == 1) { ?>
                                        <li><a href="#">Organization</a>
                                            <ul>
                                                <?php if ($_SESSION['organization_create'] == 1) { ?>
                                                    <li><a href="organization.php">Organization Create</a></li>
                                                <?php } if ($_SESSION['organization_manage'] == 1) { ?>
                                                    <li><a href="organization_manage.php">Organization Manage</a></li>
                                                <?php } if ($_SESSION['age_period'] == 1) { ?>
                                                    <li><a href="age_period.php">Age Period</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if ($_SESSION['report'] == 1) { ?>
                                        <li>
                                            <a href="#">Report</a>
                                            <ul>
                                                <?php if ($_SESSION['patient_report'] == 1) { ?>
                                                    <li><a href="patient_report.php">Patient Info</a></li>
                                                <?php } if ($_SESSION['missing_vaccination_report'] == 1) { ?>
                                                    <li><a href="missing_vaccination_report.php">Missing Vaccination</a></li>
                                                <?php } if ($_SESSION['future_vaccination_report'] == 1) { ?>
                                                    <li><a href="future_vaccination_report.php">Future Vaccination</a></li>
                                                <?php } if ($_SESSION['vaccine_list_report'] == 1) { ?>
                                                    <li><a href="vaccine_list_report.php">Vaccine List</a></li>
                                                <?php } if ($_SESSION['vaccine_stock_report'] == 1) { ?>
                                                    <li><a href="stock_information.php">Stock Information</a></li>
                                                <?php } if ($_SESSION['vaccine_ledger_report'] == 1) { ?>
                                                    <li><a href="vaccine_ledger_report.php">Vaccine Ledger</a></li>
                                                <?php } if ($_SESSION['vaccination_applied'] == 1) { ?>
                                                    <li><a href="new_revisit_report.php">Client New & Revisit</a></li>
                                                    <li><a href="vaccination_applied_report.php">Vaccination Applied</a></li>
                                                <?php } if ($_SESSION['vaccination_summary'] == 1) { ?>
                                                    <li><a href="vaccination_summary_report.php">Vaccination Summary By Trade</a></li>
                                                <?php } if ($_SESSION['vaccination_summary_by_generic'] == 1) { ?>
                                                    <li><a href="vaccination_summary_report_by_generic.php">Vaccination Summary By Generic</a></li>
                                                <?php } if ($_SESSION['vaccination_summary_by_age'] == 1) { ?>
                                                    <li><a href="vaccination_summary_report_by_age.php">Vaccination Summary By Age</a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if ($_SESSION['operational_time'] == 1) { ?>
                                        <li><a href="system_time.php">System Time</a></li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="content">
                    <!--                    Main content-->
                    <?php
                    //ENTER THE RELEVANT INFO BELOW
                    $mysqlDatabaseName = 'vmis';
                    $mysqlUserName = 'root';
                    $mysqlPassword = '';
                    $mysqlHostName = 'localhost';
                    //$mysqlExportPath = 'ForBackup.sql';
                    $mysqlExportPath = 'D:/backup/vimsForBackup.sql';

                    //DO NOT EDIT BELOW THIS LINE
                    //Export the database and output the status to the page
                    $command = 'mysqldump --opt -h' . $mysqlHostName . ' -u' . $mysqlUserName . ' -p' . $mysqlPassword . ' ' . $mysqlDatabaseName . ' > ~/' . $mysqlExportPath;
                    exec($command);
                    ?>
                    <?php
                    if (isset($view)) {
                        if ($view == 'user_permission') {
                            include './view/user_permission_form.php';
                        } elseif ($view == 'check_date') {
                            include './view/check_date.php';
                        } elseif ($view == 'manage_user') {
                            include './view/manage_user.php';
                        } elseif ($view == 'edit_user') {
                            include './view/edit_user_form.php';
                        } elseif ($view == 'manage_user_role') {
                            include './view/manage_user_role.php';
                        } elseif ($view == 'trade') {
                            include './view/trade_form.php';
                        } elseif ($view == 'vaccine_info') {
                            include './view/vaccine_info_form.php';
                        } elseif ($view == 'vaccine_form') {
                            include './view/vaccine_form.php';
                        } elseif ($view == 'dose_info') {
                            include './view/dose_entry_form.php';
                        } elseif ($view == 'vaccine_list') {
                            include './view/vaccine_list.php';
                        } elseif ($view == 'vaccine_details') {
                            include './view/vaccine_details_content.php';
                        } elseif ($view == 'opening_stock') {
                            include './view/opening_stock_form.php';
                        } elseif ($view == 'vaccine_stock') {
                            include './view/vaccine_stock_form.php';
                        } elseif ($view == 'stock_out') {
                            include './view/stock_out_from.php';
                        } elseif ($view == 'stock_ledger') {
                            include './view/stock_ledger_content.php';
                        } elseif ($view == 'ledger') {
                            include './view/ledger_content.php';
                        } elseif ($view == 'vaccine_stock_list') {
                            include './view/vaccine_stock_list.php';
                        } elseif ($view == 'stock_details') {
                            include './view/stock_details.php';
                        } elseif ($view == 'user_reports') {
                            include './view/user_reports.php';
                        } elseif ($view == 'user_details') {
                            include './view/user_details.php';
                        } elseif ($view == 'eligibility') {
                            include './view/eligibility_view.php';
                        } elseif ($view == 'registration') {
                            include './view/registration_form.php';
                        } elseif ($view == 'upcoming_vaccination') {
                            include './view/upcoming_vaccination_list.php';
                        } elseif ($view == 'next_dose_apply') {
                            include './view/next_dose_apply.php';
                        } elseif ($view == 'edit_register_user') {
                            include './view/edit_register_user_form.php';
                        } elseif ($view == 'organization') {
                            include './view/organization_form.php';
                        } elseif ($view == 'organization_manage') {
                            include './view/organization_manage.php';
                        } elseif ($view == 'age_period') {
                            include './view/age_period_form.php';
                        } elseif ($view == 'organization_edit') {
                            include './view/organization_edit_form.php';
                        } elseif ($view == 'contact') {
                            include './view/contact.php';
                        } elseif ($view == 'system_time') {
                            include './view/system_time.php';
                        } elseif ($view == 'user_create') {
                            include './view/user_create_form.php';
                        } elseif ($view == 'profile_setting') {
                            include './view/profile_setting.php';
                        } elseif ($view == 'future_vaccination') {
                            include './view/future_vaccination_list.php';
                        } elseif ($view == 'patient_report') {
                            include './view/report/patient_report.php';
                        } elseif ($view == 'future_vaccination_report') {
                            include './view/report/future_vaccination_report.php';
                        } elseif ($view == 'missing_vaccination_report') {
                            include './view/report/missing_vaccination_report.php';
                        } elseif ($view == 'vaccine_list_report') {
                            include './view/report/vaccine_list_report.php';
                        } elseif ($view == 'stock_information') {
                            include './view/report/stock_information.php';
                        } elseif ($view == 'stock_details_for_report') {
                            include './view/report/stock_details_for_report.php';
                        } elseif ($view == 'vaccine_ledger_report') {
                            include './view/report/vaccine_ledger_report.php';
                        } elseif ($view == 'new_revisit_report') {
                            include './view/report/new_revisit_report.php';
                        } elseif ($view == 'vaccination_applied_report') {
                            include './view/report/vaccination_applied_report.php';
                        } elseif ($view == 'vaccination_summary_report') {
                            include './view/report/vaccination_summary_report.php';
                        } elseif ($view == 'vaccination_summary_report_by_generic') {
                            include './view/report/vaccination_summary_report_by_generic.php';
                        } elseif ($view == 'vaccination_summary_report_by_age') {
                            include './view/report/vaccination_summary_report_by_age.php';
                        } elseif ($view == 'error') {
                            include './view/error.php';
                        }
                    } else {
                        include './view/home_content.php';
                    }
                    ?>
                </section>	
                <hr>
                <div class="row footer">
                    <div class="col-md-12">
                        <p style="float:left;">Copyright &copy; Dream Solution (BD) Ltd. 2017 - All Rights Reserved.</p>
                    </div>
                </div>				
            </div>
        </div>
        <script type="text/javascript" src="resource/jsor-jcarousel/libs/jquery-loader.js"></script>
        <script src="resource/bootstrap/js/bootstrap.min.js"></script>
        <script src="resource/jquery-ui/jquery-ui.js"></script>
        <script src="resource/datatables/jquery.dataTables.min.js"></script>
        <script src="resource/datatables/dataTables.bootstrap.min.js"></script>
        <script src="resource/custom_js/datatable.js"></script>
<!--        <script src="resource/clock/jqClock.js"></script>-->
        <script src="resource/iCheck/icheck.js"></script>
        <script src="resource/select2/select2.full.min.js"></script>
        <script src="resource/jquery_cycle_plugin/jquery_cycle.js"></script>
        <script src="resource/custom_js/clock.js"></script>
        <script src="resource/custom_js/vaccine_search.js"></script>
        <script src="resource/custom_js/search_user.js"></script>
        <script src="resource/custom_js/search_user_details.js"></script>
        <script src="resource/custom_js/next_dose.js"></script>
        <script src="resource/custom_js/advance_search.js"></script>
        <script src="resource/custom_js/dose_entry.js"></script>
        <script src="resource/custom_js/after_dose_search.js"></script>
        <script src="resource/custom_js/vaccine_select.js"></script>
        <script src="resource/custom_js/age_calculate.js"></script>
        <script src="resource/custom_js/vaccine_time.js"></script>
        <script src="resource/custom_js/ajax_modal.js"></script>
        <script src="resource/custom_js/check_transaction.js"></script>
        <script src="resource/custom_js/datepicker.js"></script>
        <script src="resource/custom_js/image_instant.js"></script>
        <script src="resource/custom_js/vaccine_ledger.js"></script>
        <script src="resource/custom_js/alert.js"></script>
		<script src="resource/custom_js/user_report.js?2"></script>
        <!--
          jCarousel core
        -->
        <script type="text/javascript" src="resource/jsor-jcarousel/dist/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="resource/jsor-jcarousel/src/core.js"></script>
        <script type="text/javascript" src="resource/jsor-jcarousel/src/core_plugin.js"></script>
        <!--
          jCarousel autoscroll plugin
        -->
        <script type="text/javascript" src="resource/jsor-jcarousel/src/autoscroll.js"></script>
        <!--
          jCarousel stylesheet
        -->
        <link rel="stylesheet" type="text/css" href="resource/jsor-jcarousel/horizontal.css">
        <link rel="stylesheet" type="text/css" href="resource/jsor-jcarousel/vertical.css">
        <script src="resource/custom_js/slider.js"></script>
    </body>
</html>
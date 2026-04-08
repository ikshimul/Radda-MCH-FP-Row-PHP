<?php
if ($_SESSION['role_permission_manage'] == 1) {
    $message = '';
    $user_id = $_GET['id'];
    require_once './classes/user_permission.php';
    $obj_role = new User_Permission();
    if (isset($_POST['btn'])) {
        $message = $obj_role->update_user_permission_setup($_POST);
    }
    $user_info = $obj_role->select_role_by_user($user_id);
    $user = mysqli_fetch_assoc($user_info);
} else {
    header('location:error.php');
}
?>
<div style="background-color: white; border: 1px solid #d4d1d1;margin-bottom: 16px;padding: 15px;">
    <div class="box-header with-border">
        <h3 class="box-title">User Role Permission</h3>
        <div class="form-errors">
            <p style="text-align: center; color:green;"><?php echo $message; ?></p>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <form action="" method="post">
            <form action="" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <table class="table table-striped table-bordered">
                    <tr class="info">
                        <th style="text-align:center">Main Menu</th>
                        <th style="text-align:center">Sub Menu</th>
                        <th style="text-align:center">Other</th>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="operational_time" value="1" class="minimal" <?php
                                if ($user['operational_time'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                System Time
                            </label>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="registration" value="1" class="minimal" <?php
                                if ($user['registration'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                Registration
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="patient_regi" value="1" class="minimal" <?php
                                        if ($user['patient_regi'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Patient Registration
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="patient_list" value="1" class="minimal" <?php
                                        if ($user['patient_list'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Patient List
                                    </label>
                                </div>
                            </div>              
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="patient_edit" value="1" class="minimal" <?php
                                            if ($user['patient_edit'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Patient Edit
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="patient_delete" value="1" class="minimal" <?php
                                            if ($user['patient_delete'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Patient Delete
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="main_vaccination" value="1" class="minimal" <?php
                                if ($user['main_vaccination'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                Vaccination
                            </label>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccination" value="1" class="minimal" <?php
                                            if ($user['vaccination'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccination
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccination_apply" value="1" class="minimal" <?php
                                            if ($user['vaccination_apply'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccination Apply
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="upcoming_vaccination" value="1" class="minimal" <?php
                                            if ($user['upcoming_vaccination'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Upcoming Vaccination
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="vaccine" value="1" class="minimal" <?php
                                if ($user['vaccine'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                Vaccine
                            </label>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_form" value="1" class="minimal" <?php
                                            if ($user['vaccine_form'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Form
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_list" value="1" class="minimal" <?php
                                            if ($user['vaccine_list'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine List
                                        </label>
                                    </div>

                                </div>                          
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_edit" value="1" class="minimal" <?php
                                            if ($user['vaccine_edit'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Edit
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_delete" value="1" class="minimal" <?php
                                            if ($user['vaccine_delete'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Delete
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="vaccine_stock" value="1" class="minimal" <?php
                                if ($user['vaccine_stock'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                Vaccine Stock
                            </label>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_opening_stock" value="1" class="minimal" <?php
                                            if ($user['vaccine_opening_stock'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Opening Stock
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="vaccine_stock_in" value="1" class="minimal" <?php
                                            if ($user['vaccine_stock_in'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Stock In
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="vaccine_stock_list" value="1" class="minimal" <?php
                                            if ($user['vaccine_stock_list'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Stock List
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="vaccine_ledger" value="1" class="minimal" <?php
                                            if ($user['vaccine_ledger'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Vaccine Ledger
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="user" value="1" class="minimal" <?php
                                if ($user['user'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                User
                            </label>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="user_create" value="1" class="minimal" <?php
                                            if ($user['user_create'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            User Create
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label>
                                            <input type="checkbox" name="role_permission_manage" value="1" class="minimal" <?php
                                            if ($user['role_permission_manage'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            Role Permission manage
                                        </label>
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="user_manage" value="1" class="minimal" <?php
                                            if ($user['user_manage'] == 1) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            User Manage
                                        </label>
                                    </div>
                                </div>                          
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="user_edit" value="1" class="minimal" <?php
                                        if ($user['user_edit'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        User Edit
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="user_delete" value="1" class="minimal" <?php
                                        if ($user['user_delete'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        User Delete
                                    </label>
                                </div>
                            </div>                          
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="organization" value="1" class="minimal" <?php
                                if ($user['organization'] == 1) {
                                    echo 'checked';
                                }
                                ?>>
                                Organization
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="organization_create" value="1" class="minimal" <?php
                                        if ($user['organization_create'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Organization Create
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="organization_manage" value="1" class="minimal" <?php
                                        if ($user['organization_manage'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Organization Manage
                                    </label>
                                </div>
                            </div>  
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="age_period" value="1" class="minimal" <?php
                                        if ($user['age_period'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Age Period
                                    </label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="organization_edit" value="1" class="minimal" <?php
                                        if ($user['organization_edit'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Organization Edit
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="organization_delete" value="1" class="minimal" <?php
                                        if ($user['organization_delete'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Organization Delete
                                    </label>
                                </div>
                            </div>           
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                            <input type="checkbox" name="report" value="1" class="minimal" <?php
                            if ($user['report'] == 1) {
                                echo 'checked';
                            }
                            ?>>
                            Report
                            </label>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="patient_report" value="1" class="minimal" <?php
                                        if ($user['patient_report'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Patient Report
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccine_list_report" value="1" class="minimal" <?php
                                        if ($user['vaccine_list_report'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccine List Report
                                    </label>
                                </div>
                            </div>    
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="future_vaccination_report" value="1" class="minimal" <?php
                                        if ($user['future_vaccination_report'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Future Vaccination Report
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="missing_vaccination_report" value="1" class="minimal" <?php
                                        if ($user['missing_vaccination_report'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Missing Vaccination Report
                                    </label>
                                </div>
                            </div>    
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccine_stock_report" value="1" class="minimal" <?php
                                        if ($user['vaccine_stock_report'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccine Stock Report
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccine_ledger_report" value="1" class="minimal" <?php
                                        if ($user['vaccine_ledger_report'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccine Ledger Report
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccination_applied" value="1" class="minimal" <?php
                                        if ($user['vaccination_applied'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccination Applied
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccination_summary" value="1" class="minimal" <?php
                                        if ($user['vaccination_summary'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccination Summary By Trade
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccination_summary_by_generic" value="1" class="minimal" <?php
                                        if ($user['vaccination_summary_by_generic'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccination Summary By Generic
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" name="vaccination_summary_by_age" value="1" class="minimal" <?php
                                        if ($user['vaccination_summary_by_age'] == 1) {
                                            echo 'checked';
                                        }
                                        ?>>
                                        Vaccination Summary By Age
                                    </label>
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </table>
                </div>
                <!-- /.row -->
                </div>
                <div class="box-footer">
                    <div class="col-xs-6">
                        <button type="submit" name="btn" class="btn bg-purple btn-flat margin pull-right">Update Role Permission</button>
                    </div>
            </form>
    </div>


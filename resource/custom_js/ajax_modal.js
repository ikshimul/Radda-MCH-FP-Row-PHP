function confirm_delete(delete_url) {
    jQuery("#modal-delete").modal('show', {backdrop: 'static'});
    document.getElementById("delete_link").setAttribute('href', delete_url);
}
function confirm_dose(confirm_dose) {
    jQuery("#modal-dose").modal('show', {backdrop: 'static'});
    document.getElementById("confirm_link").setAttribute('href', confirm_dose);
}
function send_sms(mother_phone, name, vaccine_name, date) {
    jQuery("#modal-sms").modal('show', {backdrop: 'static'});
    document.getElementById("mother_phone").value = mother_phone;
    document.getElementById("message_text_sms").value = 'Hello Mr/Ms. ' + name + ' !  Your vaccine `' + vaccine_name + '` next vaccination date ' + date + '. Please come this date.Have a nice day.';
}
function send_email(email, name, vaccine_name, date) {
    jQuery("#modal-email").modal('show', {backdrop: 'static'});
    document.getElementById("email").value = email;
    document.getElementById("message_text").value = 'Hello Mr/Ms. ' + name + ' ! Your vaccine `' + vaccine_name + '` next vaccination date ' + date + '. Please come this date.Have a nice day.';
}
function showAjaxModal(vaccine_id)
{
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="resource/image/vaccine.jpg" />jfdjsgfdjsgfj</div>');
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    $.ajax({
        url: "edit_vaccine.php?vaccine_id=" + vaccine_id,
        success: function (response)
        {
            jQuery('#modal_ajax .modal-body').html(response);
            var vaccine_time = $("#vaccine_time_id").val();
            if (vaccine_time == 3) {
                $('#time_display').show(500);
                $('#age_form').attr('required', true);
                $('#age_form_unit').attr('required', true);
                $('#age_to').attr('required', true);
                $('#age_to_unit').attr('required', true);
            } else {
                $('#time_display').hide(500);
                $('#age_form').attr('required', false);
                $('#age_form_unit').attr('required', false);
                $('#age_to').attr('required', false);
                $('#age_to_unit').attr('required', false);
            }
            $("#vaccine_time_id").change(function () {
                var vaccine_time = $("#vaccine_time_id").val();
                if (vaccine_time == 3) {
                    $('#time_display').show(500);
                    $('#age_form').attr('required', true);
                    $('#age_form_unit').attr('required', true);
                    $('#age_to').attr('required', true);
                    $('#age_to_unit').attr('required', true);
                } else {
                    $('#time_display').hide(500);
                    $('#age_form').attr('required', false);
                    $('#age_form_unit').attr('required', false);
                    $('#age_to').attr('required', false);
                    $('#age_to_unit').attr('required', false);
                }
            });

        }
    });
}
function showPassword(id) {
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="/image/vaccine_logo.jpg" /></div>');
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    $.ajax({
        url: "reset_password.php?user_id=" + id,
        success: function (response)
        {
            jQuery('#modal_ajax .modal-body').html(response);
        }
    });
}
function edit_vaccine_info(vaccine_id) {
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="resource/image/vaccine.jpg" /></div>');
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    $.ajax({
        url: "edit_vaccine_info.php?vaccine_id=" + vaccine_id,
        success: function (response)
        {
            jQuery('#modal_ajax .modal-body').html(response);
            var vaccine_time = $("#vaccine_time_id").val();
            if (vaccine_time == 3) {
                $('#time_display').show(500);
                $('#age_form').attr('required', true);
                $('#age_form_unit').attr('required', true);
                $('#age_to').attr('required', true);
                $('#age_to_unit').attr('required', true);
            } else {
                $('#time_display').hide(500);
                $('#age_form').attr('required', false);
                $('#age_form_unit').attr('required', false);
                $('#age_to').attr('required', false);
                $('#age_to_unit').attr('required', false);
            }
            $("#vaccine_time_id").change(function () {
                var vaccine_time = $("#vaccine_time_id").val();
                if (vaccine_time == 3) {
                    $('#time_display').show(500);
                    $('#age_form').attr('required', true);
                    $('#age_form_unit').attr('required', true);
                    $('#age_to').attr('required', true);
                    $('#age_to_unit').attr('required', true);
                } else {
                    $('#time_display').hide(500);
                    $('#age_form').attr('required', false);
                    document.getElementById('age_form').value = '';
                    $('#age_form_unit').attr('required', false);
                    document.getElementById('age_form_unit').value = '';
                    $('#age_to').attr('required', false);
                    document.getElementById('age_to').value = '';
                    $('#age_to_unit').attr('required', false);
                    document.getElementById('age_to_unit').value = '';
                }
            });
        }
    });
}
function edit_age_period(age_period_id) {
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="resource/image/vaccine.jpg" /></div>');
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    $.ajax({
        url: "edit_age_period.php?age_period_id=" + age_period_id,
        success: function (response)
        {
            jQuery('#modal_ajax .modal-body').html(response);
        }
    });
}
function edit_vaccine_trans(trade_id) {
    jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="resource/image/vaccine.jpg" /></div>');
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
    $.ajax({
        url: "edit_vaccine_trans.php?trans_id=" + trade_id,
        success: function (response)
        {
            jQuery('#modal_ajax .modal-body').html(response);
            $(function () {
                $("#expire_date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+20"
                });
            });
            $("#vaccine_id").change(function () {
                var vaccine_id = $("#vaccine_id").val();
                if (vaccine_id != '') {
                    $.ajax({
                        type: "POST",
                        url: "get_trade_list_vaccine_wise.php?id=" + vaccine_id,
                        success: function (result, string, jqXHR) {
                            $("#trade_id").html(result);
                            $("#trade_id").show(500);
                        }
                    });
                }
            });
        }
    });
}
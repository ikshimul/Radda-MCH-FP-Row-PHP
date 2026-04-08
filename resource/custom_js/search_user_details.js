$(document).ready(function () {
    $("#search_user").click(function () {
        var search_key = $("#search_key").val();
        if (search_key == '') {
            alert('Please enter patient id');
        } else {
            $.ajax({
                type: "POST",
                url: "search_user.php?search_key=" + search_key,
                success: function (result, string, jqXHR) {
                    $("#user_view").html(result);
                    $('#user_view').show(500);
                    $("#yes").click(function () {
                        $("#any_vaccine").show(500);
                        $(".select2").select2();
                    });
                    $("#no").click(function () {
                        $("#any_vaccine").hide(500);
                    });
                    $("#vaccine").change(function () {
                        var vaccine_id = $("#vaccine").val();
                        if (vaccine_id != '') {
                            $.ajax({
                                type: "POST",
                                url: "get_trade_list_vaccine_wise.php?id=" + vaccine_id,
                                success: function (result, string, jqXHR) {
                                    $("#trade_id").html(result);
                                    $("#trade_id").show(500);
                                    $("#trade_id").change(function () {
                                        var trade_id = $("#trade_id").val();
                                        if (trade_id != '') {
                                            $.ajax({
                                                type: "POST",
                                                url: "select_dose.php?id=" + vaccine_id,
                                                success: function (result, string, jqXHR) {
                                                    if (result == 'This vaccine has no dose information') {
                                                        alert('dose info empty');
                                                        $("#dose_view").html('');
                                                        $("#check_apply").attr('disabled', true);
                                                    } else {
                                                        $("#check_apply").attr('disabled', false);
                                                        $("#dose_view").html(result);
                                                        $('#dose_view').show(500);
                                                        $('input[type=radio][name=dose_id]').change(function () {
                                                            var dose_serial = $(this).val();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "previous_dose_date.php?user_id=" + search_key + "&vaccine_id=" + vaccine_id + "&dose_serial=" + dose_serial,
                                                                success: function (result, string, jqXHR) {
                                                                    $("#previous_date").html(result);
                                                                    $('#previous_date').show(500);
                                                                    $("#perivous_dose_date").datepicker({
                                                                        dateFormat: "yy-mm-dd",
                                                                        showOtherMonths: true,
                                                                        altField: "#birthday",
                                                                        altFormat: "yyyy-mm-dd",
                                                                        changeMonth: true,
                                                                        changeYear: true,
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    }
                                                }
                                            });
                                        } else {
                                            $('#dose_view').hide(500);
                                        }
                                    });
                                }
                            });

                        } else {
                            $('#dose_view').hide(500);
                        }
                    });
                    $("#check_apply").click(function () {
                        var chk = confirm('Are you sure to confirm this dose');
                        if (chk)
                        {
                            return true;
                        } else {
                            return false;
                        }
                    });
                }
            });
        }
    });
});

$(document).ready(function () {
    $("#search").click(function () {
        $('#advance_search').show(500);
    });
    $('#Hide').click(function () {
        $('#advance_search').hide(500);
    });
    $("#report").click(function () {
        $('#future_vaccine_report').show(500);
    });
    $('#report_hide').click(function () {
        $('#future_vaccine_report').hide(500);
    });
    $("#user_id").change(function () {
        var user_id = $("#user_id").val();
        if (user_id != '') {
            $.ajax({
                type: "POST",
                url: "check_user_role_permission.php?user_id=" + user_id,
                success: function (result, string, jqXHR) {
                    if (result == 'show_roles') {
                        $("#user_check").html('');
                        $("#display_roles").show(500);
                    } else {
                        $("#user_check").html(result);
                        $("#display_roles").hide(500);
                    }
                }
            });
        } else {
            $("#display_roles").hide(500);
        }
    });
});
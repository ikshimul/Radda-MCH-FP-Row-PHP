$(document).ready(function () {
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
});
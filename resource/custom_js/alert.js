$(document).ready(function () {
    $('#new_form').on('click', function () {
        alert('ok');
    });
});
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
});
$(document).ready(function () {
    $("#dose_number").blur(function () {
        var dose_value = $("#dose_number").val();
        if (dose_value > 15) {
            alert('Please No of Dose insert less than 16 !');
            $(this).val('')
        } else {
            $('#sendButton').attr('disabled', false);
        }
    });
});
function checkLength(el) {
    if (el.value.length != 10) {
        alert("length must be exactly 10 number")
        $("#check_id").val('');
    }
}
$(".select2").select2();
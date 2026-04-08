$(document).ready(function () {
    $("#vaccine_id").change(function () {
        var vaccine_id = $("#vaccine_id").val();
//        alert(vaccine_id);
        if (vaccine_id != '') {
            $.ajax({
                type: "POST",
                url: "search_dose.php?id=" + vaccine_id,
                success: function (result, string, jqXHR) {
                    $("#dose_view").html(result);
                    $('#dose_view').show(500);
                }
            });
        } else {
            $('#dose_view').hide(500);
        }
    });
});
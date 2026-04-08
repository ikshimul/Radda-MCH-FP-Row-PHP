$(document).ready(function () {
    $("#user_id").autocomplete({
        source: "next_dose_search.php",
        select: function (event, ui) {
            $("#id").val(ui.item.id);
            $("#vaccine_id").val(ui.item.vaccine_id);
            $("#dose_id").val(ui.item.dose_id);
        }
    });
});
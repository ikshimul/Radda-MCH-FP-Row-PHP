$(document).ready(function () {
    $("#vaccine_search").autocomplete({
        source: "search_vaccine.php",
        select: function (event, ui) {
         $("#vaccine_id").val(ui.item.vaccine_id);
        }
    });
});
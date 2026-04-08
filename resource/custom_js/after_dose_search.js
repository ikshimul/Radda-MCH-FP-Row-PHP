$(document).ready(function () {
    $("#vaccine_id").change(function () {
        var vaccine_id = $("#vaccine_id").val();
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
                                url: "search_dose.php?id=" + trade_id,
                                success: function (result, string, jqXHR) {
                                    $("#dose_view").html(result);
                                    $('#dose_view').show(500);
                                }
                            });
                        } else {
                            $('#dose_view').hide(500);
                        }
                    });
                }
            });
        }else{
            $("#trade_id").hide(500);
        }
    });
});

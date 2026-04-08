$(document).ready(function () {
    $("#trade_id").change(function () {
        var vaccine_id = $("#trade_id").val();
        if (vaccine_id != '') {
            $("#form-to").show(500);
            $("#ledger").click(function () {
                var form = $("#vaccine_ledger_date").val();
                var to = $("#vaccine_ledger_date1").val();
                $.ajax({
                    type: "POST",
                    url: "ledger_details.php?vaccine_id=" + vaccine_id + "&form=" + form + "&to=" + to,
                    success: function (result, string, jqXHR) {
                        $("#ledger_details").html(result);
                        $("#ledger_details").show(500);
                    }
                });
            });
        } else {
            $("#form-to").hide(500);
        }
    });
});
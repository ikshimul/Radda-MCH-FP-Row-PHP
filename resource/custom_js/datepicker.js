$(function () {
    $("#date2").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+10"
    });
});
$(function () {
    $("#date1").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });
});
$(function () {
    $("#expire_date").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+20"
    });
});
$("#vaccine_ledger_date").datepicker({
    dateFormat: "yy-mm-dd",
    showOtherMonths: true,
    altField: "#birthday",
    altFormat: "yyyy-mm-dd",
    changeMonth: true,
    changeYear: true,
});
$("#vaccine_ledger_date1").datepicker({
    dateFormat: "yy-mm-dd",
    showOtherMonths: true,
    altField: "#birthday",
    altFormat: "yyyy-mm-dd",
    changeMonth: true,
    changeYear: true,
});
$(function () {
    $("#dob_date").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });
});
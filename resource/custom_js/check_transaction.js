var check = new XMLHttpRequest();
function check_transaction(vaccine_id) {
    var server_page = "check_transaction.php?vaccine_id=" + vaccine_id;
    check.open("GET", server_page);
    check.onreadystatechange = function () {
        if (check.readyState == 4 && check.status == 200) {
            document.getElementById("transaction_message").innerHTML = check.responseText;
        }
        if (check.responseText == 'Please opening your vaccine balance') {
            document.getElementById("check_tran").disabled = false;
        } else {
            document.getElementById("check_tran").disabled = true;
        }
    }
    check.send(null);
}
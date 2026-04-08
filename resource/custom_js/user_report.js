
var table;

$(document).ready(function () {

    //datatables
    table = $('#user_report').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        responsive: true,

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "get_user_report.php",
            "type": "POST",
            'data': {}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],

    });
   // miniDash();


    $(document).on('click', ".view-object", function (e) {
        e.preventDefault();
        $('#view-object-id').val($(this).attr('data-object-id'));

        $('#view_model').modal({backdrop: 'static', keyboard: false});

        var actionurl = $('#view-action-url').val();
        $.ajax({
            url: baseurl + actionurl,
            data: 'id=' + $('#view-object-id').val() + '&' + crsf_token + '=' + crsf_hash,
            type: 'POST',
            dataType: 'html',
            success: function (data) {
                $('#view_object').html(data);

            }

        });

    });
});
var order_date = getUrlParameter('date');
var status = null;
var oTable;
var columns = [];
var account = getUrlParameter('id');

if (getUrlParameter('date') === undefined) {
    order_date = moment().format('YYYY-MM-DD');
}

$("#calendarFilter").html(order_date);

function showAll() {
    status = null;
    oTable.ajax.reload();
}

function showDelivered() {
    status = 1;
    oTable.ajax.reload();
}

function showUndelivered() {
    status = 0;
    oTable.ajax.reload();
}

function getSearchData() {

    return {
        'order_date': order_date,
        'account': account,
        'status': status
    };
}

    columns = [
        {"data": '', "class": 'details-control', "orderable": false, "defaultContent": ''},
        {"class": 'shipment-number', 'data': "shipment_number", "title": "Shipment"},
        {"visible": false, "data": "recip_see", "title": "See"},
        {"data": "shipper_ref2", "title": "Shipment ID"},
        {"visible": false, "data": "shipper_ref", "title": "Shipment Reference"},
        {"data": "recipient_company", "title": "Company"},
        {"data": "recipient_city", "title": "City"},
        {"data": "recipient_zip", "title": "Zip"},
        {"data": "service_type", "title": "Service Type"},
        {"data": "pod_name", "class": "podName", "title": "POD Name"},
        {"data": 'deliver_time', "class": "noBreak deliverTime", "title": "POD Time"}
    ];
function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
$(document).ready(function () {
    var orderTable = $('#orderTable');
    if(phpInfo.concise_company_slug!=''){
        var companySlug = phpInfo.concise_company_slug;
    }else{
        var companySlug = 'goldrush';
    }
    oTable = orderTable.DataTable({
        "bPaginate": true,
        "bFilter": true,
        "bSort": true,
        "processing": true,
        "iDisplayLength": 15,
        "order": [[0, "desc"]],
        "serverSide": true,
        "bAutoWidth": false,
        "sPaginationType": "full_numbers",
        "ajax": {
            "url": "https://api.concise.io/public/"+companySlug+"/shipments",
            "data": function (d) {
                return $.extend(d, getSearchData());
            }
        },
        "columns": columns,
        "oLanguage": {
            "sEmptyTable": "There are no shipments for the requested date",
            "sProcessing": "Loading Shipments..."
        },
        "fnDrawCallback": function () {
            var unDeliveredCount = 0;
            var totalCount = 0;
            var deliveredCount = 0;

            orderTable.find("tbody tr td:nth-child(2)").hover(function () {
                $(this).css('cursor', 'pointer');
            });
            orderTable.find("tbody tr td.deliverTime").text(function (line, data) {
                if (data) {
                    return moment.unix(data).utc().format("h:mm A");
                }
            });

            orderTable.find("tbody tr td.dispatchTime").text(function (line, data) {
                if (data) {
                    return moment.unix(data).utc().format("h:mm A");
                }
            });

            orderTable.find("tbody tr td.podName").text(function (line, data) {
                if (data === "1") {
                    return "Successful";
                }
                if (data === "86") {
                    return "Unsuccessful";
                }
            });
            orderTable.find("tbody tr td:last-child").each(function () {
                if ($(this).text() == '') {
                    unDeliveredCount = unDeliveredCount + 1;
                    totalCount = totalCount + 1;
                } else {
                    deliveredCount = deliveredCount + 1;
                    totalCount = totalCount + 1;
                }
            });
        }
    }).on('xhr.dt', function (e, settings, json) {
        $('#countTotal').text(numberWithCommas(json.iTotal));
        $('#countUndelivered').text(numberWithCommas(json.iTotalUndelivered));
        $('#countDelivered').text(numberWithCommas(json.iTotalDelivered));
        $('#onTimePercent').text(numberWithCommas(json.iTotalOTP));
    });

    orderTable.find('tbody').on('click', 'td.shipment-number', function () {
        var shipment_id = $('#orderTable').dataTable().fnGetData(this);
        document.location.href = "concise-shipment?id=" + shipment_id;
    });

    // Add event listener for opening and closing details
    orderTable.find('tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = oTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
    $('.DataTables_sort_icon').remove();

    $('#calendarFilter').Zebra_DatePicker({
        direction: false,
        first_day_of_week: 0,
        onSelect: function (date) {
            $("#calendarFilter").text(date);

            order_date = date;
            oTable.ajax.reload();
        }
    });
});

/* Formatting function for row details - modify as you need */
function format(d) {

    // `d` is the original data object for the row
    if (d['recip_see'] == null) {
        d['recip_see'] = "Not Set"
    }
    if (d['shipper_ref'] == null) {
        d['shipper_ref'] = "Unknown"
    }
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        '<tr>' +
        '<td>Recipient:</td>' +
        '<td>' + d['recip_see'] + '</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Shipper Ref:</td>' +
        '<td>' + d['shipper_ref'] + '</td>' +
        '</tr>' +
        '</table>';
}

function getUrlParameter(sParam) {
var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');

    if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
    }
}
};
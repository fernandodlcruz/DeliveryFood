$(document).ready(function() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page=="business.php") {
        loadOrders();
        loadMenu();
        $('.tabs').tabs();
     } 
});

function loadOrders() {
    $.ajax({
        url: HOST_NAME + "placeOrder.php",
        dataType: "jsonp",
        data: {
            companyId: $('#hdnUid').val()
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#ordersList').append(createOrderItem(obj));
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

function createOrderItem(data) {
    var client = 'Customer info: ' + data.Name + ' - ' + data.PhoneNumber + ' - ' + data.Email;

    return '<tr>' +
            '    <td>' + data.idOrder + '</td>' +
            '    <td>' + data.Item + '</td>' +
            '    <td>' + data.OrderDate + '</td>' +
            '    <td>' + data.Quantity + '</td>' +
            '    <td>$' + data.TotalPrice + '</td>' +
            '</tr>' +
            '<tr>' +
            '    <td colspan="5" class="center">' + client + '</td>' +
            '</tr>';
}

function loadMenu() {
    var form = 
    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            companyId: $('#hdnUid').val()
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#menuItems').append('<tr>' +
                                        '    <td>' + obj.Item + '</td>' +
                                        '    <td>' + obj.Description + '</td>' +
                                        '    <td>' + obj.Unit + '</td>' +
                                        '    <td>' + obj.Price + '</td>' +
                                        '    <td><a class="btn-floating btn-small" id="' + obj.idMenu + '"><i class="material-icons left">mode_edit</i></a>' +
                                        '        <a class="btn-floating btn-small red" id="' + obj.idMenu + '"><i class="material-icons left">delete_forever</i></a>' +
                                        '    </td>' +
                                        '</tr>' 
            )});
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#menuView').hide();
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

$('#btnInsert').click(function() {
    window.location.replace("companyNewItem.php");
});

function updateItem(){
    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            update: $('true').val()
        },
        success: function(data) {
    
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

function deleteItem() {
    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            deleteId: $(this).attr('id')
        },
        success: function(data) {
    
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#menuView').hide();
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}
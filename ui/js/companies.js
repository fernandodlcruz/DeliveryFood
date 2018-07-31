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
            $('#ordersList').empty();
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
    var address = 'Address: ' + data.Line1 + ' ' + data.Line2 + ', ' + data.City + ', ' + data.StateProvince + ', ' + data.PostalCode;

    return '<tr>' +
            '    <td>' + data.idOrder + '</td>' +
            '    <td>' + data.Item + '</td>' +
            '    <td>' + data.OrderDate + '</td>' +
            '    <td>' + data.Quantity + '</td>' +
            '    <td>$' + data.TotalPrice + '</td>' +
            '</tr>' +
            '<tr>' +
            '    <td colspan="5" class="center">' + client + '</td>' +
            '</tr>' +
            '<tr>' +
            '    <td colspan="5" class="center">' + address + '</td>' +
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
            $('#menuItems').empty();
            $.each(data, function (index, obj) {
                if (obj.Active=='A') {
                    buttons = '    <td><a class="btn-floating btn-small" id="upd_' + obj.idMenu + '"><i class="material-icons left">mode_edit</i></a>' +
                                '        <a class="btn-floating btn-small red" id="del_' + obj.idMenu + '"><i class="material-icons left">delete_forever</i></a>' +
                                '    </td>';
                } else {
                    buttons = '<td><i>Item inactive</i></td>';
                }

                $('#menuItems').append('<tr>' +
                                        '    <td>' + obj.Item + '</td>' +
                                        '    <td>' + obj.Description + '</td>' +
                                        '    <td>' + obj.Unit + '</td>' +
                                        '    <td>' + obj.Price + '</td>' +
                                        buttons +                                        
                                        '</tr>' 
            )});
            setButtonsListener();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#menuView').hide();
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

function setButtonsListener() {
    $('.btn-floating').each(function(index, obj) {
        $(this).click(function() {
            var arrId = $(this).attr('id').split('_');

            if (arrId[0] == 'upd') {
                updateItem(arrId[1]);
            } else {
                inactiveItem(arrId[1]);
            }
        });
    });
}

$('#btnInsert').click(function() {
    window.location.replace("companyNewItem.php");
});

function updateItem(id) {
    $.redirectPost('companyNewItem.php', {menuId: id});
}

function inactiveItem(id) {
    if (confirm("Are you sure? This action couldn´t be undone.")) {
        $.ajax({
            url: HOST_NAME + "menu.php",
            dataType: "jsonp",
            data: {
                deleteId: id
            },
            success: function(data) {
                alert("Item inactivated");
                loadMenu();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#menuView').hide();
                console.log('status: ' + xhr.status);
                console.log('error: ' + thrownError);
            }
        });
    }
}

// jquery extend function
$.extend({
    redirectPost: function(location, args) {
        var form = $('<form></form>');
        form.attr("method", "post");
        form.attr("action", location);

        $.each( args, function( key, value ) {
            var field = $('<input></input>');

            field.attr("type", "hidden");
            field.attr("name", key);
            field.attr("value", value);

            form.append(field);
        });
        $(form).appendTo('body').submit();
    }
});
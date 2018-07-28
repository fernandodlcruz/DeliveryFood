$(document).ready(function() {
    loadBusiness();
    $('.fixed-action-btn').floatingActionButton({hoverEnabled: false});
    $('.tooltipped').tooltip();    

    var path = window.location.pathname;
    var page = path.split("/").pop();
    if(page=="customerConfirm.php"){
        loadSelectedItems();
    }
});

function loadBusiness() {
    $.ajax({
        url: HOST_NAME + "companies.php",
        dataType: "jsonp",
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#business').append($('<option>', { 
                    value: obj.idUser,
                    text : obj.Name
                }));
            });
            $('select').formSelect();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

// Change the menu when user select different restaurant
$('#business').change(function() {

    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            companyId: $('#business').val()
        },
        success: function(data) {
            $('#menuList').empty();
            $.each(data, function (index, obj) {
                $('#menuList').append(createMenuItem(obj));
            });            
            $('.collapsible').collapsible();
            $('#menuView').show();
            $('.btn-floating').removeClass('disabled');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('#menuView').hide();
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
});

function createMenuItem(data) {
    return '<li>' +
            '<div class="collapsible-header">' +
            '    <div class="col s8"><h6>' + data.Item + '.' + data.Unit + '</h6></div>' +
            '    <div class="col s1">$' + data.Price + '</div>' +
            '    <div class="col s3">' +
            '    <div class="input-field col s6">' +
            '        <input type="number" id="txtQty_' + data.idMenu + '" min="0" data-length="2">' +
            '        <label for="txtQty_' + data.idMenu + '">Qty to buy</label>' +
            '    </div>' +
            '    </div>' +
            '</div>' +
            '<div class="collapsible-body"><span>' + data.Description + '</span></div>' +
            '</li>';
}

// Add to cart button
$('.fixed-action-btn').click(function() {
    var hasSelection = false;
    var orderList = [];
    var orderListQtys = [];

    $('input[type=number]').each(function() {
        if ($(this).val() != "" && $(this).val() != "0") {
            hasSelection = true;
            
            orderList.push($(this).attr('id').split("_")[1]);
            orderListQtys.push($(this).val());
        }
    });

    if (!hasSelection) {
        M.toast({html: 'Please, inform the quantity of the items you would like to order.'});
    } else{
        sessionStorage.setItem('orderList', orderList);
        sessionStorage.setItem('orderListQtys', orderListQtys);
        window.location.replace("customerConfirm.php");
    }
});

function loadSelectedItems() {
    var arrQtys = [sessionStorage.getItem('orderListQtys')];
    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            ids: sessionStorage.getItem('orderList')
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#menuItems').append('<tr>' +
                                        '    <td>' + obj.Item + '</td>' +
                                        '    <td>$' + obj.Price + '</td>' +
                                        '    <td>' + arrQtys[index] + '</td>' +
                                        '</tr>');
            });            
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}
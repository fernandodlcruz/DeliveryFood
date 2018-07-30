$(document).ready(function() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page=="customer.php") {
        loadCuisine();
        $('.fixed-action-btn').floatingActionButton({hoverEnabled: false});
        $('.tooltipped').tooltip();    
    } else if(page=="customerConfirm.php") {
        loadSelectedItems();
        loadAddresses();
        $('.modal').modal();
    }
});

// Load types of cuisine to populate the select field
function loadCuisine() {
    $.ajax({
        url: HOST_NAME + "cuisine.php",
        dataType: "jsonp",
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#cuisine').append($('<option>', { 
                    value: obj.idCuisine,
                    text : obj.Description
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

function loadBusiness(cuisineId) {
    $.ajax({
        url: HOST_NAME + "companies.php",
        dataType: "jsonp",
        data: {cuisineId: cuisineId},
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

// Change restaurants when user select different cuisine
$('#cuisine').change(function() {
    $('#menuView').hide();
    $('#business').html('<option value="" disabled selected>Choose your option</option>');
    $('.btn-floating').addClass('disabled');

    if ($(this).val()) {
        loadBusiness($(this).val());
    }
});

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
        sessionStorage.setItem('companyId', $('#business').val());
        window.location.replace("customerConfirm.php");
    }
});

function loadSelectedItems() {
    var arrQtys = sessionStorage.getItem('orderListQtys').split(',');
    var total = 0.0;

    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            ids: sessionStorage.getItem('orderList').split(',')
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                total += parseFloat(obj.Price) * parseInt(arrQtys[index]);
                $('#menuItems').append('<tr>' +
                                        '    <td>' + obj.Item + '</td>' +
                                        '    <td>$' + obj.Price + '</td>' +
                                        '    <td>' + arrQtys[index] + '</td>' +
                                        '</tr>' +
                                        '<input type="hidden" id="hdn_' + obj.idMenu + '" value="' + obj.Price + '">');
            });
            $('#totalOrder').text(total.toFixed(2));
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

function loadAddresses() {
    var address;

    $.ajax({
        url: HOST_NAME + "address.php",
        dataType: "jsonp",
        data: {
            idUser: $('#hdnUid').val()
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                address = obj.Line1 + obj.Line2 + ', ' + obj.City + ', ' + obj.StateProvince + ', ' + obj.PostalCode;
                $('#addressList').append('<p><label>' + 
                                            '<input name="optAddress" type="radio" id="optionId' + obj.idAddress + '" class="with-gap qOptionClass" value="' + obj.idAddress + '" />' + 
                                            '<span>' + address + '</span>' + 
                                        '</label></p>');
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

$('#btnPlaceOrder').click(function() {
    if ($('#addressLine1').val() != '' && $('#city').val() != '' && $('#stateProv').val() != '' && $('#postalCode').val() != '') {
        placeOrder(insertAddress());
    } else if ($('input[name=optAddress]:checked').val()) {
        placeOrder($('input[name=optAddress]:checked').val());
    } else {
        M.toast({'html': 'Please, Select an address from the list, or insert a new one.'});
    }
});

function insertAddress() {
    $.ajax({
        url: HOST_NAME + "address.php",
        dataType: "jsonp",
        data: {
            line1: $("#addressLine1").val(),
            line2: $("#addressLine2").val(),
            city: $("#city").val(),
            stateProv: $("#stateProv").val(),
            postalCode: $("#postalCode").val(),
            idUser: $('#hdnUid').val()
        },
        success: function(data) {
            return data.id;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}

function placeOrder(address) {
    var companyId = sessionStorage.getItem('companyId');
    var menuList = sessionStorage.getItem('orderList').split(',');
    var arrQtys = sessionStorage.getItem('orderListQtys').split(',');
    var isPlaced = true;
    
    $.each(menuList, function(index, value) {
        $.ajax({
            url: HOST_NAME + "placeOrder.php",
            dataType: "jsonp",
            data: {
                companyId: companyId,
                userId: $('#hdnUid').val(),
                menuId: value,
                addressId: address,
                quantity: arrQtys[index],
                totalPrice: parseFloat($("#hdn_" + value).val()) * parseInt(arrQtys[index])
            },
            error: function (xhr, ajaxOptions, thrownError) {
                isPlaced = false;
                console.log('status: ' + xhr.status);
                console.log('error: ' + thrownError);
            }
        });
    });

    if (isPlaced) {
        $('.modal').modal('open');
    }
}

$('.modal-close').click(function() {
    window.location.replace("customer.php");
});
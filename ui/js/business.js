$(document).ready(function() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page=="business.php") {
        loadOrders();
        loadMenu();
     } 
});

// loadOrders needs to pass the business id
function loadOrders() {
    $.ajax({
        url: HOST_NAME + "placeOrder.php",
        dataType: "jsonp",
        data: {
            companyId: $('4').val()
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#orders').append('<tr>' +
                '    <td>' + obj.idOrder + '</td>' +
                '    <td>' + obj.IdCompanyOrder + '</td>' +
                '    <td>' + obj.IdUserOrder + '</td>' +
                '    <td>' + obj.IdMenuOrder + '</td>' +
                '    <td>' + obj.Quantity + '</td>' +
                '    <td>' + obj.TotalPrice + '</td>' +
                '</tr>' 
            )});
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
}



function loadMenu() {
    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            companyId: $('4').val()
        },
        success: function(data) {
            $.each(data, function (index, obj) {
                $('#menuItems').append('<tr>' +
                '    <td>' + obj.idMenu + '</td>' +
                '    <td>' + obj.Item + '</td>' +
                '    <td>' + obj.Description + '</td>' +
                '    <td>' + obj.Unit + '</td>' +
                '    <td>' + obj.Price + '</td>' +
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

$(document).ready(function(){
    loadBusiness();
    $('.fixed-action-btn').floatingActionButton({hoverEnabled: false});
    $('.tooltipped').tooltip();    
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
            '        <input type="number" id="txtQty' + data.idMenu + '" min="0" max="10"  data-length="2">' +
            '        <label for="qty">Qty to buy</label>' +
            '    </div>' +
            '    </div>' +
            '</div>' +
            '<div class="collapsible-body"><span>' + data.Description + '</span></div>' +
            '</li>';
}

// Add to cart button
$('.fixed-action-btn').click(function() {
    alert('test');
});
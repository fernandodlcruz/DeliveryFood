$(document).ready(function() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page=="companyNewItem.php") {
        $('.modal').modal();
        loadMenuData();
    }
});
$('#btnItem').click(function() {
    var isPlaced = true;
    
    if ($('#hdnMenuId').val() == '') { // New item data
        data = {
            companyId: $('#hdnUid').val(),
            name: $("#name").val(),
            description: $("#description").val(),
            unit: $("#unit").val(),
            price: $("#price").val()
        };
    } else { // Update existing item
        data = {
            companyId: $('#hdnUid').val(),
            name: $("#name").val(),
            description: $("#description").val(),
            unit: $("#unit").val(),
            price: $("#price").val(),
            updateId: $('#hdnMenuId').val()
        };
    }

    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: data,
        error: function (xhr, ajaxOptions, thrownError) {
            var isPlaced = false;
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
    if (isPlaced) {
        $('.modal').modal('open');
    }
});

$('#btnCancel').click(function() {
    window.location.replace('business.php');
});

$('.modal-close').click(function() {
    window.location.replace("business.php");
});

function loadMenuData() {
    if ($('#hdnMenuId').val() != '') {
        $('#btnItem').html('Update Item');
        $.ajax({
            url: HOST_NAME + "menu.php",
            dataType: "jsonp",
            data: {
                idMenu: $('#hdnMenuId').val()
            },
            success: function(data) {
                $('#name').val(data.Item);
                $('#description').val(data.Description);
                $('#unit').val(data.Unit);
                $('#price').val(data.Price);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('status: ' + xhr.status);
                console.log('error: ' + thrownError);
            }
        });
    }
}
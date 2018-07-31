$(document).ready(function() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    if(page=="companyNewItem.php") {
        $('.modal').modal();
    }
});
$('#btnItem').click(function() {
    var isPlaced = true;
    $.ajax({
        url: HOST_NAME + "menu.php",
        dataType: "jsonp",
        data: {
            companyId: $('#hdnUid').val(),
            name: $("#name").val(),
            description: $("#description").val(),
            unit: $("#unit").val(),
            price: $("#price").val()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var isPlaced = false;
            $('#menuView').hide();
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
    if (isPlaced) {
        $('.modal').modal('open');
    }
});
$('.modal-close').click(function() {
    window.location.replace("business.php");
});
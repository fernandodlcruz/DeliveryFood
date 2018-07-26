$(document).ready(function(){
    var path = window.location.pathname;
    var page = path.split("/").pop();
    if(page=="customer"){
        console.log("customer");
        loadBusiness()
    }
});

function loadBusiness() {
    $.ajax({
        url: HOST_NAME + "companies.php",
        dataType: "jsonp",
        success: function(data) {
            $.each(data, function (index, obj) {
                // console.log( { 
                //     value: obj.idUser,
                //     name: obj.Name,
                //     phone: obj.PhoneNumber
                // });
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

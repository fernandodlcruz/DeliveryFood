// onLoad function
$(document).ready(function(){
    $('.tabs').tabs();
    loadCuisine();
});

// Signup button function
$("#btnSignup").click(function() {
    var usrType = ($("#chkCustomer").is(":checked")) ? "B" : "C";
    var idCuisine = (!$("#cuisine").val()) ? "": $("#cuisine").val();

    $.ajax({
        url: HOST_NAME + "register.php",
        dataType: "jsonp",
        data: {
            name: $("#userName").val(),
            phone: $("#phone").val(),
            email: $("#email").val(),
            userType: usrType,
            pwd: $("#pwd").val(),
            idCuisine: idCuisine
        },
        success: function(data) {
            loadUser(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
});

// Login button
$("#btnLogin").click(function() {
    $.ajax({
        url: HOST_NAME + "login.php",
        dataType: "jsonp",
        data: {
            email: $("#emailLogin").val(),
            pwd: $("#pwdLogin").val()
        },
        success: function(data) {
            loadUser(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Something went wrong trying logging you in');
            console.log('status: ' + xhr.status);
            console.log('error: ' + thrownError);
        }
    });
});

// toggle cuisine selection
  $("#chkCustomer").change(function() {
      $('#selectCuisine').toggle();
});

//Load user
function loadUser(data) {
    var page = '';

    if (data.loggedIn) {
        $.ajax({
            type: 'POST',
            url: "inc/LoadSession.inc.php",
            data: JSON.stringify(data),
            success: function() {
                console.log(data.UserType);
                if (data.UserType == 'B') {
                    page = "business.php";
                } else {
                    page = "customer.php";
                }                
                setTimeout(window.location.replace(page), 2000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Something went wrong trying logging you in');
                console.log('status: ' + xhr.status);
                console.log('error: ' + thrownError);
            }
        });        
    } else {
        $('#messages').html('E-mail/password invalid. Please, try again');
        $('#messages').show();
    }
}

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
$(document).ready(function() {

    // Shows the user menu
    $(".dropdown").hover(function() {
        $(".menu-dropdown").toggle();
    });

    // Shows login dialog
    $("#btn-login").click(function() {
        $("#modal-login").toggle();
    });

    // Shows register dialog
    $("#btn-register").click(function() {
        $("#modal-register").toggle();
    });

    // Hides any modal dialog when clicking in close
    $(".close").click(function() {
        $(".modal").hide();
    });

    // Hides the modal dialog boxes selected
    $(".btn-cancel").click(function() {
        $(".modal").hide();
    });

    var modalLogin = document.getElementById('modal-login');
    var modalRegister = document.getElementById('modal-register');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modalLogin) {
            modalLogin.style.display = "none";
        }
        if (event.target == modalRegister) {
            modalRegister.style.display = "none";
        }
    };

    // Returns an Url parameter of the current page
    function getUrlParameterByName(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
    }

    // Formats the address data received as JSON format
    function formatAddress(address) {
        return address.street + ", " + address.zipcode + ", " +
            address.city + ", " + address.country;
    }

    // Show restaurant location using google maps
    $(function() {
        if ($('div').hasClass('restaurant')) {

            console.log('sim');
            $.ajax({
                url: "../scripts/get_map_info.php",
                type: "get",
                data: {
                    id: getUrlParameterByName('id')
                },
                success: function(data) {
                    console.log('sim');
                    var restaurantAddress = formatAddress(data);

                    $('#restaurantmap')
                        .gmap3({
                            address: restaurantAddress,
                            zoom: 15
                        })
                        .marker([{
                            address: restaurantAddress
                        }]);
                }
            });
        }
    });

    // Show review input if a user is logged
    $("#btn-createreview").click(function() {
        $.getJSON("../scripts/session_status.php", function(result) {
            if (result.logged) // User is logged
                $("#addreview").toggle("show");
            else
                $("#modal-login").show();

        });
    });
    //validation of the register fields
    $("#reg-user").keyup(function() {
        if ($("#reg-user").val() == null || $("#reg-user").val() == "")
            $("#reg-user").css("background-color", "white");
        else if (/^([a-z0-9]*)$/.test($("#reg-user").val()) && /^\S/.test($("#reg-user").val()))
            $("#reg-user").css("background-color", "lightgreen");
        else
            $("#reg-user").css("background-color", "red");

    });

    $("#reg-name").keyup(function() {
        if ($("#reg-name").val() == null || $("#reg-name").val() == "")
            $("#reg-name").css("background-color", "white");
        else if (/^([^0-9]*)$/.test($("#reg-name").val()))
            $("#reg-name").css("background-color", "lightgreen");
        else
            $("#reg-name").css("background-color", "red");
    });

    $("#reg-mail").keyup(function() {
        if ($("#reg-mail").val() == null || $("#reg-mail").val() == "")
            $("#reg-mail").css("background-color", "white");
        else if (	/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($("#reg-mail").val()))
            $("#reg-mail").css("background-color", "lightgreen");
        else
            $("#reg-mail").css("background-color", "red");
    });

    $("#reg-pass1").keyup(function() {
        if ($("#reg-pass1").val() == null || $("#reg-pass1").val() == "")
            $("#reg-pass1").css("background-color", "white");
        else
            $("#reg-pass1").css("background-color", "lightgreen");
    });

    $("#reg-pass2").keyup(function() {
        if ($("#reg-pass2").val() == null || $("#reg-pass2").val() == "")
            $("#reg-pass2").css("background-color", "white");
        else if($("#reg-pass2").val() == $("#reg-pass1").val())
            $("#reg-pass2").css("background-color", "lightgreen");
        else
            $("#reg-pass2").css("background-color", "red");
    });

    $("#reg-bdate").focus(function() {
        if ($("#reg-bdate").val() == "") {
          $("#reg-bdate").val("Data de Nascimento");
        }
        console.log();
    });

    $("#reg-bdate").blur(function() {
        if ($("#reg-bdate").val() == "") {
          $("#reg-bdate").val("Data de Nascimento");
        }
        console.log();
    });

    $("#reg-bdate").keyup(function() {
        if ($("#reg-bdate").val() == null || $("#reg-bdate").val() == "")
            $("#reg-bdate").css("background-color", "white");
        else if($("#reg-pass2").val() == $("#reg-pass1").val())
            $("#reg-pass2").css("background-color", "lightgreen");
        else
            $("#reg-pass2").css("background-color", "red");
    });


});

/* $.ajax({
 url: '../scripts/session_status.php',
 type: 'get',
 data: {},
 dataType: 'json',
 success: function(data) {
 if (data.logged) // User is logged
 $("#addreview").toggle("show");
 else
 $("#modal-login").show();
 }
 });*/

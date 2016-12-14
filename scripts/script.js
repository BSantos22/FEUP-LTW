$(document).ready(function() {

    $('.bxslider').bxSlider({
        auto: true
    });

    // Unlocks submit button only if a file has been chosen
    $('input:file').change(function(){
        if ($(this).val()) {
            $('input:submit').attr('disabled',false);
            $('input:submit').css('background-color','#cf2230');
        }
    });

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

    // Shows login dialog
    $("#btn-uploaduserphoto").click(function() {
        $("#modal-uploaduserphoto").toggle();
    });

    // Hides any modal dialog when clicking in close
    $(".close").click(function() {
        $(".inputfile").val('');
        $(".modal").hide();
    });

    // Hides the modal dialog boxes selected
    $(".btn-cancel").click(function() {
        $(".inputfile").val('');
        $(".modal").hide();
    });

    var modalLogin = document.getElementById('modal-login');
    var modalRegister = document.getElementById('modal-register');
    var modalUserPhoto = document.getElementById('modal-uploaduserphoto');
    var modalRestaurantPhoto = document.getElementById('modal-uploadrestaurantphoto');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {

        if (event.target == modalLogin) {
            modalLogin.style.display = "none";
        }
        if (event.target == modalRegister) {
            modalRegister.style.display = "none";
        }
        if (event.target == modalUserPhoto) {
            $(".inputfile").val('');
            modalUserPhoto.style.display = "none";
        }
        if (event.target == modalRestaurantPhoto) {
            $(".inputfile").val('');
            modalRestaurantPhoto.style.display = "none";
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
            $("#reg-user").css("border", "1px solid #ccc");
        else if (/^([a-z0-9]*)$/.test($("#reg-user").val()) && /^\S/.test($("#reg-user").val()))
            $("#reg-user").css("border", "2px solid #3fa246");
        else
            $("#reg-user").css("border", "2px solid #c21212");

    });

    $("#reg-name").keyup(function() {
        if ($("#reg-name").val() == null || $("#reg-name").val() == "")
            $("#reg-name").css("border", "1px solid #ccc");
        else if (/^([^0-9]*)$/.test($("#reg-name").val()))
            $("#reg-name").css("border", "2px solid #3fa246");
        else
            $("#reg-name").css("border", "2px solid #c21212");
    });

    $("#reg-mail").blur(function() {
        if ($("#reg-mail").val() == null || $("#reg-mail").val() == "")
            $("#reg-mail").css("border", "1px solid #ccc");
        else if (	/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($("#reg-mail").val()))
            $("#reg-mail").css("border", "2px solid #3fa246");
        else
            $("#reg-mail").css("border", "2px solid #c21212");
    });

    $("#reg-pass2").blur(function() {
        if ($("#reg-pass2").val() == null || $("#reg-pass2").val() == "")
            $("#reg-pass2").css("border", "1px solid #ccc");
        else if($("#reg-pass2").val() == $("#reg-pass1").val()){
            $("#reg-pass1").css("border", "2px solid #3fa246");
            $("#reg-pass2").css("border", "2px solid #3fa246");
        }else{
            $("#reg-pass1").css("border", "2px solid #c21212");
            $("#reg-pass2").css("border", "2px solid #c21212");
        }
    });

    $("#reg-bdate").focus(function() {
        document.getElementById("reg-bdate").type = "date";
    });

    $("#reg-bdate").blur(function() {
        if ($("#reg-bdate").val() == "") {
            document.getElementById("reg-bdate").type = "text";
        }
    });

    $("#reg-bdate").keyup(function() {
        if ($("#reg-bdate").val() == null || $("#reg-bdate").val() == "")
            $("#reg-bdate").css("border", "1px solid #ccc");
        else if($("#reg-pass2").val() == $("#reg-pass1").val())
            $("#reg-pass2").css("border", "2px solid #3fa246");
        else
            $("#reg-pass2").css("border", "2px solid #c21212");
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

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
    function formatAddress(address){
        return address.street + ", " + address.zipcode + ", " +
            address.city + ", " + address.country;
    }

    // Show restaurant location using google maps
    $(function(){
        if ($('div').hasClass('restaurant')) {

            console.log('sim');
            $.ajax ({
                url: "../scripts/get_map_info.php",
                type: "get",
                data: {id : getUrlParameterByName('id')},
                success: function(data) {
                    console.log('sim');
                    var restaurantAddress = formatAddress(data);

                    $('#restaurantmap')
                        .gmap3({
                            address: restaurantAddress,
                            zoom:15
                        })
                        .marker([
                            {address: restaurantAddress}
                        ]);
                }
            });
        }
    });

    // Show review input if a user is logged
    $("#btn-createreview").click(function() {
        $.getJSON("../scripts/session_status.php", function(result){
                if (result.logged) // User is logged
                    $("#addreview").toggle("show");
                else
                    $("#modal-login").show();

        });
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

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

    var user = false;
    var name = false;
    var email = false;
    var password = false;
    var birthdate = false;
    var city = false;
    var country = false;
    var type = false;

    function updateSbtBtn() {
      if(user && name && email && password && birthdate && city && country && type){
        $("#reg-btn").removeAttr("disabled");
          $("#reg-btn").css("background-color", "#c21212");
      }else {
        $("#reg-btn").css("background-color","#8e8e8e");
        $("#reg-btn").attr("disabled", true);
      }

    };

    $("#reg-user").keyup(function() {
        if ($("#reg-user").val() == null || $("#reg-user").val() == ""){
            $("#reg-user").css("border", "1px solid #ccc");
            user = false;
        }else if (/^([A-Za-z0-9]*)$/.test($("#reg-user").val()) && /^\S/.test($("#reg-user").val())){
            $("#reg-user").css("border", "2px solid #3fa246");
            user = true;
        }else{
            $("#reg-user").css("border", "2px solid #c21212");
            user = false;
        }
        updateSbtBtn();
    });

    $("#reg-name").keyup(function() {
        if ($("#reg-name").val() == null || $("#reg-name").val() == ""){
            $("#reg-name").css("border", "1px solid #ccc");
            name = false;
        }else if (/^([^0-9]*)$/.test($("#reg-name").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#reg-name").val()) && /^([A-zÀ-ÿ]*)$/.test($("#reg-user").val())){
            $("#reg-name").css("border", "2px solid #3fa246");
            name = true;
        }else{
            $("#reg-name").css("border", "2px solid #c21212");
            name = false;
        }
        updateSbtBtn();
    });

    $("#reg-mail").blur(function() {
        if ($("#reg-mail").val() == null || $("#reg-mail").val() == ""){
            $("#reg-mail").css("border", "1px solid #ccc");
            email = false;
        }else if (	/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($("#reg-mail").val())){
            $("#reg-mail").css("border", "2px solid #3fa246");
            email = true;
        }else{
            $("#reg-mail").css("border", "2px solid #c21212");
            email = false;
        }
        updateSbtBtn();
    });

    $("#reg-pass2").blur(function() {
        if ($("#reg-pass2").val() == null || $("#reg-pass2").val() == ""){
            $("#reg-pass2").css("border", "1px solid #ccc");
            password = false;
        }else if($("#reg-pass2").val() == $("#reg-pass1").val()){
            $("#reg-pass1").css("border", "2px solid #3fa246");
            $("#reg-pass2").css("border", "2px solid #3fa246");
            password = true;
        }else{
            $("#reg-pass1").css("border", "2px solid #c21212");
            $("#reg-pass2").css("border", "2px solid #c21212");
            password = false;
        }
        updateSbtBtn();
    });

    $("#reg-bdate").focus(function() {
        document.getElementById("reg-bdate").type = "date";
    });

    $("#reg-bdate").blur(function() {
        if ($("#reg-bdate").val() == "") {
            document.getElementById("reg-bdate").type = "text";
            birthdate = false;
        }else{
          $("#reg-bdate").css("border", "2px solid #3fa246");
          birthdate = true;
        }
        updateSbtBtn();
    });

    $("#reg-bdate").keyup(function() {
        if ($("#reg-bdate").val() == null || $("#reg-bdate").val() == ""){
            $("#reg-bdate").css("border", "1px solid #ccc");
            birthdate = false;
        }else{
          $("#reg-bdate").css("border", "2px solid #3fa246");
          birthdate = true;
        }
        updateSbtBtn();
    });

    $("#city").keyup(function() {
        if ($("#city").val() == null || $("#city").val() == ""){
            $("#city").css("border", "1px solid #ccc");
            city = false;
        }else if (/^([^0-9]*)$/.test($("#city").val())){
            $("#city").css("border", "2px solid #3fa246");
            city = true;
        }else{
            $("#city").css("border", "2px solid #c21212");
            city = false;
        }
        updateSbtBtn();
    });

    $(".country").click(function() {
        if ($(".country").val() == null || $(".country").val() == ""){
            $(".country").css("color", "#adadad");
            country = false;
        }else{
          $(".country").css("color", "#000");
          $(".country").css("border", "2px solid #3fa246");
          country = true;
        }
        updateSbtBtn();
    });

    $("#sel-ut").click(function() {
        if ($("#sel-ut").val() == null || $("#sel-ut").val() == ""){
            $("#sel-ut").css("color", "#adadad");
            type = false;
        }else{
          $("#sel-ut").css("color", "#000");
          $("#sel-ut").css("border", "2px solid #3fa246");
          type = true;
        }
        updateSbtBtn();
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

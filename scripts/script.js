$(document).ready(function() {

    $('.bxslider').bxSlider({
        auto: true,
        slideWidth: 700,
        adaptiveHeight: true
    });

    // Unlocks submit button only if a file has been chosen
    $('input:file').change(function() {
        if ($(this).val()) {
            $('input:submit').attr('disabled', false);
            $('input:submit').css('background-color', '#cf2230');
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
            $.ajax({
                url: "../scripts/get_map_info.php",
                type: "get",
                data: {
                    id: getUrlParameterByName('id')
                },
                success: function(data) {
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
            if (result.logged) { // User is logged
                $("#input-ativatereview").toggle();
                $("#btn-createreview").toggle();
                $("#addreview").toggle("show");
                $("#btn-createreviewcancel").toggle("show");
            } else
                $("#modal-login").show();

        });
    });

    $("#input-ativatereview").focus(function() {
        $.getJSON("../scripts/session_status.php", function(result) {
            if (result.logged) { // User is logged
                $("#input-ativatereview").toggle();
                $("#btn-createreview").toggle();
                $("#addreview").toggle("show");
                $("#btn-createreviewcancel").toggle("show");
            } else
                $("#modal-login").show();

        });
    });

    $("#btn-createreviewcancel").click(function() {
        $("#input-ativatereview").toggle();
        $("#btn-createreview").toggle();
        $("#addreview").toggle();
        $("#btn-createreviewcancel").toggle();
    });

    // Show photo input if a user is logged
    $("#btn-addphoto").click(function() {
        $.getJSON("../scripts/session_status.php", function(result) {
            if (result.logged) // User is logged
                $("#modal-uploadrestaurantphoto").toggle("show");
            else
                $("#modal-login").show();

        });
    });

    //validation of the register fields

    var bUser = false;
    var bName = false;
    var bEmail = false;
    var bPassword = false;
    var bBirthdate = false;
    var bCity = false;
    var bCountry = false;
    var bType = false;

    //aux functions

    function updateSbtBtn() {
        if (bUser && bName && bEmail && bPassword && bBirthdate && bCity && bCountry && bType) {
            $("#reg-btn").removeAttr("disabled");
            $("#reg-btn").css("background-color", "#c21212");
        } else {
            $("#reg-btn").css("background-color", "#8e8e8e");
            $("#reg-btn").attr("disabled", true);
        }

    };

    function userAv(user) {
        var tempUser = user;
        $.ajax({
            url: "../scripts/valid_user.php",
            type: "get",
            data: {
                username: tempUser
            },
            success: function(temp) {
                if ($("#reg-user").val() == null || $("#reg-user").val() == "") {
                    bUser = false;
                    $("#reg-user").css("border", "1px solid #ccc");
                } else if (temp == "true" && /^([A-Za-z0-9]*)$/.test($("#reg-user").val()) && /^\S/.test($("#reg-user").val())) {
                    bUser = true;
                    $("#reg-user").css("border", "1px solid #3fa246");
                } else {
                    bUser = false;
                    $("#reg-user").css("border", "1px solid #c21212");
                }
            },
            async: false
        });
    }


    function emailAv(mail) {
        var tempEmail = mail;
        $.ajax({
            url: "../scripts/valid_email.php",
            type: "get",
            data: {
                email: tempEmail
            },
            success: function(temp) {
                if ($("#reg-mail").val() == null || $("#reg-mail").val() == "") {
                    $("#reg-mail").css("border", "1px solid #ccc");
                    bEmail = false;
                } else if (temp == "true" && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($("#reg-mail").val())) {
                    $("#reg-mail").css("border", "1px solid #3fa246");
                    bEmail = true;
                } else {
                    $("#reg-mail").css("border", "1px solid #c21212");
                    bEmail = false;
                }
            },
            async: false

        });
    }

    function dateInRange(date) {

        if (!/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(date))
            return false;
        // Parse the date parts to integers
        var temp = date.split("-");
        var tempDate = new Date();
        var day = parseInt(temp[2]);
        var month = parseInt(temp[1]);
        var year = parseInt(temp[0]);
        if ((tempDate.getYear() + 1900) - year > 18) {
            return true;
        } else if ((tempDate.getYear() + 1900) - year == 18) {
            if (((tempDate.getMonth() + 1) - month) > 0)
                return true;
            else if (((tempDate.getMonth() + 1) - month) == 0) {
                if (tempDate.getDate() - day >= 0)
                    return true;
                else
                    return false;
            }
        } else {
          return false
        }
    }

    //main functions

    $("#reg-user").keyup(function() {
        userAv($("#reg-user").val());
        updateSbtBtn();
    });

    $("#reg-name").keyup(function() {
        if ($("#reg-name").val() == null || $("#reg-name").val() == "") {
            $("#reg-name").css("border", "1px solid #ccc");
            bName = false;
        } else if (/^([^0-9]*)$/.test($("#reg-name").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#reg-name").val()) && /^([A-zÀ-ÿ]*)$/.test($("#reg-user").val())) {
            $("#reg-name").css("border", "1px solid #3fa246");
            bName = true;
        } else {
            $("#reg-name").css("border", "1px solid #c21212");
            bName = false;
        }
        updateSbtBtn();
    });

    $("#reg-mail").keyup(function() {
        emailAv($("#reg-mail").val());
        updateSbtBtn();
    });

    $("#reg-pass2").blur(function() {
        if ($("#reg-pass2").val() == null || $("#reg-pass2").val() == "") {
            $("#reg-pass2").css("border", "1px solid #ccc");
            bPassword = false;
        } else if ($("#reg-pass2").val() == $("#reg-pass1").val()) {
            $("#reg-pass1").css("border", "1px solid #3fa246");
            $("#reg-pass2").css("border", "1px solid #3fa246");
            bPassword = true;
        } else {
            $("#reg-pass1").css("border", "1px solid #c21212");
            $("#reg-pass2").css("border", "1px solid #c21212");
            bPassword = false;
        }
        updateSbtBtn();
    });

    $("#reg-bdate").focus(function() {
        document.getElementById("reg-bdate").type = "date";
    });

    $("#reg-bdate").blur(function() {
        if ($("#reg-bdate").val() == "") {
            document.getElementById("reg-bdate").type = "text";
            $("#reg-bdate").css("border", "1px solid #ccc");
            bBirthdate = false;
        } else if (dateInRange($("#reg-bdate").val())) {
            $("#reg-bdate").css("border", "1px solid #3fa246");
            bBirthdate = true;
        } else {
            $("#reg-bdate").css("border", "1px solid #c21212");
            bBirthdate = false;
        }
        updateSbtBtn();
    });

    $("#reg-bdate").keyup(function() {
        if ($("#reg-bdate").val() == null || $("#reg-bdate").val() == "") {
            $("#reg-bdate").css("border", "1px solid #ccc");
            bBirthdate = false;
        } else if (dateInRange($("#reg-bdate").val())) {
            $("#reg-bdate").css("border", "1px solid #3fa246");
            bBirthdate = true;
        } else {
            $("#reg-bdate").css("border", "1px solid #c21212");
            bBirthdate = false;
        }
        updateSbtBtn();
    });

    $("#city").keyup(function() {
        if ($("#city").val() == null || $("#city").val() == "") {
            $("#city").css("border", "1px solid #ccc");
            bCity = false;
        } else if (/^([^0-9]*)$/.test($("#city").val())) {
            $("#city").css("border", "1px solid #3fa246");
            bCity = true;
        } else {
            $("#city").css("border", "1px solid #c21212");
            bCity = false;
        }
        updateSbtBtn();
    });

    $(".country").click(function() {
        if ($(".country").val() == null || $(".country").val() == "") {
            $(".country").css("color", "#adadad");
            bCountry = false;
        } else {
            $(".country").css("color", "#000");
            $(".country").css("border", "1px solid #3fa246");
            bCountry = true;
        }
        updateSbtBtn();
    });

    $("#sel-ut").click(function() {
        if ($("#sel-ut").val() == null || $("#sel-ut").val() == "") {
            $("#sel-ut").css("color", "#adadad");
            bType = false;
        } else {
            $("#sel-ut").css("color", "#000");
            $("#sel-ut").css("border", "1px solid #3fa246");
            bType = true;
        }
        updateSbtBtn();
    });

    $("#search-type").change(function() {
        switch ($("#search-type").prop('selectedIndex')) {
            case 0:
                $("#searchbar").attr("placeholder", "Procura por restaurante...");
                break;
            case 1:
                $("#searchbar").attr("placeholder", "Procura por localização...");
                break;
            case 2:
                $("#searchbar").attr("placeholder", "Procura por categoria...");
                break;
        }

    });


    var max_fields = 4;
    var x = 0;
    $("#add-field-button").click(function() {
        if (x < max_fields) {
            x++;
            $("#advanced-search").append('' +
                '<div class="filter">' +
                '<select name="filter-type[]" required id="filter-type" class="filter-type">' +
                '<option value="rating">Rating</option>' +
                '<option value="price">Preço</option>' +
                '</select>' +
                '<select name="filter-operator[]" required id="filter-operator" class="filter-operator">' +
                '<option value="equal">=</option>' +
                '<option value="bigger">></option>' +
                '<option value="smaller"><</option>' +
                '<option value="bigger-equal">>=</option>' +
                '<option value="smaller-equal"><=</option>' +
                '</select>' +
                '<input type="number" min="1" max="5" name="amount[]" id="amount" class="amount"/>' +
                '<button class="remove-filter" type="button"><i class="fa fa-times" aria-hidden="true"></button>' +
                '</div>');
        }

        $(".filter").css({
            'display': 'inline-block',
            'vertical-align': 'top',
            'text-align': 'center',
            'font-family': 'Source Sans',
            'margin': '0px 10px 0px 10px'});
        $(".filter-type").css({
            'height': '30px',
            'width': '80px',
            'padding': '5px 5px 5px 5px',
            'margin': '0px'});
        $(".filter-operator").css({
            'height': '30px',
            'width': '40px',
            'padding': '2px 2px 2px 2px',
            'margin': '0px'});
        $(".amount").css({
            'height': '30px',
            'width': '50px',
            'padding': '10px 10px 10px 10px',
            'margin': '0px'});
        $(".remove-filter").css({
            'background-color': '#cf2230',
            'color': '#ffffff',
            'font-size': '10px',
            'height': '20px',
            'width': '20px',
            'vertical-align': 'middle',
            'border-width': '0px',
            'border-radius': '3px',
            'margin': '0px 0px 0px 5px'});
        $(".remove-filter").hover(
            function(){
                $(this).css({'background-color': '#a72230', 'cursor': 'pointer'});},
            function() {
                $(this).css({'background-color': '#cf2230'})});

/*
        .close:hover,
    .close:focus {
        color: #a72230;
        cursor: pointer;
    }*/
    });

    $("#advanced-search").on("click", ".remove-filter", function() { //user click on remove text
        $(this).parent('div').remove();
        x--;
    })

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

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

    // Shows upload user photo dialog
    $("#btn-uploaduserphoto").click(function() {
        $("#modal-uploaduserphoto").toggle();
    });

    // Shows uoload user photo dialog
    $("#btn-editrestaurantphoto").click(function() {
        $("#modal-uploadrestaurantprofilephoto").toggle();
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
        } else if (/^([^0-9]*)$/.test($("#reg-name").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#reg-name").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#reg-name").val())) {
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

    //edit profile main functions
    //(b)oolean (u)ser (e)dit Name
    var bueName = true;
    var bueBirthdate = true;
    var bueEmail = true;
    var bueCity = true;
    var bueCountry = true;
    var bueOldPass = false;
    var bueNewPass = true;
    var bueNewPass2 = true;
    updateUserEditBtn();

    function updateUserEditBtn() {
        if (bueName && bueBirthdate && bueEmail && bueCity && bueCountry && bueOldPass && bueNewPass && bueNewPass2) {
            $("#subeditprofile").removeAttr("disabled");
            $("#subeditprofile").css("background-color", "#c21212");
        } else {
            $("#subeditprofile").css("background-color", "#8e8e8e");
            $("#subeditprofile").attr("disabled", true);
        }
    }

    $("#edit-user-name").on("keyup", function() {
        if ($("#edit-user-name").val() == null || $("#edit-user-name").val() == "") {
            $("#edit-user-name").css("border", "1px solid #ccc");
            bueName = false;
        } else if (/^([^0-9]*)$/.test($("#edit-user-name").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#edit-user-name").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#edit-user-name").val())) {
            $("#edit-user-name").css("border", "1px solid #3fa246");
            bueName = true;
        } else {
            $("#edit-user-name").css("border", "1px solid #c21212");
            bueName = false;
        }
        updateUserEditBtn();
    });

    $("#edit-user-date").blur(function() {
        if (dateInRange($("#edit-user-date").val())) {
            $("#edit-user-date").css("border", "1px solid #3fa246");
            bueBirthdate = true;
        } else {
            $("#edit-user-date").css("border", "1px solid #c21212");
            bueBirthdate = false;
        }
        updateUserEditBtn();
    });

    $("#edit-user-city").on("keyup", function() {
        if ($("#edit-user-city").val() == null || $("#edit-user-city").val() == "") {
            $("#edit-user-city").css("border", "1px solid #ccc");
            bueCity = false;
        } else if (/^([^0-9]*)$/.test($("#edit-user-city").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#edit-user-city").val()) && /^([A-zÀ-ÿ]*)$/.test($("#edit-user-city").val())) {
            $("#edit-user-city").css("border", "1px solid #3fa246");
            bueCity = true;
        } else {
            $("#edit-user-city").css("border", "1px solid #c21212");
            bueCity = false;
        }
        updateUserEditBtn();
    });

    $("#edit-user-country").val($("#logged-user-country").val());


    $("#edit-user-new-pass").keyup(function() {
        if ($("#edit-user-new-pass").val() == null || $("#edit-user-new-pass").val() == "") {
            $("#edit-user-new-pass").css("border", "1px solid #ccc");
            bueNewPass = true;
            if (($("#edit-user-new-pass2").val() == null || $("#edit-user-new-pass2").val() == "")) {
                bueNewPass2 = true;
            } else {
                bueNewPass2 = false;
            }
        }else {
          bueNewPass = false;
          bueNewPass2 = false;
        }
        updateUserEditBtn();
    });

    $("#edit-user-new-pass2").blur(function() {
        if ($("#edit-user-new-pass2").val() == null || $("#edit-user-new-pass2").val() == "") {
            $("#edit-user-new-pass2").css("border", "1px solid #ccc");
            bueNewPass2 = true;
        } else if ($("#edit-user-new-pass2").val() == $("#edit-user-new-pass").val()) {
            $("#edit-user-new-pass").css("border", "1px solid #3fa246");
            $("#edit-user-new-pass2").css("border", "1px solid #3fa246");
            bueNewPass2 = true;
            bueNewPass = true;
        } else {
            $("#edit-user-new-pass").css("border", "1px solid #c21212");
            $("#edit-user-new-pass2").css("border", "1px solid #c21212");
            bueNewPass2 = false;
        }
        updateUserEditBtn();
    });

    $("#edit-user-new-pass2").blur(function() {
        if ($("#edit-user-new-pass2").val() == null || $("#edit-user-new-pass2").val() == "") {
            $("#edit-user-new-pass2").css("border", "1px solid #ccc");
            bueNewPass2 = true;
        } else if ($("#edit-user-new-pass2").val() == $("#edit-user-new-pass").val()) {
            $("#edit-user-new-pass").css("border", "1px solid #3fa246");
            $("#edit-user-new-pass2").css("border", "1px solid #3fa246");
            bueNewPass2 = true;
            bueNewPass = true;
        } else {
            $("#edit-user-new-pass").css("border", "1px solid #c21212");
            $("#edit-user-new-pass2").css("border", "1px solid #c21212");
            bueNewPass2 = false;
        }
        updateUserEditBtn();
    });

    function emailEditAv(mail) {
        var tempEmail = mail;
        $.ajax({
            url: "../scripts/valid_email.php",
            type: "get",
            data: {
                email: tempEmail
            },
            success: function(temp) {
                if ($("#edit-user-email").val() == null || $("#edit-user-email").val() == "") {
                    $("#edit-user-email").css("border", "1px solid #ccc");
                    bueEmail = false;
                } else if (temp == "true" && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test($("#edit-user-email").val())) {
                    $("#edit-user-email").css("border", "1px solid #3fa246");
                    bueEmail = true;
                } else {
                    $("#edit-user-email").css("border", "1px solid #c21212");
                    bueEmail = false;
                }
            },
            async: false

        });
    }

    $("#edit-user-email").keyup(function() {
        if ($("#edit-user-email").val() == $("#logged-user-email").val()) {
            $("#edit-user-email").css("border", "1px solid #3fa246");
            bueEmail = true;
        }
        else {
            emailEditAv($("#edit-user-email").val());
        }
        updateUserEditBtn();
    });


    function isPassU(pass) {
        var tempPass = pass.val();
        $.ajax({
            url: "../scripts/valid_pass.php",
            type: "post",
            data: {
                password: tempPass
            },
            success: function(temp) {
              if (pass.val() == null || pass.val() == "") {
                  pass.css("border", "1px solid #ccc");
                  bueOldPass = false;
              }else if (temp == "true") {
                  pass.css("border", "1px solid #c21212");
                  bueOldPass = false;
                } else {
                  pass.css("border", "1px solid #3fa246");
                  bueOldPass = true;
                }
            },
            async: false
        });
    }

    function isPassR(pass) {
        var tempPass = pass.val();
        $.ajax({
            url: "../scripts/valid_pass.php",
            type: "post",
            data: {
                password: tempPass
            },
            success: function(temp) {
              if (pass.val() == null || pass.val() == "") {
                  pass.css("border", "1px solid #ccc");
                  brePass = false;
              }else if (temp == "true") {
                  pass.css("border", "1px solid #c21212");
                  brePass = false;
                } else {
                  pass.css("border", "1px solid #3fa246");
                  brePass = true;
                }
            },
            async: false
        });
    }

    $("#edit-user-old-pass").on("blur", function() {
        isPassU($("#edit-user-old-pass"));

        updateUserEditBtn();
    });

    //edit restaurant validation functions
    function updateRestEditBtn() {
        if (breName && breStreet && brePC && breCity && breCountry && brePrice && breOpT && brePass) {
            $("#edit-rest-sbt").removeAttr("disabled");
            $("#edit-rest-sbt").css("background-color", "#c21212");
        } else {
            $("#edit-rest-sbt").css("background-color", "#8e8e8e");
            $("#edit-rest-sbt").attr("disabled", true);
        }
    }

    var breName = true;
    var breStreet = true;
    var brePC = true;
    var breCity = true;
    var breCountry = true;
    var brePrice = true;
    var breOpT = true;
    var brePass = false;
    updateRestEditBtn();

    $("#edit-rest-name").on("keyup", function() {
        if ($("#edit-rest-name").val() == null || $("#edit-rest-name").val() == "") {
            $("#edit-rest-name").css("border", "1px solid #ccc");
            breStreet = false;
        } else if (/^([^0-9]*)$/.test($("#edit-rest-name").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#edit-rest-name").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#edit-rest-name").val())) {
            $("#edit-rest-name").css("border", "1px solid #3fa246");
            breStreet = true;
        } else {
            $("#edit-rest-name").css("border", "1px solid #c21212");
            breStreet = false;
        }
        updateRestEditBtn();
    });

    $("#edit-rest-street").on("keyup", function() {
        if ($("#edit-rest-street").val() == null || $("#edit-rest-street").val() == "") {
            $("#edit-rest-street").css("border", "1px solid #ccc");
            breStreet = false;
        } else if (/^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#edit-rest-street").val()) && /^([A-zÀ-ÿ0-9 ]*)$/.test($("#edit-rest-street").val())) {
            $("#edit-rest-street").css("border", "1px solid #3fa246");
            breStreet = true;
        } else {
            $("#edit-rest-street").css("border", "1px solid #c21212");
            breStreet = false;
        }
        updateRestEditBtn();
    });

    $("#edit-rest-pc").on("keyup", function() {
        if ($("#edit-rest-pc").val() == null || $("#edit-rest-pc").val() == "") {
            $("#edit-rest-pc").css("border", "1px solid #ccc");
            brePC = false;
        } else if (/^\d{4}(?:[-\s]\d{3})?$/.test($("#edit-rest-pc").val())) {
            $("#edit-rest-pc").css("border", "1px solid #3fa246");
            brePC = true;
        } else {
            $("#edit-rest-pc").css("border", "1px solid #c21212");
            brePC = false;
        }
        updateRestEditBtn();
    });


    $("#edit-rest-pass").on("blur", function() {
        isPassR($("#edit-rest-pass"));
        updateRestEditBtn();
    });

    $("#edit-rest-city").on("keyup", function() {
        if ($("#edit-rest-city").val() == null || $("#edit-rest-city").val() == "") {
            $("#edit-rest-city").css("border", "1px solid #ccc");
            breCity = false;
        } else if (/^([^0-9]*)$/.test($("#edit-rest-city").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#edit-rest-city").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#edit-rest-city").val())) {
            $("#edit-rest-city").css("border", "1px solid #3fa246");
            breCity = true;
        } else {
            $("#edit-rest-city").css("border", "1px solid #c21212");
            breCity = false;
        }
        updateRestEditBtn();
    });

    $("#edit-rest-country").on("keyup", function() {
        if ($("#edit-rest-country").val() == null || $("#edit-rest-country").val() == "") {
            $("#edit-rest-country").css("border", "1px solid #ccc");
            breCountry = false;
        } else if (/^([^0-9]*)$/.test($("#edit-rest-country").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#edit-rest-country").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#edit-rest-country").val())) {
            $("#edit-rest-country").css("border", "1px solid #3fa246");
            breCountry = true;
        } else {
            $("#edit-rest-country").css("border", "1px solid #c21212");
            breCountry = false;
        }
        updateRestEditBtn();
    });

    $("#edit-rest-price").on("blur", function() {
        if ($("#edit-rest-price").val() == null || $("#edit-rest-price").val() == "") {
            $("#edit-rest-price").css("border", "1px solid #ccc");
            brePrice = false;
        } else if ($("#edit-rest-price").val() >= 1 && $("#edit-rest-price").val() <= 5) {
            $("#edit-rest-price").css("border", "1px solid #3fa246");
            brePrice = true;
        } else {
            $("#edit-rest-price").css("border", "1px solid #c21212");
            brePrice = false;
        }
        updateRestEditBtn();
    });

    //add restaurant validation functions
    function updateRestAddBtn() {
        console.log("name:" + baeName + " st:" + baeStreet + " pc:" + baePC + " city:" + baeCity + " ctr:" + baeCountry + " price:" + baePrice + " ot:" + baeOpT + " pass:" + baePass);
        if (baeName && baeStreet && baePC && baeCity && baeCountry && baePrice && baeOpT && baePass) {
            $("#add-rest-sbt").removeAttr("disabled");
            $("#add-rest-sbt").css("background-color", "#c21212");
        } else {
            $("#add-rest-sbt").css("background-color", "#8e8e8e");
            $("#add-rest-sbt").attr("disabled", true);
        }
    }

    var baeName = false;
    var baeStreet = false;
    var baePC = false;
    var baeCity = false;
    var baeCountry = false;
    var baePrice = false;
    var baeOpT = true;
    var baePass = false;
    updateRestAddBtn();

    function isPassAR(pass) {
        var tempPass = pass.val();
        $.ajax({
            url: "../scripts/valid_pass.php",
            type: "post",
            data: {
                password: tempPass
            },
            success: function(temp) {
              if (pass.val() == null || pass.val() == "") {
                  pass.css("border", "1px solid #ccc");
                  baePass = false;
              }else if (temp == "true") {
                  pass.css("border", "1px solid #c21212");
                  baePass = false;
                } else {
                  pass.css("border", "1px solid #3fa246");
                  baePass = true;
                }
            },
            async: false
        });
    }

    $("#add-rest-name").on("keyup", function() {
        if ($("#add-rest-name").val() == null || $("#add-rest-name").val() == "") {
            $("#add-rest-name").css("border", "1px solid #ccc");
            baeName = false;
        } else if (/^([^0-9]*)$/.test($("#add-rest-name").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#add-rest-name").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#add-rest-name").val())) {
            $("#add-rest-name").css("border", "1px solid #3fa246");
            baeName = true;
        } else {
            $("#add-rest-name").css("border", "1px solid #c21212");
            baeName = false;
        }
        updateRestAddBtn();
    });

    $("#add-rest-street").on("keyup", function() {
        if ($("#add-rest-street").val() == null || $("#add-rest-street").val() == "") {
            $("#add-rest-street").css("border", "1px solid #ccc");
            baeStreet = false;
        } else if (/^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#add-rest-street").val()) && /^([A-zÀ-ÿ0-9 ]*)$/.test($("#add-rest-street").val())) {
            $("#add-rest-street").css("border", "1px solid #3fa246");
            baeStreet = true;
        } else {
            $("#add-rest-street").css("border", "1px solid #c21212");
            baeStreet = false;
        }
        updateRestAddBtn();
    });

    $("#add-rest-pc").on("keyup", function() {
        if ($("#add-rest-pc").val() == null || $("#add-rest-pc").val() == "") {
            $("#add-rest-pc").css("border", "1px solid #ccc");
            baePC = false;
        } else if (/^\d{4}(?:[-\s]\d{3})?$/.test($("#add-rest-pc").val())) {
            $("#add-rest-pc").css("border", "1px solid #3fa246");
            baePC = true;
        } else {
            $("#add-rest-pc").css("border", "1px solid #c21212");
            baePC = false;
        }
        updateRestAddBtn();
    });


    $("#add-rest-pass").on("blur", function() {
        isPassR($("#add-rest-pass"));
        updateRestAddBtn();
    });

    $("#add-rest-city").on("keyup", function() {
        if ($("#add-rest-city").val() == null || $("#add-rest-city").val() == "") {
            $("#add-rest-city").css("border", "1px solid #ccc");
            baeCity = false;
        } else if (/^([^0-9]*)$/.test($("#add-rest-city").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#add-rest-city").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#add-rest-city").val())) {
            $("#add-rest-city").css("border", "1px solid #3fa246");
            baeCity = true;
        } else {
            $("#add-rest-city").css("border", "1px solid #c21212");
            baeCity = false;
        }
        updateRestAddBtn();
    });

    $("#add-rest-country").on("keyup", function() {
        if ($("#add-rest-country").val() == null || $("#add-rest-country").val() == "") {
            $("#add-rest-country").css("border", "1px solid #ccc");
            baeCountry = false;
        } else if (/^([^0-9]*)$/.test($("#add-rest-country").val()) && /^([^.,\/#!$%\^&\*;:{}=\-+_`~()]*)$/.test($("#add-rest-country").val()) && /^([A-zÀ-ÿ ]*)$/.test($("#add-rest-country").val())) {
            $("#add-rest-country").css("border", "1px solid #3fa246");
            baeCountry = true;
        } else {
            $("#add-rest-country").css("border", "1px solid #c21212");
            baeCountry = false;
        }
        updateRestAddBtn();
    });

    $("#add-rest-price").on("blur", function() {
        if ($("#add-rest-price").val() == null || $("#add-rest-price").val() == "") {
            $("#add-rest-price").css("border", "1px solid #ccc");
            baePrice = false;
        } else if ($("#add-rest-price").val() >= 1 && $("#add-rest-price").val() <= 5) {
            $("#add-rest-price").css("border", "1px solid #3fa246");
            baePrice = true;
        } else {
            $("#add-rest-price").css("border", "1px solid #c21212");
            baePrice = false;
        }
        updateRestAddBtn();
    });

    $("#add-rest-pass").on("blur", function() {
        isPassAR($("#add-rest-pass"));
        updateRestAddBtn();
    });

    //-------------------------------------------------------------


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
            $('' +
                '<div class="filter">' +
                '<select name="filter-type[]" required id="filter-type" class="filter-type">' +
                '<option value="rating">Avaliação</option>' +
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
                '</div>').appendTo("#advanced-search").css({
                'width': '0px',
                'white-space': 'nowrap'
            }).hide().animate({
                width: '250px'
            }, 400);
        }

        $(".filter").css({
            'display': 'inline-block',
            'vertical-align': 'top',
            'text-align': 'center',
            'font-family': 'Source Sans',
            'margin': '0px 10px 0px 10px'
        });
        $(".filter-type").css({
            'height': '30px',
            'width': '100px',
            'padding': '5px 5px 5px 5px',
            'margin': '0px',
            'color': '#000',
            'background-color': 'rgba(255, 255, 255, 0.85098)'
        });
        $(".filter-operator").css({
            'height': '30px',
            'width': '60px',
            'padding': '2px 2px 2px 2px',
            'margin': '0px',
            'color': '#000',
            'background-color': 'rgba(255, 255, 255, 0.85098)'
        });
        $(".amount").css({
            'height': '30px',
            'width': '80px',
            'padding': '10px 10px 10px 10px',
            'margin': '0px',
            'color': '#000',
            'background-color': 'rgba(255, 255, 255, 0.85098)'
        });
        $(".remove-filter").css({
            'background-color': '#cf2230',
            'color': '#ffffff',
            'font-size': '10px',
            'height': '20px',
            'width': '20px',
            'vertical-align': 'middle',
            'border-width': '0px',
            'border-radius': '3px',
            'margin': '0px 0px 0px 5px'
        });
        $(".remove-filter").hover(
            function() {
                $(this).css({
                    'background-color': '#a72230',
                    'cursor': 'pointer'
                });
            },
            function() {
                $(this).css({
                    'background-color': '#cf2230'
                })
            });

    });

    $("#advanced-search").on("click", ".remove-filter", function() { //user click on remove text
        $parent = $(this).parent('div')

        $parent.animate({
                width: '0px'
            },
            400,
            "linear",
            function() {
                $parent.remove();
            });
        x--;
    })

    $("#order-type, #order-orientation").change(function() {
        var type = document.getElementById("order-type").selectedIndex;
        var orient = document.getElementById("order-orientation").selectedIndex;

        $.ajax({
            type: "post",
            url: "../scripts/change_restaurants.php",
            data: {type: type, orientation: orient},
            async: false,
            success: function(data, textStatus ){
                $string = "../pages/list_restaurants.php";
                $url = window.location.href;
                $split = $url.split(".php");
                $string += $split[1];

                window.location.href = $string;
            }
        });
    });
});
;
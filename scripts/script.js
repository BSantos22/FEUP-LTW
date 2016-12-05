$(document).ready(function() {

    // Show the modal dialog box selected
    $("#userbutton").click(function() {
        $(".modal").show();
    });

    // Hides the modal dialog boxes selected
    $(".close").click(function() {
        $(".modal").hide();
    });

    // Hides the modal dialog boxes selected
    $(".cancelbtn").click(function() {
        $(".modal").hide();
    });

    var modal = document.getElementById('modal-login');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
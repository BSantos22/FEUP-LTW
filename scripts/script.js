$(document).ready(function() {

    // Modal dialog boxes
    // Show the modal dialog box selected
    $("#btn-user").click(function() {
        $(".modal").show();
    });

    // Hides the modal dialog boxes selected
    $(".close").click(function() {
        $(".modal").hide();
    });

    // Hides the modal dialog boxes selected
    $(".btn-cancel").click(function() {
        $(".modal").hide();
    });

    var modal = document.getElementById('modal-login');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // Show review input
    $("#btn-createreview").click(function() {
        var session = document.getElementById('sessionvar').value;

        if (session == 'logged')
            $("#addreview").toggle("show");
        else
            $("#modal-login").show();
    });
});
<?php
    session_start();

    if (!empty($_POST)) {
        $_SESSION['ptype'] = $_SESSION['type'];
        $_SESSION['type'] = $_POST['type'];
        $_SESSION['porientation'] = $_SESSION['orientation'];
        $_SESSION['orientation'] = $_POST['orientation'];
    }
?>
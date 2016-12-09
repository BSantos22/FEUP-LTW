<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/user.php');

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/profilestyle.css";

    require('../templates/header.php');
    require('../templates/profile.php');
    require('../templates/footer.php');
?>
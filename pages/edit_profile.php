<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        else
            header('Location: ' . 'home.php');

    } catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/editprofilestyle.css";

    include ('../templates/header.php');
    include ('../templates/edit_profile.php');
    include ('../templates/footer.php');
?>
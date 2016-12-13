<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    try {
        if (isset($_SESSION['username']))
            updateUser($db, $_SESSION['username'], $_POST['name'], $_POST['birthday'], $_POST['email'], $_POST['city'], $_POST['country']);
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    header('Location: ' . '../pages/profile.php');
?>
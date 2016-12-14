<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/user.php');

    try {
        if (isset($_SESSION['username'])) {
            $user = getUserByUsername($db, $_SESSION['username']);
            $restaurants = getAllRestaurants($db);
        }

        else
            header('Location: ' . 'home.php');
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/addrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/add_restaurant.php');
    require('../templates/footer.php');
?>

<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/restaurant.php');
    require_once ('../database/user.php');

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        $restaurants = getAllRestaurants($db);
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/listrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/list_restaurants.php');
    require('../templates/footer.php');
?>

<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/user.php');
    require_once('../database/countries.php');

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

    $countries = getCountries($db);
    $cssStyle = "../styles/addrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/add_restaurant.php');
    require('../templates/footer.php');
?>

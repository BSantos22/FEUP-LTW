<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/restaurant.php');
    require_once ('../database/user.php');
    require_once('../database/countries.php');

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        if (isset($_GET['search'])) {
            $keywords = preg_split("/[^a-zA-Z0-9À-ỳ]/u", $_GET['search']);
            $restaurants = searchRestaurantsByKeywords($db, $keywords);
        }
        else {
            $restaurants = getAllRestaurants($db);
        }
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $countries = getCountries($db);
    $cssStyle = "../styles/listrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/list_restaurants.php');
    require('../templates/footer.php');
?>

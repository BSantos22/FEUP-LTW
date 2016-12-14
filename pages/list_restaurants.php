<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/restaurant.php');
    require_once ('../database/user.php');

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        if (isset($_GET['search'])) {
            $keywords = preg_split("/[^a-zA-Z0-9À-ỳ]/u", $_GET['search']);
            $restaurants = searchRestaurantsByKeywords($db, $keywords, $_GET['search-type']);
        }
        else {
            $restaurants = getAllRestaurants($db);
        }
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/listrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/list_restaurants.php');
    require('../templates/footer.php');
?>

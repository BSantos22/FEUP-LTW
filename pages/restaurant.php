<?php
    session_start();
    
    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/review.php');
    require_once('../database/user.php');
    require_once('../database/countries.php');

    $id = $_GET['id'];

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        $restaurant = getRestaurantById($db, $id);
        $reviews = getReviewsByRestaurant($db, $id);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $countries = getCountries($db);
    $cssStyle = "../styles/restaurantstyle.css";

    require('../templates/header.php');
    require('../templates/restaurant.php');
    require('../templates/footer.php');
?>

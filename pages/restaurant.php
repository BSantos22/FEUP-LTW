<?php
    session_start();
    
    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/review.php');

    $id = $_GET['id'];

    try {
      $restaurant = getRestaurantById($db, $id);
      $reviews = getReviewByRestaurant($db, $id);
    } catch (PDOException $e) {
      die($e->getMessage());
    }

    $cssStyle = "../styles/restaurantstyle.css";

    require('../templates/header.php');
    require('../templates/restaurant.php');
    require('../templates/footer.php');
?>

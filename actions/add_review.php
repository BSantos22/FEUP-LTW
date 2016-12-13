<?php
    include_once('../database/connection.php');
    include_once('../database/review.php');

    insertReview($db, $_POST['idUsername'], $_POST['idRestaurant'], $_POST['rating'], $_POST['text']);

    $location = "../pages/restaurant.php?id=" . $_POST['idRestaurant'];
    header("Location: " . $location);
?>
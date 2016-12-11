<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/restaurant.php');

    header('Content-Type: application/json');

    $restaurant = getRestaurantById($db, $_GET['id']);

    echo json_encode([
        "name" => $restaurant['name'],
        "street" => $restaurant['street'],
        "zipcode" => $restaurant['zipcode'],
        "city" => $restaurant['city'],
        "country" => $restaurant['country']]);
?>
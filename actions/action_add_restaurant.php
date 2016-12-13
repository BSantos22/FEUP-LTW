<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/restaurant.php');

    try {
        if(isset($_SESSION['username']))
            createRestaurant($db, $_POST['name'], $_SESSION['username'], $_POST['address'], $_POST['zipcode'], $_POST['city'], $_POST['country'], $_POST['category'], $_POST['price'], $_POST['opentime'], $_POST['closetime']);
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    header('Location: ' . '../pages/home.php');
?>
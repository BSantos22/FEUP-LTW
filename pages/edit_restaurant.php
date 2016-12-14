<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/restaurant.php');
    require_once ('../database/user.php');

    $id = $_GET['id'];

    try {
        if (isset($_SESSION['username'])) {
            $user = getUserByUsername($db, $_SESSION['username']);
            $restaurant = getRestaurantById($db, $_GET['id']);
        }

        else
            header('Location: ' . 'home.php');
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/editrestaurantstyle.css";

    require('../templates/header.php');
    require('../templates/edit_restaurant.php');
    require('../templates/footer.php');
?>

<?php
    session_start();
    
    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/user.php');

    $_SESSION['search'] = "";
    $_SESSION['search-type'] = "";

    try {
        if (isset($_SESSION['username']))
            $user = getUserByUsername($db, $_SESSION['username']);

        $restaurants = getAllRestaurants($db);
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/homestyle.css";

    require('../templates/header.php');
    require('../templates/home.php');
    require('../templates/footer.php');
?>

<?php
    session_start();
    
    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/user.php');

    $_SESSION['search'] = "";
    $_SESSION['search-type'] = "";
    $_SESSION['type'] = 0;
    $_SESSION['ptype'] = 0;
    $_SESSION['orientation'] = 0;
    $_SESSION['porientation'] = 0;

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

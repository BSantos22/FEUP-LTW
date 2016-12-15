<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/restaurant.php');
    require_once('../database/review.php');
    require_once('../database/user.php');
    require_once('../database/reply.php');

    try {
        if (isset($_SESSION['username'])) {
            $user = getUserByUsername($db, $_SESSION['username']);

            if ($user['status'] == 'owner') {
                $restaurants = getRestaurantByOwner($db, $_SESSION['username']);
                $replys = getReplyByUser($db, $_SESSION['username']);
            }

            if ($user['status'] == 'reviewer') {
                $reviews = getReviewsByReviewer($db, $_SESSION['username']);
            }
        } else
            header('Location: ' . 'home.php');


    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/profilestyle.css";

    require('../templates/header.php');
    require('../templates/profile.php');
    require('../templates/footer.php');
?>
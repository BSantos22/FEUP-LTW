<?php
    include_once('../database/connection.php');
    include_once('../database/reply.php');

    insertReply($db, $_POST['idReview'], $_POST['idUsername'], $_POST['inputreview']);

    $location = "../pages/restaurant.php?id=" . $_POST['idRestaurant'];
    header("Location: " . $location);
?>
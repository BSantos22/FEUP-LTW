<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    $user = getUserByUsername($db, $_GET['username']);
    echo json_encode($user == false);
?>

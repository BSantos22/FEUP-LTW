<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    $email = getUserByEmail($db, $_GET['tempEmail']);
    echo json_encode($user == false);
?>

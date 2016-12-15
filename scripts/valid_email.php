<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    $tempEmail = getUserByEmail($db, $_GET['email']);
    echo json_encode($tempEmail == false);
?>

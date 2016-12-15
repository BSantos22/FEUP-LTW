<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    try {
        createUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['birthday'], $_POST['city'], $_POST['country'], $_POST['user_type']);
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
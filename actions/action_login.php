<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    if (userExists($db, $_POST['username'], $_POST['password'])){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['user-logged'] = true;
    }

    else if (($loginUser = userEmailExists($db, $_POST['username'], $_POST['password'])) != null){
        $_SESSION['username'] = $loginUser['username'];
        $_SESSION['user-logged'] = true;
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

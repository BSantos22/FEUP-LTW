<?php
    session_start();

    include_once('../database/connection.php');
    include_once('../database/user.php');

    $user = userExists($db, $_SESSION['username'], $_POST['password']);
    echo json_encode($user == false);
?>

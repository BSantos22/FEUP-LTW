<?php
    session_start();

    require_once('../database/connection.php');
    require_once ('../database/user.php');

    try {
        if (isset($_SESSION['username'])) {
            $user = getUserByUsername($db, $_SESSION['username']);

            if ($user['status']!= 'admin'){
                header("Location: pages/home.php");
                die();
            }

            $users = getAllUsers($db);
        }
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

    $cssStyle = "../styles/listusersstyle.css";

    require('../templates/header.php');
    require('../templates/list_users.php');
    require('../templates/footer.php');
?>
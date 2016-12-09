<?php
    session_start();

    if (isset($_SESSION['user-logged']))
        echo json_encode(['logged' => true]);
    else
        echo json_encode(['logged' => false]);
?>

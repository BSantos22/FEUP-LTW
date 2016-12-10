<?php

session_start();

include_once('../database/connection.php');
include_once('../database/user.php');

if ($_POST['submit'] == 'owner') {
    $status = 'owner';
}
else {
    $status = 'reviewer';
}

createUser($db, $_POST['username'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['birthday'], $_POST['city'], $_POST['country'], $status);

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
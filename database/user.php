<?php

function userExists($db, $username, $password) {
    $query = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($username, hash('sha256', $password)));

    return $stmt->fetch() !== false;
}

function getUserByUsername($db, $username) {
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($username));

    return $stmt->fetch();
}

?>





<?php

function userExists($username, $password) {
    global $db;
    $query = "SELECT * FROM User WHERE username = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() !== false;
}
?>

<?php

function userExists($db, $username, $password) {
    $query = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($username, hash('sha256', $password)));

    return $stmt->fetch() !== false;
}

function getAllUsers($db){
    $stmt = $db->prepare('SELECT * FROM user');
    $stmt->execute();

    return $stmt->fetchAll();
}

function userEmailExists($db, $email, $password) {
    $query = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($email, hash('sha256', $password)));

    return $stmt->fetch();
}

function getUserByUsername($db, $username) {
    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($username));

    return $stmt->fetch();
}

function getUserByEmail($db, $email) {
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->execute(array($email));

    return $stmt->fetch();
}

function createUser($db, $username, $name, $email, $password, $birthday, $city, $country, $status) {
    $query = "INSERT INTO user VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->execute(array($username, $name, $email, hash('sha256', $password), $birthday, $city, $country, $status, 'defaultlogo.png'));
}

function updateUser($db, $username, $name, $birthday, $email, $city, $country){
    $stmt = $db->prepare('UPDATE user SET name = ?, birthday = ?, email = ?,  city = ?, country = ? WHERE username = ?');
    $stmt->execute(array($name, $birthday, $email, $city, $country, $username));
}


function updateUserPhoto($db, $username, $photo){
    $stmt = $db->prepare('UPDATE user SET photopath = ? WHERE username = ?');
    $stmt->execute(array($photo, $username));
}

?>

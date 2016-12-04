<?php
function getAllRestaurants($db){
    $stmt = $db->prepare('SELECT * FROM restaurant');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getRestaurantById($db, $id) {
    $stmt = $db->prepare('SELECT * FROM restaurant WHERE id = ?');
    $stmt->execute(array($id));

    return $stmt->fetch();
}

function getRestaurantByName($db, $name) {
    $stmt = $db->prepare('SELECT * FROM restaurant WHERE name = ?');
    $stmt->execute(array($name));
    return $stmt->fetch();
}
?>
<?php

function getAllRestaurants(){
    global $db;
    $stmt = $db->prepare('SELECT * FROM restaurant');
    $stmt->execute();

    return $stmt->fetchAll();
}

?>
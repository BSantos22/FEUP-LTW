<?php
    function getRestaurantPhotoByRestaurant($db, $idRestaurant) {
        $stmt = $db->prepare('SELECT * FROM photo_restaurant WHERE idRestaurant = ?');
        $stmt->execute(array($idRestaurant));

        return $stmt->fetchAll();
    }

    function getRestaurantPhotoByRestaurant1($db, $idRestaurant) {
        $stmt = $db->prepare('SELECT * FROM photo_restaurant LEFT JOIN restaurant on photo_restarurantWHERE idRestaurant = ?');
        $stmt->execute(array($idRestaurant));

        return $stmt->fetchAll();
    }

    function insertRestaurantPhoto($db, $idRestaurant, $name) {
        $query = "INSERT INTO photo_restaurant VALUES(NULL,?,?)";
        $stmt = $db->prepare($query);
        $stmt->execute(array($idRestaurant, $name));
    }
?>
<?php
function getReviewsByRestaurant($db, $id){
    $stmt = $db->prepare('SELECT review.id AS reviewID, review.idReviewer AS idReviewer, review.rating AS rating, review.text AS text, user.name AS username, user.photopath AS usernamephotopath
                          FROM review LEFT JOIN user ON review.idReviewer = user.username WHERE idRestaurant = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function getReviewsByReviewer($db, $username){
    $stmt = $db->prepare('SELECT review.idReviewer AS reviewer, review.rating AS rating, review.text AS text, restaurant.name AS restaurantname, restaurant.id AS restaurantid
                          FROM review LEFT JOIN restaurant ON review.idRestaurant = restaurant.id WHERE idReviewer = ?');
    $stmt->execute(array($username));

    return $stmt->fetchAll();
}

function insertReview($db, $idReviewer, $idRestaurant, $rating, $text) {
    $stmt = $db->prepare('INSERT INTO review VALUES (NULL, ?, ?, ?, ?)');
    $stmt->execute(array($idReviewer, $idRestaurant, $rating, $text));
}
?>
